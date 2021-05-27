<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'username',
            'email:email',
            'role',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{promote-admin} <=> {promote-user}',
                'buttons' => [
                    'promote-admin' => function ($url, $model, $key) {
                        return Html::a('Admin', $url);
                    },
                    'promote-user' => function ($url, $model, $key) {
                        return Html::a('User', $url);
                    }
                ]
            ],
        ],
    ]); ?>


</div>
