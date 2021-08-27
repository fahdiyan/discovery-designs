<?php

use app\models\Product;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\InvoiceDetail */
/* @var $form yii\widgets\ActiveForm */

$products = Product::find()->all();
$listData = ArrayHelper::map($products, 'id','name');
?>

<div class="invoice-detail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'invoice_id')->textInput(['disabled' => true]) ?>

    <?= $form->field($model, 'product_id')->dropDownList($listData) ?>

    <?= $form->field($model, 'qty')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
