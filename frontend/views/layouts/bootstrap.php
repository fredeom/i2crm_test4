<?php

\frontend\assets\MainAsset::register($this);

$this->beginPage();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <?php $this->registerCsrfMetaTags() ?>
    <?php $this->head() ?>
  </head>
  <body>
    <?php $this->beginBody(); ?>

    <?=$this->render("//common/head") ?>

    <?=$content?>

    <?=$this->render("//common/footer") ?>

    <?php $this->endBody() ?>
  </body>
</html>

<?php $this->endPage() ?>
