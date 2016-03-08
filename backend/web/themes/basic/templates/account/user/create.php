<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '添加用户';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border hidden">
                <h3 class="box-title">账户信息</h3>
            </div>
            <?php $form = ActiveForm::begin([
                'id' => 'form-signup',
            ]); ?>
            <div class="box-body">
                <?= $form->field($model, 'username', ['enableAjaxValidation' => true])->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email', ['enableAjaxValidation' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('提交', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>

    </div>
</div>
