<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%customer}}`.
 */
class m210827_111037_create_customer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%customer}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'address' => $this->string()->notNull(),
            'city' => $this->string(),
            'country' => $this->string(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()->defaultValue(null),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%customer}}');
    }
}
