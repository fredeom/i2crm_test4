<?php

\frontend\assets\MainAsset::register($this);

?>
<?php $this->beginPage(); ?>
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

    <div class="inside-banner">
        <div class="container">
            <span class="pull-right"><a href="/">Home</a> / <?=$this->title ?></span>
            <h2><?=$this->title ?></h2>
        </div>
    </div>

    <div class="container">
        <div class="spacer">
            <?=$content ?>
        </div>
    </div>

    <?=$this->render("//common/footer") ?>

    <?php $this->endBody(); ?>

  </body>
</html>

<?php $this->endPage(); ?>

