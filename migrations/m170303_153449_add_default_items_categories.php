<?php

use yii\db\Migration;

class m170303_153449_add_default_items_categories extends Migration
{
    public function up()
    {
        $this->insert('categories', [
            'title' => 'TV'
        ]);

        $this->insert('categories', [
            'title' => 'Mobile'
        ]);
    }

    public function down()
    {
        $this->delete('categories', ['title' => 'TV'],
            ['title' => 'Mobile']);
    }
}
