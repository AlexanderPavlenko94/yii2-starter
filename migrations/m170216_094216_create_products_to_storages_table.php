<?php

use yii\db\Migration;

/**
 * Handles the creation of table `products_to_storages`.
 */
class m170216_094216_create_products_to_storages_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('products_to_storages', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'storage_id' => $this->integer(),
            'count_product' => $this->integer(),
        ]);

        $this->addForeignKey('fk_product_storage_id', 'products_to_storages', 'product_id', 'products', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk_storage_id', 'products_to_storages', 'storage_id', 'storages', 'id', 'cascade', 'cascade');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('products_to_storages');
    }
}
