<?php

use yii\db\Migration;

/**
 * Class m210526_223445_email_verification_token
 */
class m210526_223445_email_verification_token extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'verification_token', $this->string()->defaultValue(null));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'verification_token');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210526_223445_email_verification_token cannot be reverted.\n";

        return false;
    }
    */
}
