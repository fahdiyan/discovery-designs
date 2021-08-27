<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%invoice}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%customer}}`
 */
class m210827_113509_create_invoice_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%invoice}}', [
            'id' => $this->primaryKey(),
            'subject' => $this->string()->notNull(),
            'customer_id' => $this->integer()->notNull(),
            'tax' => $this->integer(),
            'issue_date' => $this->timestamp()->defaultValue(null),
            'due_date' => $this->timestamp()->defaultValue(null),
            'created_at' => $this->timestamp()->defaultValue(null),
            'updated_at' => $this->timestamp()->defaultValue(null),
        ]);

        // creates index for column `customer_id`
        $this->createIndex(
            '{{%idx-invoice-customer_id}}',
            '{{%invoice}}',
            'customer_id'
        );

        // add foreign key for table `{{%customer}}`
        $this->addForeignKey(
            '{{%fk-invoice-customer_id}}',
            '{{%invoice}}',
            'customer_id',
            '{{%customer}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%customer}}`
        $this->dropForeignKey(
            '{{%fk-invoice-customer_id}}',
            '{{%invoice}}'
        );

        // drops index for column `customer_id`
        $this->dropIndex(
            '{{%idx-invoice-customer_id}}',
            '{{%invoice}}'
        );

        $this->dropTable('{{%invoice}}');
    }
}
