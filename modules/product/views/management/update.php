<?php

use app\assets\AppAsset;
use yii\bootstrap\BootstrapAsset;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $productForm \app\modules\product\models\forms\ProductForm */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
        'modelClass' => 'Product',
    ]) . $productForm->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $productForm->title, 'url' => ['view', 'id' => $id]];
$this->registerCssFile('@web/css/modules/product/update.css', ['depends' => [BootstrapAsset::className()]]);
$this->registerJsFile('@web/js/modules/product/update.js', ['depends' => [AppAsset::className()]]);

$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="products-update">

    <h1><?= Html::encode($this->title); ?></h1>

    <?= $this->render('_form', [
        'product' => $productForm,
    ]); ?>

</div>
