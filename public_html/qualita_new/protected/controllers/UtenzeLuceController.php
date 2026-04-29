<?php

class UtenzeLuceController extends Controller {

    public $layout = '//layouts/column2';

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin', 'delete', 'view', 'esporta', 'verifica', 'scarica'),
                'users' => Yii::app()->MyUtils->getPermition('azioni'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionEsporta($anno = null) {
        $model = new UtenzeLuce;
        $model->datiEsportazione = $model->getEsportazione($anno);
        $this->renderPartial('_esporta', array('model' => $model));
    }

    public function actionScarica($id) {
        $model = $this->loadModel($id);
        $model->utenze = Yii::app()->MyUtils->getUtenze($model->struttura, $model->anno, 'luce');
        $model->struttura_nome = Yii::app()->MyUtils->getSelectValue($model->struttura, "doc_unita");

        # print_r($model->utenze);
        # exit();


        $this->renderPartial('_scarica', array('model' => $model));
    }

    public function actionVerifica() {

        $exist = Yii::app()->db->createCommand("SELECT id FROM utenze_luce WHERE anno ='" . $_POST['anno'] . "'AND  struttura ='" . $_POST['struttura'] . "' ")->queryScalar();
        header('Content-Type: application/json; charset="UTF-8"');
        echo CJSON::encode(array('exist' => $exist));
        Yii::app()->end();
    }

    public function actionView($id) {

        $model = $this->loadModel($id);
        $model->utenze = Yii::app()->MyUtils->getUtenze($model->struttura, $model->anno, 'luce');
        $model->struttura_nome = Yii::app()->MyUtils->getSelectValue($model->struttura, "doc_unita");
        $this->render('view', array('model' => $model));
    }

    public function actionCreate() {
        $model = new UtenzeLuce;
        $model->setSelect();
        if (isset($_POST['UtenzeLuce'])) {
            $model->attributes = $_POST['UtenzeLuce'];
            $model->setAttribute('totale', $model->setTotale());
            if ($model->save()) {
                $model->setAttribute('totale', $model->setTotale());
                $model->setAttribute('c_totale', $model->setCostoTotale());
                $model->save();

                // INVIO NOTIFICHE PUSH
                Yii::app()->MyPush->newNotificaton($model->tableName(), "ucl", "create", $model->id);
                $model->struttura_nome = Yii::app()->MyUtils->getSelectValue($model->struttura, "doc_unita");

                Yii::app()->user->setFlash('opResultOK', 'Nuovi consumi energia <b>' . $model->struttura_nome . ' ' . $model->anno . ' </b> inseriti con successo');
                $this->redirect(array('admin'));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionUpdate($id) {

        $model = $this->loadModel($id);
        $model->setSelect();

        if (isset($_POST['UtenzeLuce'])) {
            $model->attributes = $_POST['UtenzeLuce'];
            $model->setAttribute('totale', $model->setTotale());
            $model->setAttribute('c_totale', $model->setCostoTotale());
            if ($model->save()) {
                // INVIO NOTIFICHE PUSH
                Yii::app()->MyPush->newNotificaton($model->tableName(), "ucl", "update", $model->id);

                Yii::app()->user->setFlash('opResultOK', 'Consumi energia <b>' . $model->struttura_nome . ' ' . $model->anno . ' </b> aggiornati con successo');
                $this->redirect(array('admin'));
            }
        }

        $this->render('update', array('model' => $model,));
    }

    public function actionDelete($id) {

        $model = $this->loadModel($id);

        // INVIO NOTIFICHE PUSH
        Yii::app()->MyPush->newNotificaton($model->tableName(), "ucl", "delete", $model->id);
        $model->struttura_nome = Yii::app()->MyUtils->getSelectValue($model->struttura, "doc_unita");
        Yii::app()->user->setFlash('opResultOK', 'Consumi energia <b>' . $model->struttura_nome . ' ' . $model->anno . ' </b> rimossi con successo');

        $model->delete();
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('UtenzeLuce');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin() {
        $model = new UtenzeLuce('search');
        $model->unsetAttributes();  // clear any default values

        $model->setSelect();
        $model->setAttribute('anno', date("Y"));

        if (isset($_POST['UtenzeLuce']))
            $model->attributes = $_POST['UtenzeLuce'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function loadModel($id) {
        $model = UtenzeLuce::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'utenze-luce-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
