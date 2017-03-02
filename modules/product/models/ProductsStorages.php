<?php

namespace app\modules\product\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "products_to_storages".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $storage_id
 * @property integer $count_product
 *
 */
class ProductsStorages extends ActiveRecord
{

    public $rememberMe = true;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products_to_storages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'product_id', 'storage_id', 'count_product'], 'integer'],
        ];
    }

    public function create($userData)
    {
        $this->product_id = $userData->product_id;
        $this->storage_id = $userData->storage_id;
        $this->count_product = $userData->count_product;

        $this->save();
        return $this;
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('products_to_storages', 'ID'),
            'product_id' => Yii::t('products_to_storages', 'ProductId'),
            'storage_id' => Yii::t('products_to_storages', 'StorageId'),
            'count_product' => Yii::t('products_to_storages', 'CountProduct'),
        ];
    }

    /**
     * Relation with table Products .
     */
    public function getProduct()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id']);
    }
}