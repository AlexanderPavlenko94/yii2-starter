<?php

namespace app\modules\product;

use Yii;

/**
 * product module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\product\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (empty(Yii::$app->i18n->translations['product'])) {
            Yii::$app->i18n->translations['product'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => __DIR__ . '/messages',
            ];
        }
    }
}