<?php

namespace frontend\controllers;

use \common\models\Message;

class AdminController extends \yii\web\Controller
{
    public function actionUsers()
    {
        $users = \common\models\User::find()->all();
        return $this->render('users', ['users' => $users]);
    }

    public function actionMarked()
    {
        return $this->render('marked', ['messages' => Message::find()->orderBy('created_at asc')->all()]);
    }
}
