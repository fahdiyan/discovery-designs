<?php

use yii\db\Migration;
use app\models\Customer;
use app\models\Product;
use app\models\Invoice;
use app\models\InvoiceDetail;

/**
 * Class m210827_121732_add_default_data_master
 */
class m210827_121732_add_default_data_master extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $customer = new Customer([
            'name' => 'Barrington Publishers',
            'address' => '17 Great Suffolk Street',
            'city' => 'London SE1 0NS',
            'country' => 'United Kingdom',
        ]);

        $customer->save();

        $product1 = new Product([
            'type' => Product::TYPE_SERVICE,
            'name' => 'Design',
            'price' => 230
        ]);
        $product2 = new Product([
            'type' => Product::TYPE_SERVICE,
            'name' => 'Development',
            'price' => 330
        ]);
        $product3 = new Product([
            'type' => Product::TYPE_SERVICE,
            'name' => 'Meetings',
            'price' => 60
        ]);

        $product1->save();
        $product2->save();
        $product3->save();

        $invoice = new Invoice([
            'subject' => 'Spring Marketing Campaign',
            'issue_date' => date("Y-m-d h:i:s", strtotime('06/05/2017')),
            'due_date' => date("Y-m-d h:i:s", strtotime('06/05/2017')),
            'tax' => 10,
            'customer_id' => $customer->id,
        ]);

        $invoice->save();

        $invoiceDetail1 = new InvoiceDetail([
            'invoice_id' => $invoice->id,
            'product_id' => $product1->id,
            'qty' => 41,
        ]);
        $invoiceDetail2 = new InvoiceDetail([
            'invoice_id' => $invoice->id,
            'product_id' => $product2->id,
            'qty' => 57,
        ]);
        $invoiceDetail3 = new InvoiceDetail([
            'invoice_id' => $invoice->id,
            'product_id' => $product3->id,
            'qty' => 4.5,
        ]);

        $invoiceDetail1->save();
        $invoiceDetail2->save();
        $invoiceDetail3->save();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        InvoiceDetail::deleteAll();
        Invoice::deleteAll();
        Customer::deleteAll();
        Product::deleteAll();
    }
}
