<?php

use yii\db\Migration;

/**
 * Class m210526_225932_add_user_roles
 */
class m210526_225932_add_user_roles extends Migration
{
    public function safeUp()
    {
      $this->addColumn('{{%user}}', 'role', $this->integer()->defaultValue(0)); // 0 - casual user; 1 - admin
    }

    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'role');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210526_225932_add_user_roles cannot be reverted.\n";

        return false;
    }
    */
}
