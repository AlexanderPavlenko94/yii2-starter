<?php

use yii\helpers\Html;
use app\assets\AppAsset;
/* @var $this yii\web\View */
/* @var $model app\modules\product\models\Product  */

$this->registerCssFile('@web/css/modules/product/view.css');
$this->registerJsFile('@web/js/modules/product/showcase.js', ['depends' => [AppAsset::className()]]);
?>
<?php foreach ($model as $value): ?>
    <?php //var_dump($value); die; ?>
<div class="row">
    <div class="col-sm-1 col-md-2">
        <div class="thumbnail">
            <?php  $a = Html::img($value->picture, ['alt' => 'hello', 'width' => 50, 'height' => 50]);
            echo $a ?>
                <h3><?= Html::encode("{$value->title}") ?></h3>
                <p><?= Html::encode("{$value->description}") ?></p>
                <?= Html::checkbox('agree', true, ['label' => 'Buy']); ?>
            <?=  Html::button('Delete', ['class' => 'btn btn-primary delete', 'data-id' => $value->id])?>
        </div>
    </div>
</div>
<?php endforeach; ?>

    <p>
        <?= Html::a(Yii::t('product', 'Cancel'), ['index'], ['class' => 'btn btn-default']); ?>
        <?= Html::a(Yii::t('product', 'Buy'), ['index'], ['class' => 'btn btn-default']); ?>
    </p>

