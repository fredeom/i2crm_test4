<?php

namespace app\modules\main\controllers;

use frontend\components\Common;
use yii\web\Controller;
use yii\db\Query;

class DefaultController extends Controller
{
    public $layout = 'bootstrap';

    public function actionIndex()
    {
        $query_advert = (new Query())->from(['ad' => 'advert'])->rightJoin(['u' =>'user'], 'u.id=ad.fk_agent')->orderBy('idadvert desc');
        $command = $query_advert->limit(5);
        $result_general = $command->all();
        $count_general = $command->count();

        $featured = $query_advert->limit(15)->all();
        $recommend_query  = $query_advert->where("recommend = 1")->limit(5);
        $recommend = $recommend_query->all();
        $recommend_count = $recommend_query->count();

        return $this->render('index', [
            'result_general' => $result_general,
            'count_general' => $count_general,
            'featured' => $featured,
            'recommend' => $recommend,
            'recommend_count' => $recommend_count
        ]);
    }

    // public function actionIndex()
    // {
    //     $query = new Query();
    //     $command = $query->from('advert')->orderBy('idadvert desc')->limit(5);
    //     $result_general = $command->all();
    //     $count_general = $command->count();

    //     return $this->render('index', [
    //       'result_general' => $result_general,
    //       'count_general' => $count_general
    //     ]);
    // }

    // public function actionIndex()
    // {
    //     return $this->render('index', ['title' => 'Realestate Bootstrap Theme']);
    // }

    // public function actionService() {
    //   $cache = \Yii::$app->cache;
    //   //$cache->set('test', 1);
    //   echo $cache->get('test');
    // }

    public function actionEvent() {
      $component = \Yii::$app->common;
      $component->on(\frontend\components\Common::EVENT_NOTIFY, [$component, 'notifyAdmin']);
      $component->sendMail('SUBJECT', 'BODY', 'fredeom@ya.ru', 'NAME');
      $component->off(\frontend\components\Common::EVENT_NOTIFY, [$component, 'notifyAdmin']);
    }

    // public function actionImage() {
    //   Image::frame('https://wallpaper-mania.com/wp-content/uploads/2018/09/High_resolution_wallpaper_background_ID_77701324869.jpg', 5, '666', 0)
    //     ->rotate(-8)
    //     ->save(\Yii::getAlias('@webroot') . '/images/image.jpg', ['jpg_quality' => 50]);
    //   return '<img src="/images/image.jpg" />';
    // }

    public function actionLoginData() {
      print \Yii::$app->user->identity->username;
    }
}
