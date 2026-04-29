<?php

class UtenzeAcquaController extends Controller {

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
        $model = new UtenzeAcqua;
        $model->datiEsportazione = $model->getEsportazione($anno);
        $this->renderPartial('_esporta', array('model' => $model));
    }

    public function actionScarica($id) {
        $model = $this->loadModel($id);
        $model->utenze = Yii::app()->MyUtils->getUtenze($model->struttura, $model->anno, 'acqua');
        $model->struttura_nome = Yii::app()->MyUtils->getSelectValue($model->struttura, "doc_unita");
        $this->renderPartial('_scarica', array('model' => $model));
    }

    public function actionVerifica() {

        $exist = Yii::app()->db->createCommand("SELECT id FROM utenze_acqua WHERE anno ='" . $_POST['anno'] . "'AND  struttura ='" . $_POST['struttura'] . "' ")->queryScalar();
        header('Content-Type: application/json; charset="UTF-8"');
        echo CJSON::encode(array('exist' => $exist));
        Yii::app()->end();
    }

    public function actionView($id) {

        $model = $this->loadModel($id);
        $model->utenze = Yii::app()->MyUtils->getUtenze($model->struttura, $model->anno, 'acqua');
        $model->struttura_nome = Yii::app()->MyUtils->getSelectValue($model->struttura, "doc_unita");
        $this->render('view', array('model' => $model));
    }

    public function actionCreate() {
        $model = new UtenzeAcqua;
        $model->setSelect();
        if (isset($_POST['UtenzeAcqua'])) {
            $model->attributes = $_POST['UtenzeAcqua'];
            $model->setAttribute('totale', $model->setTotale());
            if ($model->save()) {
                $model->setAttribute('totale', $model->setTotale());
                $model->setAttribute('c_totale', $model->setCostoTotale());
                $model->save();


                // INVIO NOTIFICHE PUSH
                Yii::app()->MyPush->newNotificaton($model->tableName(), "uca", "create", $model->id);

                $model->struttura_nome = Yii::app()->MyUtils->getSelectValue($model->struttura, "doc_unita");

                Yii::app()->user->setFlash('opResultOK', 'Nuovi consumi acqua <b>' . $model->struttura_nome . ' ' . $model->anno . ' </b> inseriti con successo');
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

        if (isset($_POST['UtenzeAcqua'])) {
            $model->attributes = $_POST['UtenzeAcqua'];
            $model->setAttribute('totale', $model->setTotale());
            $model->setAttribute('c_totale', $model->setCostoTotale());
            if ($model->save()) {

                // INVIO NOTIFICHE PUSH
                Yii::app()->MyPush->newNotificaton($model->tableName(), "uca", "update", $model->id);

                Yii::app()->user->setFlash('opResultOK', 'Consumi acqua <b>' . $model->struttura_nome . ' ' . $model->anno . ' </b> aggiornati con successo');
                $this->redirect(array('admin'));
            }
        }

        $this->render('update', array('model' => $model,));
    }

    public function actionDelete($id) {

        $model = $this->loadModel($id);
        // INVIO NOTIFICHE PUSH
        Yii::app()->MyPush->newNotificaton($model->tableName(), "uca", "delete", $model->id);

        $model->struttura_nome = Yii::app()->MyUtils->getSelectValue($model->struttura, "doc_unita");
        Yii::app()->user->setFlash('opResultOK', 'Consumi acqua <b>' . $model->struttura_nome . ' ' . $model->anno . ' </b> rimossi con successo');

        $model->delete();
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('UtenzeAcqua');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin() {
        $model = new UtenzeAcqua('search');
        $model->unsetAttributes();  // clear any default values

        $model->setSelect();
        #$model->setAttribute('anno', date("Y"));

        if (isset($_POST['UtenzeAcqua']))
            $model->attributes = $_POST['UtenzeAcqua'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function loadModel($id) {
        $model = UtenzeAcqua::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'utenze-acqua-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
