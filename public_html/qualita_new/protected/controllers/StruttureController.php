<?php

class StruttureController extends Controller {

    public $layout = '//layouts/column2';

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin', 'delete', 'view'),
                'users' => Yii::app()->MyUtils->getPermition('admin'),
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

    public function actionCreate() {
        $model = new Strutture;
        $model->setSelectValue();
        if (isset($_POST['Strutture'])) {
            $model->attributes = $_POST['Strutture'];
            $model->setAttribute('colore', Yii::app()->db->createCommand("SELECT id FROM doc_colori WHERE colore='" . $model->colore . "'")->queryScalar());

            if ($model->save()) {

                //inserisco le tipologie di soggiorno in base alla scelta dei questionari da mostrare
                //nella tabella doc_cienti_tipologia_soggiorni
                $sg = array();

                if($model->qjunior == 'Y'){
                    $sg[] = 1;
                }
                if($model->qsenior == 'Y'){
                    $sg[] = 2;
                }
                if($model->qstudio == 'Y'){
                    $sg[] = 3;
                }
                if($model->qscientifici == 'Y') {
                    $sg[] = 4;
                }
                if($model->qsport == 'Y'){
                    $sg[] = 5;
                }
                
                foreach($sg as $s) {
                    $soggiornoCliente = new ClientiTipologiaSoggiorni();
                    $soggiornoCliente->cliente_id = $model->ente;
                    $soggiornoCliente->tipologia_id = $s;
                    $soggiornoCliente->soggiorno_id = $model->id;
                    $soggiornoCliente->save();
                }
                

                Yii::app()->user->setFlash('opResultOK', 'Nuova struttura <b>' . $model->nome . "</b> creata con successo");
                $this->redirect(array('admin'));
            }
        }
        $this->render('create', array('model' => $model,));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $model->setSelectValue();
        if (isset($_POST['Strutture'])) {
            $model->attributes = $_POST['Strutture'];
            $model->setAttribute('colore', Yii::app()->db->createCommand("SELECT id FROM doc_colori WHERE colore='" . $model->colore . "'")->queryScalar());

            if ($model->save()) {

                //elimino i records dei questionari soggiorni dalla tabella clienti_tipologia_soggiorni
                ClientiTipologiaSoggiorni::model()->deleteAllByAttributes(['soggiorno_id' => $model->id]);

                //inserisco le tipologie di soggiorno in base alla scelta dei questionari da mostrare
                //nella tabella doc_cienti_tipologia_soggiorni
                $sg = array();

                if($model->qjunior == 'Y'){
                    $sg[] = 1;
                }
                if($model->qsenior == 'Y'){
                    $sg[] = 2;
                }
                if($model->qstudio == 'Y'){
                    $sg[] = 3;
                }
                if($model->qscientifici == 'Y') {
                    $sg[] = 4;
                }
                if($model->qsport == 'Y'){
                    $sg[] = 5;
                }
                
                foreach($sg as $s) {
                    $soggiornoCliente = new ClientiTipologiaSoggiorni();
                    $soggiornoCliente->cliente_id = $model->ente;
                    $soggiornoCliente->tipologia_id = $s;
                    $soggiornoCliente->soggiorno_id = $model->id;
                    $soggiornoCliente->save();
                }

                Yii::app()->user->setFlash('opResultOK', 'Struttura <b>' . $model->nome . ' </b> aggiornata con successo');
                $this->redirect(array('admin'));
            }
        }
        $this->render('update', array('model' => $model,));
    }

    public function actionDelete($id) {

        ClientiTipologiaSoggiorni::model()->deleteAllByAttributes(['soggiorno_id' => $id]);

        $model = $this->loadModel($id);
        $model->delete();
        Yii::app()->user->setFlash('opResultOK', 'Struttura <b>' . $model->nome . '</b> rimossa con successo');
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Strutture');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin() {
        $model = new Strutture('search');
        $model->setSelectValue();
        $model->unsetAttributes();  // clear any default values
        if (isset($_REQUEST['Strutture']))
            $model->attributes = $_REQUEST['Strutture'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function loadModel($id) {
        $model = Strutture::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'strutture-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
