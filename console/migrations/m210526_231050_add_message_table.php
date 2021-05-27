<?php

use yii\db\Migration;

/**
 * Class m210526_231050_add_message_table
 */
class m210526_231050_add_message_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->execute("CREATE TABLE \"message\"(
          fk_author INT NULL REFERENCES \"user\"(id),
          message TEXT,
          mark BOOLEAN,
          created_at BIGINT
        )");
      $this->execute("ALTER TABLE \"message\" ADD COLUMN idmessage SERIAL PRIMARY KEY");
    }

    /**
     * {@inheritdoc}
     */
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
