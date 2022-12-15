<?php

namespace backend\models;

class Products extends \common\models\Products
{
    private $specialCategories = ['dell', 'lenovo'];
    public function fields()
    {
        return [
            'id',
            'name',
            'category_name',
            'brand_name',
            'price' => function() {
                return in_array(mb_strtolower($this->brand_name), $this->specialCategories) ? $this->rrp_price : $this->price;
            },
            'status' => function() {
                return Products::$statuses[$this->status];
            },
            'status_code' => function() {
                return $this->status;
            }
        ];
    }
}