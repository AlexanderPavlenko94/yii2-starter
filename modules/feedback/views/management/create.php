<?php

use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\feedback\models\Feedback */

$this->title = Yii::t('feedback', 'Create Feedback');
$this->params['breadcrumbs'][] = ['label' => Yii::t('feedback', 'Feedbacks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        If you have business inquiries or other questions, please fill out the following form to contact us.
        Thank you.
    </p>
    <div class="row">
        <div class="feedback-form col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

            <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>


            <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [ 'captchaAction' => '/site/captcha',
                'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
            ]) ?>

            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

</div>
