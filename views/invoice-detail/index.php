<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $invoice \app\models\Invoice */
/* @var $searchModel app\models\InvoiceDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Invoice Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-detail-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Invoice Detail', ['/invoice-detail/create', 'invoice_id' => $invoice->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'invoice_id',
            'product_id',
            'qty',
            'created_at',
            //'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'update' => function($index, $model) {
                        return Html::a(
                            Html::tag('span', '', ['class' => 'glyphicon glyphicon-pencil']),
                            ['/invoice-detail/update', 'id' => $model->id]
                        );
                    },
                    'view' => function($index, $model) {
                        return Html::a(
                            Html::tag('span', '', ['class' => 'glyphicon glyphicon-eye-open']),
                            ['/invoice-detail/view', 'id' => $model->id]
                        );
                    },
                    'delete' => function($index, $model) {
                        return Html::a(
                            Html::tag('span', '', ['class' => 'glyphicon glyphicon-trash']),
                            ['/invoice-detail/delete', 'id' => $model->id],
                            [
                                'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                'data-method' => 'post',
                            ]
                        );
                    }
                ]
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
