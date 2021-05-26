<?php

namespace console\controllers;

class SomeController extends \yii\console\Controller
{
  public function actionIndex()
  {
    $this->stdout("Hello?\n", \yii\helpers\Console::ITALIC);
    echo \yii\console\widgets\Table::widget([
      'headers' => ['Project', 'Status', 'Participant'],
      'rows' => [
        ['Yii', 'OK', '@samdark'],
        ['Yii', 'OK', '@cebe'],
      ],
    ]);
  }
}
