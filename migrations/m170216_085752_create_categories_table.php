<?php

use yii\db\Migration;

/**
 * Handles the creation of table `categories`.
 */
class m170216_085752_create_categories_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('categories', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'created_at' => $this->dateTime(),
            'update_at' => $this->dateTime(),
            'deleted' => $this->boolean(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('categories');
    }
}
