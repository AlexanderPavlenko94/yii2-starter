<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

use yii\bootstrap\BootstrapAsset;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\product\models\Product;
use app\modules\product\models\Storage;

$this->registerCssFile('@web/css/modules/product/add.css', ['depends' => [BootstrapAsset::className()]]);

$this->title = Yii::t('product', 'Entered products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-register">
    <h1><?= Html::encode($this->title); ?></h1>

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-2 control-label'],
        ],
    ]);

    $product = Product::find()->all();
    $itemsProduct = ArrayHelper::map($product, 'id', 'title');
    $paramsProduct = [
        'prompt' => 'Choose product'
    ];

    $storage = Storage::find()->all();
    $itemsStorage = ArrayHelper::map($storage, 'id', 'title');
    $paramsStorage = [
        'prompt' => 'Choose storage'
    ];
    ?>

    <?= $form->field($model, 'product_id')->dropDownList($itemsProduct, $paramsProduct); ?>

    <?= $form->field($model, 'storage_id')->dropDownList($itemsStorage, $paramsStorage); ?>

    <?= $form->field($model, 'count_product')->textInput(); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Add'), ['class' => 'btn btn-success']); ?>
        <?= Html::a(Yii::t('product', 'Cancel'), ['index'], ['class' => 'btn btn-default']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>