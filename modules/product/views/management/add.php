<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

use yii\bootstrap\BootstrapAsset;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->registerCssFile('@web/css/modules/product/add.css', ['depends' => [BootstrapAsset::className()]]);

$this->title = Yii::t('product', 'Add');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-add">
    <h1><?= Html::encode($this->title); ?></h1>

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
        'id' => 'add-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-2 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'title')->textInput(); ?>

    <?= $form->field($model, 'description')->textInput(); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Add'), ['class' => 'btn btn-success']); ?>
        <?= Html::a(Yii::t('product', 'Cancel'), ['products'], ['class' => 'btn btn-default']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>