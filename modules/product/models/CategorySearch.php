<?php

namespace app\modules\product\models;

use yii\base\Model;


class CategorySearch extends Category
{
    /**
     * @inheritdoc
     */

    public function rules()
    {
        return [
            [
                [
                    'title',
                    'created_at',
                    'update_at',
                    'deleted',
                ],
                'safe',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public static function getCategoriesObjectsParams()
    {
        $categoriesQuery = CategorySearch::find();
        $categoriesObjectsParams = $categoriesQuery->all();
        foreach ($categoriesObjectsParams as $value) {
            $categoriesTitle[] = $value->id;
        }
        return $categoriesTitle;
    }
}