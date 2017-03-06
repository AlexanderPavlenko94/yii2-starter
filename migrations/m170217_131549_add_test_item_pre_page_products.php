<?php

use yii\db\Migration;

class m170217_131549_add_test_item_pre_page_products extends Migration
{
    public function up()
    {
        $this->insert('products', [
            'title' => 'TV',
            'description' => 'Testing GridProducts',
            'status' => 'in_stock',
        ]);
        $this->insert('products', [
            'title' => 'telephone',
            'description' => 'New Item',
            'status' => 'in_stock',
        ]);
    }

    public function down()
    {
        $this->delete('products', ['title' => 'TV', 'description' => 'Testing GridProducts', 'status' => 'in_stock'],
            ['title' => 'telephone', 'description' => 'New Item', 'status' => 'in_stock']
            );
    }
}
