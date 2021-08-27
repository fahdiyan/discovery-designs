<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%invoice_detail}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%invoice}}`
 * - `{{%product}}`
 */
class m210827_114124_create_invoice_detail_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%invoice_detail}}', [
            'id' => $this->primaryKey(),
            'invoice_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'qty' => $this->decimal(15, 2)->notNull(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()->defaultValue(null),
        ]);

        // creates index for column `invoice_id`
        $this->createIndex(
            '{{%idx-invoice_detail-invoice_id}}',
            '{{%invoice_detail}}',
            'invoice_id'
        );

        // add foreign key for table `{{%invoice}}`
        $this->addForeignKey(
            '{{%fk-invoice_detail-invoice_id}}',
            '{{%invoice_detail}}',
            'invoice_id',
            '{{%invoice}}',
            'id',
            'CASCADE'
        );

        // creates index for column `product_id`
        $this->createIndex(
            '{{%idx-invoice_detail-product_id}}',
            '{{%invoice_detail}}',
            'product_id'
        );

        // add foreign key for table `{{%product}}`
        $this->addForeignKey(
            '{{%fk-invoice_detail-product_id}}',
            '{{%invoice_detail}}',
            'product_id',
            '{{%product}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%invoice}}`
        $this->dropForeignKey(
            '{{%fk-invoice_detail-invoice_id}}',
            '{{%invoice_detail}}'
        );

        // drops index for column `invoice_id`
        $this->dropIndex(
            '{{%idx-invoice_detail-invoice_id}}',
            '{{%invoice_detail}}'
        );

        // drops foreign key for table `{{%product}}`
        $this->dropForeignKey(
            '{{%fk-invoice_detail-product_id}}',
            '{{%invoice_detail}}'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            '{{%idx-invoice_detail-product_id}}',
            '{{%invoice_detail}}'
        );

        $this->dropTable('{{%invoice_detail}}');
    }
}
