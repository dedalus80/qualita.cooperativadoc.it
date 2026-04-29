<?php

class DbNonconformeController extends Controller {

    public $layout = '//layouts/column2';

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules() {

        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin', 'delete', 'view'),
                'users' => array('@'),
            ),
                /*
                  array('allow',  // allow all users to perform 'index' and 'view' actions
                  'actions'=>array('index','view'),
                  'users'=>array('*'),
                  ),
                  array('allow', // allow admin user to perform 'admin' and 'delete' actions
                  'actions'=>array('admin','delete'),
                  'users'=>array('admin'),
                  ),
                  array('deny',  // deny all users
                  'users'=>array('*'),
                  ), */
        );
    }

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionStampa($id) {

        # HTML2PDF has very similar syntax
        $html2pdf = Yii::app()->ePdf->HTML2PDF();
        $html2pdf->WriteHTML($this->renderPartial('_print', array('model' => $this->loadModel($id)), true));
        $html2pdf->Output('NonConforme-' . $id . '.pdf', 'D');
    }

    public function actionEsporta() {

        $model = new DbNonconforme('search');
        $model->datiEsportazione = $model->getEsportazione();

        $this->renderPartial('_esporta', array(
            'model' => $model
        ));
    }

    public function actionCreate() {

        $model = new DbNonconforme;
        
        $this->performAjaxValidation($model);

        # SELECT VARIE PER INSERIMENTO DATI ------------------------------------
        $model->selectFunzioni      = $model->getSelect('doc_funzione');
        $model->selectSocieta       = $model->getSelect('doc_societa');
        $model->selectTipologie     = $model->getSelect('doc_tipologia_apertura');
        $model->selectUnita         = $model->getSelect('doc_unita');
        $model->selectResponsabili  = $model->getSelect('doc_responsabile');
        $model->selectChiusure      = $model->getSelect('doc_chiusura');
        $model->typeUser            = $model->getUserType(Yii::app()->user->getId());


        if (isset($_POST['DbNonconforme'])) {
            $model->attributes = $_POST['DbNonconforme'];
            $model->setAttribute('data', date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i"));
            $model->setAttribute('id_utente', Yii::app()->user->getId());
            
            # SETTO LA STRUTTURA DI RIFERIMENTO PER L'UTENTE -------------------
            if (Yii::app()->user->getId() != 110 && $model->typeUser !='admin')
                $model->setAttribute('unita_operativa', $model->setUserUnita(Yii::app()->user->getId()));
            
            
            
            # GESTIONE EVENTUALI ALLEGATI --------------------------------------
            $model->allegato = CUploadedFile::getInstance($model, 'allegato');
            if ($model->allegato && $model->allegato != '') {
                $model->allegato->saveAs(Yii::app()->basePath . '/../images/allegati/' . $model->allegato);
                $model->setAttribute('allegato', $model->allegato);
            }

            # GENERAZIONE AUTOMATICA CODICE LEGATO A STRUTTURA -----------------
            if ($model->save()) {
                $codice = $model->generaCodice($model->attributes['unita_operativa'], Yii::app()->db->lastInsertID);

                # INVIO EMAIL INSERIMENTO AZIONE -------------------------------
                $model->sendEmail($model->attributes['id'], "O");
                $this->redirect(array('view', 'id' => $model->id));
            }
        }
        
        # SETTO LA STRUTTURA DI RIFERIMENTO PER L'UTENTE -----------------------
        if (Yii::app()->user->getId() != 110 && $model->typeUser !='admin')
           $model->setAttribute('unita_operativa', $model->setUserUnita(Yii::app()->user->getId()));
        
        $this->render('create', array(
            'model' => $model
        ));
    }

    public function actionUpdate($id) {

        $model = $this->loadModel($id);
        
        $this->performAjaxValidation($model);
        
        # SELECT VARIE PER INSERIMENTO DATI ------------------------------------
        $model->selectFunzioni      = $model->getSelect('doc_funzione');
        $model->selectSocieta       = $model->getSelect('doc_societa');
        $model->selectTipologie     = $model->getSelect('doc_tipologia_apertura');
        $model->selectUnita         = $model->getSelect('doc_unita');
        $model->selectResponsabili  = $model->getSelect('doc_responsabile');
        $model->selectChiusure      = $model->getSelect('doc_chiusura');
        $model->typeUser            = $model->getUserType(Yii::app()->user->getId());
        
        if (isset($_POST['DbNonconforme'])) {

            $model->attributes = $_POST['DbNonconforme'];
            $model->setAttribute('data_aggiornamento', date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i"));


            # GESTIONE EVENTUALI ALLEGATI --------------------------------------
            $model->allegato = CUploadedFile::getInstance($model, 'allegato');
            if ($model->allegato && $model->allegato != '')
                $model->allegato->saveAs(Yii::app()->basePath . '/../images/allegati/' . $model->allegato);
            else
                $model->setAttribute('allegato', $model->getAllegato($model->attributes['id']));
            
            # SE TRATTAMENTO VIENE ACCETTATO SETTO DATA 
            if ($model->typeUser == 'admin' && $model->trattamento_accettato == 'Y')
                $model->setAttribute('trattamento_data', date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i"));
            
            
            if ($model->save()) {

                # INVIO EMAIL --------------------------------------------------
                # AGGIORNAMNETO DA PARTE DELL' UTENTE AD ADMIN
                # RISPOSTA NEGATIVA A TRATTAMENTO ALL'UTENTE CHE HA INSERITO 
                /*
                if ($model->typeUser == 'admin') {
                    if ($model->trattamento_accettato == 'N')
                        $model->sendEmailTrattamento($model->attributes['id']);
                }
                else
                    $model->sendEmail($model->attributes['id'], "E");
                */
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('DbNonconforme');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin() {

        $model = new DbNonconforme('search');
        $model->unsetAttributes();  // clear any default values
        
        # SELECT VARIE PER INSERIMENTO DATI ------------------------------------
        $model->selectFunzioni      = $model->getSelect('doc_funzione');
        $model->selectSocieta       = $model->getSelect('doc_societa');
        $model->selectTipologie     = $model->getSelect('doc_tipologia_apertura');
        $model->selectUnita         = $model->getSelect('doc_unita');
        $model->selectResponsabili  = $model->getSelect('doc_responsabile');
        $model->selectChiusure      = $model->getSelect('doc_chiusura');
        $model->selectCodici        = $model->getCodici(Yii::app()->user->getId());
        $model->typeUser            = $model->getUserType(Yii::app()->user->getId());
        
        if (isset($_GET['DbNonconforme']))
            $model->attributes = $_GET['DbNonconforme'];
        
        # SETTO LA STRUTTURA DI RIFERIMENTO PER L'UTENTE -----------------------
        if (Yii::app()->user->getId() == 110)
            $model->setAttribute('unita_operativa', array("19", "20", "21", "22"));
        else if($model->typeUser !='admin')
           $model->setAttribute('unita_operativa', $model->setUserUnita(Yii::app()->user->getId()));
        
        
        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function loadModel($id) {
        $model = DbNonconforme::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'La pagina richiesta non esiste.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'db-nonconforme-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
