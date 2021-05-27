<?php use yii\helpers\Html; ?>
<?php foreach ($messages as $message): ?>
  <?php if (((!$message->mark || $isAdmin) && !$showOnlyMarked) || ($message->mark && $isAdmin && $showOnlyMarked)): ?>
    <div class="row">
        <div class="col-lg-6">
            <div style="display:flex; flex-flow: row nowrap; justify-content: flex-start; align-items:flex-start;">
              <div style="padding-right: 10px;"><span class="<?= $message?->user?->isAdmin() ? "admin_mark" : "" ?>"><?= $message?->user?->username ?: "Guest" ?></span></div>
              <div style="max-width: 400px; padding-right: 10px;" class="<?= $message->mark && !$showOnlyMarked ? 'grayed' : '' ?>"><?= $message?->message ?></div>
              <?php if ($isAdmin): ?>
                <?php if (!$showOnlyMarked): ?>
                  <?= Html::beginForm([\Yii::$app->controller->id . '/mark-message', 'shouldMark' => true, 'idmessage' => $message->idmessage], 'post', ['data-pjax' => '', 'class' => 'form-inline']); ?>
                    <?= Html::hiddenInput('idmessage', $message->idmessage) ?>
                    <?= Html::submitButton('Incorrect', ['class' => 'btn btn-sm btn-secondary']); ?>
                  <?= Html::endForm() ?>
                <?php endif; ?>
                <div>&nbsp;</div>
                <?= Html::beginForm([\Yii::$app->controller->id . '/mark-message', 'shouldMark' => false, 'idmessage' => $message->idmessage], 'post', ['data-pjax' => '', 'class' => 'form-inline']); ?>
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