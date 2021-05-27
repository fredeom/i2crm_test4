<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use frontend\widgets\MessageContainerWidget;

$this->title = 'My Yii Application';

$css = <<<CSS

.admin_mark {
  background: #bada55;
}

.grayed {
  background: #aaa;
}

.info {
  color: lightgray;
}

CSS;

$this->registerCss($css, ["type" => "text/css"], "mystyle" );

?>

<div class="site-index">

    <div class="body-content">


        <?php Pjax::begin(['enablePushState' => false]); ?>

        <?= Html::beginForm(['site/send-message'], 'post', ['data-pjax' => '', 'class' => 'form-inline']); ?>
            <div class="form-group">
              <?= Html::submitButton(Yii::$app->user->isGuest ? 'Обновить сообщения' : 'Послать сообщение', ['class' => 'btn btn-lg btn-primary']) ?>
            </div>
            <br/>
            <br/>
            <div class="form-group">
              <?= Yii::$app->user->isGuest ? "" : Html::textarea('text', '', ['class' => 'form-control']) ?>
            </div>
        <?= Html::endForm() ?>

        <?= MessageContainerWidget::widget(['messages' => $messages]) ?>

        <?php Pjax::end(); ?>
    </div>
</div>
