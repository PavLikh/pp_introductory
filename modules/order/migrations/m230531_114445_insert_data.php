<?php

use yii\db\Migration;

/**
 * Class m230531_114445_insert_data
 */
class m230531_114445_insert_data extends Migration
{
    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $sql = file_get_contents(__DIR__ . '/../sql-scripts/data.sql');
        $this->db->createCommand($sql)->execute();
    }

    public function down()
    {
        $this->truncateTable('orders');
        $this->truncateTable('services');
        $this->truncateTable('users');
    }
}
