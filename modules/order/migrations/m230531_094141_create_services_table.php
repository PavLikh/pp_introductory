<?php

use yii\db\Migration;

/**
 * Class m230531_094141_services
 */
class m230531_094141_create_services_table extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('services', [
            'id' => 'pk',
            'name' => $this->string(300)->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('services');
    }
}
