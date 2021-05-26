<?php

use \yii\bootstrap\ActiveForm;
use \yii\helpers\Url;
use \yii\helpers\Html;

?>

<?php $form = ActiveForm::begin([
        'enableAjaxValidation' => true,
        'validationUrl' => Url::to(['/validate/subscribe']),
        'options' => ['class' => 'form-inline']
      ]);
?>
<?= $form->field($model, 'email')->textInput(['placeholder' => 'Enter Your email address'])->label(false) ?>

<?= Html::submitButton('Notify Me!', ['class' => 'btn btn-success']) ?>

<?php ActiveForm::end(); ?>