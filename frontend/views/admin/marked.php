<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

$css = <<<CSS

.info {
  color: lightgray;
}

CSS;

$this->registerCss($css, ["type" => "text/css"], "mynextstyle" );

?>
<?php Pjax::begin(['enablePushState' => false]); ?>
<?php foreach ($messages as $message): ?>
  <?php if ($message->mark): ?>
    <div class="row">
      <div class="col-lg-6">
        <div style="display:flex; flex-flow: row nowrap; justify-content: flex-start; align-items:flex-start;">
          <div style="padding-right: 10px;"><span class="<?= $message?->user?->isAdmin() ? "admin_mark" : "" ?>"><?= $message?->user?->username ?: "Guest" ?></span></div>
          <div style="max-width: 400px; padding-right: 10px;"><?= $message?->message ?></div>
          <?= Html::beginForm(['site/mark-correct'], 'post', ['data-pjax' => '', 'class' => 'form-inline']); ?>
            <?= Html::hiddenInput('idmessage', $message->idmessage) ?>
            <?= Html::submitButton('Correct', ['class' => 'btn btn-sm btn-secondary']); ?>
          <?= Html::endForm() ?>
          <div class="info"><?= $message?->idmessage ?>&nbsp;</div>
          <div class="info"><?= $message?->fk_author ?>&nbsp;</div>
          <div class="info"><?= $message?->mark ?>&nbsp;</div>
        </div>
    </div>
    </div>
  <?php endif; ?>
<?php endforeach; ?>
<?php Pjax::end(); ?>