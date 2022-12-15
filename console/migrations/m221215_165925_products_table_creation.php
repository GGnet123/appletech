<?php

use yii\db\Migration;

/**
 * Class m221215_165925_products_table_creation
 */
class m221215_165925_products_table_creation extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('products', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'category_name' => $this->string(),
            'brand_name' => $this->string(),
            'price' => $this->integer(),
            'rrp_price' => $this->integer(),
            'status' => $this->integer(1)
        ]);

        $this->createIndex('product_status_index', 'products', 'status');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('products');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221215_165925_products_table_creation cannot be reverted.\n";

        return false;
    }
    */
}
