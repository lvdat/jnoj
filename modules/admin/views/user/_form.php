<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'newPassword')->textInput() ?>

    <?= $form->field($model, 'role')->radioList([
        $model::ROLE_PLAYER => 'PARTICIPATING USER',
        $model::ROLE_USER => 'GENERAL USER',
        $model::ROLE_VIP => 'VIP',
        $model::ROLE_ADMIN => 'ADMIN'
    ]) ?>Participating

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
