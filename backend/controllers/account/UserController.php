<?php
/**
 * UserController.php 
 *
 * @Author: renk(renk@yiipal.com)
 * @Date: 2016/3/7
 */

namespace backend\controllers\account;

use backend\models\account\CreateUserForm;
use backend\models\account\ResetPasswordForm;
use yii;
use common\base\BaseController;
use common\models\User;
use yii\data\ActiveDataProvider;


class UserController extends BaseController{

    public function actionIndex(){
        $query = User::find([]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionInfo($id){
        $user = User::findOne(['id'=>$id]);
        print_r($user);exit;
    }

    public function actionUpdate($id){
        $model = new ResetPasswordForm($id);
        if(!$model)
            throw new NotFoundHttpException('The requested page does not exist.');

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');
            $this->redirect(['account/user/index']);
        }else{
            return $this->render('resetPassword', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id){
        $model = User::findIdentity($id);
        if(!$model)
            throw new NotFoundHttpException('The requested page does not exist.');
        $model->delete();
        Yii::$app->session->setFlash('success', '删除成功！');
        $this->redirect(['account/user/index']);
    }

    public function actionCreate(){
        $model = new CreateUserForm();
        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
                return yii\bootstrap\ActiveForm::validate($model);
            }
            if ($user = $model->signup()) {
                return $this->redirect(['account/user/index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
}