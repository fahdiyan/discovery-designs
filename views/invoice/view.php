<?php

use app\models\InvoiceDetailSearch;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Invoice */
/* @var $searchModel app\models\InvoiceDetailSearch */
/* @var $detail ActiveDataProvider */

$this->title = $model->subject;
$this->params['breadcrumbs'][] = ['label' => 'Invoices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="invoice-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'subject',
            'customer_id',
            'tax',
            'issue_date',
            'due_date',
            'created_at',
            'updated_at',
        ],
    ]) ?>

    <?= $this->render('/invoice-detail/index', [
        'invoice' => $model,
        'searchModel' => $searchModel,
        'dataProvider' => new ActiveDataProvider([
            'query' => InvoiceDetailSearch::find()->where(['invoice_id' => $model->id]),
            'sort' => false,
        ]),
    ]) ?>

</div>
