<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel app\models\UserSearch */

$this->title = Yii::t('app', 'Users');
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <hr>
    <p>
        <?php Modal::begin([
            'header' => '<h2>' . Yii::t('app', 'ADD MULTI USER') . '</h2>',
            'toggleButton' => ['label' => Yii::t('app', 'ADD MULTI USER'), 'class' => 'btn btn-success'],
        ]);?>
        <?php $form = ActiveForm::begin(['options' => ['target' => '_blank']]); ?>

        <p class="hint-block">1. CREATE BY FORMAT <code>username password</code></p>
        <p class="hint-block">2. Username only use [a-z0-9_], not only number and string length from 4 to 32 chars</p>
        <p class="hint-block">3. Password at least six digits</p>

        <?= $form->field($generatorForm, 'names')->textarea(['rows' => 10])  ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Generate'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
        <?php Modal::end(); ?>

        Selected item：
        <a id="general-user" class="btn btn-success" href="javascript:void(0);">
            Set as normal user
        </a>
        <a id="vip-user" class="btn btn-success" href="javascript:void(0);">
            Set as VIP user
        </a>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'options' => ['id' => 'grid'],
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
                'name' => 'id',
            ],
            'id',
            'username',
            'nickname',
            'email:email',
            [
                'attribute' => 'role',
                'value' => function ($model, $key, $index, $column) {
                    if ($model->role == \app\models\User::ROLE_PLAYER) {
                        return 'PARTICIPATING USER';
                    } else if ($model->role == \app\models\User::ROLE_USER) {
                        return 'GENERAL USER';
                    } else if ($model->role == \app\models\User::ROLE_VIP) {
                        return 'VIP';
                    } else if ($model->role == \app\models\User::ROLE_ADMIN) {
                        return 'ADMIN';
                    }
                    return 'not set';
                },
                'format' => 'raw'
            ],
            // 'status',
            // 'created_at',
            // 'updated_at',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    $this->registerJs('
    $("#general-user").on("click", function () {
        var keys = $("#grid").yiiGridView("getSelectedRows");
        $.post({
           url: "'.\yii\helpers\Url::to(['/admin/user/index', 'action' => \app\models\User::ROLE_USER]).'", 
           dataType: \'json\',
           data: {keylist: keys}
        });
    });
    $("#vip-user").on("click", function () {
        var keys = $("#grid").yiiGridView("getSelectedRows");
        $.post({
           url: "'.\yii\helpers\Url::to(['/admin/user/index', 'action' => \app\models\User::ROLE_VIP]).'", 
           dataType: \'json\',
           data: {keylist: keys}
        });
    });
    ');
    ?>
</div>
