<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use \common\widgets\Alert;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(['enablePushState' => false]); ?>
    <?= Alert::widget() ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'username',
            'email:email',
            'role:boolean:Is Admin',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{promote-admin} {promote-user}',
                'buttons' => [
                    'promote-admin' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-arrow-up"></span>',
                                        ['admin/promote-user'],
                                        [
                                          'data-method' => 'post',
                                          'data-params' => [
                                              'role' => 1,
                                              'iduser' => $key
                                          ],
                                          'data-pjax' => true,
                                        ]);
                                      //  Url::to(['admin/promote-user', 'role' => 1, 'iduser' => $key]));
                    },
                    'promote-user' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-arrow-down"></span>',
                                        ['admin/promote-user'],
                                        [
                                          'data-method' => 'post',
                                          'data-params' => [
                                              'role' => 0,
                                              'iduser' => $key
                                          ],
                                          'data-pjax' => true,
                                        ]);
                                      //  Url::to(['admin/promote-user', 'role' => 0, 'iduser' => $key]));
                    }
                ]
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
