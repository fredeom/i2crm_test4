<?php

namespace frontend\controllers;

use \common\models\User;
use \common\models\UserSearch;
use \common\models\Message;

class AdminController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            [
              'class' => \frontend\filters\AdminAuthActionFilter::class,
              'only' => ['users', 'marked']
            ]
        ];
    }

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
      $this->view->params['isAdmin'] = true;
      $searchModel = new UserSearch();
      $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

      return $this->render('users', [
          'searchModel' => $searchModel,
          'dataProvider' => $dataProvider,
      ]);
    }

    public function actionPromoteAdmin($id)
    {
      return $this->promote(1, $id);
    }

    public function actionPromoteUser($id)
    {
      return $this->promote(0, $id);
    }

    public function promote($role, $id)
    {
        if ($id != \Yii::$app->user?->id) {
            if (($model = User::findOne($id)) !== null) {
              $model->role = $role;
              $model->save();
            }
        }
        return $this->redirect(["admin/users"]);
    }

    public function actionMarked()
    {
        $this->view->params['isAdmin'] = true;
        return $this->render('marked', [
          'messages' => Message::find()->orderBy('created_at asc')->all(),
          'backUrl' => ['admin/marked']
        ]);
    }
}
