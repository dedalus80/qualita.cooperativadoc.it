<?php
    Yii::import('zii.widgets.CMenu', true);

    class DocumentMenu extends CMenu
    {

        public function init()
        {
            //$criteria = new CDbCriteria;
            //$criteria->condition = '`status` = 1';
            //$criteria->order = '`position` ASC';

            $items = DocumentiQualitaProcedura::model()->findAll();

            if(Yii::app()->user->getState('group') == 'ADMIN')
                $this->items[] = array('label'=>'Admin', 'url'=> Yii::app()->request->baseUrl.'/index.php/documentiQualitaProcedura/admin');
            else
                $this->items[] = array('label'=>'Documenti', 'url'=> Yii::app()->request->baseUrl.'/index.php/documentiQualita/index');

            foreach ($items as $item)
                $this->items[] = array('label'=>$item->procedura, 'url'=> Yii::app()->request->baseUrl.'/index.php/documentiQualita/index/'.$item->id);

            parent::init();
        }
    }
