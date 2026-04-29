<?php

class InviiEmailController extends Controller {

    public $layout = '//layouts/column2';

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('admin', 'getDelivery'),
                'users' => Yii::app()->MyUtils->getPermition('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    
    public function actionDelivery() {
        $id = $_POST['id'];
        $model = new InviiEmail;
        $dati = $model->getDelivery($id);
        header('Content-Type: application/json; charset="UTF-8"');
        echo CJSON::encode(array('delivery' => $dati['txt'], 'totale' => $dati['count']));
        Yii::app()->end();
    }
    
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionAdmin() {
        $model = new InviiEmail('search');
        
        $model->unsetAttributes();  // clear any default values
        if (isset($_POST['InviiEmail'])) {
            $model->attributes = $_POST['InviiEmail'];
            $model->setAttribute('data_invio', Yii::app()->MyUtils->reverseDate($model->data_invio));
        }
        
        
        $this->render('admin', array('model' => $model,));
    }

    public function loadModel($id) {
        $model = InviiEmail::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'invii-email-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
