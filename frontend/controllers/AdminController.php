<?php

namespace frontend\controllers;

use \common\models\User;
use \common\models\UserSearch;
use \common\models\Message;

class AdminController extends \yii\web\Controller
{
    public function actions()
    {
        return [
            'mark-message' => [
              'class' => \frontend\actions\MarkMessageAction::class,
              'backUrl' => ['admin/marked']
            ]
        ];
    }

    public function actionUsers()
    {
      $searchModel = new UserSearch();
      $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

      return $this->render('users', [
          'searchModel' => $searchModel,
          'dataProvider' => $dataProvider,
      ]);
    }

    public function actionPromoteAdmin()
    {
      return $this->promote(1);
    }

    public function actionPromoteUser()
    {
      return $this->promote(0);
    }

    public function promote($role)
    {
        if (\Yii::$app->request->get('id') != \Yii::$app->user?->id) {
            if (($model = User::findOne(\Yii::$app->request->get('id'))) !== null) {
              $model->role = $role;
              $model->save();
            }
        }
        return $this->redirect(["admin/users"]);
    }

    public function actionMarked()
    {
        return $this->render('marked', [
          'messages' => Message::find()->orderBy('created_at asc')->all(),
          'backUrl' => ['admin/marked']
        ]);
    }
}
