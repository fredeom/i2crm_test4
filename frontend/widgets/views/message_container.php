<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

?>
<?php foreach ($messages as $message): ?>
  <?php if (((!$message->mark || $isAdmin) && !$showOnlyMarked) || ($message->mark && $isAdmin && $showOnlyMarked)): ?>
    <div class="row">
        <div class="col-lg-6">
            <div class="message_wrapper">
              <div class="message_wrapper__message_author"><span class="<?= $message?->user?->isAdmin() ? "admin_mark" : "" ?>"><?= $message?->user?->username ?: "Guest" ?></span></div>
              <div class="message_wrapper__message_content<?= $message->mark && !$showOnlyMarked ? ' grayed' : '' ?>"><?= $message?->message ?></div>
              <?php if ($isAdmin): ?>
                <?php if (!$showOnlyMarked): ?>
                  <?= Html::beginForm(
                        [
                          \Yii::$app->controller->id . '/mark-message',
                          'shouldMark' => true,
                          'idmessage' => $message->idmessage,
                          'page' => $pagination->getPage() + 1,
                        ],
                        'post', ['data-pjax' => '', 'class' => 'form-inline']); ?>
                    <?= Html::submitButton('Incorrect', ['class' => 'btn btn-sm btn-secondary']); ?>
                  <?= Html::endForm() ?>
                <?php endif; ?>
                <div>&nbsp;</div>
                <?= Html::beginForm(
                      [
                        \Yii::$app->controller->id . '/mark-message',
                        'shouldMark' => false,
                        'idmessage' => $message->idmessage,
                        'page' => $pagination->getPage() + 1,
                      ],
                      'post', ['data-pjax' => '', 'class' => 'form-inline']); ?>
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
<?= LinkPager::widget(['pagination' => $pagination]) ?>