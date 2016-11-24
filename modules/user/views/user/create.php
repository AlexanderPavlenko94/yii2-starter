<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user app\modules\user\models\Users */

$this->title = Yii::t('app', 'Create Users');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-create">

    <h1><?= Html::encode($this->title); ?></h1>

    <?= $this->render('_form', [
        'user' => $user,
        'authAssignmentModel' => $authAssignmentModel,
        'roles' => $roles,
    ]); ?>

</div>
