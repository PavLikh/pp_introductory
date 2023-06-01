<?php

use yii\db\Migration;

/**
 * Class m230601_090235_CreateTablestatus
 */
class m230531_081420_CreateTableStatus extends Migration
{
    public function up()
    {
        $this->createTable('status', [
            // 'id' => $this->primaryKey(),
            // 'id' => $this->integer()->unique(),
            'id' => $this->tinyInteger(1)->notNull()->unique(),
            'name' => $this->string(300)->notNull()
        ]);
        
        $this->insert('status', [
            'id' => 0,
            'name' => 'Pending'
        ]);
        $this->insert('status', [
            'id' => 1,
            'name' => 'In progress'
        ]);
        $this->insert('status', [
            'id' => 2,
            'name' => 'Completed'
        ]);
        $this->insert('status', [
            'id' => 3,
            'name' => 'Canceled'
        ]);
        $this->insert('status', [
            'id' => 4,
            'name' => 'Fail'
        ]);
       
    }

    public function down()
    {
        $this->dropTable('status');
    }
}
