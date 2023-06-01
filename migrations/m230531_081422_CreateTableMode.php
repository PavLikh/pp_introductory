<?php

use yii\db\Migration;

/**
 * Class m230601_090235_CreateTablestatus
 */
class m230531_081422_CreateTableMode extends Migration
{
    public function up()
    {
        $this->createTable('mode', [
            'id' => $this->tinyInteger(1)->notNull()->unique(),
            'name' => $this->string(300)->notNull()
        ]);
        
        $this->insert('mode', [
            'id' => 0,
            'name' => 'Manual'
        ]);
        $this->insert('mode', [
            'id' => 1,
            'name' => 'Auto'
        ]);      
    }

    public function down()
    {
        $this->dropTable('mode');
    }
}
