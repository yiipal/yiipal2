<?php
/**
 * index.php
 *
 * @Author: renk(renk@yiipal.com)
 * @Date: 2016/3/4
 */
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */

$this->title = '用户列表';
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
                    'label' => '用户名',
                    'attribute' => 'username',
                    'value' => function ($data) {
                        //print_r($data);exit;
                        $url = Html::a($data->username,Url::to(['/account/user/info','id'=>$data->id]));
                        return $url;
                    },
                    'format'=>'raw',
                    'enableSorting'=>true,
                ],
                'email',
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
                            $url = Url::to(['/system/contentfields/index','content_type' => $model->username]);
                            return Html::a('<span class="glyphicon glyphicon-cog"></span>', $url, $options);
                        },
                    ]
                ],
            ],
        ]); ?>

    </div>
</div>

