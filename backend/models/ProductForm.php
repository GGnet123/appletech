<?php
namespace backend\models;

use common\models\Products;
use yii\base\Model;

class ProductForm extends Model
{
    public $name;
    public $category_name;
    public $brand_name;
    public $price;
    public $rrp_price;
    public $status;

    public function rules()
    {
        return [
            [['name', 'category_name', 'brand_name', 'status'], 'required'],
            [['name', 'category_name', 'brand_name'], 'string'],
            [['price', 'rrp_price'], 'integer'],
            [['price', 'rrp_price'], 'default', 'value' => 0],
            [['status'], 'integer'],
            ['status', 'in', 'range' => [Products::STATUS_AVAILABLE, Products::STATUS_FOR_ORDER]],
        ];
    }

    public function save() {
        $product = new Products($this->attributes);
        return $product->save();
    }
}