<?php
/**
 * Formbuilder.php 
 *
 * @Author: renk(renk@yiipal.com)
 * @Date: 2016/3/4
 */

namespace backend\controllers\form;

use yii;
use backend\models\form\FormBuilder;
use yii\web\Controller;
use yii\data\ActiveDataProvider;


class FormBuilderController extends Controller{
    public function actionIndex(){
        $query = FormBuilder::find(['collection'=>'form']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate(){
        $model = new FormBuilder(['scenario' => 'create']);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->render('create', [
                'model' => $model,
            ]);        }else{
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($name){
        $model = FormBuilder::findOne(['collection'=>'form','name'=>$name]);

        if(!$model)
            throw new NotFoundHttpException('The requested page does not exist.');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }else{
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
}