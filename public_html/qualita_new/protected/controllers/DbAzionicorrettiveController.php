<?php

class DbAzionicorrettiveController extends Controller {

    public $layout = '//layouts/column2';

    public function filters() {
        return array('accessControl',);
    }

    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin', 'delete', 'view', 'esporta', 'stampa','indicatoriTipologie','indicatoriStrutture','ncDetail'),
                //'users' => Yii::app()->MyUtils->getPermition('azioni'),
                'users' => Yii::app()->user->accessController('AzioniCorrettive'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    
	public function actionNcDetail()
    {
        $model = new DbAzionicorrettive;
        $dati = $model->getNcDetail($_POST['id']);
        header('Content-Type: application/json; charset="UTF-8"');
        echo CJSON::encode(array('codice' => $dati['codice'], 'descrizione' => $dati['descrizione'], 'trattamento' => $dati['trattamento']));
        Yii::app()->end();
    }
	
    public function actionIndicatoriStrutture()
    {
        $this->authorize('AzioniCorrettive', 'view');

        $model = new DbAzionicorrettive('search');
        $model->indicatori = Yii::app()->MyStats->setIndicatoriStrutture("AC");
        $this->render('indicatoriStrutture', array('model' => $model,));
    }

    public function actionIndicatoriTipologie() 
    {
        $this->authorize('AzioniCorrettive', 'view');

        $model = new DbAzionicorrettive('search');
        $model->indicatori = Yii::app()->MyStats->setIndicatoriTipologie("AC");
        $this->render('indicatoriTipologie', array('model' => $model,));
    }
    
    public function actionStampa($id)
    {
        $model = $this->loadModel($id);

        $this->authorize('AzioniCorrettive', 'view', $model->id_utente, $model->unita_operativa);

        $model->setDefaultValue();
        
        $html2pdf = Yii::app()->ePdf->HTML2PDF('P', 'A4', 'en', false, 'ISO-8859-15', array(mL, mT, mR, mB));
        $html2pdf->WriteHTML($this->renderPartial('_print', array('model' => $model), true));
        $html2pdf->Output('azione-correttiva-' . Yii::app()->db->createCommand("SELECT codice FROM db_nonconforme WHERE id='" . $model->codice_riferimento . "'")->queryScalar() . '.pdf', 'D');
    }

    public function actionEsporta($anni = NULL)
    {
        $model = new DbAzionicorrettive;
        $model->datiEsportazione = $model->getEsportazione($anni);
        $this->renderPartial('_esporta', array('model' => $model));
    }

    public function actionCreate()
    {
        $this->authorize('AzioniCorrettive', 'create');

        $model = new DbAzionicorrettive;
        $model->setDefaultValue();
        
        # SETTO LA STRUTTURA DI RIFERIMENTO PER L'UTENTE -----------------------
        if (Yii::app()->user->getId() != 110 && $model->typeUser != 'admin')
            $model->setAttribute('unita_operativa', Yii::app()->MyUtils->getStrutturaId());
                
        if (isset($_POST['DbAzionicorrettive'])) {
            $model->attributes = $_POST['DbAzionicorrettive'];
            
            if($model->typeUser != 'admin')
                $model->setAttribute('data', date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i"));
            else
                $model->setAttribute('data', (new DateTime($_POST['DbAzionicorrettive']['data']))->format('Y-m-d H:i:s'));

            $model->setAttribute('descrizione', Yii::app()->MyUtils->reverseDate($model->attributes['descrizione'], 'db'));
            $model->setAttribute('id_utente', Yii::app()->user->getId());
            $model->setAttribute('anno', date("Y"));
            $model->setAttribute('data_az', Yii::app()->MyUtils->reverseDate($model->data_az));

            #GESTIONE ALLEGATI -------------------------------------------------
            $model->allegato = CUploadedFile::getInstance($model, 'allegato');
            if ($model->allegato && $model->allegato != '') {
                $model->allegato->saveAs(Yii::app()->basePath . '/../images/allegati/' . $model->allegato);
                $model->setAttribute('allegato', $model->allegato);
            }

            if ($model->save()) {
                Yii::app()->user->setFlash('opResultOK', 'Nuova azione correttiva / preventiva <b>' . $model->codice_riferimento . "</b> inserita con successo");

                # INVIO EMAIL AGGIORNAMENTO AZIONE -------------------------------
                Yii::app()->MyEmails->sendEmailAc("ac_create", $model->id);

                // INVIO NOTIFICHE PUSH
                Yii::app()->MyPush->newNotificaton($model->tableName(), "ac", "create", $model->id);

                $this->redirect(array('admin'));
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

        $this->authorize('AzioniCorrettive', 'update', $model->id_utente, $model->unita_operativa);

        $model->setDefaultValue();
        
        if (isset($_POST['DbAzionicorrettive'])) {
            $model->attributes = $_POST['DbAzionicorrettive'];
            $model->setAttribute('descrizione', Yii::app()->MyUtils->reverseDate($model->attributes['descrizione'], 'db'));
            $model->setAttribute('data_aggiornamento', date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i"));
            $model->setAttribute('data_az', Yii::app()->MyUtils->reverseDate($model->data_az));

            if($model->typeUser == 'admin') {
                $model->setAttribute('data', (new DateTime($_POST['DbAzionicorrettive']['data']))->format('Y-m-d H:i:s'));
            }

            #GESTIONE ALLEGATI -------------------------------------------------
            $model->allegato = CUploadedFile::getInstance($model, 'allegato');
            if ($model->allegato && $model->allegato != '')
                $model->allegato->saveAs(Yii::app()->basePath . '/../images/allegati/' . $model->allegato);
            else
                $model->setAttribute('allegato', $model->getAllegato($model->attributes['id']));


            # MANDO EMAIL -----------------------------------------------------
            if ($model->save()) {
                Yii::app()->user->setFlash('opResultOK', 'Azione correttiva / preventiva <b>' . $model->codice_riferimento . "</b> aggiornata con successo");

                # INVIO EMAIL AGGIORNAMENTO AZIONE -------------------------------
                Yii::app()->MyEmails->sendEmailAc("ac_update", $model->id);

                // INVIO NOTIFICHE PUSH
                Yii::app()->MyPush->newNotificaton($model->tableName(), "ac", "update", $model->id);

                $this->redirect(array('admin'));
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

        $this->authorize('AzioniCorrettive', 'delete', $model->id_utente, $model->unita_operativa);

        Yii::app()->user->setFlash('opResultOK', 'Azione correttiva / preventiva <b>' . $model->codice_riferimento . "</b> eliminata con successo");
        Yii::app()->MyPush->newNotificaton($model->tableName(), "ac", "delete", $id);
        
        $model->delete();
        
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionIndex()
    {
        $this->authorize('AzioniCorrettive', 'view');

        $dataProvider = new CActiveDataProvider('DbAzionicorrettive');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin()
    {
        $this->authorize('AzioniCorrettive', 'view');

        $model = new DbAzionicorrettive('search');
        $model->unsetAttributes();  // clear any default values
        $model->setDefaultValue();
        
        if (isset($_GET['DbAzionicorrettive']))
            $model->attributes = $_GET['DbAzionicorrettive'];
        
        $this->render('admin', array('model' => $model, ));
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $model = $this->loadModel($id);

        $this->authorize('AzioniCorrettive', 'view', $model->id_utente, $model->unita_operativa);

        $this->render('view',array(
            'model'=>$model,
        ));
    }

    public function loadModel($id)
    {
        $model = DbAzionicorrettive::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'La pagina richiesta non esiste.');
        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'db-azionicorrettive-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
