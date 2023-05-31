<?php

use yii\db\Migration;

/**
 * Class m230531_110759_users
 */
class m230531_110759_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    // public function safeUp()
    // {

    // }

    /**
     * {@inheritdoc}
     */
    // public function safeDown()
    // {
    //     echo "m230531_110759_users cannot be reverted.\n";

    //     return false;
    // }
    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string(300)->notNull(),
            'last_name' => $this->string(300)->notNull()
        ]);
    }

    public function down()
    {
        $this->dropTable('users');
    }
    
}
