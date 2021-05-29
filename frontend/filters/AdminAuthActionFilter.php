<?php

namespace frontend\filters;

use \yii\base\ActionFilter;
use \common\models\User;
use \yii\web\ForbiddenHttpException;

class AdminAuthActionFilter extends ActionFilter
{
    public function beforeAction($action)
    {
      return User::findOne(\Yii::$app->user?->id)?->isAdmin() ?
                true :
                throw new ForbiddenHttpException(\Yii::t('yii', 'You are not allowed to perform this action.'));
    }
}