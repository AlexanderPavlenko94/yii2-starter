<?php

namespace app\modules\product\models\forms;

use yii\base\Model;

/**
 * Class SearchForm
 *
 * @package app\modules\product\models\forms
 *
 * @property string $items
 * @property string $search_key
 * @property string $search_value
 */
class SearchForm extends Model
{
    public $items;
    public $search_key;
    public $search_value;

    public function rules()
    {
        return [
            [['search_key','search_value'], 'string']
        ];
    }
}