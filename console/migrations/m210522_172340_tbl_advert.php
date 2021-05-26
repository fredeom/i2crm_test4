<?php

use yii\db\Migration;

class m210522_172340_tbl_advert extends Migration
{
    public function safeUp()
    {
      $this->execute("
        CREATE TABLE IF NOT EXISTS `advert` (
          `idadvert` int(11) NOT NULL AUTO_INCREMENT,
          `price` mediumint(11) DEFAULT NULL,
          `address` varchar(255) DEFAULT NULL,
          `fk_agent` mediumint(11) DEFAULT NULL,
          `bedroom` smallint(1) DEFAULT NULL,
          `livingroom` smallint(1) DEFAULT NULL,
          `parking` smallint(1) DEFAULT NULL,
          `kitchen` smallint(1) DEFAULT NULL,
          `general_image` varchar(200) DEFAULT NULL,
          `description` text,
          `location` varchar(30) DEFAULT NULL,
          `hot` smallint(1) DEFAULT NULL,
          `sold` smallint(1) DEFAULT NULL,
          `type` varchar(50) DEFAULT NULL,
          `recommend` smallint(1) DEFAULT NULL,
          `created_at` int(11) NOT NULL,
          `updated_at` int(11) NOT NULL,
          PRIMARY KEY (`idadvert`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;
      ");
    }

    public function safeDown()
    {
      $this->dropTable("advert");
      return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210522_172340_tbl_advert cannot be reverted.\n";

        return false;
    }
    */
}
