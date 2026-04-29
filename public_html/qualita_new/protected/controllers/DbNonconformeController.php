<?php

class DbNonconformeController extends Controller {

    public $layout = '//layouts/column2';

    public function filters() {
        return array('accessControl');
    }

    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array(
                                'create',
                                'update',
                                'admin', 
                                'delete',
                                'view',
                                'esporta',
                                'stampa',
                                'indicatoriTipologie',
                                'indicatoriStrutture'
                            ),
                            //'users' => Yii::app()->MyUtils->getPermition('azioni'),
                'users' => Yii::app()->user->accessController('AzioniNonConformi'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndicatoriStrutture() 
    {
        $this->authorize('AzioniNonConformi', 'view');

        $model = new DbNonconforme('search');
        $model->indicatori = Yii::app()->MyStats->setIndicatoriStrutture("NC");

        $this->render('indicatoriStrutture', array('model' => $model,));
    }

    public function actionIndicatoriTipologie() 
    {
        $this->authorize('AzioniNonConformi', 'view');    
        
        $model = new DbNonconforme('search');
        $model->indicatori = Yii::app()->MyStats->setIndicatoriTipologie("NC");

        $this->render('indicatoriTipologie', array('model' => $model));
    }

    public function actionStampa($id)
    {
        $model = $this->loadModel($id);
        
        $this->authorize('AzioniNonConformi', 'view', $model->id_utente, $model->unita_operativa);
        
        $html2pdf = Yii::app()->ePdf->HTML2PDF('P', 'A4', 'en', false, 'ISO-8859-15', array(mL, mT, mR, mB));
        $html2pdf->WriteHTML($this->renderPartial('_print', array('model' => $model), true));
        $html2pdf->Output('azione-non-conforme-' . $model->codice . '.pdf', 'D');
    }

    public function actionEsporta($anno = NULL) {
        $model = new DbNonconforme;
        $model->datiEsportazione = $model->getEsportazione();
        $this->renderPartial('_esporta', array('model' => $model));
    }

    public function actionCreate() 
    {
        $this->authorize('AzioniNonConformi');

        $model = new DbNonconforme;
        $model->setDefaultValue();
        
        # SETTO LA STRUTTURA DI RIFERIMENTO PER L'UTENTE -----------------------
        if (Yii::app()->user->getId() != 110 && $model->typeUser != 'admin')
            $model->setAttribute('unita_operativa', Yii::app()->MyUtils->getStrutturaId());
        
        
        if (isset($_POST['DbNonconforme'])) {
            
            $model->attributes = $_POST['DbNonconforme'];
            
            if($model->typeUser != 'admin')
                $model->setAttribute('data', date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i"));
            else
                $model->setAttribute('data', (new DateTime($_POST['DbNonconforme']['data']))->format('Y-m-d H:i:s'));

            
            $model->setAttribute('data_nc', Yii::app()->MyUtils->reverseDate($model->data_nc));
            $model->setAttribute('anno', date("Y"));
            $model->setAttribute('id_utente', Yii::app()->user->getId());
            
            
            # GESTIONE EVENTUALI ALLEGATI --------------------------------------
            $model->allegato = CUploadedFile::getInstance($model, 'allegato');
            if ($model->allegato && $model->allegato != '') {
                $model->allegato->saveAs(Yii::app()->basePath . '/../images/allegati/' . $model->allegato);
                $model->setAttribute('allegato', $model->allegato);
            }

            # GENERAZIONE AUTOMATICA CODICE LEGATO A STRUTTURA -----------------
            if ($model->save()) {
                $codice = $model->generaCodice($model->attributes['unita_operativa'], Yii::app()->db->lastInsertID);
                Yii::app()->user->setFlash('opResultOK', 'Azione non conforme <b>' . $codice . "</b> inserita con successo");

                # INVIO NOTIFICHE PUSH
                Yii::app()->MyPush->newNotificaton($model->tableName(), "nc", "create", $model->id);

                # INVIO EMAIL INSERIMENTO AZIONE -------------------------------
                Yii::app()->MyEmails->sendEmailNc("nc_create", $model->attributes['id']);

                $this->redirect(array('admin')) ;
            }
        }
      
        if(Yii::app()->user->getState('group') != 'ADMIN') {
            $strutture = CHtml::listData(
                                Strutture::model()->findAllByAttributes(
                                    array('id' => Yii::app()->user->getState('strutture')),
                                    array('order'=>'nome')
                                ),
                                'id',
                                'nome'
                            );
        }
        else {
            $strutture = CHtml::listData(Strutture::model()->findAll(array('order'=>'nome')), 'id', 'nome');
        }

        $this->render('create', array('model' => $model, 'strutture' => $strutture));
    }

    public function actionUpdate($id) 
    {
        $model = $this->loadModel($id);

        $this->authorize('AzioniNonConformi', 'update', $model->id_utente, $model->unita_operativa);

        $model->setDefaultValue();
        
        if (isset($_POST['DbNonconforme'])) {

            $model->attributes = $_POST['DbNonconforme'];
            $model->setAttribute('data_aggiornamento', date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i"));
            $model->setAttribute('data_nc', Yii::app()->MyUtils->reverseDate($model->data_nc));

            if($model->typeUser == 'admin')
                $model->setAttribute('data', (new DateTime($_POST['DbNonconforme']['data']))->format('Y-m-d H:i:s'));

            # GESTIONE EVENTUALI ALLEGATI --------------------------------------
            $model->allegato = CUploadedFile::getInstance($model, 'allegato');
            if ($model->allegato && $model->allegato != '') {
                $model->allegato->saveAs(Yii::app()->basePath . '/../images/allegati/' . $model->allegato);
                $model->setAttribute('allegato', $model->allegato);
            }
            else
                $model->setAttribute('allegato', $model->getAllegato());

            # SE TRATTAMENTO VIENE ACCETTATO SETTO DATA 
            if ($model->typeUser == 'admin' && $model->trattamento_accettato == 'Y')
                $model->setAttribute('trattamento_data', date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i"));

            if ($model->save()) {

                # INVIO EMAIL AGGIORNAMENTO AZIONE -------------------------------
                Yii::app()->MyEmails->sendEmailNc("nc_update", $id);

                // APERTURA AZIONE CORRETTIVA
                if ($model->apertura_ac == 'Y')
                    $model->openAzioneCorrettiva();

                // INVIO NOTIFICHE PUSH
                Yii::app()->MyPush->newNotificaton($model->tableName(), "nc", "update", $model->id);

                Yii::app()->user->setFlash('opResultOK', 'Azione non conforme <b>' . $model->codice . "</b> aggiornata con successo");
                $this->redirect(array('admin', 'id' => $model->id));
            }
        }

        if(Yii::app()->user->getState('group') != 'ADMIN') {
            $strutture = CHtml::listData(
                                Strutture::model()->findAllByAttributes(
                                    array('id' => Yii::app()->user->getState('strutture')),
                                    array('order'=>'nome')
                                ),
                                'id',
                                'nome'
                            );
        }
        else {
            $strutture = CHtml::listData(Strutture::model()->findAll(array('order'=>'nome')), 'id', 'nome');
        }
        
        $this->render('update', array('model' => $model, 'strutture' => $strutture));
    }

    public function actionDelete($id) 
    {
        $model = $this->loadModel($id);

        $this->authorize('AzioniNonConformi', 'delete', $model->id_utente, $model->unita_operativa);

        Yii::app()->MyPush->newNotificaton($model->tableName(), "nc", "delete", $id);
        Yii::app()->user->setFlash('opResultOK', 'Azione non conforme <b>' . $model->codice . "</b> eliminata con successo");
        $model->deleteCodice();
        $model->delete();
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionIndex() 
    {
        $this->authorize('AzioniNonConformi', 'view');

        $dataProvider = new CActiveDataProvider('DbNonconforme');
        $this->render('index', array('dataProvider' => $dataProvider,));
    }

    public function actionAdmin() 
    {
        $this->authorize('AzioniNonConformi', 'view');

        $model = new DbNonconforme('search');
        $model->unsetAttributes();  // clear any default values
        $model->deleteCodice();
        $model->setDefaultValue();
        
        if (isset($_GET['DbNonconforme']))
            $model->attributes = $_GET['DbNonconforme'];
        
        
        $this->render('admin', array('model' => $model,));
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $model = $this->loadModel($id);

        $this->authorize('AzioniNonConformi', 'view', $model->id_utente, $model->unita_operativa);


        $this->render('view',array(
            'model'=>$model,
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
