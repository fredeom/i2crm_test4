<?php

use yii\db\Migration;

/**
 * Class m210526_231050_add_message_table
 */
class m210526_231050_add_message_table extends Migration
{
    public function safeUp()
    {
      $this->createTable("{{%message}}", [
        'idmessage' => $this->primaryKey(),       // "SERIAL PRIMARY KEY",
        'fk_author' => $this->integer()->null(),  // "INT NULL",
        'message' => $this->text(),               // 'TEXT',
        'mark' => $this->boolean(),               // 'BOOLEAN',
        'created_at' => $this->bigInteger()       // 'BIGINT'
      ]);
      $this->addForeignKey('fk1', 'message', 'fk_author', 'user', 'id','CASCADE','CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%message}}');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210526_231050_add_message_table cannot be reverted.\n";

        return false;
    }
    */
}
