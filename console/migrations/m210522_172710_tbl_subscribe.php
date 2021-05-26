<?php

use yii\db\Migration;

class m210522_172710_tbl_subscribe extends Migration
{
    public function safeUp()
    {
      $this->execute("
        CREATE TABLE IF NOT EXISTS `subscribe` (
          `idsubscribe` int(11) NOT NULL AUTO_INCREMENT,
          `email` varchar(50) DEFAULT NULL,
          `date_subscribe` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          PRIMARY KEY (`idsubscribe`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
      ");
    }

    public function safeDown()
    {
      $this->dropTable("subscribe");
      return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210522_172710_tbl_subscribe cannot be reverted.\n";

        return false;
    }
    */
}
