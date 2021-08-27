<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\InvoiceDetail */

$this->title = $model->product->name;
$this->params['breadcrumbs'][] = ['label' => $model->invoice->subject, 'url' => ['/invoice/view', 'id' => $model->invoice_id]];
$this->params['breadcrumbs'][] = 'Invoice Details - ' . $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="invoice-detail-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['/invoice-detail/update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['/invoice-detail/delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'invoice_id',
            'product_id',
            'qty',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
