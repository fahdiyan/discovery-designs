<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m210827_112355_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'type' => $this->integer()->notNull(),
            'price' => $this->decimal(15,2)->defaultValue(0),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()->defaultValue(null),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product}}');
    }
}
