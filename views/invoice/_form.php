<?php

use app\models\Customer;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Invoice */
/* @var $form yii\widgets\ActiveForm */


$customers = Customer::find()->all();
$listData = ArrayHelper::map($customers, 'id','name');
?>

<div class="invoice-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer_id')->dropDownList($listData) ?>

    <?= $form->field($model, 'tax')->textInput() ?>

    <?= $form->field($model, 'issue_date')->textInput() ?>

    <?= $form->field($model, 'due_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
