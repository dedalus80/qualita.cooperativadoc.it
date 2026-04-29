<?php

class AzioniVerificheEducativeController extends Controller {

    public $layout = '//layouts/column2';

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {

        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'create', 'update', 'admin', 'delete', 'esporta', 'verifica', 'stampa', 'modello'),
                'users' => Yii::app()->MyUtils->getPermition('verifiche'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionStampa($id) {
        $model = $this->loadModel($id);
        $model->setDefaultValue();
        $html2pdf = Yii::app()->ePdf->HTML2PDF('P', 'A4', 'en', false, 'ISO-8859-15', array(mL, mT, mR, mB));
        $html2pdf->WriteHTML($this->renderPartial('_print', array('model' => $model), true));
        $html2pdf->Output('verifica-inspettiva-' . $model->codice_verifica . '.pdf', 'D');
    }

    public function actionModello() {
        $model = new AzioniVerificheEducative('search');
        $model->setDefaultValue();
        $html2pdf = Yii::app()->ePdf->HTML2PDF('P', 'A4', 'en', false, 'ISO-8859-15', array(mL, mT, mR, mB));
        $html2pdf->WriteHTML($this->renderPartial('_modello', array('model' => $model), true));
        $html2pdf->Output('modello-verifica-ispettiva-educative.pdf', 'D');
    }

    public function actionCreate() {
        $model = new AzioniVerificheEducative;
        $model->setDefaultValue();
        if (isset($_POST['AzioniVerificheEducative'])) {

            $model->attributes = $_POST['AzioniVerificheEducative'];
            $model->setAttribute('data', Yii::app()->MyUtils->reverseDate($model->data));
            $model->setAttribute('ora_inizio', $model->ora_inizio . ":00");
            $model->setAttribute('ora_fine', $model->ora_fine . ":00");
            $model->setAttribute('anno', date("Y"));
            $model->setAttribute('autore', Yii::app()->user->getId());

            $model->updateVerificaGenerale();

            if ($model->save()) {

                // APERTURA EVENTUALI NON CONFORMITA'
                if ($model->apertura_nc == 'Y')
                    $model->openNonConforme();

                // INVIO NOTIFICHE PUSH
                Yii::app()->MyPush->newNotificaton($model->tableName(), "vea", "create", $model->id);

                Yii::app()->user->setFlash('opResultOK', 'Verifica dati educazione <b>' . $model->codice_verifica . "</b> creata con successo");
                $this->redirect(array('admin'));
            }
        }

        $this->render('create', array('model' => $model,));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $model->setDefaultValue();

        if (isset($_POST['AzioniVerificheEducative'])) {
            $model->attributes = $_POST['AzioniVerificheEducative'];
            $model->setAttribute('data', Yii::app()->MyUtils->reverseDate($model->data));
            $model->setAttribute('ora_inizio', $model->ora_inizio . ":00");
            $model->setAttribute('ora_fine', $model->ora_fine . ":00");
            $model->setAttribute('anno', date("Y"));

            $model->updateVerificaGenerale();

            if ($model->save()) {
                if ($model->apertura_nc == 'Y')
                    $model->openNonConforme();

                // INVIO NOTIFICHE PUSH
                Yii::app()->MyPush->newNotificaton($model->tableName(), "vea", "update", $model->id);

                Yii::app()->user->setFlash('opResultOK', 'Verifica dati educazione <b>' . $model->codice_verifica . "</b> aggiornata con successo");
                $this->redirect(array('admin'));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id) {
        $model = $this->loadModel($id);
        Yii::app()->user->setFlash('opResultOK', 'Verifica dati educazione <b>' . $model->codice_verifica . "</b> rimossa con successo");

        // INVIO NOTIFICHE PUSH
        Yii::app()->MyPush->newNotificaton($model->tableName(), "vea", "delete", $model->id);

        $model->delete();
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('AzioniVerificheEducative');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin() {
        $model = new AzioniVerificheEducative('search');
        $model->setDefaultValue();
        $model->unsetAttributes();  // clear any default values
        
        $model->anno = date("Y");
        
        if (isset($_POST['AzioniVerificheEducative']))
            $model->attributes = $_POST['AzioniVerificheEducative'];

        $this->render('admin', array('model' => $model,));
    }

    public function loadModel($id) {
        $model = AzioniVerificheEducative::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'azioni-verifiche-educative-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}