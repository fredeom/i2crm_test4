<?php

namespace app\modules\main\controllers;

use common\models\Advert;
use common\models\LoginForm;
use frontend\components\Common;
use frontend\filters\FilterAdvert;
use frontend\models\ContactForm;
use frontend\models\SignupForm;
use yii\base\DynamicModel;
use yii\data\Pagination;
use \yii\web\Response;
use \yii\widgets\ActiveForm;

class MainController extends \yii\web\Controller
{
  public $layout = 'inner';

  public function actions() {
    return [
      'captcha' => [
        'class' => 'yii\captcha\CaptchaAction',
        'fixedVerifyCode' => YII_ENV_TEST ? 'testme': null,
      ],
      'test' => [
        'class' => 'frontend\actions\TestAction',
      ],
      'page' => [
        'class' => 'yii\web\ViewAction',
        'layout' => 'inner',
      ]
    ];
  }

  public function behaviors() {
    return [
      [
        'only' => ['view-advert'],
        'class' => FilterAdvert::class,
      ]
    ];
  }

public function actionFind($propert='',$price='',$apartment = ''){
  $this->layout = 'sell';
  $query = Advert::find();
  $query->filterWhere(['like', 'address', $propert])
      ->orFilterWhere(['like', 'description', $propert])
      ->andFilterWhere(['type' => $apartment]);

  if($price){
    $prices = explode("-",$price);

    if(isset($prices[0]) && isset($prices[1])) {
      $query->andWhere(['between', 'price', $prices[0], $prices[1]]);
    }
    else{
      $query->andWhere(['>=', 'price', $prices[0]]);
    }
  }

  $countQuery = clone $query;
  $pages = new Pagination(['totalCount' => $countQuery->count()]);
  $pages->setPageSize(10);

  $model = $query->offset($pages->offset)->limit($pages->limit)->all();

  $request = \Yii::$app->request;
  return $this->render("find", ['model' => $model, 'pages' => $pages, 'request' => $request]);
}

  public function actionIndex()
  {
      return $this->render('index');
  }

  public function actionRegister() {
    $model = new SignupForm;
    if (\Yii::$app->request->isAjax && $model->load(\Yii::$app->request->post())) {
      \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      return ActiveForm::validate($model);
    }
    if ($model->load(\Yii::$app->request->post()) && $model->signup()) {
      \Yii::$app->session->setFlash('success', 'Registration succeeded');
    }
    return $this->render('register', ['model' => $model]);
  }

  public function actionLogin() {
    $model = new LoginForm;
    if ($model->load(\Yii::$app->request->post()) && $model->login()) {
      return $this->goBack();
    }
    return $this->render('login', ['model' => $model]);
  }

  public function actionLogout() {
    \Yii::$app->user->logout();
    return $this->goHome();
  }

  public function actionContact() {
    $model = new ContactForm;
    //$model->scenario = 'short';
    if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
      $body = " <div>Body: <b> ".$model->body." </b></div>";
      $body .= " <div>Email: <b> ".$model->email." </b></div>";

      if (\Yii::$app->common->sendMail($model->subject, $model->body, $model->email, $model->name)) {
        return 'Send success. <a href="' . \yii\helpers\Url::to('/main') . '">Go back to site</a>';
      } else {
        return 'Send failed. <a href="' . \yii\helpers\Url::to(['main/contact']) . '">Go back to site</a>';
      }
    }

    return $this->render('contact', ['model' => $model]);
  }

  public function actionViewAdvert($id){
    $model = Advert::findOne($id);

    $data = ['name', 'email', 'text'];
    $model_feedback = new DynamicModel($data);
    $model_feedback->addRule('name','required');
    $model_feedback->addRule('email','required');
    $model_feedback->addRule('text','required');
    $model_feedback->addRule('email','email');

    if (\Yii::$app->request->isPost) {
      if ($model_feedback->load(\Yii::$app->request->post()) && $model_feedback->validate()) {
        \Yii::$app->common->sendMail('Subject Advert',$model_feedback->text);
      }
    }

    $user = $model->user;
    $images = Common::getImageAdvert($model, false);

    $current_user = ['email' => '', 'username' => ''];

    if (!\Yii::$app->user->isGuest) {
      $current_user['email'] = \Yii::$app->user->identity->email;
      $current_user['username'] = \Yii::$app->user->identity->username;
    }

    return $this->render('view_advert',[
      'model' => $model,
      'model_feedback' => $model_feedback,
      'images' =>$images,
      'current_user' => $current_user
    ]);
  }
}
