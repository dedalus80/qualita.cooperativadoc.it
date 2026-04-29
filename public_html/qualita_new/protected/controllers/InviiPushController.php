<?php

class InviiPushController extends Controller {

    public $layout = '//layouts/column2';

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {

        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'create', 'update', 'admin', 'delete', 'esporta', 'sendPush', 'messaggio', 'CheckDest','registerId'),
                'users' => Yii::app()->MyUtils->getPermition('azioni'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    
    public function actionRegisterId() {
        Yii::app()->db->createCommand("UPDATE admin SET id_signal ='" . $_POST['id'] . "' WHERE id='" . Yii::app()->user->getId() . "'")->execute();
        header('Content-Type: application/json; charset="UTF-8"');
        echo CJSON::encode(array('text' => "test"));
        Yii::app()->end();
    }
    
    
    public function actionView($id) {
        $this->render('view', array('model' => $this->loadModel($id),));
    }

    public function actionDelivery() {
        $id = $_POST['id'];
        $model = new InviiPush;
        $dati = $model->getDelivery($id);
        header('Content-Type: application/json; charset="UTF-8"');
        echo CJSON::encode(array('delivery' => $dati['txt'], 'totale' => $dati['count']));
        Yii::app()->end();
    }

    public function actionCreate() {

        $model = new InviiPush;
        $model->unsetAttributes();

        if (isset($_POST['InviiPush'])) {

            $model->attributes = $_POST['InviiPush'];
            $model->setAttribute('tipo', $model->id_destinatari ? "S" : "M");
            $model->setAttribute('data_invio', date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":00");

            $model->setAttribute('quanti', $model->setDestination());

            $struttura = Yii::app()->MyUtils->getStruttura();
            if ($struttura)
                $model->setAttribute('centro', $struttura);


            if ($model->save() && $model->quanti > 0) {
                $result = $model->sendMultiSms();
                Yii::app()->user->setFlash($result['stato'], $result['txt']);
                $this->redirect(array('admin'));
            } else if (!$model->quanti > 0 && $model->quanti)
                $model->addError("data_visita", "Non sono presenti contatti a cui inviare il messaggio ");
        }

        $model->setAttribute('data_visita', Yii::app()->MyUtils->reverseDate($model->data_visita));
        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        if (isset($_POST['InviiPush'])) {
            $model->attributes = $_POST['InviiPush'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array('model' => $model,));
    }

    public function sendPush($id) {

        $model = new InviiPush;
        $model->sendResult = $model->sendSingleSms($id);
        Yii::app()->user->setFlash($model->sendResult['type'], $model->sendResult['message']);
        Yii::app()->user->setFlash('opResultKO', "ma che palle");
        $this->redirect(array('admin'));
    }

    public function actionDelete($id) {
        $this->loadModel($id)->delete();
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('InviiPush');
        $this->render('index', array('dataProvider' => $dataProvider,));
    }

    public function actionAdmin() {
        $model = new InviiPush('search');
        $model->setDefaultValue();
        $model->unsetAttributes();  // clear any default values
        if (isset($_POST['InviiPush'])) {
            $model->attributes = $_POST['InviiPush'];
            $model->setAttribute('data_invio', Yii::app()->MyUtils->reverseDate($model->data_invio));
        }
        $this->render('admin', array('model' => $model,));
    }

    public function loadModel($id) {
        $model = InviiPush::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'invii-push-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
