<?php

use yii\db\Migration;

class m170303_164206_add_default_items_products_to_categories extends Migration
{
    public function up()
    {
        $this->insert('products_to_categories', [
            'product_id' => 1,
            'category_id' => 1
        ]);

        $this->insert('products_to_categories', [
            'product_id' => 2,
            'category_id' => 2
        ]);
    }

    public function down()
    {
        $this->delete('categories', ['product_id' => 1, 'category_id' => 1],
            ['product_id' => 2, 'category_id' => 2]);
    }
}
