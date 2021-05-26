<?php

namespace frontend\filters;

use \yii\base\ActionFilter;
use \yii\web\HttpException;
use \common\models\Advert;

class FilterAdvert extends ActionFilter
{
  public function beforeAction($action)
  {
    $id = \Yii::$app->request->get("id");
    $model = Advert::findOne($id);
    if (!$model) {
      throw new HttpException(404, "Unknown advert");
    }
    return parent::beforeAction($action);
  }
}