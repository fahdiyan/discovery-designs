<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property int $type
 * @property float|null $price
 * @property string $created_at
 * @property string|null $updated_at
 *
 * @property InvoiceDetail[] $invoiceDetails
 */
class Product extends \yii\db\ActiveRecord
{
    /** (Attr: type) type for Service */
    const TYPE_SERVICE = 1;

    /** (Attr: type) type for Product */
    const TYPE_PRODUCT = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'value' => new Expression('NOW()'),
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['type'], 'integer'],
            [['price'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'type' => 'Type',
            'price' => 'Price',
            'created_at' => 'Created',
            'updated_at' => 'Updated',
        ];
    }

    /**
     * Gets query for [[InvoiceDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceDetails()
    {
        return $this->hasMany(InvoiceDetail::className(), ['product_id' => 'id']);
    }

    public static function typeOptions()
    {
        return [
            static::TYPE_SERVICE => 'Service',
            static::TYPE_PRODUCT => 'Product',
        ];
    }
}
