<?php
namespace backend\models;

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
            [['price', 'rrp_price'], 'integer', 'min' => 0],
            [['price', 'rrp_price'], 'default', 'value' => 0],
            [['status'], 'integer'],
            ['status', 'in', 'range' => [\common\models\Products::STATUS_AVAILABLE, \common\models\Products::STATUS_FOR_ORDER]],
        ];
    }

    public function save() {
        $attr = $this->attributes;
        if (in_array(mb_strtolower($attr['brand_name']), Products::$specialBrands) && !$attr['rrp_price']) {
            $attr['rrp_price'] = $attr['price'];
            $attr['price'] = 0;
        }
        $product = new \backend\models\Products($attr);
        return [$product->save(), $product];
    }
}