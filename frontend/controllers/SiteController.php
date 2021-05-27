<?php
namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use \yii\widgets\ActiveForm;
use \common\models\Message;
use \yii\web\Response;
use yii\base\DynamicModel;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
              'class' => 'yii\web\ErrorAction',
              // 'layout' => 'bootstrap',
            ],
            // 'captcha' => [
            //   'class' => 'yii\captcha\CaptchaAction',
            //   'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            // ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
      $messages = Message::find()->orderBy('created_at asc')->all();
      // $model = \common\models\User::find()->all();
      // echo "<pre>";
      // var_dump($model);
      // echo "</pre>";
      // exit(0);
      // try {
      //   //\Yii::$app->db->createCommand("INSERT INTO \"user\" (\"username\",\"auth_key\",\"password_hash\",\"email\",\"created_at\",\"updated_at\") VALUES ('some','gum','hash','a@a.ru', 123, 321)")->execute();
      //   $rows = \Yii::$app->db->createCommand("SELECT * FROM \"user\"")->queryAll();
      //   echo "<pre>";
      //   var_dump($rows);
      //   echo "</pre>";
      //   exit();
      // } catch (Exception $ex) {
      //   var_dump($ex);
      // }
      return $this->render('index', ['messages' => $messages]);
    }

    public function actionSendMessage()
    {
       if (\Yii::$app->request->isAjax && !empty($text = \Yii::$app->request->post("text"))) {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $message = new Message();
        $message->message = $text;
        $message->mark = false;
        $message->fk_author = \Yii::$app->user?->identity?->id;
        $message->save();
      }
      return $this->render('index', ['messages' => Message::find()->orderBy('created_at asc')->all()]);
    }

    public function actionMarkIncorrect()
    {
      return $this->markMessage(true);
    }

    public function actionMarkCorrect()
    {
      return $this->markMessage(false);
    }

    protected function markMessage($isCorrect)
    {
        $idmessage = \Yii::$app->request->post("idmessage");
        if (\Yii::$app->request->isAjax && !empty($idmessage)) {
            Message::find()->where(['idmessage' => $idmessage])->one()->setMark($isCorrect)->save();
            return $this->redirect(['site/index']);//$this->render('index', ['messages' => Message::find()->all()]);
        }
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    // /**
    //  * Displays contact page.
    //  *
    //  * @return mixed
    //  */
    // public function actionContact()
    // {
    //     $model = new ContactForm();
    //     if ($model->load(Yii::$app->request->post()) && $model->validate()) {
    //         if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
    //             Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
    //         } else {
    //             Yii::$app->session->setFlash('error', 'There was an error sending your message.');
    //         }

    //         return $this->refresh();
    //     } else {
    //         return $this->render('contact', [
    //             'model' => $model,
    //         ]);
    //     }
    // }

    // /**
    //  * Displays about page.
    //  *
    //  * @return mixed
    //  */
    // public function actionAbout()
    // {
    //     return $this->render('about');
    // }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $model->signup()) {
                Yii::$app->session->setFlash('success', 'Thank you for registration.');
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Registration failed.');
            }
        } 

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    // /**
    //  * Requests password reset.
    //  *
    //  * @return mixed
    //  */
    // public function actionRequestPasswordReset()
    // {
    //     $model = new PasswordResetRequestForm();
    //     if ($model->load(Yii::$app->request->post()) && $model->validate()) {
    //         if ($model->sendEmail()) {
    //             Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

    //             return $this->goHome();
    //         } else {
    //             Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
    //         }
    //     }

    //     return $this->render('requestPasswordResetToken', [
    //         'model' => $model,
    //     ]);
    // }

    // /**
    //  * Resets password.
    //  *
    //  * @param string $token
    //  * @return mixed
    //  * @throws BadRequestHttpException
    //  */
    // public function actionResetPassword($token)
    // {
    //     try {
    //         $model = new ResetPasswordForm($token);
    //     } catch (InvalidArgumentException $e) {
    //         throw new BadRequestHttpException($e->getMessage());
    //     }

    //     if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
    //         Yii::$app->session->setFlash('success', 'New password saved.');

    //         return $this->goHome();
    //     }

    //     return $this->render('resetPassword', [
    //         'model' => $model,
    //     ]);
    // }

    // /**
    //  * Verify email address
    //  *
    //  * @param string $token
    //  * @throws BadRequestHttpException
    //  * @return yii\web\Response
    //  */
    // public function actionVerifyEmail($token)
    // {
    //     try {
    //         $model = new VerifyEmailForm($token);
    //     } catch (InvalidArgumentException $e) {
    //         throw new BadRequestHttpException($e->getMessage());
    //     }
    //     if ($user = $model->verifyEmail()) {
    //         if (Yii::$app->user->login($user)) {
    //             Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
    //             return $this->goHome();
    //         }
    //     }

    //     Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
    //     return $this->goHome();
    // }

    // /**
    //  * Resend verification email
    //  *
    //  * @return mixed
    //  */
    // public function actionResendVerificationEmail()
    // {
    //     $model = new ResendVerificationEmailForm();
    //     if ($model->load(Yii::$app->request->post()) && $model->validate()) {
    //         if ($model->sendEmail()) {
    //             Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
    //             return $this->goHome();
    //         }
    //         Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
    //     }

    //     return $this->render('resendVerificationEmail', [
    //         'model' => $model
    //     ]);
    // }
}
