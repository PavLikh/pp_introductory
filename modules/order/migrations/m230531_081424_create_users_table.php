<?php

use yii\db\Migration;

/**
 * Class m230531_110759_users
 */
class m230531_081424_create_users_table extends Migration
{
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
