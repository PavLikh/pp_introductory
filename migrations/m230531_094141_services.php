<?php

use yii\db\Migration;

/**
 * Class m230531_094141_services
 */
class m230531_094141_services extends Migration
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
    //     echo "m230531_094141_services cannot be reverted.\n";

    //     return false;
    // }

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('services', [
            // 'id' => $this->primaryKey(),
            'id' => 'pk',
            'name' => $this->string(300)->notNull(),
        ]);

        // $this->db->createCommand('ALTER TABLE orders AUTO_INCREMENT=18')->execute();
    }

    public function down()
    {
        $this->dropTable('services');
    }
}
