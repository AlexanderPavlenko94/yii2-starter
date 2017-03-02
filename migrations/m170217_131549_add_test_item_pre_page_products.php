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
    }

    public function down()
    {
        $this->delete('products', ['title' => 'TV', 'description' => 'Testing GridProducts', 'status' => 'in_stock']);
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
