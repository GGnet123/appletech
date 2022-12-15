<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "admin.products".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $category_name
 * @property string|null $brand_name
 * @property int|null $price
 * @property int|null $rrp_price
 * @property int|null $status
 */
class Products extends \yii\db\ActiveRecord
{
    const STATUS_AVAILABLE = 1;
    const STATUS_FOR_ORDER = 2;

    public static $statuses = [
        self::STATUS_AVAILABLE => 'В наличии',
        self::STATUS_FOR_ORDER => 'Под заказ',
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin.products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'category_name', 'brand_name', 'status'], 'required'],
            [['price', 'rrp_price'], 'default', 'value' => 0],
            [['price', 'rrp_price', 'status'], 'integer'],
            ['status', 'in', 'range' => [Products::STATUS_AVAILABLE, Products::STATUS_FOR_ORDER]],
            [['name', 'category_name', 'brand_name'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'category_name' => 'Category Name',
            'brand_name' => 'Brand Name',
            'price' => 'Price',
            'rrp_price' => 'Rrp Price',
            'status' => 'Status',
        ];
    }
}
