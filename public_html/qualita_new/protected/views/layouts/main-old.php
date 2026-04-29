<? session_start() ?>

<? error_reporting(1)?>

<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
        <![endif]-->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/custom.css" />
        <title><?php echo $this->pageTitle ?></title>
    </head>
    <? if (Yii::app()->user->getId()) { ?>
        <body>
            <?
            $model = new LoginForm;
            $this->renderPartial('../site/login', array('model' => $model,));
            ?>
        </body>        
    <? } else { ?>
        <body class="new">    
            <div class="container" id="page">
                <div id="header">
                    <div id='myheader'>
                        <div id="logo"><?php echo Yii::app()->name; ?> </div>
                        <div id="mainmenu">
                            <?php
                            $this->widget('zii.widgets.CMenu', array(
                                'items' => array(
                                    array('label' => 'NON CONFORMITA\'', 'url' => array('/dbNonconforme/admin'), 'visible' => $_SESSION['user']['id']!=102),
                                    array('label' => 'AZIONI CORRETTIVE - AZIONI PREVENTIVE', 'url' => array('/dbAzionicorrettive/admin'),'visible' => $_SESSION['user']['id']!=102),
                                    array('label' => 'GESTIONE UTENTI', 'url' => array('/utenti/admin'), 'visible' => $_SESSION['user']['user_type']==1),
                                    array('label' => 'QUESTIONARI', 'url' => array('/questionarioDoc/admin'), 'visible' => $_SESSION['user']['user_type']==3  || $_SESSION['user']['user_type']==1 || $_SESSION['user']['id']==75  || $_SESSION['user']['id']==57 ),
                                    array('label' => 'SHARING ONLINE', 'url' => array('/shPreiscrizioni/admin'), 'visible' => $_SESSION['user']['id']==39 || $_SESSION['user']['id']==56  || $_SESSION['user']['id']==1 || $_SESSION['user']['id']==197),
                                    array('label' => 'STESSO PIANO', 'url' => array('/spPreiscrizioni/admin'), 'visible' => Yii::app()->user->getId() ==102 || Yii::app()->user->getId()==1 || Yii::app()->user->getId()==197),
                                    array('label' => 'CAMPUS SANPAOLO', 'url' => array('/caPreiscrizioni/admin'), 'visible' => Yii::app()->user->getId()==1 || Yii::app()->user->getId()==56 || Yii::app()->user->getId()==197),
                                    array('label' => 'ESCI', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest, 'linkOptions'=>array('id'=>'logout'),)
                                ),
                            ));
                            ?>
                        </div><!-- mainmenu -->
                    </div>
                </div><!-- header -->
                <div id="break">
                    <div id="mybreak">
                        <?php if (isset($this->breadcrumbs)): ?>
                        <?php $this->widget('zii.widgets.CBreadcrumbs', array('links' => $this->breadcrumbs)); ?>
                    <?php endif ?>
                    </div>
                </div>    
                <div id="mycontent">
                    
                    <?php echo $content; ?>

                    <div class="clear"></div>
                </div>
                <div id="footer">
                    <div style="text-align: center;">
                        <font class="testoBlu"><b>D.O.C. s.c.s</b> </font> Via Assietta 16/b 10128 Torino <font class="testoBlu"><b>
                                t.</b></font> +39.011.516.20.38 <font class="testoBlu"><b>f.</b></font> +39.011.517.54.86 <font class="testoBlu"><b>e.</b></font> info@cooperativadoc.it <font class="testoBlu"><b>w.</b></font> www.cooperativadoc.it<br/> 
                            P.IVA e C.F. 05617000012 Sistema di Gestione Qualit&agrave; Certificato ISO 9001 ente CSQA n&deg; cert 5975 <img src='<?php echo Yii::app()->request->baseUrl; ?>/images/qualita-doc-black.png' style="vertical-align: middle" /> 

                    </div>
                </div>

            </div>
        </body>
    <? } ?>
</html>
