<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user app\modules\user\models\Users */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Users',
]) . $user->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $user->id, 'url' => ['view', 'id' => $user->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="users-update">

    <h1><?= Html::encode($this->title); ?></h1>

    <?= $this->render('_form', [
        'user' => $user,
        'authAssignmentModel' => $authAssignmentModel,
        'roles' => $roles,
    ]); ?>

</div>
