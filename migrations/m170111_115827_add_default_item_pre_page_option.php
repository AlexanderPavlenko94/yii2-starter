<?php

use yii\db\Migration;

class m170111_115827_add_default_item_pre_page_option extends Migration
{
    public function up()
    {
        $this->insert('options', [
            'namespace' => 'grid',
            'key' => 'itemsPrePage',
            'value' => 3,
            'description' => 'Default number of items in the table on page',
        ]);

        $this->insert('options', [
            'namespace' => 'userView',
            'key' => 'productsPrePage',
            'value' => 4,
            'description' => 'Default number of products in the showcase on page',
        ]);
    }

    public function down()
    {
        $this->delete('options', ['namespace' => 'grid', 'key' => 'itemsPrePage'],
            ['namespace' => 'userView', 'key' => 'productsPrePage']);
    }
}
