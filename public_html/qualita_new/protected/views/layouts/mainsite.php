<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>
            <?php echo $this->pageTitle; ?>
        </title>
        <meta name="language" content="en" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-touch-fullscreen" content="yes" />
        <meta name="description" content="<?php echo $this->pageTitle; ?>" />
        <meta name="author" content="" />
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,700" rel="stylesheet" type="text/css" />
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap-assets/fonts/font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap-assets/css/styles.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap-assets/plugins/jstree/dist/themes/avalon/style.min.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap-assets/plugins/codeprettifier/prettify.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap-assets/plugins/iCheck/skins/minimal/blue.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap-assets/plugins/form-daterangepicker/daterangepicker-bs3.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap-assets/plugins/switchery/switchery.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap-assets/plugins/fullcalendar/fullcalendar.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap-assets/plugins/form-colorpicker/colorpicker.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap-assets/css/custom-styles.css" type="text/css" rel="stylesheet" />
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
        <meta name="msapplication-TileImage" content="<?php echo Yii::app()->request->baseUrl; ?>/images/icone/ms-icon-144x144.png" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/custom.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/custom_mobile.css" />
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap-assets/plugins/iCheck/skins/minimal/_all.css" type="text/css" rel="stylesheet" />
        <!-- Custom Checkboxes / iCheck -->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap-assets/plugins/iCheck/skins/flat/_all.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap-assets/plugins/iCheck/skins/square/_all.css" type="text/css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap-assets/plugins/iCheck/skins/all.css" />
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap-assets/plugins/summernote/dist/summernote.css" type="text/css" rel="stylesheet" />
        <!-- Summernote -->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap-assets/plugins/bootstrap-fullcalendar/fullcalendar.css" type="text/css" rel="stylesheet" />
        <!-- Summernote -->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap-assets/plugins/pines-notify/pnotify.css" type="text/css" rel="stylesheet" />

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

    <body class="focused-form">
        <div id="body"></div>
        <?php
        /*if (!Yii::app()->user->getId()) {
            $model = new LoginForm;
            $this->renderPartial('../site/login', array('model' => $model,));
        }*/
            echo $content;
        ?>
        
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap-assets/js/bootstrap.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap-assets/plugins/iCheck/icheck.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap-assets/js/enquire.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap-assets/js/application.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap-assets/js/ace.min.js"></script> 
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap-assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap-assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap-assets/plugins/bootstrap-timepicker/bootstrap-timepicker.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap-assets/plugins/bootstrap-datepicker/bootstrap-datepicker.it.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap-assets/plugins/form-colorpicker/form.colorpicker.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap-assets/plugins/summernote/dist/summernote.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/functions.js?v=1.0"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap-assets/plugins/charts-morrisjs/raphael.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap-assets/plugins/charts-morrisjs/morris.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap-assets/plugins/easypiechart/jquery.easypiechart.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap-assets/plugins/bootstrap-fullcalendar/lib/moment.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap-assets/plugins/bootstrap-fullcalendar/fullcalendar.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap-assets/plugins/bootstrap-fullcalendar/lang/it.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap-assets/plugins/pines-notify/pnotify.min.js"></script>
        
        <ul class="vakata-context">
        </ul>
        <div id="jstree-marker" style="display: none;">&nbsp;</div>
    </body>
</html>