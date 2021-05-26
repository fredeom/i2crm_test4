<?php
/* @var $this yii\web\View */
echo "<pre>";
var_dump(Yii::$app->defaultRoute);
echo "</pre>";
?>
<h1>test/index</h1>

<p>
    You may change the content of this page by modifying
    the file <code><?= __FILE__; ?></code>.
</p>
<style>
  th, td {
    border: 1px dotted red;
    padding: 5px;
  }
</style>
<table>
  <thead>
    <tr>
      <?php
        foreach ($t->attributeLabels() as $label) {
          echo "<th>$label</th>";
        }
      ?>
    </tr>
  </thead>
  <tbody>
  <?php
        foreach ($t->attributes() as $label) {
          echo "<td>{$t->$label}</td>";
        }
      ?>
  </tbody>
</table>

<img src="<?=$image_url?>"/>