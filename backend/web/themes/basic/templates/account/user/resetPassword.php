<?php
/**
 * update.php
 *
 * @Author: renk(renk@yiipal.com)
 * @Date: 2016/3/4
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */

$this->title = '修改密码';
?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border hidden">
                <h3 class="box-title">基本信息</h3>
            </div>
            <?php $form = ActiveForm::begin(); ?>
            <div class="box-body">
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= Html::submitButton('提交',['class'=>'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>

    </div>
</div>