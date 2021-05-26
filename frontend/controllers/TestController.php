<?php

namespace frontend\controllers;

use frontend\models\Image;
use common\models\T1;

class TestController extends \yii\web\Controller
{
    public function actionIndex()
    {
      $t = T1::find()->where(['id' => 1])->one();
      $image = Image::getImageUrl();
      return $this->render('index', ['image_url' => $image, 't' => $t]);
    }

}
