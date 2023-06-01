<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m230531_081428_orders
 */
class m230531_081428_orders extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('orders', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'link' => $this->string(300)->notNull(),
            'quantity' => $this->integer()->notNull(),
            'service_id' => $this->integer()->notNull(),
            'status' => $this->tinyInteger(1)->notNull()->comment('0 - Pending, 1 - In progress, 2 - Completed, 3 - Canceled, 4 - Fail'),
            'created_at' => $this->integer()->notNull(),
            'mode' => $this->tinyInteger(1)->notNull()->comment('0 - Manual, 1 - Auto'),
        ]);

        $this->addForeignKey(
            'fk-order-user_id',
            'orders',
            'user_id',
            'users',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-order-status_id',
            'orders',
            'status',
            'status',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-order-mode_id',
            'orders',
            'mode',
            'mode',
            'id',
            'CASCADE'
        );

    }

    public function down()
    {
        $this->dropTable('orders');
    }
}
