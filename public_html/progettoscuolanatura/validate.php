<?php
session_start();
include("/var/www/vhosts/cooperativadoc.it/qualita.cooperativadoc.it/progettoscuolanatura/class/class-db.php");
 define("LIB","https://qualita.cooperativadoc.it/bootstrap-assets");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title>Convegno Scuola Natura</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-touch-fullscreen" content="yes" />
        <meta name="description" content="Convegno progettoscuolanatura.it" />
        <meta name="author" content="" />
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,700" rel="stylesheet" type="text/css"/>   
        <link href="<?= LIB ?>/fonts/font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet" />        <!-- Font Awesome -->
        <link href="<?= LIB ?>/css/styles.css" type="text/css" rel="stylesheet"/>  
        <link href="<?= LIB ?>/css/custom-styles.css" type="text/css" rel="stylesheet"/>   
     </head>
    <body class="focused-form"  style="background: url(./img/linea_footer.png) repeat-x top left;" >
        <div class="container" id="login-form">
            <div class="login-logo" style="margin-top:20px">
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="text-align: center; padding-top: 10px" >
                            <img src='./img/logo_scuolanatura.png' style="max-width: 150px; width: 150px" />
                            <h2 style="text-align: center; width: 100%">CONVEGNO SCUOLA NATURA</h2></div>
                        <div class="panel-body">
                            <form class="form-horizontal" id="login-form" action="./opCode.php" method="post">   
                                <? if ($_SESSION['error']) { ?>
                                    <div class="alert alert-dismissable alert-danger">
                                        <i class="fa fa-fw fa-exclamation-triangle"></i>&nbsp; <strong>Attenzione</strong> <?= $_SESSION['error'] ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                    </div>
                                    <? unset($_SESSION['error']);
                                } ?>
                                <? if ($_SESSION['result']) { ?>
                                    <div class="alert alert-dismissable alert-success">
                                        <i class="fa fa-fw fa-check"></i>&nbsp; <strong><?= $_SESSION['result'] ?></strong> 
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                    </div>
                                    <? unset($_SESSION['result']);
                                } ?>
                                <? if (!$_SESSION['idUser']) { ?>
                                    <div class="form-group" style="margin-bottom: 10px!important">
                                        <div class="col-xs-12">
                                            <div class="input-group">							
                                                <span class="input-group-addon">
                                                    <i class="fa fa-user"></i>
                                                </span>

                                                <input size="40" placeholder="Nome utente" class="form-control" name="user" id="user" type="text" />                                   
                                                <div class="errorMessage" id="LoginForm_username_em_" style="display:none"></div>                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-bottom: 10px!important">
                                        <div class="col-xs-12">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-key"></i>
                                                </span>
                                                <input size="40" placeholder="Password" class="form-control" name="psw" id="psw" type="password" />
                                                <div class="errorMessage" id="LoginForm_password_em_" style="display:none"></div>                             
                                            </div>
                                        </div>
                                    </div>
                                <? } ?>
                                <div class="form-group" style="margin-bottom: 10px!important">
                                    <div class="col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-barcode"></i>
                                            </span>
                                            <input size="40" placeholder="Codice Voucher" class="form-control" name="voucher" id="voucher" type="text"  value='<?= $_REQUEST['code'] ?>' />                                    <div class="errorMessage" id="LoginForm_password_em_" style="display:none"></div>                                </div>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <div class="clearfix">
                                        <input class="btn btn-orange pull-right" type="submit" name="yt0" value="<?= $_SESSION['idUser'] ? "Valida" : "Accedi"; ?>"  id='voucher-btn'/> 
                                    </div>
                                </div>
                            </form>                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="<?= LIB ?>/js/bootstrap.min.js"></script> 								
    </body>
</html>