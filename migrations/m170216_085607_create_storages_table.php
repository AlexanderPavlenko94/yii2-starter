<?php

use yii\db\Migration;

/**
 * Handles the creation of table `storages`.
 */
class m170216_085607_create_storages_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('storages', [
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
        $this->dropTable('storages');
    }
}
