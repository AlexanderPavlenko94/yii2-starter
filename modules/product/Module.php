<?php

namespace app\modules\product;

use app\modules\product\models\Cart;
use Yii;
use yii\helpers\ArrayHelper;

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
        Yii::$app->urlManager->addRules(require(__DIR__ . '/config/routes.php'));
        $this->getRepositoryObj();
    }


    /**
     * Load options from database to Yii::$app->params
     */
    protected function getRepositoryObj()
    {
        $repository = Yii::$app->params;
        $cart['cart'] = new Cart();
        Yii::$app->params = ArrayHelper::merge($repository, $cart);
    }
}