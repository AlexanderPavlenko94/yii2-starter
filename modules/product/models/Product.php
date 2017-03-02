<?php

namespace app\modules\product\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "products".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $picture
 * @property string $status
 * @property string $created_at
 * @property string $update_at
 * @property string $deleted
 */
class Product extends ActiveRecord
{
    /** Active product status */
    const STATUS_IN_STOCK = 'in_stock';

    /** Blocked product status */
    const STATUS_ABSENT = 'absent';

    /** Created product status */
    const STATUS_EN_ROUTE = 'en_route';

    const DEFAULT_AVATAR_URL = '/img/no_image.png';

    public $rememberMe = true;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['id', 'integer'],
            [['status'], 'string'],
            ['deleted', 'boolean'],
            [['created_at', 'update_at'], 'safe'],
            [['title', 'description', 'picture'], 'string'],

        ];
    }

    /**
     * @param $productData
     * @return Product
     */
    public function create($productData)
    {
        $this->title = $productData->title;
        $this->description = $productData->description;
        $this->picture = self::DEFAULT_AVATAR_URL;

        $this->save();
        return $this;
    }

    /**
     * @inheritdoc
     * @return \yii\db\ActiveQuery the newly created [[ActiveQuery]] instance.
     */
    public static function getProductCategoriesQuery()
    {
        $query = Product::find();

        $query->select(['products.id', 'products.title', 'products.description', 'products.picture'
            ,'products.status', 'products.created_at', 'products.update_at'])
            ->from('products')
            ->leftJoin('products_to_categories', 'products.id = products_to_categories.product_id')
            ->leftJoin('categories', 'products_to_categories.category_id = categories.id');

        return $query;
    }

    /**
     * Relation with table ProductsStorages .
     */
    public function getProductsStorages()
    {
        return $this->hasOne(ProductsStorages::className(), ['product_id' => 'id']);
    }

    /**
     * Relation with table ProductsCategories .
     */
    public function getProductsCategories()
    {
        return $this->hasOne(ProductsCategories::className(), ['product_id' => 'id']);
    }

    /**
     * Get count_product .
     */
    public function getCount($id)
    {
        $modelProductsStorages = ProductsStorages::find()->where(["product_id" => $id])->all();

        if(!empty($modelProductsStorages)){
            $count = 0;
            foreach ($modelProductsStorages as $value)
            {
                $count += $value->count_product;
            }
            return $count;
        }

        return null;
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('product', 'ID'),
            'title' => Yii::t('product', 'Title'),
            'description' => Yii::t('product', 'Description'),
            'status' => Yii::t('product', 'Status'),
            'created_at' => Yii::t('product', 'Added time'),
            'update_at' => Yii::t('product', 'Last update in'),
            'deleted' => Yii::t('product', 'Delete status'),
        ];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
                'value' => date('Y-m-d H:i:s'),
            ],
        ];
    }
    }