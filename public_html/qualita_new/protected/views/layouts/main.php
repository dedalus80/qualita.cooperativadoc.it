<?php
if (Yii::app()->user->getId()) {
    $userDetail = Yii::app()->MyUtils->getUserInfo();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            <?php echo $this->pageTitle; ?>
        </title>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-touch-fullscreen" content="yes" />
        <meta name="description" content="<?php echo $this->pageTitle; ?>" />
        <meta name="author" content="" />
        <meta name="msapplication-TileImage" content="<?php echo Yii::app()->request->baseUrl; ?>/images/icone/ms-icon-144x144.png" />

        <link href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico" rel="stylesheet" />
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo Yii::app()->request->baseUrl; ?>/images/icone//apple-icon-57x57.png" />
        <link rel="apple-touch-icon" sizes="60x60" href="<?php echo Yii::app()->request->baseUrl; ?>/images/icone/apple-icon-60x60.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo Yii::app()->request->baseUrl; ?>/images/icone/apple-icon-72x72.png" />
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo Yii::app()->request->baseUrl; ?>/images/icone/apple-icon-76x76.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo Yii::app()->request->baseUrl; ?>/images/icone/apple-icon-114x114.png" />
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo Yii::app()->request->baseUrl; ?>/images/icone/apple-icon-120x120.png" />
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo Yii::app()->request->baseUrl; ?>/images/icone/apple-icon-144x144.png" />
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo Yii::app()->request->baseUrl; ?>/images/icone/apple-icon-152x152.png" />
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo Yii::app()->request->baseUrl; ?>/images/icone/apple-icon-180x180.png" />
        <link rel="icon" type="image/png" sizes="192x192" href="<?php echo Yii::app()->request->baseUrl; ?>/images/icone/android-icon-192x192.png" />
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo Yii::app()->request->baseUrl; ?>/images/icone/favicon-32x32.png" />
        <link rel="icon" type="image/png" sizes="96x96" href="<?php echo Yii::app()->request->baseUrl; ?>/images/icone/favicon-96x96.png" />
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo Yii::app()->request->baseUrl; ?>/images/icone/favicon-16x16.png" />

        <?php
        if (Yii::app()->user->getId()) {
            include './protected/config/notifications.php';

            // COMMENTARE QUI SOTTO PER ABILITARE LE FUNZIONI IN FASE DI SVILUPPO
        }
        ?>
        <!-- FullCalendar -->
        <!--[if lt IE 10]>
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap-assets/js/media.match.min.js"></script>
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap-assets/js/placeholder.min.js"></script>
        <![endif]-->
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries. Placeholdr.js enables the placeholder attribute -->
        <!--[if lt IE 9]>
            <link href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap-assets/css/ie8.css" type="text/css" rel="stylesheet"/>   
            <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.1.0/respond.min.js"></script>
            <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap-assets/plugins/charts-flot/excanvas.min.js"></script>
            <script type="text/javascript" src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <!-- The following CSS are included as plugins and can be removed if unused-->
        <style type="text/css">
            .jqstooltip {
                position: absolute;
                left: 0px;
                top: 0px;
                visibility: hidden;
                background: rgb(0, 0, 0) transparent;
                background-color: rgba(0, 0, 0, 0.6);
                filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);
                -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";
                color: white;
                font: 10px arial, san serif;
                text-align: left;
                white-space: nowrap;
                padding: 5px;
                border: 1px solid white;
                z-index: 10000;
            }

            .jqsfield {
                color: white;
                font: 10px arial, san serif;
                text-align: left;
            }

        </style>
    </head>
    <?php
        
        $questionari = array("questionarioFormazione","questionarioDoc","questionarioKeluar","questionarioSharing","questionarioSenior","questionarioJunior","questionarioStudio","questionarioScientifici");
    
        $controller = Yii::app()->controller->id ;
        $action     = Yii::app()->controller->action->id ;
    	
        $controller=='dbReclami' && $action =='statistiche' ? $grafici ='Y':"";
        $controller=='utenzePresenze' && $action =='statistiche' ? $grafici ='Y':"";
        $controller=='utenzePresenze' && $action =='stats' ? $grafici ='Y':"";
        in_array($controller,$questionari) && $action =='grafici' ? $grafici ='Y':"";
        
        if($grafici =='YNS'): ?>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/canvg/1.4/rgbcolor.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/stackblur-canvas/1.4.1/stackblur.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/canvg/dist/browser/canvg.min.js"></script>
            <script src="https://code.highcharts.com/highcharts.js"></script>
            <script src="https://code.highcharts.com/modules/series-label.js"></script>
            <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <?php endif;  ?>
    <body class="<?= Yii::app()->user->getId() ? " infobar-offcanvas " : "focused-form " ?>">
        <div id="body"></div>
        <?php
        /*if (!Yii::app()->user->getId()) {
            $model = new LoginForm;
            $this->renderPartial('../site/login', array('model' => $model,));
        } 
        else {*/
            $counter = Yii::app()->MyStats->getCounter();
        ?>
            <header id="topnav" class="navbar navbar-fixed-top clearfix navbar-primary " role="banner">
                <a id="leftmenu-trigger" class="" data-toggle="tooltip" data-placement="right" title="Apri Menu"></a>
                <a class="navbar-brand" href="index.html">Qualita Cooperativadoc</a>
                <div class="yamm navbar-left navbar-collapse collapse in">
                </div>
                <ul class="nav navbar-nav toolbar pull-right resume" style='padding-right: 10px'>
                    <?php if (Yii::app()->MyUtils->getMenuPermition('azioni')): ?>
                        <li class="dropdown toolbar-icon-bg ">
                            <a href="<?= Yii::app()->request->baseUrl; ?>/index.php/dbNonconforme/admin" class="hasnotifications dropdown-toggle" data-toggle="tooltip" data-placement="bottom" title="Azioni non conformi"><span class="icon-bg"><i class="fa fa-fw fa-thumbs-o-down"></i></span><?= $counter['nonconformi'] > 0 ? '<span class="badge  badge-danger">' . $counter['nonconformi'] . '</span>' : '' ?></a>
                        </li>
                        <li class="dropdown toolbar-icon-bg">
                            <a href="<?= Yii::app()->request->baseUrl; ?>/index.php/dbAzionicorrettive/admin" class="hasnotifications dropdown-toggle" data-toggle="tooltip" data-placement="bottom" title="Azioni correttive"><span class="icon-bg"><i class="fa fa-fw fa-thumbs-o-up"></i></span>  <?= $counter['preventive'] > 0 ? '<span class="badge  badge-success">' . $counter['preventive'] . '</span>' : '' ?></a>
                        </li>
                        <li class="dropdown toolbar-icon-bg ">
                            <a href="<?= Yii::app()->request->baseUrl; ?>/index.php/dbReclami/admin" class="hasnotifications dropdown-toggle" data-toggle="tooltip" data-placement="bottom" title="Reclami"><span class="icon-bg"><i class="fa fa-fw fa-bullhorn"></i></span>  <?= $counter['reclami'] > 0 ? '<span class="badge  badge-danger">' . $counter['reclami'] . '</span>' : '' ?></a>
                        </li>
                        <li class="dropdown toolbar-icon-bg ">
                            <a href="<?= Yii::app()->request->baseUrl; ?>/index.php/ReclamiAzioni/admin" class="hasnotifications dropdown-toggle" data-toggle="tooltip" data-placement="bottom" title="Azioni Reclami"><span class="icon-bg"><i class="fa fa-arrow-circle-right"></i></span>  <?= $counter['azioni'] > 0 ? '<span class="badge  badge-success">' . $counter['azioni'] . '</span>' : '' ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if (Yii::app()->MyUtils->getMenuPermition('verifiche_ispettive')): ?>
                        <li class="dropdown toolbar-icon-bg ">
                            <a href="<?= Yii::app()->request->baseUrl; ?>/index.php/AzioniVerifiche/admin" class="hasnotifications dropdown-toggle" data-toggle="tooltip" data-placement="bottom" title="Azioni Reclami"><span class="icon-bg"><i class="fa fa-check"></i></span>  <?= $counter['verifiche'] > 0 ? '<span class="badge  badge-warning">' . $counter['verifiche'] . '</span>' : '' ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if (Yii::app()->MyUtils->getMenuPermition('formazione')): ?>
                        <li class="dropdown toolbar-icon-bg ">
                            <a href="<?= Yii::app()->request->baseUrl; ?>/index.php/AzioniFormazione/admin" class="hasnotifications dropdown-toggle" data-toggle="tooltip" data-placement="bottom" title="Corsi formazione"><span class="icon-bg"><i class="fa fa-graduation-cap"></i></span>  <?= $counter['formazione'] > 0 ? '<span class="badge  badge-warning">' . $counter['formazione'] . '</span>' : '' ?></a>
                        </li>
                    <?php endif; ?>
                </ul>
                <ul class="nav navbar-nav toolbar pull-right" style='margin-right: 50px'></ul>
                <ul class="nav navbar-nav toolbar pull-right"></ul>
            </header>
            <div id="wrapper">
                <div id="layout-static">
                    <div class="static-sidebar-wrapper sidebar-midnightblue">
                        <div class="static-sidebar" style="top: 50px;">
                            <div class="sidebar">
                                <div class="widget stay-on-collapse">
                                    <div class="widget-body welcome-box tabular">
                                        <div class="tabular-row">
                                            <div class="tabular-cell welcome-avatar">
                                                <a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/avatar/<?= $userDetail['avatar'] ? $userDetail['avatar'] : "default_avatar.png" ?>" class="avatar" /></a>
                                            </div>
                                            <div class="tabular-cell welcome-options">
                                                <span class="welcome-text">Benvenuto</span>
                                                <a href="#" class="name">
                                                    <?= $userDetail['nome'] . " " . $userDetail['cognome'] ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget stay-on-collapse" id="widget-sidebar">
                                    <nav role="navigation" class="widget-body">
                                        <ul class="acc-menu">
                                            <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php"><i class="fa fa-home"></i><span>Home</span></a></li>
                                            <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/utenti/profilo"><i class="fa fa-pencil"></i><span>Modifica Profilo</span> </a></li>

                                            <?php if (Yii::app()->user->getState('group') == 'ADMIN'): ?>
                                            <li class="hasChild"><a href="javascript:;"><i class="fa fa-user-circle"></i><span>Utenti</span></a>
                                                <ul class="acc-menu">
                                                    <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/Utenti/admin">Elenco utenti</a></li>
                                                    <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/utentiTags/admin">Tag utenti</a></li>
                                                    <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/utentiTags/assegna">Assegna tag</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/ruoli/admin"><i class="fa fa-user-circle"></i><span>Ruoli</span></a></li>
                                            <li class="hasChild"><a href="javascript:;"><i class="fa fa-cogs fa-spin"></i><span>Impostazioni</span></a>
                                                <ul class="acc-menu">
                                                    <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/Strutture/admin">Strutture</a></li>
                                                    <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/Clienti/admin">Clienti</a></li>
                                                    <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/TipologieFormazione/admin">Corsi formazione</a></li>
                                                    <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/formazioneTitoloCorsi/admin">Titoli corsi formazione</a></li>
                                                    <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/Societa/admin">Societ&agrave;</a></li>
                                                    <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/Funzioni/admin">Funzioni</a></li>
                                                    <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/Centri/admin">Centri</a></li>
                                                    <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/Responsabili/admin">Responsabili</a></li>
                                                    <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/TipologieStrutture/admin">Tipologie strutture</a></li>
                                                    <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/TipologieVerifiche/admin">Tipologie verifiche</a></li>
                                                    <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/TipologieConformita/admin">Tipologie non conformit&agrave;</a></li>
                                                    <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/areaStruttura/admin">Aree Strutture Alberghiere</a></li>
                                                    <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/questionnaire/index">Questionari</a></li>
                                                    <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/documentCategory/admin">Categorie documenti</a></li>
                                                </ul>
                                            </li>
                                            <?php endif; ?>
                                            
                                            <!--
                                            <?php //if(Yii::app()->user->getState('typeUserId') == 10):?>
                                            <li class="hasChild"><a href="javascript:;"><i class="fa fa-cogs fa-spin"></i><span>Impostazioni</span></a>
                                                <ul class="acc-menu">
                                                    <li><a href="<?php //echo Yii::app()->request->baseUrl; ?>/index.php/TipologieFormazione/admin">Corsi formazione</a></li>
                                                    <li><a href="<?php //echo Yii::app()->request->baseUrl; ?>/index.php/formazioneTitoloCorsi/admin">Titoli corsi formazione</a></li>
                                                </ul>
                                            </li>
                                            <?php //endif;?>
                                            -->

                                            <?php //if (Yii::app()->MyUtils->getMenuPermition('boss')): ?>
                                            <?php //if (Yii::app()->user->isEnabled('Comunicazioni')): ?>
                                            <?php if (Yii::app()->user->getState('typeUserId') == 9): ?>
                                            <li class="hasChild"><a href="javascript:;"><i class="fa fa-microphone "></i><span>Comunicazioni</span></a>
                                                <ul class="acc-menu">
                                                    <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/Comunicazioni/admin">Comunicazioni inviate</a></li>
                                                    <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/Comunicazioni/create">Nuova communicazione</a></li>
                                                    <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/InviiPush/admin">Notifiche Push</a></li>
                                                    <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/InviiSms/admin">Invii Sms</a></li>
                                                </ul>
                                            </li>
                                            <?php endif; ?>

                                            <?php //if (Yii::app()->MyUtils->getMenuPermition('azioni') && Yii::app()->user->getState('typeUserId') != 10): ?>
                                            <?php if (Yii::app()->user->isEnabled('AzioniNonConformi')): ?>
                                            <span class="widget-heading">Qualita</span>
                                            <li class="hasChild"><a href="javascript:;"><i class="fa fa-thumbs-o-down"></i><span>Azioni Non Conformi</span><span class=""><?= $counter['nonconformi'] > 0 ? "<span class='badge  badge-danger'>" . $counter['nonconformi'] . "</span>" : "" ?></span></a>
                                                <ul class="acc-menu">
                                                    <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/dbNonconforme/admin">Elenco non conformit&agrave; </a></li>
                                                    <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/dbNonconforme/indicatoriTipologie">Indicatori per tipologia</a></li>
                                                    <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/dbNonconforme/indicatoriStrutture">Indicatori per strutture</a></li>
                                                </ul>
                                            </li>
                                            <?php endif; ?>

                                            <?php if (Yii::app()->user->isEnabled('AzioniCorrettive')): ?>
                                            <li class="hasChild"><a href="javascript:;"><i class="fa fa-thumbs-o-up"></i><span>Azioni Correttive</span><span class=""><?= $counter['preventive'] > 0 ? "<span class='badge  badge-success'>" . $counter['preventive'] . "</span>" : "" ?></span></a>
                                                <ul class="acc-menu">
                                                    <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/dbAzionicorrettive/admin">Elenco Azioni correttive</a></li>
                                                    <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/dbAzionicorrettive/indicatoriTipologie">Indicatori per tipologia</a></li>
                                                    <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/dbAzionicorrettive/indicatoriStrutture">Indicatori per strutture</a></li>
                                                </ul>
                                            </li>
                                            <?php endif; ?>

                                            <?php if (Yii::app()->user->isEnabled('Reclami')): ?>
                                            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/dbReclami/admin"><i class="fa fa-bullhorn"></i><span>Reclami<span class="only-4800"><?= $counter['reclami'] > 0 ? "<span class='badge  badge-danger'>" . $counter['reclami'] . "</span>" : "" ?></span></span>  </a></li>
                                            <?php endif; ?>

                                            <?php if (Yii::app()->user->isEnabled('AzioniReclami')): ?>
                                            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/ReclamiAzioni/admin"><i class="fa fa-arrow-circle-right"></i><span>Azioni reclami<span class="only-4800"><?= $counter['azioni'] > 0 ? "<span class='badge  badge-success'>" . $counter['azioni'] . "</span>" : "" ?></span></span></a></li>
                                            <?php endif; ?>

                                            <?php if (Yii::app()->user->isEnabled('Verifiche')): ?>
                                            <li class="hasChild"><a href="javascript:;"><i class="fa fa-check"></i><span>Verifiche</span><span class=""><?= $counter['verifiche'] > 0 ? "<span class='badge  badge-warning'>" . $counter['verifiche'] . "</span>" : "" ?></span></a>
                                                <?php $this->widget('application.components.VerificheMenu', array('htmlOptions' => array('class' => 'acc-menu')));?>
                                            </li>
                                            <?php endif; ?>

                                            <?php if(Yii::app()->user->isEnabled('DocumentiQualita') || Yii::app()->user->getState('group') == 'ADMIN'):?>
                                            <li class="hasChild"><a href="javascript:;"><i class="fa fa-file-o"></i><span>Documenti Qualità</span><span class=""><!--<?php //echo $counter['verifiche'] > 0 ? "<span class='badge  badge-warning'>" . $counter['verifiche'] . "</span>" : "" ?>--></span></a>
                                                <?php $this->widget('application.components.DocumentMenu', array('htmlOptions' => array('class' => 'acc-menu')));?>                                                
                                            </li>
                                            <?php endif;?>
                                            
                                            <?php if(Yii::app()->user->isEnabled('DocumentiSoggiorni') || Yii::app()->user->getState('group') == 'ADMIN'):?>
                                            <li class="hasChild"><a href="javascript:;"><i class="fa fa-file-o"></i><span>Documenti Soggiorni Estivi</span><span class=""><!--<?php //echo $counter['verifiche'] > 0 ? "<span class='badge  badge-warning'>" . $counter['verifiche'] . "</span>" : "" ?>--></span></a>
                                                <?php $this->widget('application.components.DocumentSoggiorniMenu', array('htmlOptions' => array('class' => 'acc-menu')));?>                                                
                                            </li>
                                            <?php endif;?>

                                            <?php if(Yii::app()->user->isEnabled('Area Documenti') || Yii::app()->user->getState('group') == 'ADMIN'):?>
                                            <li class="hasChild"><a href="javascript:;"><i class="fa fa-file-o"></i><span>Area Documenti</span><span class=""><!--<?php //echo $counter['verifiche'] > 0 ? "<span class='badge  badge-warning'>" . $counter['verifiche'] . "</span>" : "" ?>--></span></a>
                                                <?php $this->widget('application.components.DocumentsMenu', array('htmlOptions' => array('class' => 'acc-menu')));?>                                                
                                            </li>
                                            <?php endif;?>

                                            <?php if (Yii::app()->user->isEnabled('Formazione')): ?>
                                            <li class="hasChild"><a href="javascript:;"><i class="fa fa-graduation-cap"></i><span>Formazione</span><span class=""><?= $counter['formazione'] > 0 ? "<span class='badge  badge-warning'>" . $counter['formazione'] . "</span>" : "" ?></span></a>
                                                <ul class="acc-menu">
                                                    <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/azioniFormazione/calendario">Calendario Formazione</a></li>
                                                    <?php if (Yii::app()->user->getState('group') == 'ADMIN'): ?>
                                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/azioniFormazione/admin">Formazioni</a></li>
                                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/formazioneCategorie/admin">Categorie</a></li>
                                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/formazioneCorsi/admin">Corsi</a></li>
                                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/formazioneGruppi/admin">Gruppi</a></li>
                                                    <?php endif; ?>
                                                </ul>
                                            </li>
                                            <?php endif; ?>

                                            <?php //if (Yii::app()->MyUtils->getMenuPermition('statistiche')): ?>
                                            <?php if (Yii::app()->user->isEnabled('Statistiche')): ?>
                                            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/dbReclami/statistiche"><i class="fa fa-line-chart"></i><span>Statistiche</span></a></li>
                                            <?php endif; ?>

                                            <?php //if (Yii::app()->MyUtils->getMenuPermition('utenze') && Yii::app()->user->getState('typeUserId') != 10): ?>
                                            <?php if (Yii::app()->user->isEnabled('Utenze')): ?>
                                            <li class="hasChild"><a href="javascript:;"><i class="fa fa-cloud"></i><span>Utenze</span>  </a>
                                                <ul class="acc-menu">
                                                    <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/utenzePresenze/admin">Presenze strutture</a></li>
                                                    <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/utenzeGas/admin">Consumi Gas</a></li>
                                                    <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/utenzeLuce/admin">Consumi Energia</a></li>
                                                    <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/utenzeAcqua/admin">Consumi Acqua</a></li>
                                                    <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/utenzeRifiuti/admin">Consumi Rifiuti</a></li>
                                                    <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/utenzeChimici/admin">Consumi Sostanze Chimiche</a></li>
                                                    <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/utenzePresenze/statistiche">Statistiche generali</a></li>
                                                    <?php if(Yii::app()->user->getState('group') == 'ADMIN'): ?>
                                                    <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/utenzePresenze/stats">Statistiche strutture</a></li>
                                                    <?php endif ; ?>
                                                </ul>
                                            </li>
                                            <?php endif; ?>
                                            
                                            <?php //if (Yii::app()->MyUtils->getMenuPermition('letture')): ?>
                                            <?php if (Yii::app()->user->isEnabled('Letture')): ?>
                                            <li class="hasChild"><a href="javascript:;"><i class="fa fa-tachometer"></i><span>Letture contatori</span>  </a>
                                                <ul class="acc-menu">
                                                    <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/Matricole/admin">Elenco matricole</a></li>
                                                    <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/Letture/elenco">Elenco letture</a></li>
                                                </ul>
                                            </li>
                                            <?php endif; ?>

                                            <?php if (Yii::app()->user->isEnabled('Segnalazioni')): ?>
                                                <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/reports/admin"><i class="fa fa-wrench"></i><span>Segnalazioni / Manutenzioni<span class="only-4800"><?php //$counter['reclami'] > 0 ? "<span class='badge  badge-danger'>" . $counter['reclami'] . "</span>" : "" ?></span></span>  </a></li>
                                            <?php endif;?>

                                            <?php if (Yii::app()->MyUtils->getMenuPermition('QU')): ?>
                                            <span class="widget-heading">Feedback</span>
                                            
                                            <?php $stopQu = true; if(!$stopQu): ?>
                                            <?php if (Yii::app()->MyUtils->getMenuPermition('boss')): ?>
                                            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/questionarioJunior/smile"><i class="fa fa-smile-o"></i><span>Indice Soddisfazione</span></a></li>
                                            <?php endif; ?>
                                            <li class="hasChild"><a href="javascript:;"><i class="fa fa-question"></i><span>Questionari</span>  </a>
                                                <ul class="acc-menu">
                                                    <?php if (Yii::app()->MyUtils->getMenuPermition('q_doc')): ?>
                                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/questionarioDoc/admin">Doc  <span class=" badge badge-primary"><?= $counter['q_doc'] ?></span></a></li>
                                                    <?php endif; ?>
                                                    <?php if (Yii::app()->MyUtils->getMenuPermition('q_formazione')): ?>
                                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/questionarioFormazione/admin">Formazione  <span class=" badge badge-primary"><?= $counter['q_formazione'] ?></span></a></li>
                                                    <?php endif; ?>
                                                    <?php if (Yii::app()->MyUtils->getMenuPermition('q_keluar') && $counter['q_keluar'] > 0): ?>
                                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/questionarioKeluar/admin">Keluar <span class="badge badge-primary"><?= $counter['q_keluar'] ?></span></a></li>
                                                    <?php endif; ?>
                                                    <?php if (Yii::app()->MyUtils->getMenuPermition('q_sharing')): ?>
                                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/questionarioSharing/admin">Sharing <span class="badge badge-primary"><?= $counter['q_sharing'] ?></span></a></li>
                                                    <?php endif; ?>
                                                    <?php if (Yii::app()->MyUtils->getMenuPermition('q_vacanza')): ?>
                                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/questionarioUnavacanza/admin">Una Vacanza <span class="badge badge-primary"><?= $counter['q_vacanza'] ?></span></a></li>
                                                    <?php endif; ?>
                                                    <?php if (Yii::app()->MyUtils->getMenuPermition('q_junior')): ?>
                                                        <!--<li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/questionarioJunior/admin">Junior <span class="badge badge-primary"><?= $counter['q_junior'] ?></span></a></li>-->
                                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/survey-stays/admin/1">Junior <span class="badge badge-primary"><?= $counter['q_junior'] ?></span></a></li>
                                                        <?php if ($counter['q_gjunior'] > 0): ?>
                                                            <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/questionarioGenitoriJunior/admin">Genitori Junior <span class="badge badge-primary"><?= $counter['q_gjunior'] ?></span></a></li>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    <?php if (Yii::app()->MyUtils->getMenuPermition('q_senior')): ?>
                                                        <!--<li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/questionarioSenior/admin">Senior <span class="badge badge-primary"><?= $counter['q_senior'] ?></span></a></li>-->
                                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/survey-stays/admin/2">Senior <span class="badge badge-primary"><?= $counter['q_senior'] ?></span></a></li>
                                                        <?php if ($counter['q_senior'] > 0): ?>
                                                            <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/questionarioGenitoriSenior/admin">Genitori Senior <span class="badge badge-primary"><?= $counter['q_gsenior'] ?></span></a></li>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    <?php if (Yii::app()->MyUtils->getMenuPermition('q_studio')): ?>
                                                        <!--<li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/questionarioStudio/admin">Vacanze Studio <span class="badge badge-primary"><?= $counter['q_studio'] ?></span></a></li>-->
                                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/survey-stays/admin/3">Vacanze Inglese <span class="badge badge-primary"><?= $counter['q_studio'] ?></span></a></li>
                                                        <?php if ($counter['q_studio'] > 0): ?>
                                                            <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/questionarioGenitoriStudio/admin">Genitori Vacanze Studio <span class="badge badge-primary"><?= $counter['q_gstudio'] ?></span></a></li>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    <?php if (Yii::app()->MyUtils->getMenuPermition('q_scientifici')): ?>
                                                        <!--<li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/questionarioScientifici/admin">Campus formativi <span class="badge badge-primary"><?= $counter['q_scientifici'] ?></span></a></li>-->
                                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/survey-stays/admin/4">Campus scientifici <span class="badge badge-primary"><?= $counter['q_scientifici'] ?></span></a></li>
                                                        <?php if ($counter['q_scientifici'] > 0): ?>
                                                            <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/questionarioGenitoriScientifici/admin">Genitori campus formativi <span class="badge badge-primary"><?= $counter['q_gscientifici'] ?></span></a></li>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    <?php if (Yii::app()->MyUtils->getMenuPermition('q_sport')): ?>
                                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/survey-stays/admin/5">Campus sportivi <span class="badge badge-primary"><?= $counter['q_sport'] ?></span></a></li>
                                                        <?php if ($counter['q_sport'] > 0): ?>
                                                            <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/questionarioGenitoriScientifici/admin">Genitori campus formativi <span class="badge badge-primary"><?= $counter['q_gscientifici'] ?></span></a></li>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </ul>
                                            </li>
                                            <?php endif; ?>
                                            
                                            <li class="hasChild"><a href="javascript:;"><i class="fa fa-bar-chart-o"></i><span>Statistiche questionari</span>  </a>
                                                <ul class="acc-menu">
                                                    <?php if (Yii::app()->MyUtils->getMenuPermition('q_doc') ): ?>
                                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/questionarioDoc/grafici">Doc</a></li>
                                                    <?php endif; ?>
                                                    <?php if (Yii::app()->MyUtils->getMenuPermition('q_formazione') ): ?>
                                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/questionarioFormazione/grafici"> Formazione</a></li>
                                                    <?php endif; ?>
                                                    <?php if (Yii::app()->MyUtils->getMenuPermition('q_keluar') ): ?>
                                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/questionarioKeluar/grafici"> Keluar</a></li>
                                                    <?php endif; ?>
                                                    <?php if (Yii::app()->MyUtils->getMenuPermition('q_sharing') ): ?>
                                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/questionarioSharing/grafici"> Sharing</a></li>
                                                    <?php endif; ?>

                                                    <?php if (Yii::app()->MyUtils->getMenuPermition('q_junior') ): ?>
                                                        <!--<li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/questionarioJunior/grafici"> Junior</a></li>-->
                                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/survey-stays/stats/1"> Junior</a></li>
                                                    <?php endif; ?>
                                                    <?php if (Yii::app()->MyUtils->getMenuPermition('q_junior') && $counter['q_gjunior'] > 0): ?>
                                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/questionarioGenitoriJunior/grafici">Genitori Junior</a></li>
                                                    <?php endif; ?>
                                                    <?php if (Yii::app()->MyUtils->getMenuPermition('q_senior') ): ?>
                                                        <!--<li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/questionarioSenior/grafici"> Senior</a></li>-->
                                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/survey-stays/stats/2"> Senior</a></li>
                                                    <?php endif; ?>
                                                    <?php if (Yii::app()->MyUtils->getMenuPermition('q_senior') && $counter['q_gsenior'] > 0): ?>
                                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/questionarioGenitoriSenior/grafici">Genitori Senior</a></li>
                                                    <?php endif; ?>
                                                    <?php if (Yii::app()->MyUtils->getMenuPermition('q_studio') ): ?>
                                                        <!--<li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/questionarioStudio/grafici">Studio</a></li>-->
                                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/survey-stays/stats/3">Studio</a></li>
                                                    <?php endif; ?>
                                                    <?php if (Yii::app()->MyUtils->getMenuPermition('q_studio') && $counter['q_gstudio'] > 0): ?>
                                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/questionarioGenitoriStudio/grafici">Genitori Studio</a></li>
                                                    <?php endif; ?>
                                                    <?php if (Yii::app()->MyUtils->getMenuPermition('q_scientifici') ): ?>
                                                        <!--<li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/questionarioScientifici/grafici">Campus formativi</a></li>-->
                                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/survey-stays/stats/4">Campus scientifici</a></li>
                                                    <?php endif; ?>
                                                    <?php if (Yii::app()->MyUtils->getMenuPermition('q_scientifici') && $counter['q_gscientifici'] > 0): ?>
                                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/questionarioGenitoriScientifici/grafici">Genitori Campus scientifici</a></li>
                                                    <?php endif; ?>
                                                    <?php if (Yii::app()->MyUtils->getMenuPermition('q_sport') ): ?>
                                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/survey-stays/stats/5">Campus sportivi</a></li>
                                                    <?php endif; ?>
                                                    <?php if (Yii::app()->MyUtils->getMenuPermition('q_sport') && $counter['q_gsport'] > 0): ?>
                                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/questionarioGenitoriScientifici/grafici">Genitori Campus sportivi</a></li>
                                                    <?php endif; ?>
                                                </ul>
                                            </li>
                                            <?php endif; ?>
                                            
                                            <!--
                                            <?php //if(Yii::app()->user->getState('typeUserId') == 10):?>
                                                <li class="hasChild"><a href="javascript:;"><i class="fa fa-question"></i><span>Questionari</span>  </a>
                                                    <ul class="acc-menu">
                                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/questionarioFormazione/admin">Formazione  <span class=" badge badge-primary"><?= $counter['q_formazione'] ?></span></a></li>
                                                    </ul>
                                                </li>
                                            <?php //endif;?>
                                            -->

                                            <?php //if (Yii::app()->MyUtils->getMenuPermition('iscrizioni')): ?>
                                            <?php if (Yii::app()->user->isEnabled('Preiscrizioni')): ?>
                                                <span class="widget-heading">Preiscrizioni</span>
                                                <?php //if (Yii::app()->MyUtils->getMenuPermition('admin')): ?>
                                                <?php if (Yii::app()->user->getState('group') == 'ADMIN'): ?>
                                                <li class="hasChild"><a href="javascript:;"><i class="fa fa-cogs fa-spin"></i><span>Impostazioni</span></a>
                                                    <ul class="acc-menu">
                                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/Occupazioni/admin">Occupazioni</a></li>
                                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/Segnalato/admin">Segnalato da</a></li>
                                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/Formule/admin">Formule abitative</a></li>
                                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/Housing/admin">Formule Housing Sharing</a></li>
                                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/Campus/admin">Formule Campus Sharing</a></li>
                                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/Camere/admin">Camere Campus San Paolo</a></li>
                                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/CampusFossata/admin">Formule Campus Cascina Fossata</a></li>
                                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/HousingFossata/admin">Formule Housing Cascina Fossata</a></li>
                                                    </ul>
                                                </li>
                                                <?php endif; ?>

                                                <?php if (Yii::app()->MyUtils->getMenuPermition('TIM')): ?>
                                                <li class="hasChild"><a href="javascript:;"><i class="fa fa-book tim"></i><span>Soggiorni Tim</span><span class=" badge badge-primary"><?= $counter['is_tim'] ?></span>  </a>
                                                    <ul class="acc-menu">
                                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/timPreiscrizioni/admin"><span>Iscrizioni soggiorni</span><span class=" badge badge-primary"><?= $counter['is_tim'] ?></span></a></li>
                                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/timCentri/admin"><span>Centri  </span></a></li>
                                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/timFascie/admin"><span>Fascie Reddito  </span></a></li>
                                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/timFunzioni/admin"><span>Funzioni  </span></a></li>
                                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/timSedi/admin"><span>Sedi di lavoro </span></a></li>
                                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/timSocieta/admin"><span>Societ&agrave; </span></a></li>
                                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/timSoggiorni/admin"><span>Soggiorni </span></a></li>
                                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/timTurni/admin"><span>Turni</span></a></li>
                                                        <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/timPartenze/admin"><span>Partenze</span></a></li>
                                                    </ul>
                                                </li>
                                                <?php endif; ?>

                                                <?php if (Yii::app()->MyUtils->getMenuPermition('SP')): ?>
                                                <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/spPreiscrizioni/admin"><i class="fa fa-book stessoP"></i><span>StessoPiano  </span><span class=" badge badge-primary"><?= $counter['is_stessopiano'] ?></span></a></li>
                                                <?php endif; ?>

                                                <?php if (Yii::app()->MyUtils->getMenuPermition('CS')): ?>
                                                    <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/caPreiscrizioni/admin"><i class="fa fa-book campuS"></i><span>Campus San Paolo  </span><span class=" badge badge-primary"><?= $counter['is_campus'] ?></span></a></li>
                                                <?php endif; ?>

                                                <?php if (Yii::app()->MyUtils->getMenuPermition('SH')): ?>
                                                    <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/shPreiscrizioni/admin"><i class="fa fa-book shariNG"></i><span>Sharing Online  </span><span class=" badge badge-primary"><?= $counter['is_sharing'] ?></span></a></li>
                                                <?php endif; ?>

                                                <?php if (Yii::app()->MyUtils->getMenuPermition('FO')): ?>
                                                    <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/foPreiscrizioni/admin"><i class="fa fa-book cascinaF"></i><span>Cascina Fossata Online  </span><span class=" badge badge-primary"><?= $counter['is_fossata'] ?></span></a></li>
                                                <?php endif; ?>

                                                <?php if (Yii::app()->MyUtils->getMenuPermition('SN')): ?>
                                                    <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/snPreiscrizioni/admin"><i class="fa fa-book scuolaNatura"></i><span>Scuola Natura </span><span class=" badge badge-primary"><?= $counter['is_scuola'] ?></span></a></li>
                                                <?php endif; ?>

                                                <?php if (Yii::app()->MyUtils->getMenuPermition('CM')): ?>
                                                    <li><a href="<?= Yii::app()->request->baseUrl; ?>/index.php/cmPreiscrizioni/admin"><i class="fa fa-book scuolaNatura"></i><span>Facciamo l'albero </span><span class=" badge badge-primary"><?= $counter['is_comune'] ?></span></a></li>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            
                                            <?php if (Yii::app()->user->isEnabled('Scarica Dati')): ?>
                                                <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/site/export"><i class="fa fa-download"></i><span>Scarica dati</span></a></li>
                                            <?php endif; ?>
                                            
                                            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/site/logout"><i class="fa fa-sign-out"></i><span>Esci</span></a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="static-content-wrapper">
                        <div class="static-content">
                            <div class="page-content">
                                <div class="page-heading">
                                    <?php if (isset($this->breadcrumbs)): ?>
                                        <h4>
                                            <?php $this->widget('zii.widgets.CBreadcrumbs', array('links' => $this->breadcrumbs)); ?>
                                        </h4>
                                    <?php endif ?>
                                </div>
                                <div class="container-fluid">
                                    <div data-widget-group="group1" class="ui-sortable">
                                        <?php if (Yii::app()->user->hasFlash('opResultOK')): ?>
                                            <div class="alert alert-dismissable alert-success">
                                                <i class="fa fa-fw fa-check"></i>&nbsp; <strong></strong>
                                                <?php echo Yii::app()->user->getFlash('opResultOK'); ?>
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (Yii::app()->user->hasFlash('opResultKO')): ?>
                                            <div class="alert alert-dismissable alert-danger">
                                                <i class="fa fa-fw fa-warning"></i>&nbsp; <strong>Attenzione</strong>
                                                <?php echo Yii::app()->user->getFlash('opResultKO'); ?>
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
                                            </div>
                                        <?php endif; ?>
                                        <?php echo $content; ?>
                                    </div>
                                </div>
                                <!-- .container-fluid -->
                            </div>
                            <!-- #page-content -->
                        </div>
                        <footer role="contentinfo">
                            <div class="clearfix">
                                <ul class="list-unstyled list-inline pull-left">
                                    <li>
                                        <p style="text-align:center"> <span class="or_bold">D.O.C. s.c.s</span> Via Assietta 16/b 10128 Torino <span class="or_bold">t.</span> +39.011.516.20.38 <span class="or_bold">f.</span> +39.011.517.54.86 <span class="or_bold">e.</span> info@cooperativadoc.it <span class="or_bold">w.</span> www.cooperativadoc.it P.IVA e C.F. 05617000012
                                            <br /> Sistema di Gestione Qualit&agrave; Certificato ISO 9001 ente CSQA cert n&deg; 5975 <img src='<?php echo Yii::app()->request->baseUrl; ?>/images/qualita-keluar-black.png' />
                                        </p>
                                    </li>
                                </ul>
                                <button class="pull-right btn btn-link btn-xs hidden-print" id="back-to-top"><i class="fa fa-arrow-up"></i></button>
                            </div>
                        </footer>
                    </div>
                </div>
            </div>

        <?php //} ?>

        <div id="notification-box" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id='notification-title'><i class="fa fa-bell-o"></i>&nbsp; Abilitazione notifiche</h4>
                    </div>
                    <div class="modal-body">
                        <div class="bootbox-body" id="">
                            <p>Mettere la spunta per abilitare <b id="notification-user"></b> a ricevere notifiche quando vengono completati i questionari</p>
                        </div>
                        <form name="" id="" method="POST" href="http://www.test.it">
                            <input id='notification-id' name="notification-id" type="hidden" value="" />
                            <div class="row row-7">
                                <div class='col-xs-6 col-sm-6 '><input type="checkbox" class='checkbox-green q_check' id="q_junior" name="q_junior" />&nbsp;&nbsp;<span class='hidden-480'>Soggiorni </span>Junior</div>
                                <div class='col-xs-6 col-sm-6 '><input type="checkbox" class='checkbox-green q_check' id="q_senior" name="q_senior" />&nbsp;&nbsp;<span class='hidden-480'>Soggiorni </span>Senior</div>
                            </div>
                            <div class="row row-7">
                                <div class='col-xs-6 col-sm-6 '><input type="checkbox" class='checkbox-green q_check' id="q_scientifici" name="q_scientifici" />&nbsp;&nbsp;<span class='hidden-480'>Soggiorni</span> Campus Scientifici</div>
                                <div class='col-xs-6 col-sm-6 '><input type="checkbox" class='checkbox-green q_check' id="q_studio" name="q_studio" />&nbsp;&nbsp;<span class='hidden-480'>Soggiorni</span> Vacanza Studio</div>
                            </div>
                            <div class="row row-7">
                                <div class='col-xs-6 col-sm-6 '><input type="checkbox" class='checkbox-green q_check' id="q_doc" name="q_doc" />&nbsp;&nbsp;Cooperativa Doc</div>
                                <div class='col-xs-6 col-sm-6 '><input type="checkbox" class='checkbox-green q_check' id="q_campus" name="q_campus" />&nbsp;&nbsp;Campus San Paolo</div>
                            </div>
                            <div class="row row-7">
                                <div class='col-xs-6 col-sm-6 '><input type="checkbox" class='checkbox-green q_check' id="q_keluar" name="q_keluar" />&nbsp;&nbsp;Keluar</div>
                                <div class='col-xs-6 col-sm-6 '><input type="checkbox" class='checkbox-green q_check' id="q_sharing" name="q_sharing" />&nbsp;&nbsp;Sharing</div>
                            </div>
                            <div class="row row-7">
                                <div class='col-xs-6 col-sm-6 '><input type="checkbox" class='checkbox-green q_check' id="q_formazione" name="q_formazione" />&nbsp;&nbsp;Formazione</div>
                                <div class='col-xs-6 col-sm-6 '><input type="checkbox" class='checkbox-green q_check' id="q_vacanza" name="q_vacanza" />&nbsp;&nbsp;Unavacanza Una esperienza </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" id="notification-undo">Annulla</button>
                        <button type="button" class="btn btn-orange" id="notification-confirm">Abilita</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="wait" role="dialog" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog">
                <h2><i class='fa fa-spin fa-circle-o-notch fa-fw ' style='font-size: 20px;'></i>&nbsp;&nbsp;Elaborazione PDF in corso  Attendere ...</h2>
            </div>
        </div>
        
        <div id="delDato_box" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id='delDato_title'>Custom title</h4>
                    </div>
                    <div class="modal-body">
                        <div class="bootbox-body" id="delDato_txt">I am a custom dialog</div>
                        <form name="delDato_form" id="delDato_form" method="POST" href="http://www.test.it">
                            <input type="hidden" name="id" id="delDato_id" value="" />

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" id="delDato_undo">Annulla</button>
                        <button type="button" class="btn btn-orange" id="delDato_confirm">Conferma</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="export_box" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id='delDato_title'>Esportazioni dati</h4>
                    </div>
                    <div class="modal-body">
                        <div class="bootbox-body" id="export_txt">
                            <div class='row'>
                                <div class='col-xs-12'>
                                    <label>Selezionare gli anni per i quali si vuole esportare <span id="detail-export" class="orange"  > </span></label>
                                </div>
                            </div>
                            <?php
                            $k = 0;
                            for ($x = 2012; $x <= date("Y"); $x++) {
                                ?>
                                <div class='row'>
                                    <div class='col-xs-6'><label>Dati <?= $x ?></label></div>
                                    <div class='col-xs-6 pull-right' style="text-align:right"><input type="checkbox" id="<?= $k ?>" name="<?= $x ?>" value="<?= $x ?>" class='checkbox-green' /> </div>
                                </div>
                                <?php
                                $k++;
                            }
                            ?>
                        </div>
                        <form name="export_form" id="export_form" method="POST" href="http://www.test.it">
                            <input type="hidden" name="id_export" id="id_export" value="" />

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" id="export_undo">Annulla</button>
                        <button type="button" class="btn btn-orange" id="export_confirm">Conferma</button>
                    </div>
                </div>
            </div> 
        </div>
        
        <ul class="vakata-context">
        </ul>
        
        <div id="jstree-marker" style="display: none;">&nbsp;</div>
    </body>
</html>
