<?php

namespace backend\models;

class Products extends \common\models\Products
{
    public function fields()
    {
        return [
            'id',
            'name',
            'category_name',
            'brand_name',
            'price' => function() {
                return in_array(mb_strtolower($this->brand_name), self::$specialBrands) ? $this->rrp_price : $this->price;
            },
            'status',
            'status_name'  => function() {
                return Products::$statuses[$this->status];
            }
        ];
    }
}