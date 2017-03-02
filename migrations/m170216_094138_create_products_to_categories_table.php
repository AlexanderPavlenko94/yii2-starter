<?php

use yii\db\Migration;

/**
 * Handles the creation of table `products_to_categories`.
 */
class m170216_094138_create_products_to_categories_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('products_to_categories', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'category_id' => $this->integer(),
        ]);

        $this->addForeignKey('fk_product_id', 'products_to_categories', 'product_id', 'products', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk_category_id', 'products_to_categories', 'category_id', 'categories', 'id', 'cascade', 'cascade');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('products_to_categories');
    }
}
