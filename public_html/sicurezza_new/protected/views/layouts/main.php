<? session_start() ?>

<? error_reporting(1) ?>

<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title>Gestionale Qualità</title>

        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

        <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/css/font-awesome.min.css" />

        <!-- page specific plugin styles -->
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/css/jquery-ui.min.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/css/jquery.gritter.css" />


        <!-- text fonts -->
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/css/ace-fonts.css" />

        <!-- ace styles -->
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/css/ace.min.css" />

        <!--[if lte IE 9]>
                <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/css/ace-part2.min.css" />
        <![endif]-->
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/css/ace-skins.min.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/css/ace-rtl.min.css" />

        <!--[if lte IE 9]>
          <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/css/ace-ie.min.css" />
        <![endif]-->

        <!-- inline styles related to this page -->

        <!-- ace settings handler -->
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/js/ace-extra.min.js"></script>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

        <!--[if lte IE 8]>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/js/html5shiv.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/js/respond.min.js"></script>
        <![endif]-->



        <!-- basic scripts -->

        <!--[if !IE]> -->

        <script type="text/javascript">
            window.jQuery || document.write("<script src='<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/js/jquery.min.js'>"+"<"+"/script>");
        </script>

        <!-- <![endif]-->

        <!--[if IE]>
        <script type="text/javascript">
         window.jQuery || document.write("<script src='<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/js/jquery1x.min.js'>"+"<"+"/script>");
        </script>
        <![endif]-->

        <link href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico" rel="shortcut icon" type="image/x-icon" />

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>
    <? if (!$_SESSION['user']['id']) { ?>
        <body class="login-layout blur-login">
            <?
            $model = new LoginForm;
            $this->renderPartial('../site/login', array('model' => $model,));
            ?>
        </body>        
    <? } else { ?>
        <body class="no-skin">
            <!-- #section:basics/navbar.layout -->
            <div id="navbar" class="navbar navbar-default">
                <script type="text/javascript">
                    try{ace.settings.check('navbar' , 'fixed')}catch(e){}
                    dirPanel = '<?php echo $dirPanel; ?>';
                </script>

                <div class="navbar-container" id="navbar-container">
                    <!-- #section:basics/sidebar.mobile.toggle -->
                    <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler">
                        <span class="sr-only">Toggle sidebar</span>

                        <span class="icon-bar"></span>

                        <span class="icon-bar"></span>

                        <span class="icon-bar"></span>
                    </button>

                    <!-- /section:basics/sidebar.mobile.toggle -->
                    <div class="navbar-header pull-left">
                        <!-- #section:basics/navbar.layout.brand -->
                        <a href="#" class="navbar-brand">
                            <small>
                                <i class="fa fa-leaf"></i>
                                Gestionale Qualit&agrave;
                            </small>
                        </a>

                        <!-- /section:basics/navbar.layout.brand -->

                        <!-- #section:basics/navbar.toggle -->

                        <!-- /section:basics/navbar.toggle -->
                    </div>

                    <!-- #section:basics/navbar.dropdown -->


                    <!-- /section:basics/navbar.dropdown -->
                </div><!-- /.navbar-container -->
            </div>

            <!-- /section:basics/navbar.layout -->
            <div class="main-container" id="main-container">
                <script type="text/javascript">
                    try{ace.settings.check('main-container' , 'fixed')}catch(e){}
                </script>

                <!-- #section:basics/sidebar -->
                <div id="sidebar" class="sidebar                  responsive">
                    <script type="text/javascript">
                        try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
                    </script>

                    <div class="sidebar-shortcuts" id="sidebar-shortcuts">
                        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
                            <button class="btn btn-info">
                                <a href="javascript:send('sms');" style='color:#FFF' >	<i class="ace-icon fa fa-comment"></i>  </a>
                            </button>
                            <button class="btn btn-info">
                                <a href="javascript:send('email');" style='color:#FFF'>	<i class="ace-icon fa fa-envelope"></i></a>
                            </button>
                            <button class="btn btn-info">
                                <a href="javascript:send('mms');" style='color:#FFF'> <i class="ace-icon fa fa-users"></i></a>
                            </button>
                            <button class="btn btn-info">
                                <a href="javascript:send('fax');" style='color:#FFF'>	<i class="ace-icon fa fa-flag"></i></a>
                            </button>
                        </div>
                        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
                            <span class="btn btn-info"> </span>

                            <span class="btn btn-infoo"></span>

                            <span class="btn btn-info"></span>

                            <span class="btn btn-info"></span>
                        </div>



                    </div><!-- /.sidebar-shortcuts -->

                  
                        
                        <?php
                        $this->widget('zii.widgets.CMenu', array(
                            'items' => array(
                                array(
                                    'label' => '<i class="menu-icon fa fa-folder"></i><span class="menu-text">Config</span><b class="arrow fa fa-angle-down"></b>',
                                    'url' => '#',
                                    'linkOptions' => array(
                                        'class' => 'dropdown-toggle',
                                        'data-toggle' => '',
                                    ),
                                    'itemOptions' => array('class' => ''),
                                    'items' => array(
                                        array(
                                            'label' => '<i class="menu-icon fa fa-caret-right"></i>Elenco',
                                            'url' => array('/dbAzionicorrettive/admin')
                                        ),
                                        array(
                                            'label' => '<i class="menu-icon fa fa-caret-right"></i>Azione correttiva',
                                            'url' => array('/dbAzionicorrettive/create')
                                        ),
                                    )
                                ),
                                
                                array(
                                    'label' => '<i class="menu-icon fa fa-user"></i><span class="menu-text">Utenti</span><b class="arrow fa fa-angle-down"></b>',
                                    'url' => '#',
                                    'linkOptions' => array(
                                        'class' => 'dropdown-toggle',
                                        'data-toggle' => '',
                                    ),
                                    'itemOptions' => array('class' => ''),
                                    'items' => array(
                                        array(
                                            'label' => '<i class="menu-icon fa fa-caret-right"></i>Elenco',
                                            'url' => array('/utenti/admin')
                                        ),
                                        array(
                                            'label' => '<i class="menu-icon fa fa-caret-right"></i>Non conformtà',
                                            'url' => array('/utenti/create'),
                                        ),
                                    )
                                ),
                                array(
                                    'label' => '<i class="menu-icon fa fa-folder"></i><span class="menu-text">Non Conformit&agrave;</span><b class="arrow fa fa-angle-down"></b>',
                                    'url' => '#',
                                    'linkOptions' => array(
                                        'class' => 'dropdown-toggle',
                                        'data-toggle' => '',
                                    ),
                                    'itemOptions' => array('class' => ''),
                                    'items' => array(
                                        array(
                                            'label' => '<i class="menu-icon fa fa-caret-right"></i>Elenco',
                                            'url' => array('/dbNonconforme/admin')
                                        ),
                                        array(
                                            'label' => '<i class="menu-icon fa fa-caret-right"></i>Non conformtà',
                                            'url' => array('/dbNonconforme/create'),
                                        ),
                                    )
                                ),
                                array(
                                    'label' => '<i class="menu-icon fa fa-folder"></i><span class="menu-text">Azioni Correttive</span><b class="arrow fa fa-angle-down"></b>',
                                    'url' => '#',
                                    'linkOptions' => array(
                                        'class' => 'dropdown-toggle',
                                        'data-toggle' => '',
                                    ),
                                    'itemOptions' => array('class' => ''),
                                    'items' => array(
                                        array(
                                            'label' => '<i class="menu-icon fa fa-caret-right"></i>Elenco',
                                            'url' => array('/dbAzionicorrettive/admin')
                                        ),
                                        array(
                                            'label' => '<i class="menu-icon fa fa-caret-right"></i>Azione correttiva',
                                            'url' => array('/dbAzionicorrettive/create')
                                        ),
                                    )
                                ),
                                
                            ),
                            'encodeLabel' => false,
                            'htmlOptions' => array(
                                'class' => 'nav nav-list',
                            ),
                            'submenuHtmlOptions' => array(
                                'class' => 'submenu',
                            )
                        ));
                        ?>
                    

                    <!-- #section:basics/sidebar.layout.minimize -->
                    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
                        <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
                    </div>

                    <!-- /section:basics/sidebar.layout.minimize -->
                    <script type="text/javascript">
                        try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
                    </script>
                </div>

                <!-- /section:basics/sidebar -->
                <div class="main-content">
                    <!-- #section:basics/content.breadcrumbs -->
                    <div class="breadcrumbs" id="breadcrumbs">
                        <script type="text/javascript">
                            try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
                        </script>

                        <ul class="breadcrumb">
                            <?php if (isset($this->breadcrumbs)): ?>
                                <?php
                                $this->widget('zii.widgets.CBreadcrumbs', array(
                                    'links' => $this->breadcrumbs,
                                    'tagName' => 'article',
                                    'htmlOptions' => array('class' => 'breadcrumbs'),
                                ));
                                ?><!-- breadcrumbs -->
    <?php endif ?>
                        </ul><!-- /.breadcrumb -->

                        <!-- #section:basics/content.searchbox -->
                        <div class="nav-search" id="nav-search">
                            <form class="form-search">
                                <span class="input-icon">
                                    <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                                    <i class="ace-icon fa fa-search nav-search-icon"></i>
                                </span>
                            </form>
                        </div><!-- /.nav-search -->

                        <!-- /section:basics/content.searchbox -->
                    </div> 

                    <!-- /section:basics/content.breadcrumbs -->
                    <div class="page-content">
                        <!-- #section:settings.box -->
                        <div class="ace-settings-container" id="ace-settings-container">
                            <div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
                                <i class="ace-icon fa fa-cog bigger-150"></i>
                            </div>

                            <div class="ace-settings-box clearfix" id="ace-settings-box">
                                <div class="pull-left width-50">
                                    <!-- #section:settings.skins -->
                                    <div class="ace-settings-item">
                                        <div class="pull-left">
                                            <select id="skin-colorpicker" class="hide">
                                                <option data-skin="no-skin" value="#438EB9">#438EB9</option>
                                                <option data-skin="skin-1" value="#222A2D">#222A2D</option>
                                                <option data-skin="skin-2" value="#C6487E">#C6487E</option>
                                                <option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
                                            </select>
                                        </div>
                                        <span>&nbsp; Choose Skin</span>
                                    </div>

                                    <!-- /section:settings.skins -->

                                    <!-- #section:settings.navbar -->
                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-navbar" />
                                        <label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
                                    </div>

                                    <!-- /section:settings.navbar -->

                                    <!-- #section:settings.sidebar -->
                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar" />
                                        <label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
                                    </div>

                                    <!-- /section:settings.sidebar -->

                                    <!-- #section:settings.breadcrumbs -->
                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-breadcrumbs" />
                                        <label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
                                    </div>

                                    <!-- /section:settings.breadcrumbs -->

                                    <!-- #section:settings.rtl -->
                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" />
                                        <label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
                                    </div>

                                    <!-- /section:settings.rtl -->

                                    <!-- #section:settings.container -->
                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container" />
                                        <label class="lbl" for="ace-settings-add-container">
                                            Inside
                                            <b>.container</b>
                                        </label>
                                    </div>

                                    <!-- /section:settings.container -->
                                </div><!-- /.pull-left -->

                                <div class="pull-left width-50">
                                    <!-- #section:basics/sidebar.options -->
                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover" />
                                        <label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>
                                    </div>

                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact" />
                                        <label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>
                                    </div>

                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" />
                                        <label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
                                    </div>

                                    <!-- /section:basics/sidebar.options -->
                                </div><!-- /.pull-left -->
                            </div><!-- /.ace-settings-box -->
                        </div><!-- /.ace-settings-container -->

                        <!-- /section:settings.box -->
                        <div class="page-header">
                            
                            
                        </div><!-- /.page-header -->


                        <div class="row">
                            <div class="col-xs-12">
                                <!-- PAGE CONTENT BEGINS -->
    <?php echo $content; ?>
                                <!-- PAGE CONTENT ENDS -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.page-content -->
                </div><!-- /.main-content -->

                <div class="footer">
                    <div class="footer-inner">
                        <!-- #section:basics/footer -->
                        <div class="footer-content">

                            <font class="testoBlu"><b>D.O.C. s.c.s</b> </font> Via Assietta 16/b 10128 Torino <font class="testoBlu"><b>
                                    t.</b></font> +39.011.516.20.38 <font class="testoBlu"><b>f.</b></font> +39.011.517.54.86 <font class="testoBlu"><b>e.</b></font> info@cooperativadoc.it <font class="testoBlu"><b>w.</b></font> www.cooperativadoc.it<br/> 
                            P.IVA e C.F. 05617000012 Sistema di Gestione Qualit&agrave; Certificato ISO 9001:2008  EA:31a ente CSQA n&deg; cert 14852


                            </span>

                            &nbsp; &nbsp;
                            <span class="action-buttons">
                                <a href="#">
                                    <i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
                                </a>

                                <a href="#">
                                    <i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
                                </a>

                                <a href="#">
                                    <i class="ace-icon fa fa-rss-square orange bigger-150"></i>
                                </a>
                            </span>
                        </div>

                        <!-- /section:basics/footer -->
                    </div>
                </div>

                <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                    <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
                </a>
            </div><!-- /.main-container -->

            <div id="dialog-info" class="hide"> <!-- / Mostra Varie informazioni  -->
                <div id='testo-info'></div> 
            </div>

            <div id="dialog-alert" class="hide"> <!-- / Mostra alert generico  -->
                <div id='testo-alert'></div> 
            </div>


            <script type="text/javascript">
                if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
            </script>
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/js/bootstrap.min.js"></script>

            <!-- page specific plugin scripts -->
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/js/jquery-ui.min.js"></script>
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/js/jquery.ui.touch-punch.min.js"></script>
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/js/fuelux/fuelux.spinner.min.js"></script>
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/js/bootbox.min.js"></script>

            <!-- ace scripts -->
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/js/ace-elements.min.js"></script>
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/js/ace.min.js"></script>

            <!-- inline scripts related to this page -->
            <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/css/ace.onpage-help.css" />

            <!-- page specific plugin scripts -->
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/js/jquery.dataTables.min.js"></script>
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/js/jquery.dataTables.bootstrap.js"></script>
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/js/jquery.autosize.min.js"></script>

            <script type="text/javascript"> ace.vars['base'] = '..'; </script>
            <script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/js/ace/ace.onpage-help.js"></script>
<? } ?>
    </body>
</html>
