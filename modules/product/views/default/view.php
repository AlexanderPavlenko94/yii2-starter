<?php

use app\modules\product\models\Product;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\product\models\Product */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->title;
$this->registerCssFile('@web/css/modules/product/view.css');
?>
<div class="products-view">

    <h1><?= Html::encode($model->title); ?></h1>
    <div class="form-group">
        <?= Html::img(
            $model->picture ? : Product::DEFAULT_AVATAR_URL,
            ['alt' => 'Product picture', 'width' => 200, 'height' => 200, 'class' => 'picture-border']
        ) ?>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'description',
            'status',
            'created_at',
            'update_at',
        ],
    ]); ?>

    <p>
        <?= Html::a(Yii::t('product', 'Cancel'), ['index'], ['class' => 'btn btn-default']); ?>
    </p>

</div>
