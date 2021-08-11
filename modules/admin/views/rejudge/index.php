<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $rejudge app\modules\admin\models\Rejudge */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Rejudge';
?>

<div class="contest-form">

    <?php $form = ActiveForm::begin(); ?>

    <h3>Re-judgment of the submitted record, fill in one of the following three input boxes</h3>

    <?= $form->field($rejudge, 'problem_id')->hint('Problem ID') ?>

    <?= $form->field($rejudge, 'contest_id')->dropDownList($rejudge->getContestIdList())->hint('Contest ID') ?>

    <?= $form->field($rejudge, 'run_id')->hint('Run ID on status table') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
