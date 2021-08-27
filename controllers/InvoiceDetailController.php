<?php

namespace app\controllers;

use Yii;
use app\models\InvoiceDetail;
use app\models\InvoiceDetailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InvoiceDetailController implements the CRUD actions for InvoiceDetail model.
 */
class InvoiceDetailController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all InvoiceDetail models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InvoiceDetailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'invoice' => null,
        ]);
    }

    /**
     * Displays a single InvoiceDetail model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new InvoiceDetail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($invoice_id = null)
    {
        $model = new InvoiceDetail();
        !empty($invoice_id) && $model->invoice_id = $invoice_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/invoice/view', 'id' => $model->invoice_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing InvoiceDetail model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/invoice/view', 'id' => $model->invoice_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing InvoiceDetail model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $invoice = $model->invoice_id;
        $model->delete();

        return $this->redirect(['/invoice/view', 'id' => $invoice]);
    }

    /**
     * Finds the InvoiceDetail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return InvoiceDetail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InvoiceDetail::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
