<?php
/**
 * build.php
 *
 * @Author: renk(renk@yiipal.com)
 * @Date: 2016/3/4
 */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Form Builder';
?>

<div class="row">
    <div class="col-sm-12">
        <?= \yii\grid\GridView::widget([
            'dataProvider' => $dataProvider,
            'layout' => '{items}{pager}{summary}',
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'class' => 'yii\grid\DataColumn',
                    'label' => '表单名称',
                    'attribute' => 'data_label',
                    'value' => function ($data) {
                        //print_r($data);exit;
                        $url = Html::a($data->data_label,Url::to(['/form/form-builder/update','name'=>$data->name]));
                        return $url;
                    },
                    'format'=>'raw',
                    'enableSorting'=>true,
                ],
                'name',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{config} {update} {delete}',
                    'headerOptions' => ["width" => "80"],
                    'buttons' =>[
                        'config' => function ($url, $model, $key) {
                            $options = array_merge([
                                'title' => Yii::t('yii', '管理字段'),
                                'aria-label' => Yii::t('yii', '管理字段'),
                                'data-pjax' => '0',
                            ]);
                            $url = Url::to(['/system/contentfields/index','content_type' => $model->name]);
                            return Html::a('<span class="glyphicon glyphicon-cog"></span>', $url, $options);
                        },
                    ]
                ],
            ],
        ]); ?>

    </div>
</div>

