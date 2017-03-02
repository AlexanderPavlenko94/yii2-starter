<?php

namespace app\modules\product\models\forms;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use app\modules\product\models\Product;

/**
 * ProductForm is the model behind the update product.
 *
 * @property string $title
 * @property string $description
 * @property string $status
 * @property string $picture
 *
 * @package app\modules\product\models\forms
 */
class ProductForm extends Model
{
    public $title;
    public $description;
    public $status;
    public $picture;

    const SCENARIO_PROFILE = 'profile';

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [
                ['status'], 'in', 'range' => [Product::STATUS_IN_STOCK, Product::STATUS_ABSENT, Product::STATUS_EN_ROUTE],
                'message' => Yii::t('product', 'Status is invalid.'),
            ],
            ['picture', 'string', 'max' => '255'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'title' => Yii::t('product', 'Title'),
            'description' => Yii::t('product', 'Description'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios = ArrayHelper::merge($scenarios,
            [self::SCENARIO_PROFILE => ['title', 'description', 'status', 'picture']]
        );
        return $scenarios;
    }
}
