<?php

use yii\db\Migration;

class m170303_153419_add_default_item_storages extends Migration
{
    public function up()
    {
        $this->insert('storages', [
            'title' => 'MainStorage'
        ]);
    }

    public function down()
    {
        $this->delete('storages', ['title' => 'MainStorage']);
    }
}
