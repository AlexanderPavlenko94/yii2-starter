<?php

namespace app\modules\product\models\forms;

use Yii;
use yii\base\Model;

/**
 * Class EnteredForm
 *
 * @package app\modules\product\models\forms
 *
 * @property string $product_id
 * @property string $storage_id
 * @property string $count_product
 */
class EnteredForm extends Model
{
    public $product_id;
    public $storage_id;
    public $count_product;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['product_id', 'storage_id', 'count_product'], 'required'],
            ['count_product', 'integer']
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'product_id' => Yii::t('product', 'Product'),
            'storage_id' => Yii::t('product', 'Storage'),
            'count_product' => Yii::t('product', 'CountProduct'),
        ];
    }
}
