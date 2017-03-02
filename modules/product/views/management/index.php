<?php

use app\modules\product\models\Product;
use dosamigos\datepicker\DatePicker;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\product\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Info');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">

    <h1><?= Html::encode($this->title); ?></h1>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => yii\grid\SerialColumn::className()],
            [
                'label' => Yii::t('product', 'Picture'),
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::img($model->picture, [
                        'alt' => Yii::t('product', 'Picture'),
                        'style' => 'width:60px; object-fit:cover;',
                        'class' => 'img-circle',
                    ]);
                },
            ],
            [
                'label' => 'Title',
                'attribute' => 'title',
                'headerOptions' => ['width' => '100'],
                'value' => 'title'
            ],
            [
                'label' => 'Count',
                'attribute' => 'count',
                'headerOptions' => ['width' => '100'],
                'value' => function($model){
                    return $model->getCount($model->id);
                }
            ],
            [
                'label' => 'Description',
                'attribute' => 'description',
                'headerOptions' => ['width' => '100'],
                'value' => 'description'
            ],
            [
                'attribute' => 'status',
                'headerOptions' => ['width' => '120'],
                'content' => function ($model) {
                    $label = Product::STATUS_IN_STOCK === $model->status ? 'success' : 'default';
                    $label = Product::STATUS_ABSENT === $model->status ? 'danger' : $label;
                    $label = Product::STATUS_EN_ROUTE === $model->status ? 'danger' : $label;
                    return "<span class='visible-md-block visible-xs-block
                        visible-sm-block visible-lg-block label label-{$label}'>{$model->status}</span>";
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'status',
                    [
                        Product::STATUS_IN_STOCK => ucfirst(Product::STATUS_IN_STOCK),
                        Product::STATUS_ABSENT => ucfirst(Product::STATUS_ABSENT),
                        Product::STATUS_EN_ROUTE => ucfirst(Product::STATUS_EN_ROUTE),
                    ],
                    ['prompt' => Yii::t('product', 'All'), 'class' => 'form-control']
                ),
            ],
            [
                'attribute' => 'created_at',
                'value' => 'created_at',
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'created_at',
                    'clientOptions' => ['format' => 'yyyy-mm-d']
                ]),
                'format' => 'html',
                'content' => function ($model) {
                    return Yii::$app->formatter->asDatetime($model->created_at);
                },
            ],
            [
                'attribute' => 'update_at',
                'value' => 'update_at',
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'update_at',
                    'clientOptions' => ['format' => 'yyyy-mm-d']
                ]),
                'format' => 'html',
                'content' => function ($model) {
                    return Yii::$app->formatter->asDatetime($model->update_at);
                },
            ],
            [
                'class' => yii\grid\ActionColumn::className(),
                'header' => Yii::t('product', 'Actions'),
                'headerOptions' => ['width' => '35'],
                'contentOptions' => ['style' => 'text-align: center'],
                'template' => '{view} {update}',
            ],
        ],
    ]); ?>

    <div class="form-test">
        <?= Html::a(Yii::t('product', 'Add'), ['entered'], ['class' => 'btn btn-default']); ?>
    </div>
</div>