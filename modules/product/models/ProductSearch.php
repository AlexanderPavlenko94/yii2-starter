<?php

namespace app\modules\product\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public $count = '';

    public function rules()
    {
        return [
            [
                [
                    'title',
                    'description',
                    'picture',
                    'status',
                    'created_at',
                    'update_at',
                    'deleted',
                    'count',
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

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Product::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => Yii::$app->params['grid']['itemsPrePage'],
            ],
            'sort' => [
                'attributes' => ['count'],
                'defaultOrder' => 'created_at DESC',
            ],
        ]);

        $dataProvider->sort->attributes['title'] = [
            'asc' => ['title' => SORT_ASC],
            'desc' => ['title' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'products.title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'picture', $this->picture])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'created_at', $this->created_at])
            ->andFilterWhere(['like', 'update_at', $this->update_at]);

        return $dataProvider;
    }
}