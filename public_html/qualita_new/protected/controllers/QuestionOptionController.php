<?php

class QuestionOptionController extends Controller
{
    public function filters()
    {
        return array(
            'accessControl',
            'postOnly + delete',
        );
    }

    public function accessRules()
    {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('index', 'view', 'create', 'update', 'delete'),
                'expression'=>'Yii::app()->user->getState("group") == "ADMIN"',
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('QuestionOption');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionView($id)
    {
        $model = $this->loadModel($id);
        $this->render('view', array('model' => $model));
    }

    public function actionCreate($question_id)
    {
        $model = new QuestionOption;
        $model->question_id = $question_id;

        if (isset($_POST['QuestionOption'])) {
            $model->attributes = $_POST['QuestionOption'];
            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Opzione creata con successo.');
                $this->redirect(array('question/view', 'id' => $question_id));
            }
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (isset($_POST['QuestionOption'])) {
            $model->attributes = $_POST['QuestionOption'];
            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Opzione aggiornata.');
                $this->redirect(array('question/view', 'id' => $model->question_id));
            }
        }

        $this->render('update', array('model' => $model));
    }

    public function actionDelete($id)
    {
        $model = $this->loadModel($id);
        $question_id = $model->question_id;
        $model->delete();

        Yii::app()->user->setFlash('success', 'Opzione eliminata.');
        $this->redirect(array('question/view', 'id' => $question_id));
    }

    public function loadModel($id)
    {
        $model = QuestionOption::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'Opzione non trovata.');
        return $model;
    }
}
