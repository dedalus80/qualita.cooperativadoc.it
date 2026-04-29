<?php

class ShPreiscrizioniController extends Controller {

    public $layout = '//layouts/column2';

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin', 'delete', 'view', 'esporta', 'accomodations'),
                'users' => Yii::app()->MyUtils->getPermition('SH'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionView($id) {
        $this->render('view', array('model' => $this->loadModel($id)));
    }

    public function actionStampa($id) {
        $html2pdf = Yii::app()->ePdf->HTML2PDF();
        $html2pdf->WriteHTML($this->renderPartial('_print', array('model' => $this->loadModel($id)), true));
        $html2pdf->Output('Sharing_Presiscrizione-' . $id . '.pdf', 'D');
    }

    public function actionEsporta($anni = null) {
        $model = new ShPreiscrizioni('search');
        $model->datiEsportazione = $model->getEsportazione($anni);
        $this->renderPartial('_esporta', array('model' => $model));
    }

    public function actionCreate() {
        $model = new ShPreiscrizioni;
         $model->setSelectValue();

        if (isset($_POST['ShPreiscrizioni'])) {
            $model->attributes = $_POST['ShPreiscrizioni'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create');
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);
         $model->setSelectValue();



        if (isset($_POST['ShPreiscrizioni'])) {

            $model->attributes = $_POST['ShPreiscrizioni'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }
        $this->render('update', array('model' => $model,));
    }

    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('ShPreiscrizioni');
        $this->render('index', array('dataProvider' => $dataProvider));
    }

    public function actionAdmin() {
        $model = new ShPreiscrizioni('search');
        $model->unsetAttributes();  // clear any default values
        $model->setSelectValue();
        $model->setAttribute('anno', date("Y"));
        $model->setSelectValue();
        
        if (isset($_POST['ShPreiscrizioni']))
            $model->attributes = $_POST['ShPreiscrizioni'];
        
        $this->render('admin', array('model' => $model));
    }

    public function loadModel($id) {
        $model = ShPreiscrizioni::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'sh-preiscrizioni-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionAccomodations()
    {
        if(Yii::app()->request->isAjaxRequest) {
            $id = $_POST['id'];

            $data = CHtml::listData(
                Campus::model()->findAll(
                    array('condition' => 'formulaId = :id', 'params' => [':id' => $id], 'order'=> 'nome')
                ), 
                'id', 
                'nome'
            );

            $html = '';

            foreach($data as $id => $val) {
                $html .= '<option value="'.$id.'">'.$val.'</option>';
            }
        
            echo $html;
        }

        Yii::app()->end();
    }

}
