<?php

use yii\db\Migration;

/**
 * Handles the creation of table `products`.
 */
class m170215_155253_create_products_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('products', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'description' => $this->string(),
            'picture' => $this->string(),
            'status' => "ENUM('in_stock', 'absent', 'en_route') DEFAULT 'in_stock'",
            'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'update_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'deleted' => $this->boolean(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('products');
    }
}
