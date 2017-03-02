<?php

use app\modules\product\models\Product;
use app\widgets\crop\Crop;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $product app\modules\product\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-form">

    <div class="form-group">
        <?= Html::activeLabel($product, 'product') ?>
        <?= Crop::widget([
            'uploadUrl' => '/product/management/upload-avatar',
            'inputLabel' => 'Choose',
            'modalLabel' => 'Set picture',
            'noPhotoUrl' => $product->picture ?: Product::DEFAULT_AVATAR_URL,
            'photoId' => 'product-picture',
        ]) ?>
    </div>

    <div class="form-group">
        <?= Html::button(
            Yii::t('app', 'Delete'),
            ['class' => 'btn btn-danger btn-block button-width', 'id' => 'deletePicture']
        ); ?>
    </div>

    <?php $form = ActiveForm::begin(['id' => 'productForm']); ?>

    <?= $form->field($product, 'title')->textInput(['maxlength' => true]); ?>

    <?= $form->field($product, 'description')->textInput(['maxlength' => true]); ?>

    <?= $form->field($product, 'status')->dropDownList(
        [
            'in_stock' => Yii::t('product', 'In_stock'),
            'absent' => Yii::t('product', 'Absent'),
            'en_route' => Yii::t('product', 'En_route'),
        ]
    ); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Update'), ['class' => 'btn btn-success']); ?>
        <?= Html::a(Yii::t('product', 'Cancel'), ['products'], ['class' => 'btn btn-default']); ?>
    </div>

    <?= Html::activeHiddenInput($product, 'picture', ['id' => 'picture-field']); ?>
    <?php ActiveForm::end(); ?>

</div>