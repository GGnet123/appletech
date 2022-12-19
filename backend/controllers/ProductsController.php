<?php

namespace backend\controllers;

use backend\models\ProductForm;
use backend\models\Products;
use common\models\Products as CommonProducts;

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
        return Products::find()->orderBy('id')->all();
    }

    public function actionCreate()
    {
        $product = new ProductForm();
        $product->attributes = \Yii::$app->request->post();
        if ($product->validate()) {
            list($success, $newProduct) = $product->save();
            return [
                'success' => $success,
                'errors' => $product->errors,
                'product' => $newProduct
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

    /**
     * @throws \yii\db\Exception
     */
    public function actionBrand($name)
    {
        $name = mb_strtolower($name);
        $priceAttr = in_array($name, Products::$specialBrands) ? 'rrp_price' : 'price';
        $commonSql = "select *
                    from products
                    where lower(brand_name) = :name
                      and status = 1
                    order by {$priceAttr}";
        $mainSql = "with minProduct as ({$commonSql} asc limit 1),
        maxProduct as ({$commonSql} desc limit 1)
        select json_build_object('min', minProduct.*, 'max', maxProduct.*) as products
        from minProduct, maxProduct";
        if ($result = \Yii::$app->getDb()->createCommand($mainSql, [':name' => $name])->queryOne()) {
            $products = json_decode($result['products']);
            return $products->min->idr == $products->max->id ? [new Products($products->min)] : [new Products($products->min), new Products($products->max)];
        }
        return [];
    }
}
