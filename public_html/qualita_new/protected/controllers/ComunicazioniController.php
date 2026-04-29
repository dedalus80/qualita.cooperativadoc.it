<?php

class ComunicazioniController extends Controller {

    public $layout = '//layouts/column2';

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin', 'delete', 'view', 'esporta', 'elenco', 'azione', 'statistiche', 'registerId'),
                //'users' => Yii::app()->MyUtils->getPermition('azioni'),
                'expression'=>'Yii::app()->user->getState("typeUserId") == 9',
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionRegisterId() {
        Yii::app()->db->createCommand("UPDATE utenti SET id_signal ='" . $_POST['id'] . "' WHERE id='" . Yii::app()->user->getId() . "'")->execute();
        header('Content-Type: application/json; charset="UTF-8"');
        echo CJSON::encode(array('text' => $text));
        Yii::app()->end();
    }

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionCreate() {
        $model = new Comunicazioni;
        $model->setSelect(); 
        if (isset($_POST['Comunicazioni'])) {
            $model->attributes = $_POST['Comunicazioni'];
            
            if ($model->data_invio)
                $model->setAttribute('data_invio', Yii::app()->MyUtils->reverseDate($model->data_invio) );
            else
               $model->setAttribute('data_invio', date("Y")."-".date("m")."-".date("d") );
                        
            $result = $model->sendComunication();
            
            Yii::app()->user->setFlash($result['stato'], $result['txt']);
            if ($model->save())
                $this->redirect(array('admin'));
        }
        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $model->setSelect();
        if (isset($_POST['Comunicazioni'])) {
            $model->attributes = $_POST['Comunicazioni'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id) {
        $model = $this->loadModel($id);
        $model->delete();
        Yii::app()->user->setFlash('opResultOK', 'Comunicazione <b>' . $model->titolo . "</b> rimossa con successo");
        
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Comunicazioni');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin() {
        $model = new Comunicazioni('search');
        $model->unsetAttributes();  // clear any default values
        $model->setSelect();
        if (isset($_POST['Comunicazioni']))
            $model->attributes = $_POST['Comunicazioni'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function loadModel($id) {
        $model = Comunicazioni::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'comunicazioni-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
