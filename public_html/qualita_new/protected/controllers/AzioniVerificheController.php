<?php

class AzioniVerificheController extends Controller {

    public $layout = '//layouts/column2';

    public function filters() {
        return array(
            'accessControl',
        );
    }

    public function accessRules() {

        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'create', 'update', 'admin', 'delete', 'verifica', 'calendario', 'getVerifica', 'setVerifica', 'tipoVerifica', 'indicatoriStrutture','processi','esterne','compila','stampa','modello','downloadNc'),
                'users' => Yii::app()->MyUtils->getPermition('verifiche'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionVerifica() {

        $model = $this->loadModel($_POST['id']);
        $dati = $model->checkVerifica();
        header('Content-Type: application/json; charset="UTF-8"');
        echo CJSON::encode(array('controller' => $dati['controller'], 'idverifica' => $dati['idverifica']));
        Yii::app()->end();
    }

    public function actionIndicatoriStrutture() {
        $model = new AzioniVerifiche('search');
        $model->indicatori = Yii::app()->MyStats->setIndicatoriVerifiche();
        
        $indicatori = $model->getIndicatoriStrutture();
        //exit;
        
        //$this->render('indicatoriStrutture', array('model' => $model,));
        $this->render('indicatoriStrutture', array('model' => $model, 'indicatori' => $indicatori));
    }

    public function actionCalendario($anno = null) {

        $model = new AzioniVerifiche;
        if ($anno) {
            $model->anno = $anno;
            $model->calendario = "anno";
        } else {
            $model->anno = date("Y");
            $model->calendario = "mesi";
        }

        $model->setDefaultValue();
        if ($model->datiAdmin['admin'] != true)
            $model->setAttribute('unita_operativa', $model->datiAdmin['user_unita']);

        $stats = $model->getVerifiche();
        $verifiche = $model->getSmallVerifiche($model->anno);

        $model->selectAnni = Yii::app()->MyUtils->getYears();
        $this->render('calendario', array("model" => $model, 'stats' => $stats, 'verifiche' => $verifiche));
    }

    public function actionCreate() {

        $model = new AzioniVerifiche;
        $model->setDefaultValue();

        if (isset($_POST['AzioniVerifiche'])) {

            $model->attributes = $_POST['AzioniVerifiche'];
            $model->setAttribute('data_prevista', Yii::app()->MyUtils->reverseDate($model->data_prevista));
            
            $model->data_prevista_fine ? $model->setAttribute('data_prevista_fine', Yii::app()->MyUtils->reverseDate($model->data_prevista_fine)) : $model->setAttribute('data_prevista_fine', NULL);
            $model->setAttribute('data_effettiva', Yii::app()->MyUtils->reverseDate($model->data_effettiva));
            $model->setAttribute('codice', $model->getCodice());
            $model->setAttribute('anno', date("Y"));
			$model->setAttribute('compilatore',  Yii::app()->user->getId()  );
			
			#GESTIONE ALLEGATI -------------------------------------------------
            $model->diario = CUploadedFile::getInstance($model, 'diario');
            if ($model->diario && $model->diario != '') {
                $model->diario->saveAs(Yii::app()->basePath . '/../images/diari_verifiche/' . $model->diario);
                $model->setAttribute('diario', $model->diario);
            }
			$model->verbale = CUploadedFile::getInstance($model, 'verbale');
            if ($model->verbale && $model->verbale != '') {
                $model->verbale->saveAs(Yii::app()->basePath . '/../images/verbali_verifiche/' . $model->verbale);
                $model->setAttribute('verbale', $model->verbale);
            }
			
            if ($model->save()) { 

                // INVIO NOTIFICHE PUSH
                Yii::app()->MyPush->newNotificaton($model->tableName(), "ve", "create", $model->id);

                // MANDO EMAIL ALL'INCARICATO
                Yii::app()->MyEmails->sendEmailVerifica("verifica", $model->id);

                Yii::app()->user->setFlash('opResultOK', 'Verifica  <b>' . $model->codice . "</b> inserita con successo");
                $this->redirect(array('admin'));
            }
        }
        $this->render('create', array('model' => $model,));
    }

    public function actionUpdate($id) {
        
        $error = false ;
        
        // MANDO EMAIL ALL'INCARICATO PER TEST
        //Yii::app()->MyEmails->sendEmailVerifica("verifica", $id);
        
        $model = $this->loadModel($id);
        $model->setDefaultValue();

        if (isset($_POST['AzioniVerifiche'])) {
            $model->attributes = $_POST['AzioniVerifiche'];

            $model->setAttribute('data_prevista', Yii::app()->MyUtils->reverseDate($model->data_prevista));
            $model->setAttribute('data_effettiva', Yii::app()->MyUtils->reverseDate($model->data_effettiva));
            $model->data_prevista_fine ? $model->setAttribute('data_prevista_fine', Yii::app()->MyUtils->reverseDate($model->data_prevista_fine)) : $model->setAttribute('data_prevista_fine', NULL);
            //$model->setAttribute('codice', $model->getCodice());
            $model->setAttribute('compilatore',  Yii::app()->user->getId()  );
			
			
			#GESTIONE ALLEGATI -------------------------------------------------
            $model->diario = CUploadedFile::getInstance($model, 'diario');
            if ($model->diario && $model->diario != '') {
                $model->diario->saveAs(Yii::app()->basePath . '/../images/diari_verifiche/' . $model->diario);
                $model->setAttribute('diario', $model->diario);
            }
			else
				$model->diario = $model->getAllegato("diario");
			
			$model->verbale = CUploadedFile::getInstance($model, 'verbale');
			
            if ($model->verbale && $model->verbale != '') {
                $model->verbale->saveAs(Yii::app()->basePath . '/../images/verbali_verifiche/' . $model->verbale);
                
            }else
				$model->verbale = $model->getAllegato("verbale");
			
			
			if($model->verbale !='' && $model->diario !='' && ($model->tipo_verifica =='6' || $model->tipo_verifica =='8'))
                $model->completa ='Y';
			
            
            // AGGIUNTO PER VERIFCARE CARICAMENTO VERBALE 
            if($model->diario  && !file_exists(Yii::app()->basePath . '/../images/diari_verifiche/' . $model->diario)){
                $error = true ;
                $error_text .= "Non è stato possibile caricare il diario ".$model->diario." : Verificarne il peso e l'estenzione <br />";
            }
            
            if($model->verbale  && !file_exists(Yii::app()->basePath . '/../images/verbali_verifiche/' . $model->verbale)){
                $error = true ;
                $error_text .= "Non è stato possibile caricare il diario ".$model->verbale." : Verificarne il peso e l'estenzione <br />";
            }
                        
            if($error == false){
                if ($model->save()) {

                    // INVIO NOTIFICHE PUSH
                    Yii::app()->MyPush->newNotificaton($model->tableName(), "ve", "update", $model->id);

                    // MANDO EMAIL ALL'INCARICATO
                    //Yii::app()->MyEmails->sendEmailVerifica("verifica", $model->id);

                    Yii::app()->user->setFlash('opResultOK', 'Verifica  <b>' . $model->codice . "</b> aggiornata con successo");
                    $this->redirect(array('admin'));
                }
            }else
                Yii::app()->user->setFlash('opResultKO', 'Errore aggiornamento verifica <b>' . $model->codice . "</b><br />".$error_text);
        }
        
        $this->render('update', array('model' => $model,));
    }

    public function actionGetverifica() {

        $action = $_POST['action'];

        if ($action == 'get') {
            $model = new AzioniVerifiche;
            $dati = $model->getVerifica($_POST['id']);
            header('Content-Type: application/json; charset="UTF-8"');
            echo CJSON::encode(array('codice' => $dati['codice'], 'unita_operativa' => $dati['unita_operativa'],  'nome_unita' => $dati['nome_unita'],'tipo_verifica' => $dati['tipo_verifica'], 'tipo_processo' => $dati['tipo_processo'], 'prima_verifica' => $dati['prima_verifica'], 'seconda_verifica' => $dati['seconda_verifica'], 'incaricato' => $dati['incaricato'] , 'dettaglio' => $dati['dettaglio'] ));
            Yii::app()->end();
        }
        else if ($action == 'set') {

            $model = new AzioniVerifiche;
            $model->unita_operativa = $_POST['unita_operativa']; #= "adoum";
            $model->tipo_verifica 	= $_POST['tipo_verifica']; #= "cognome";
            $model->tipo_processo 	= $_POST['tipo_processo']; #= "cognome";
            $model->prima_verifica 	= $_POST['prima_verifica']; #= "22-07-2015";
            $model->seconda_verifica = $_POST['seconda_verifica']; #= "22-07-2015";
            $model->incaricato 		= $_POST['incaricato']; #= "22-07-2015";
            $model->dettaglio 		= $_POST['dettaglio']; #= "22-07-2015";

            $dati = $model->setVerifica($_POST['id']);

            header('Content-Type: application/json; charset="UTF-8"');
            echo CJSON::encode(array(
                'mex' => $dati['messaggio'],
                'newVerifiche' => $dati['newVerifiche'],
                'idRemove' => $dati['idRemove'],
                'remove' => $dati['remove'],
                'newDate' => $dati['newDate'],
                'stato' => $dati['stato'],
                'error' => $dati['error']
            ));

            Yii::app()->end();
        }
    }

    public function actionSetverifica() {

        $action = $_POST['action'];


        if ($action == 'get') {
            $model = new AzioniVerifiche;
            $dati = $model->getVerifica($_POST['id']);
            header('Content-Type: application/json; charset="UTF-8"');
            echo CJSON::encode(array('unita_operatia' => $dati['unita_operativa'], 'tipo_verifica' => $dati['tipo_verifica'], 'prima_verifica' => $dati['prima_verifica'], 'seconda_verifica' => $dati['seconda_verifica'], 'incaricato' => $dati['incaricato']));
            Yii::app()->end();
        } else if ($action == 'set') {

            $model = new AzioniVerifiche;
            $model->unita_operativa = $_POST['unita_operativa']; #= "adoum";
            $model->tipo_verifica = $_POST['tipo_verifica']; #= "cognome";
            $model->tipo_processo = $_POST['tipo_processo']; #= "cognome";
            $model->prima_prevista = $_POST['prima_verifica']; #= "22-07-2015";
            $model->seconda_prevista = $_POST['seconda_verifica']; #= "22-07-2015";
            $model->incaricato = $_POST['incaricato']; #= "22-07-2015";
			$model->dettaglio 		= $_POST['dettaglio']; #= "22-07-2015";
            $dati = $model->setVerifica($id);

            header('Content-Type: application/json; charset="UTF-8"');
            echo CJSON::encode(array(
                'mex' => $dati['messaggio'],
                'scadenze' => $dati['scadenze'],
                'remove' => $dati['remove'],
                'newDate' => $dati['newDate'],
            ));

            Yii::app()->end();
        }
    }

    public function actionDelete($id) {
        $model = $this->loadModel($id);

        // rimuovo le eventuali inspezioni fatte
        if ($model->tipo_verifica == '2')
            $model->rimuoviInspezioni();

        // INVIO NOTIFICHE PUSH
        Yii::app()->MyPush->newNotificaton($model->tableName(), "ve", "delete", $model->id);
        Yii::app()->user->setFlash('opResultOK', ' Verifica inspettiva  <b>' . Yii::app()->MyUtils->getSelectValue($model->tipo_verifica, "doc_tipologie_verifiche") . "</b> rimossa con successo");

        $model->delete();

        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionIndex($id = null) {
        $model = new AzioniVerifiche('search');
        $model->unsetAttributes();  // clear any default values
        $model->setDefaultValue();

        if ($id) {
            $model->tipo_verifica = $id;
        }

        if (isset($_GET['AzioniVerifiche'])) {
            $model->attributes = $_GET['AzioniVerifiche'];
        }
        
        $this->render('index', array('model' => $model,'idTipoVerifica'=>$id));
    }

    public function actionCompila($id) {
        $model = $this->loadModel($id);
        
        $answers = VerificheAnswers::model()->count('verificaId=:id', array(':id'=>$id));
                
        if($answers!=='0') {
            $questions = VerificheQuestionsGroups::model()
                            ->with('verificheQuestions')
                            ->findAll(array('order'=>'`rank`','condition' => 'verificheAnswers.verificaId=:vid', 'params'=>array('vid'=>$id)));
        }
        else {

            $questions = VerificheQuestionsGroups::model()
                            ->with('groupQuestions')
                            ->findAll(array('order'=>'`rank`','condition' => 'groupQuestions.tipologiaVerificaId=:tid', 'params'=>array('tid'=>$model->tipo_verifica)));
        
            //inserisco i record relativi alle risposte con valori null
            foreach($questions as $group) {
                foreach($group['groupQuestions'] as $question) {
                    $data[] = [
                        'verificaId' => $id,
                        'questionId' => $question->id
                    ];
                }
            }
        
            if (!empty($data)) {
                foreach ($data as $row) {
                    Yii::app()->db->createCommand()->insert('doc_verifiche_answers', $row);
                }
            }

            $questions = VerificheQuestionsGroups::model()
                            ->with('verificheQuestions')
                            ->findAll(array('order'=>'`rank`','condition' => 'verificheAnswers.verificaId=:vid', 'params'=>array('vid'=>$id)));
        }

        $totQuestions = VerificheQuestions::model()->count('tipologiaVerificaId=:id', array(':id'=>$model->tipo_verifica));

        $progress = $model->getProgress();

        if(isset($_POST['AzioniVerifiche'])) {
            // Verifica e crea la directory per i file NC se non esiste
            $ncDir = Yii::app()->basePath . '/data/nc';
            if (!file_exists($ncDir)) {
                mkdir($ncDir, 0755, true);
            }
            
            if(isset($_POST['Questions'])) {
                $init=$noConformita=0;
                foreach($_POST['Questions'] as $qid => $risposta) {
                    $answer = VerificheAnswers::model()->findByAttributes(array('verificaId'=>$model->id,'questionId'=>$qid));                
                    if(!$answer) {
                        $answer = new VerificheAnswers();
                    }
                    
                    // Salva il vecchio valore di answer e file_nc per gestire l'eliminazione
                    $oldAnswer = $answer->answer;
                    $oldFileNc = $answer->file_nc;
                    
                    $answer->setAttribute('answer',$risposta['answer']);
                    $answer->setAttribute('verificaId', $model->id);
                    $answer->setAttribute('questionId',$qid);
                    $answer->setAttribute('note',$risposta['note']);
                    
                    // Gestione upload file per risposte NC
                    if($risposta['answer'] == 'NC') {
                        // Gestisci l'upload del file se presente
                        $fileNc = CUploadedFile::getInstanceByName('Questions['.$qid.'][file_nc]');
                        if($fileNc && $fileNc->getError() == UPLOAD_ERR_OK) {
                            // Valida estensione (immagine o PDF)
                            $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif', 'pdf');
                            $extension = strtolower($fileNc->getExtensionName());
                            
                            if(in_array($extension, $allowedExtensions)) {
                                // Genera un nome univoco per il file
                                $fileName = $model->id . '_' . $qid . '_' . time() . '_' . uniqid() . '.' . $extension;
                                $filePath = $ncDir . '/' . $fileName;
                                
                                // Salva il file
                                if($fileNc->saveAs($filePath)) {
                                    // Elimina il vecchio file se esiste
                                    if($oldFileNc && file_exists($ncDir . '/' . $oldFileNc)) {
                                        @unlink($ncDir . '/' . $oldFileNc);
                                    }
                                    $answer->setAttribute('file_nc', $fileName);
                                }
                            }
                        } else {
                            // Se non c'è nuovo file ma la risposta è ancora NC, mantieni il file esistente
                            if($oldAnswer == 'NC' && $oldFileNc) {
                                $answer->setAttribute('file_nc', $oldFileNc);
                            }
                        }
                    } else {
                        // Se la risposta non è più NC, elimina il file se esiste
                        if($oldAnswer == 'NC' && $oldFileNc && file_exists($ncDir . '/' . $oldFileNc)) {
                            @unlink($ncDir . '/' . $oldFileNc);
                        }
                        $answer->setAttribute('file_nc', null);
                    }
                    
                    $answer->save(false);

                    if($risposta['answer']) {
                        $init++;
                    }

                    if($risposta['answer']=='NC') {
                        $noConformita++;
                    }
                }
            }

            $model->attributes = $_POST['AzioniVerifiche'];
            $model->setAttribute('data', Yii::app()->MyUtils->reverseDate($model->data));
            $model->setAttribute('ora_inizio', $model->ora_inizio . ":00");
            $model->setAttribute('ora_fine', $model->ora_fine . ":00");
            $model->setAttribute('anno', date("Y"));
            $model->setAttribute('stato', $init . " / " . $totQuestions);
            $model->setAttribute('non_conformita', $noConformita);

            if ($model->save(false)) {
                if ($model->apertura_nc == 'Y') {
                    $model->openNonConforme();
                }

                // INVIO NOTIFICHE PUSH
                Yii::app()->MyPush->newNotificaton($model->tableName(), "vea", "update", $model->id);
            }

            Yii::app()->user->setFlash('opResultOK', 'Verifica <b>' . $model->codice . "</b> aggiornata con successo");

            $this->redirect(Yii::app()->request->urlReferrer);
        }

        $this->render('updateVerifica', array('model'=>$model,'questions'=>$questions,'progress'=>$progress));
    }

    public function actionAdmin() {
        $model = new AzioniVerifiche('search');
        $model->unsetAttributes();  // clear any default values
        $model->setDefaultValue();
        
        // $model->stats = Yii::app()->MyUtils->getVerificheStats();

        if (isset($_GET['AzioniVerifiche'])) {
            $model->attributes = $_GET['AzioniVerifiche'];
        }

        $this->render('admin', array('model' => $model,));
    }
    
    public function actionEsterne() {
        $model = new AzioniVerifiche('search');
        $model->unsetAttributes();  // clear any default values
        $model->setDefaultValue();
        $model->tipo_verifica = 6;
        // $model->stats = Yii::app()->MyUtils->getVerificheStats();

        if (isset($_POST['AzioniVerifiche']))
            $model->attributes = $_POST['AzioniVerifiche'];
        $this->render('admin', array('model' => $model,));
    }
    
    public function actionProcessi() {
        $model = new AzioniVerifiche('search');
        $model->unsetAttributes();  // clear any default values
        $model->setDefaultValue();
        $model->tipo_verifica = 8;
        // $model->stats = Yii::app()->MyUtils->getVerificheStats();

        if (isset($_POST['AzioniVerifiche']))
            $model->attributes = $_POST['AzioniVerifiche'];
        $this->render('admin', array('model' => $model,));
    }

    public function actionStampa($id) {
        $model = $this->loadModel($id);
        $model->setDefaultValue();

        //$questions = VerificheQuestions::model()
        //                ->with('verificheAnswers')
        //                ->findAll(array('order'=>'ordine','condition' => 'tipologiaVerificaId =:id', 'params'=>array('id' => $model->tipo_verifica)));

        $questions = VerificheQuestionsGroups::model()
                        ->with('verificheQuestions')
                        ->findAll(array('order'=>'`rank`','condition' => 'verificheAnswers.verificaId =:id', 'params'=>array('id' => $id)));

        $progress = $model->getProgress();

        $pdf = $this->renderPartial('_print', array('model' => $model, 'questions'=>$questions, 'progress'=>$progress), true);

        $html2pdf = Yii::app()->ePdf->HTML2PDF('P', 'A4', 'it', true, 'UTF-8', array(mL, mT, mR, mB));
        $html2pdf->WriteHTML($pdf);
        $html2pdf->Output('verifica-ispettiva-' . $model->codice . '.pdf', 'D');
    }

    public function actionModello($id) {

        $model = TipologieVerifiche::model()->findByPk($id);
        
        $questions = VerificheQuestionsGroups::model()
                        ->with('verificheQuestions')
                        ->findAll(array('order'=>'`rank`','condition' => 't.tipologiaVerificaId =:id', 'params'=>array('id' => $model->id)));
                        
        //$totQuestions = VerificheQuestions::model()->count('tipologiaVerificaId=:id', array(':id'=>$model->tipo_verifica));
        
        $html2pdf = Yii::app()->ePdf->HTML2PDF('P', 'A4', 'en', false, 'ISO-8859-15', array(mL, mT, mR, mB));
        $html2pdf->WriteHTML($this->renderPartial('_modello', array('model'=>$model,'questions'=>$questions), true));
        $html2pdf->Output('modello_'.str_replace(' ','-',$model->nome.'.pdf'), 'D');
    }
    
    public function actionDownloadNc($file) {
        $ncDir = Yii::app()->basePath . '/data/nc';
        $filePath = $ncDir . '/' . basename($file);
        
        // Verifica che il file esista e sia nella directory corretta (sicurezza)
        if(file_exists($filePath) && strpos(realpath($filePath), realpath($ncDir)) === 0) {
            $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
            $isImage = in_array($extension, array('jpg', 'jpeg', 'png', 'gif'));
            
            if($isImage) {
                $mimeType = 'image/' . ($extension == 'jpg' ? 'jpeg' : $extension);
            } else {
                $mimeType = 'application/pdf';
            }
            
            header('Content-Type: ' . $mimeType);
            header('Content-Disposition: inline; filename="' . basename($filePath) . '"');
            header('Content-Length: ' . filesize($filePath));
            readfile($filePath);
            Yii::app()->end();
        } else {
            throw new CHttpException(404, 'File non trovato.');
        }
    }
    
    public function loadModel($id) {
        $model = AzioniVerifiche::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'azioni-verifiche-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
