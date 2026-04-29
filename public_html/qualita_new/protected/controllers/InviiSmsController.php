<?php

class InviiSmsController extends Controller {

    public $layout = '//layouts/column2';

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('admin', 'delivery','delete'),
                'users' => Yii::app()->MyUtils->getPermition('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    
    public function actionDelivery() {
        $id = $_POST['id'] = 1;
        
        $model=$this->loadModel($_POST['id']);
        $dati = $model->getDelivery();
        
        header('Content-Type: application/json; charset="UTF-8"');
        echo CJSON::encode(array('delivery' => $dati['txt'], 'totale' => $dati['count']));
        Yii::app()->end();
    }
    
    public function actionDelete($id) {
        $this->loadModel($id)->delete();
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionAdmin() {
        $model = new InviiSms('search');
        
        $model->unsetAttributes();  // clear any default values
        if (isset($_POST['InviiSms'])) {
            $model->attributes = $_POST['InviiSms'];
            $model->setAttribute('data_invio', Yii::app()->MyUtils->reverseDate($model->data_invio));
        }
        $this->render('admin', array('model' => $model,));
    }

    public function loadModel($id) {
        $model = InviiSms::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'invii-sms-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
