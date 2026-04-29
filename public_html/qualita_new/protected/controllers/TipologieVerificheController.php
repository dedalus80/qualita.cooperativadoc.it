<?php

class TipologieVerificheController extends Controller {

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

    public function actionCreate() {
        $model = new TipologieVerifiche;
        $model->setSelect();

        if (isset($_POST['TipologieVerifiche'])) {
            $model->attributes = $_POST['TipologieVerifiche'];
            $model->setAttribute('colore', Yii::app()->db->createCommand("SELECT id FROM doc_colori WHERE colore='" . $model->colore . "'")->queryScalar());

            if ($model->save()) {
                Yii::app()->user->setFlash('opResultOK', 'Tipologia verifica <b>' . $model->nome . "</b>creata con successo");
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

        if (isset($_POST['TipologieVerifiche'])) {
            $model->attributes = $_POST['TipologieVerifiche'];
            $model->setAttribute('colore', Yii::app()->db->createCommand("SELECT id FROM doc_colori WHERE colore='" . $model->colore . "'")->queryScalar());

            if ($model->save()) {
                Yii::app()->user->setFlash('opResultOK', 'Tipologia verifica <b>' . $model->nome . "</b> aggiornata con successo");
                $this->redirect(array('admin'));
            }
        }

        $question = new VerificheQuestions();
        $group = new VerificheQuestionsGroups();


        /*$criteria = new CDbCriteria;
        $criteria->join = "INNER JOIN doc_verifiche_questions q ON (q.groupId = t.id)";
        $criteria->condition = "tipologiaVerificaID=$id";*/

        $groupQuestions = VerificheQuestionsGroups::model()->with('verificheQuestions')->findAllByAttributes(array('tipologiaVerificaId'=>$id));

        $this->render('update', array(
            'model' => $model,
            'question' => $question,
            'group' => $group,
            'groupQuestions' => $groupQuestions
        ));
    }

    public function actionDelete($id) {
        $model = $this->loadModel($id);
        $model->delete();
        Yii::app()->user->setFlash('opResultOK', 'Tipologia verifica <b>' . $model->nome . '</b> rimossa con successo');


        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionAdmin() {
        $model = new TipologieVerifiche('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['TipologieVerifiche']))
            $model->attributes = $_GET['TipologieVerifiche'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function loadModel($id) {
        $model = TipologieVerifiche::model()->with(array('verificheQuestions','questionsGroups'))->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'tipologie-verifiche-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
