<?php

namespace frontend\filters;

use \yii\base\ActionFilter;

class AdminAuthActionFilter extends ActionFilter
{
    public function beforeAction($action)
    {
      return \common\models\User::findOne(\Yii::$app->user?->id)?->isAdmin()
              ??
              throw new \yii\web\ForbiddenHttpException(\Yii::t('yii', 'You are not allowed to perform this action.'));
    }
}