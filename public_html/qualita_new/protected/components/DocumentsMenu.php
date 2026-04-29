<?php
    Yii::import('zii.widgets.CMenu', true);

    class DocumentsMenu extends CMenu
    {

        public function init()
        {
            //$criteria = new CDbCriteria;
            //$criteria->condition = '`status` = 1';
            //$criteria->order = '`position` ASC';

            $items = DocumentsCategory::model()->findAll();

            if(Yii::app()->user->getState('group') == 'ADMIN')
                $this->items[] = array('label'=>'Procedure documenti', 'url'=> Yii::app()->request->baseUrl.'/index.php/documentProcedure/admin');

            foreach ($items as $item)
                $this->items[] = array('label'=>$item->name, 'url'=> Yii::app()->request->baseUrl.'/index.php/document/index/'.$item->id);

            parent::init();
        }
    }