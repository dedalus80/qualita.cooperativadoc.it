<?php
    Yii::import('zii.widgets.CMenu', true);

    class VerificheMenu extends CMenu
    {

        public function init()
        {
            //$criteria = new CDbCriteria;
            //$criteria->condition = '`status` = 1';
            //$criteria->order = '`position` ASC';

            if (Yii::app()->MyUtils->getMenuPermition('verifiche')) {

                $items = TipologieVerifiche::model()->findAll("is_hidden = :status", array(':status'=>'N'));

                if(Yii::app()->user->getState('group') == 'ADMIN') {
                    $this->items[] = array('label'=>'Verifiche', 'url'=> Yii::app()->request->baseUrl.'/index.php/azioniVerifiche/admin');
                    $this->items[] = array('label'=>'Indicatori per strutture', 'url'=> Yii::app()->request->baseUrl.'/index.php/azioniVerifiche/indicatoriStrutture');
                } else {
                    $this->items[] = array('label'=>'Verifiche', 'url'=> Yii::app()->request->baseUrl.'/index.php/azioniVerifiche/index');
                }

                    /*<li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/azioniVerifiche/calendario">Calendario Verifiche</a></li>
                    <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/azioniVerifiche/indicatoriStrutture">Indicatori per strutture</a></li>*/

                $this->items[] = array('label'=>'Calendario Verifiche', 'url'=> Yii::app()->request->baseUrl.'/index.php/azioniVerifiche/calendario');
                

                foreach ($items as $item) {
                    if (in_array($item->id, array(1,3,4,6,7,8)) && Yii::app()->MyUtils->getMenuPermition('verifiche_int'))
                        $this->items[] = array('label'=>$item->nome, 'url'=> Yii::app()->request->baseUrl.'/index.php/azioniVerifiche/index/'.$item->id);
                    else
                        $this->items[] = array('label'=>$item->nome, 'url'=> Yii::app()->request->baseUrl.'/index.php/azioniVerifiche/index/'.$item->id);
                }
            }

            parent::init();
        }
    }
