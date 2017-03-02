<?php

namespace app\modules\product\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "storages".
 *
 * @property integer $id
 * @property string $title
 * @property string $created_at
 * @property string $update_at
 * @property string $deleted
 */
class Storage extends ActiveRecord
{

    public $rememberMe = true;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'storages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['id', 'integer'],
            ['deleted', 'boolean'],
            [['created_at', 'update_at'], 'safe'],
            [['title'], 'string'],

        ];
    }

    public function create($userData)
    {
        $this->title = $userData->title;

        $this->save();
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('storage', 'ID'),
            'title' => Yii::t('storage', 'Title'),
            'created_at' => Yii::t('storage', 'Added time'),
            'update_at' => Yii::t('storage', 'Last update in'),
            'deleted' => Yii::t('storage', 'Delete status'),
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