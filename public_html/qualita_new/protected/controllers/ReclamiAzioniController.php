<?php

class ReclamiAzioniController extends Controller {

    public $layout = '//layouts/column2';

    public function filters() {
        return array(
            'accessControl',
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin', 'delete', 'view', 'esporta', 'getAzione', 'azione','ReclamoDetail'),
                'users' => Yii::app()->user->accessController('AzioniReclami'), //Yii::app()->MyUtils->getPermition('azioni'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

	public function actionReclamoDetail()
    {
        $this->authorize('AzioniReclami', 'view');

        $model = new ReclamiAzioni;
        $dati = $model->getReclamoDetail($_POST['id']);
        header('Content-Type: application/json; charset="UTF-8"');
        echo CJSON::encode(array('codice' => $dati['codice'], 'descrizione' => $dati['descrizione'], 'tipologia' => $dati['tipologia'], 'cognome' => $dati['cognome'], 'nome' => $dati['nome'], 'canale' => $dati['canale']  ));
        Yii::app()->end();
    }
	
    public function actionEsporta($anno = null)
    {
        $this->authorize('AzioniReclami', 'view');

        $model = new ReclamiAzioni();
        $model->datiEsportazione = $model->getEsportazione($anno);
        $this->renderPartial('_esporta', array('model' => $model));
    }
	
	
	
    public function actionAzione($id)
    {
        $this->authorize('AzioniReclami', 'create');

        $model = new ReclamiAzioni;
        $model->setDefaultValue();
        $model->id_reclamo = $id;

        if (isset($_POST['ReclamiAzioni'])) {
            $model->attributes = $_POST['ReclamiAzioni'];


            $model->setAttribute('effettuata_il', date("Y") . "-" . date("m") . "-" . date("d"));
            $model->setAttribute('anno', date("Y"));
            $model->setAttribute('unita_operativa', $model->getUnitaReclamo());
            $model->setAttribute('entro_il', Yii::app()->MyUtils->reverseDate($model->entro_il));

            if ($model->save()) {

                # GESTIONE EVENTUALI ALLEGATI 
                $model->allegato = CUploadedFile::getInstance($model, 'allegato');
                if ($model->allegato && $model->allegato != '') {
                    $model->allegato->saveAs(Yii::app()->basePath . '/../images/allegati_azioni/' . $model->allegato);
                    $model->setAttribute('allegato', $model->allegato);
                }
                
                # INVIO EMAIL  -------------------------------
                Yii::app()->MyEmails->sendEmailAre("are_create", $model->id);

                // INVIO NOTIFICHE PUSH
                Yii::app()->MyPush->newNotificaton($model->tableName(), "are", "create", $model->id);
                
                
                
                Yii::app()->user->setFlash('opResultOK', 'Nuova azione reclamo <b>' . $model->getCodiceReclamo() . "</b> creata con successo");
                $this->redirect(array('admin'));
            }
        }

        $this->render('create', array('model' => $model,));
    }

    public function actionCreate()
    {
        $this->authorize('AzioniReclami', 'create');

        $model = new ReclamiAzioni;
        $model->setDefaultValue();
        
        if (isset($_POST['ReclamiAzioni'])) {

            $model->attributes = $_POST['ReclamiAzioni'];
            $model->setAttribute('effettuata_il', date("Y") . "-" . date("m") . "-" . date("d"));
            $model->setAttribute('anno', date("Y"));
            $model->setAttribute('unita_operativa', $model->getUnitaReclamo());

            $model->setAttribute('entro_il', Yii::app()->MyUtils->reverseDate($model->entro_il));

            # GESTIONE EVENTUALI ALLEGATI 
            $model->allegato = CUploadedFile::getInstance($model, 'allegato');

            if ($model->allegato && $model->allegato != '') {
                $nome = $model->getNomeAllegato();
                $model->allegato->saveAs(Yii::app()->basePath . '/../images/allegati_azioni/' . $nome);
                $model->setAttribute('allegato', $nome);
            }
            else
                $model->setAttribute('allegato', $model->getPreviusAllegato());

            if ($model->save()) {

                # INVIO EMAIL  -------------------------------
                Yii::app()->MyEmails->sendEmailAre("are_create", $model->id);

                // INVIO NOTIFICHE PUSH
                Yii::app()->MyPush->newNotificaton($model->tableName(), "are", "create", $model->id);

                Yii::app()->user->setFlash('opResultOK', 'Nuova azione reclamo <b>' . $model->getCodiceReclamo() . "</b> creata con successo");
                $this->redirect(array('admin'));
            }
        }

        $this->render('create', array('model' => $model,));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        $reclamo = DbReclami::model()->findByPk($model->id_reclamo);

        $this->authorize('AzioniReclami', 'update', $reclamo->id_utente, $reclamo->unita_operativa);

        $model->setDefaultValue();

        if (isset($_POST['ReclamiAzioni'])) {
            $model->attributes = $_POST['ReclamiAzioni'];
            $model->setAttribute('effettuata_il', date("Y") . "-" . date("m") . "-" . date("d"));
            $model->setAttribute('entro_il', Yii::app()->MyUtils->reverseDate($model->entro_il));

            $model->codice = $model->getCodiceReclamo();

            # GESTIONE EVENTUALI ALLEGATI 
            $model->allegato = CUploadedFile::getInstance($model, 'allegato');

            if ($model->allegato && $model->allegato != '') {
                $nome = $model->getNomeAllegato();
                $model->allegato->saveAs(Yii::app()->basePath . '/../images/allegati_azioni/' . $nome);
                $model->setAttribute('allegato', $nome);
            }
            else
                $model->setAttribute('allegato', $model->getPreviusAllegato());


            if ($model->save()) {

                # INVIO EMAIL  -------------------------------
                Yii::app()->MyEmails->sendEmailAre("are_update", $model->id);

                // INVIO NOTIFICHE PUSH
                Yii::app()->MyPush->newNotificaton($model->tableName(), "are", "update", $model->id);

                Yii::app()->user->setFlash('opResultOK', 'Azione reclamo <b>' . $model->codice . "</b> aggiornata con successo");
                $this->redirect(array('admin'));
            }
        }

        $this->render('update', array('model' => $model,));
    }

    public function actionDelete($id)
    {
        $model = $this->loadModel($id);

        $reclamo = DbReclami::model()->findByPk($model->id_reclamo);

        $this->authorize('AzioniReclami', 'delete', $reclamo->id_utente, $reclamo->unita_operativa);
        
        Yii::app()->MyPush->newNotificaton($model->tableName(), "are", "delete", $model->id);
        
        $model->delete();
        Yii::app()->user->setFlash('opResultOK', 'Azione reclamo <b>' . $model->codice . "</b> eliminato con successo");

        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionIndex()
    {
        $this->authorize('AzioniReclami', 'view');

        $dataProvider = new CActiveDataProvider('ReclamiAzioni');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin()
    {
        $this->authorize('AzioniReclami', 'view');
        
        $model = new ReclamiAzioni('search');
        $model->unsetAttributes();  // clear any default values
        $model->setDefaultValue();

        if (isset($_POST['ReclamiAzioni']))
            $model->attributes = $_POST['ReclamiAzioni'];

        $this->render('admin', array('model' => $model,));
    }

    public function loadModel($id)
    {
        $model = ReclamiAzioni::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) 
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'reclami-azioni-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
