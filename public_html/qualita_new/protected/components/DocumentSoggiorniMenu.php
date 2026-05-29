<?php
    Yii::import('zii.widgets.CMenu', true);

    class DocumentSoggiorniMenu extends CMenu
    {

        public function init()
        {
            //$criteria = new CDbCriteria;
            //$criteria->condition = '`status` = 1';
            //$criteria->order = '`position` ASC';

            $items = DocumentiSoggiorniProcedura::model()->findAll();

            if(Yii::app()->user->getState('group') == 'ADMIN')
                $this->items[] = array('label'=>'Admin', 'url'=> Yii::app()->request->baseUrl.'/index.php/documentiSoggiorniProcedura/admin');

            $this->items[] = array('label'=>'Elenco Documenti', 'url'=> Yii::app()->request->baseUrl.'/index.php/documentiSoggiorni/index');

            foreach ($items as $item)
                $this->items[] = array('label'=>$item->procedura, 'url'=> Yii::app()->request->baseUrl.'/index.php/documentiSoggiorni/index/'.$item->id);

            parent::init();
        }
    }
