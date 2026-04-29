<?php

class DbReclamiController extends Controller {

    public $layout = '//layouts/column2';

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin', 'delete', 'view', 'esporta', 'getAzione', 'azione', 'statistiche','stampa','stampaGrafici'),
                //'users' => Yii::app()->MyUtils->getPermition('azioni'),
                'users' => Yii::app()->user->accessController('Reclami'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    
    public function actionStampa($id)
    {
        $this->authorize('Reclami', 'view');

        $model = $this->loadModel($id);
        $model->setDefaultValue();
        $html2pdf = Yii::app()->ePdf->HTML2PDF('P', 'A4', 'en', false, 'ISO-8859-15', array(mL, mT, mR, mB));
        $html2pdf->WriteHTML($this->renderPartial('_print', array('model' => $model), true));
        $html2pdf->Output('reclamo-' . $model->codice . '.pdf', 'D');
    }
    
    /*
    public function actionStampaGrafici($anno = null){
        
        $model = new DbReclami('search');
        !$anno ? $anno = '2018':''; 
        $html2pdf = Yii::app()->ePdf->HTML2PDF('L', 'A4', 'en', false, 'ISO-8859-15', array(mL, mT, mR, mB));
        $html2pdf->WriteHTML($this->renderPartial('_grafici', array('model' => $model,'anno' => $anno ), true));
        $html2pdf->Output('statistiche-'.$anno . '.pdf', 'D');
        
    }
    */
    
    public function actionStampaGrafici()
    {
        $this->authorize('Reclami', 'view');

        $anno  = $_POST['anno'] ;
        $model = new DbReclami('search');
        $file  ='statistiche-'.$anno ;

        $html2pdf = Yii::app()->ePdf->HTML2PDF('L', 'A4', 'en', false, 'UTF-8', array(mL, mT, mR, mB));

        $pdf = $this->renderPartial('_grafici', array('model' => $model,'anno' => $anno), true);
        
        $html2pdf->WriteHTML($pdf);
        $html2pdf->Output( YiiBase::getPathOfAlias('webroot').'/protected/stampe/statistiche/'.$file.'.pdf', 'F');
        
        header('Content-Type: application/json; charset="UTF-8"');
        echo CJSON::encode(array('stampa' => 'protected/stampe/statistiche/'.$file.'.pdf?ver='.time()));
        Yii::app()->end();
    }
    
    public function actionAzione($id)
    {
        $model = new ReclamiAzioni;
        $model->redirect(array('admin'));
    }

    public function actionEsporta($anno = null) 
    {
        $model = new DbReclami('search');
        $model->datiEsportazione = $model->getEsportazione($anno);
        $this->renderPartial('_esporta', array('model' => $model));
    }

    public function actionStatistiche($anno = null , $struttura = null) 
    {
        $this->authorize('Reclami', 'view');

        $model = new DbReclami();
        $model->setDefaultValue();
        $model->anno = $anno ?: date('Y');
        
        $model->stats = Yii::app()->MyStats->getStatsAzioni($model->anno);

        $this->render('stats', array('model' => $model));
    }

    public function actionView($id)
    {
        $model = $this->loadModel($id);

        $this->authorize('Reclami', 'view', $model->id_utente, $model->unita_operativa);

        $this->render('view', array('model' => $model));
    }

    public function actionGetAzione()
    {
        $this->authorize('Reclami', 'create');

        $select = Yii::app()->MyUtils->getSelect("doc_funzione");

        $n = $_POST['id'] + 1;
        $text .= ' <div class="block-azione row-extra" id ="new-row-' . $_POST['id'] . '">';

        $text .= '<div class="row">';
        $text .= '<div class="col-xs-312 col-sm-12 extra-row">';
        $text .= '<label for="" class="control-label">Descrizione azione ' . $n . ' </label>';
        $text .= '<textarea type="text" name="NewAzione[' . $_POST['id'] . '][descrizione]"   class="form-control extra-prezzo"  /></textarea>';
        $text .= '</div>';
        $text .= '</div>';
        $text .= '<div class="row row-10">';

        $text .= '<div class="col-xs-12 col-sm-2 extra-row">';
        $text .= '<label for="" class="control-label">Entro il</label>';
        $text .= ' <div class="input-group">';
        $text .= ' <span class="input-group-addon"><i class="fa fa-calendar"></i></span>';
        $text .= '<input type="text" name="NewAzione[' . $_POST['id'] . '][entro_il]"  class="form-control hasDatepicker form-size richiamo" style="width: 100px !important" />';
        $text .= '</div>';
        $text .= '</div>';


        $text .= '<div class="col-xs-6 col-sm-2 extra-row">';
        $text .= '<label for="" class="control-label">Nome</label>';
        $text .= '<input type="text" name="NewAzione[' . $_POST['id'] . '][nome]"   class="form-control extra-prezzo disabled" value=""  />';
        $text .= '</div>';

        $text .= '<div class="col-xs-6 col-sm-2 extra-row">';
        $text .= '<label for="" class="control-label">Cognome</label>';
        $text .= '<input type="text" name="NewAzione[' . $_POST['id'] . '][cognome]"   class="form-control extra-unit" value="" />';
        $text .= '</div>';

        $text .= '<div class="col-xs-12 col-sm-2 extra-row">';
        $text .= '<label for="" class="control-label">Funzione</label>';
        $text .= '<select name="NewAzione[' . $_POST['id'] . '][funzione]"  class="form-control" >';
        $text .= '<option value="">Seleziona</option>';
        foreach ($select AS $id => $val) {
            $text .= '<option value ="' . $id . '"   >' . $val . '</option>';
        }
        $text .= '</select>';
        $text .= '</div>';

        $text .= '<div class="col-xs-10 col-sm-3 extra-row">';
        $text .= '<label for="" class="control-label">Allegato</label>';
        $text .= '<input type="file" name="NewAzione[' . $_POST['id'] . '][allegato]"   class="form-control extra-unit" value="" />';
        $text .= '</div>';


        $text .= '<div class="col-xs-2  col-sm-1 extra-row">';
        $text .= '<label for="" class="control-label">&nbsp;</label><br />';
        $text .= '<span class="row-action"><a href="javascript:delExtraRow(\'new\',' . $_POST['id'] . ')" data-extra="new" data-extraid="' . $_POST['id'] . '" class="dell-extra btn btn-danger btn-sm btn-medium open-search  button-icon button-icon-red"style="padding: 7px" rel= "tooltip" data-toggle="tooltip" title= "Elimina azione" ><i class="fa fa-trash"></i></a></span>';
        $text .= '</div>';

        $text .= '</div>';
        $text .= '</div>';

        header('Content-Type: application/json; charset="UTF-8"');
        echo CJSON::encode(array('text' => $text));

        Yii::app()->end();
    }

    public function actionCreate()
    {
        $this->authorize('Reclami', 'create');

        $model = new DbReclami;
        $model->setDefaultValue();
        
        # SETTO LA STRUTTURA DI RIFERIMENTO PER L'UTENTE -----------------------
        if (Yii::app()->user->getId() != 110 && $model->typeUser != 'admin')
            $model->setAttribute('unita_operativa', Yii::app()->MyUtils->getStrutturaId());
        
        
        if (isset($_POST['DbReclami'])) {

            $model->attributes = $_POST['DbReclami'];

            $model->id_utente = Yii::app()->user->getId();
            
            if($model->typeUser != 'admin')
                $model->setAttribute('data_inserimento', date("Y") . "-" . date("m") . "-" . date("d"));
            else
                $model->setAttribute('data_inserimento', (new DateTime($_POST['DbReclami']['data_inserimento']))->format('Y-m-d'));
            
            $model->setAttribute('anno', date("Y"));
            $model->codice = $model->generaCodice();

            # GESTIONE EVENTUALI ALLEGATI --------------------------------------
            $model->allegato = CUploadedFile::getInstance($model, 'allegato');

            if ($model->allegato && $model->allegato != '') {
                $model->allegato->saveAs(Yii::app()->basePath . '/../images/allegati_reclami/' . $model->allegato);
                $model->setAttribute('allegato', $model->allegato);
            }

            if ($model->save()) {

                if ($model->non_conformita == 'Y')
                    $model->nonConforme();


                if (isset($_POST['NewAzione'])) {
                    foreach ($_POST['NewAzione'] as $valNew => $new) {

                        if ($_FILES['NewAzione']['name'][$valNew]['allegato'])
                            $new['allegato'] = $_FILES['Azione']['name'][$valNew]['allegato'];
                        else
                            $new['allegato'] = Yii::app()->db->createCommand("SELECT allegato FROM db_reclami_azioni WHERE id = '" . $new['id'] . "'  ")->queryScalar();

                        $model->addAzioneReclamo($new, $model->id);
                        
                        if (is_uploaded_file($_FILES['NewAzione']['tmp_name'][$valNew]['allegato'])) {
                            move_uploaded_file($_FILES['NewAzione']['tmp_name'][$valNew]['allegato'], Yii::app()->basePath . '/../images/allegati_azioni/' . $new['allegato']);
                        }
                    }
                }

                # INVIO EMAIL AGGIORNAMENTO AZIONE -------------------------------
                Yii::app()->MyEmails->sendEmailRe("re_create", $model->id);

                // INVIO NOTIFICHE PUSH
                Yii::app()->MyPush->newNotificaton($model->tableName(), "re", "create", $model->id);

                Yii::app()->user->setFlash('opResultOK', 'Nuovo reclamo <b>' . $model->codice . "</b> creato con successo");
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

        $this->authorize('Reclami', 'update', $model->id_utente, $model->unita_operativa);

        $model->setDefaultValue();
        $model->setAzioni();

        if (isset($_POST['DbReclami'])) {

            $model->attributes = $_POST['DbReclami'];

            if($model->typeUser == 'admin') {
                $model->setAttribute('data_inserimento', (new DateTime($_POST['DbReclami']['data_inserimento']))->format('Y-m-d'));
            }

            # GESTIONE EVENTUALI ALLEGATI 
            $model->allegato = CUploadedFile::getInstance($model, 'allegato');
            if ($model->allegato && $model->allegato != '') {
                $model->allegato->saveAs(Yii::app()->basePath . '/../images/allegati_reclami/' . $model->allegato);
                $model->setAttribute('allegato', $model->allegato);
            }
            else
                $model->setAttribute('allegato', $model->getOldAllegato());

            if ($model->save()) {

                if ($model->non_conformita == 'Y')
                    $model->nonConforme();

                Yii::app()->user->setFlash('opResultOK', 'Reclamo <b>' . $model->codice . "</b> aggiornato con successo");

                if (isset($_POST['Azione']) || isset($_POST['NewAzione'])) {

                    if (isset($_POST['NewAzione'])) {
                        foreach ($_POST['NewAzione'] as $valNew => $new) {

                            if ($_FILES['NewAzione']['name'][$valNew]['allegato'])
                                $new['allegato'] = $_FILES['Azione']['name'][$valNew]['allegato'];
                            else
                                $new['allegato'] = Yii::app()->db->createCommand("SELECT allegato FROM db_reclami_azioni WHERE id = '" . $new['id'] . "'  ")->queryScalar();

                            $model->addAzioneReclamo($new, $model->id);

                            if (is_uploaded_file($_FILES['NewAzione']['tmp_name'][$valNew]['allegato'])) {
                                move_uploaded_file($_FILES['NewAzione']['tmp_name'][$valNew]['allegato'], Yii::app()->basePath . '/../images/allegati_azioni/' . $new['allegato']);
                            }
                        }
                    }


                    if (isset($_POST['Azione'])) {

                        foreach ($_POST['Azione'] as $valOld => $old) {

                            if ($_FILES['Azione']['name'][$valOld]['allegato'])
                                $old['allegato'] = $_FILES['Azione']['name'][$valOld]['allegato'];
                            else
                                $old['allegato'] = Yii::app()->db->createCommand("SELECT allegato FROM db_reclami_azioni WHERE id = '" . $old['id'] . "'  ")->queryScalar();

                            $model->addAzioneReclamo($old, $id);
                            if (is_uploaded_file($_FILES['Azione']['tmp_name'][$valOld]['allegato'])) {
                                move_uploaded_file($_FILES['Azione']['tmp_name'][$valOld]['allegato'], Yii::app()->basePath . '/../images/allegati_azioni/' . $old['allegato']);
                            }
                        }
                    }
                }

                # INVIO EMAIL AGGIORNAMENTO AZIONE -------------------------------
                Yii::app()->MyEmails->sendEmailRe("re_update", $model->id);

                // INVIO NOTIFICHE PUSH
                Yii::app()->MyPush->newNotificaton($model->tableName(), "re", "update", $model->id);

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

        $this->authorize('Reclami', 'delete', $model->id_utente, $model->unita_operativa);

        Yii::app()->MyPush->newNotificaton($model->tableName(), "re", "delete", $id);

        $model->removeAction();
        $model->delete();

        // INVIO NOTIFICHE PUSH


        Yii::app()->user->setFlash('opResultOK', 'Reclamo <b>' . $model->codice . "</b> eliminato con successo");
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionIndex()
    {
        $this->authorize('Reclami', 'view');

        $dataProvider = new CActiveDataProvider('DbReclami');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin()
    {
        $this->authorize('Reclami', 'view');

        $model = new DbReclami('search');
        $model->unsetAttributes();  // clear any default values
        $model->setDefaultValue();
        $model->setAttribute('anno', date("Y"));
        
        if (isset($_POST['DbReclami']))
            $model->attributes = $_POST['DbReclami'];

        $this->render('admin', array('model' => $model,));
    }

    public function loadModel($id)
    {
        $model = DbReclami::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) 
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'db-reclami-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
