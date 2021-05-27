<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

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

        <?php foreach ($messages as $message): ?>
          <?php if (!$message->mark || \common\models\User::findOne(\Yii::$app->user->id)?->isAdmin()): ?>
            <div class="row">
                <div class="col-lg-6">
                    <div style="display:flex; flex-flow: row nowrap; justify-content: flex-start; align-items:flex-start;">
                      <div style="padding-right: 10px;"><span class="<?= $message?->user?->isAdmin() ? "admin_mark" : "" ?>"><?= $message?->user?->username ?: "Guest" ?></span></div>
                      <div style="max-width: 400px; padding-right: 10px;" class="<?= $message->mark ? 'grayed' : '' ?>"><?= $message?->message ?></div>
                      <?php if (\common\models\User::findOne(\Yii::$app->user->id)?->isAdmin()): ?>
                        <?= Html::beginForm(['site/mark-incorrect'], 'post', ['data-pjax' => '', 'class' => 'form-inline']); ?>
                          <?= Html::hiddenInput('idmessage', $message->idmessage) ?>
                          <?= Html::submitButton('Incorrect', ['class' => 'btn btn-sm btn-secondary']); ?>
                        <?= Html::endForm() ?>
                        <div>&nbsp;</div>
                        <?= Html::beginForm(['site/mark-correct'], 'post', ['data-pjax' => '', 'class' => 'form-inline']); ?>
                          <?= Html::hiddenInput('idmessage', $message->idmessage) ?>
                          <?= Html::submitButton('Correct', ['class' => 'btn btn-sm btn-secondary']); ?>
                        <?= Html::endForm() ?>
                      <?php endif; ?>
                      <div class="info"><?= $message?->idmessage ?>&nbsp;</div>
                      <div class="info"><?= $message?->fk_author ?>&nbsp;</div>
                      <div class="info"><?= $message?->mark ?>&nbsp;</div>
                    </div>
                </div>
            </div>
          <?php endif; ?>
        <?php endforeach; ?>

        <?php Pjax::end(); ?>
    </div>
</div>
