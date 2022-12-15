<?php

namespace backend\controllers;

use backend\models\ProductForm;
use backend\models\Products;

/**
 * Site controller
 */
class ProductsController extends Controller
{
    protected $optionalAuthActions = ['get', 'brand'];
    protected $noAuthActions = [];

    protected function verbs()
    {
        return [
            'get' => ['GET'],
            'create' => ['POST'],
            'update' => ['PATCH'],
            'brand' => ['GET'],
        ];
    }

    public function actionGet($id = null)
    {
        if ($id) {
            return Products::findOne($id);
        }
        return Products::find()->all();
    }

    public function actionCreate()
    {
        $product = new ProductForm();
        $product->attributes = \Yii::$app->request->post();
        if ($product->validate()) {
            return [
                'success' => $product->save(),
                'error' => $product->errors
            ];
        }
        return ['success' => false, 'errors' => $product->errors];
    }

    public function actionUpdate($id = null)
    {
        $product = Products::findOne($id);
        if (!$product) {
            \Yii::$app->response->setStatusCode(404);
            return ['success' => false, 'error' => 'Not found'];
        }
        $data = \Yii::$app->request->post();
        $product->setAttributes($data);
        if ($product->validate()) {
            return ['success' => $product->save(), 'errors' => $product->errors];
        }
        return ['success' => false, 'errors' => $product->errors];
    }

    public function actionBrand($name)
    {
        return Products::find()->where(['category_name' => $name])->all();
    }
}
