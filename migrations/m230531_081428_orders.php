<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m230531_081428_orders
 */
class m230531_081428_orders extends Migration
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
    //     echo "m230531_081428_orders cannot be reverted.\n";

    //     return false;
    // }

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('orders', [
            'id' => $this->primaryKey(),
            // 'id' => 'pk',
            // 'id' => Schema::TYPE_PK,
            'user_id' => $this->integer()->notNull(),
            // 'user_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'link' => $this->string(300)->notNull(),
            'quantity' => $this->integer()->notNull(),
            // 'quantity' => Schema::TYPE_INTEGER,
            'service_id' => $this->integer()->notNull(),
            // 'service_id' => Schema::TYPE_INTEGER,
            'status' => $this->tinyInteger(1)->notNull()->comment('0 - Pending, 1 - In progress, 2 - Completed, 3 - Canceled, 4 - Fail'),
            'created_at' => $this->integer()->notNull(),
            // 'created_at' => Schema::TYPE_INTEGER,
            'mode' => $this->tinyInteger(1)->notNull()->comment('0 - Manual, 1 - Auto'),
        ]);

    }

    public function down()
    {
        // echo "m230531_081428_orders cannot be reverted.\n";
        $this->dropTable('orders');
    }
}
