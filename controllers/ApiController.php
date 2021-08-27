<?php

namespace app\controllers;

use app\models\Invoice;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Response;

class ApiController extends Controller
{
    private $token = 'a53f2f8bfd99bb78ad7c0de42d80a362cd2caacc0ffeeb2a2e3f84b9c27d142f';

    /**
     * Endpoint to get the result of combine API RS and Kelurahan
     * @return array
     */
    public function actionListInvoice()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        if ($this->validateSignature()) {
            $result = [];

            $model = Invoice::find()->all();

            foreach ($model as $data) {
                $invoice = $data->attributes;
                $invoice = ArrayHelper::merge($invoice, $data->customer->attributes);
                $invoice['items'] = [];

                foreach ($data->invoiceDetails as $items) {
                    $invoiceDetail[$items->product->name] = $items->attributes;
                    $invoiceDetail[$items->product->name] = ArrayHelper::merge(
                        $invoiceDetail[$items->product->name],
                        $items->product->attributes
                    );
                }

                $invoice['items'] = $invoiceDetail;
                $result[] = $invoice;
            }

            return $this->response($result);
        }

        return [
            'status' => 'failed',
            'message' => 'Invalid request',
        ];
    }

    public function actionDetailInvoice($id = null)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        if ($this->validateSignature() && !empty($id)) {
            $model = Invoice::findOne(['id' => $id]);

            if ($model) {
                $invoice = $model->attributes;
                $invoice = ArrayHelper::merge($invoice, $model->customer->attributes);
                $invoice['items'] = [];

                foreach ($model->invoiceDetails as $items) {
                    $invoiceDetail[$items->product->name] = $items->attributes;
                    $invoiceDetail[$items->product->name] = ArrayHelper::merge(
                        $invoiceDetail[$items->product->name],
                        $items->product->attributes
                    );
                }

                $invoice['items'] = $invoiceDetail;

                return $this->response($invoice);
            }

            return [
                'status' => 'failed',
                'message' => 'Data not found',
            ];
        }

        return [
            'status' => 'failed',
            'message' => 'Invalid request',
        ];
    }

    /**
     * Validate incoming request before starting process
     * @return bool
     */
    private function validateSignature()
    {
        $signature = Yii::$app->request->headers->get('Signature');

        return $signature === $this->token;
    }

    /**
     * Setup request response based on result of combine data rumah sakit umum and kelurahan
     * @param $data
     * @return array
     */
    private function response($data)
    {
        $response = [
            'status' => 'failed',
            'count' => 0,
            'data' => null
        ];

        if (!empty($data)) {
            $response = [
                'status' => 'success',
                'count' => count($data),
                'data' => $data
            ];
        }

        return $response;
    }
}