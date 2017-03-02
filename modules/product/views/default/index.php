<?php

use app\assets\AppAsset;
use yii\bootstrap\BootstrapAsset;
use yii\bootstrap\Html;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;

/* @var $searchModels app\modules\product\models\InfoSearch */
/* @var $categoriesModels app\modules\product\models\CategorySearch */
/* @var $formModel app\modules\product\models\forms\SearchForm */
/* @var $pagination */
/* @var $filterParams */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->registerJsFile('@web/js/modules/product/update.js', ['depends' => [AppAsset::className()]]);
$this->registerCssFile('@web/css/modules/product/showcase.css', ['depends' => [BootstrapAsset::className()]]);
?>

<?php $searchForm = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'post',
]); ?>
<div id="wrapper-header">
    <div id="main-header" class="object">
        <?= $searchForm->field($formModel, 'search_value')->textInput()->label('Search') ?>
        <?= $searchForm->field($formModel, 'search_key')->label('Select a search term')
            ->dropDownList([
                    'products.title' => 'Title',
                    'products.description' => 'Description'
            ]) ?>
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-default']); ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-2 col-md-2 container-categories">

<?php foreach ($categoriesModels as $value): ?>
      <?php  $arrayCheckbox[$value->id] = $value->title;?>
<?php endforeach; ?>
<?=  $searchForm->field($formModel, 'items[]')->checkboxList(
        $arrayCheckbox
    ,
        [
            'item'=>function ($index, $label, $name, $checked, $value) use ($filterParams) {
                $checked =  in_array($value,$filterParams) ? 'checked' : '';
            return "<label><input name=\"SearchForm[items][]\" value=\"$value\" $checked type=\"checkbox\"> $label</label>";
            }
        ]
    ); ?>

<?php ActiveForm::end();?>
    </div>
    <div class="col-sm-10">
            <?php foreach ($searchModels as $value): ?>
                <div class="row">
                    <div class="col-sm-4 col-md-3 ">
                        <div class="thumbnail">
                            <?php  $a = Html::img($value->picture, ['alt' => 'hello', 'width' => 300, 'height' => 200]);
                             echo $a ?>
                            <div class="caption">
                                <h3><?= Html::encode("{$value->title}") ?></h3>
                                <p><?= Html::encode("{$value->description}") ?></p>
                                <p><?= Html::a(Yii::t('product', 'More'), ['view', 'id' => $value->id], ['class' => 'btn btn-primary more']); ?>
                                    <?= Html::a(Yii::t('product', 'Buy'), ['cart', 'id' => $value->id], ['class' => 'btn btn-primary buy']); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
<?php endforeach; ?>

            <div class="pagination">
                <?php echo LinkPager::widget([
                  'pagination' => $pagination,
                ]);
                 ?>
            </div>
    </div>
</div>