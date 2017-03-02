<?php

namespace app\modules\product\models\forms;

use app\modules\product\models\Product;
use Yii;
use yii\base\Model;

/**
 * Class AddProductForm
 *
 * @package app\modules\product\models\forms
 *
 * @property string $title
 * @property string $description
 * @property string $picture
 */
class AddProductForm extends Model
{
    public $title;
    public $description;
    public $picture;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['title', 'description'], 'trim'],
            'titleUnique' => [
                'title', 'unique',
                'targetClass' => new Product(),
                'message' => Yii::t('product', 'This title has already been taken.')
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
            'picture' => Yii::t('product', 'Picture'),
        ];
    }
}
