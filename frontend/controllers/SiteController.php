<?php

namespace frontend\controllers;

use Yii;

use yii\base\DynamicModel;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\Pagination;
use yii\helpers\HtmlPurifier;

use common\models\LoginForm;
use common\models\Message;
use common\models\User;

use frontend\models\SignupForm;


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
                        'actions' => ['logout', 'send-message'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'send-message' => ['post'],
                    'mark-message' => ['post'],
                ],
            ]
        ];
    }

    public function actions()
    {
        return [
            'error' => [
              'class' => 'yii\web\ErrorAction',
            ],
            'mark-message' => [
              'class' => \frontend\actions\MarkMessageAction::class,
              'renderCallback' => 'actionIndex'
            ]
        ];
    }

    public function actionIndex()
    {
      $this->view->params['isAdmin'] = User::find()->where(['id' => Yii::$app->user->id])->one()?->isAdmin() ?? false;

      $isAdmin = User::findOne(\Yii::$app->user->id)?->isAdmin() ?? false;
      $query = Message::find();
      if (!$isAdmin) {
        $query = $query->where(['mark' => 0]);
      }
      $query = $query->orderBy(['created_at' => SORT_ASC]);
      $count = $query->count();
      $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 10, 'route' => 'site/index']);
      $pageFromGET = \Yii::$app->request->get('page');
      $pagination->setPage(isset($pageFromGET) ? $pageFromGET - 1 : $pagination->pageCount - 1, true);
      $messages = $query->offset($pagination->offset)->limit($pagination->limit)->all();
      return $this->render('index', [
        'messages' => $messages,
        'isAdmin' => $isAdmin,
        'pagination' => $pagination,
      ]);
    }

    public function actionSendMessage()
    {
       if (\Yii::$app->request->isAjax && !empty($text = HtmlPurifier::process(\Yii::$app->request->post("text")))) {
        //\Yii::$app->response->format = Response::FORMAT_JSON;
        $message = new Message();
        $message->message = $text;
        $message->mark = false;
        $message->fk_author = \Yii::$app->user?->identity?->id;
        $message->save();
      }
      return $this->actionIndex();
    }

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

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

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
}
