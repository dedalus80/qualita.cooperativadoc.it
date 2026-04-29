<?php
$this->breadcrumbs = array('Home ' => array('index'), 'Esportazione dati',);
$default = array("1","2","62","37");

?>
<div class="panel panel-default panel-margin panel-480">
    <div class="panel-heading">
        <h2><i class='fa fa-download bigger-110 icon-only btn  btn-circle circle-blue'></i>&nbsp;Esporta dati</h2>
        <div class="panel-ctrls">
            <ul class="demo-btns">

            </ul>
        </div>
    </div>
    <div class="panel-body">
        <table class='table table-striped table-bordered dataTable'>
            <thead>
                <tr>
                    <th class='dark'>Dati</th>
                    <th class="small-left dark" >Esporta</th>
                </tr>
            </thead>
            <tbody>
                <?php //if ( in_array(Yii::app()->user->getId(), $default) ): ?>
                <?php if (Yii::app()->user->getState('group') == 'ADMIN'): ?>
                    <tr>
                        <td>Azioni non conformi</td>
                        <td class="small-left"><a href='#' class='  btn-export'  id="dbNonconforme"  >
						<i class='fa fa-download bigger-110 icon-only btn  btn-circle circle-blue'></i></a></td>
                    </tr>
                    <tr>
                        <td>Azioni corretive</td>
                        <td class="small-left"><a href='#' class=' btn-export' id="dbAzionicorrettive"   ><i class='fa fa-download bigger-110 icon-only btn  btn-circle circle-blue'></i></a></td>
                    </tr>
                    <tr>
                        <td>Reclami</td>
                        <td class="small-left"><a href='#' class=' btn-export' id="dbReclami"  ><i class='fa fa-download bigger-110 icon-only btn  btn-circle circle-blue'></i></a></td>
                    </tr>
                    <tr>
                        <td>Azioni reclami</td>
                        <td class="small-left"><a href='#' class=' btn-export' id="ReclamiAzioni"  ><i class='fa fa-download bigger-110 icon-only btn  btn-circle circle-blue'></i></a></td>
                    </tr>
                    <tr>
                        <td>Presenze strutture</td>
                        <td class="small-left"><a href='#' class=' btn-export' id="UtenzePresenze"  ><i class='fa fa-download bigger-110 icon-only btn  btn-circle circle-blue'></i></a></td>
                    </tr>
                    <tr>
                        <td>Consumi Energetici</td>
                        <td class="small-left"><a href='#' class=' btn-export'  id="UtenzeLuce" ><i class='fa fa-download bigger-110 icon-only btn  btn-circle circle-blue'></i></a></td>
                    </tr>
                    <tr>
                        <td>Consumi acqua</td>
                        <td class="small-left"><a href='#' class=' btn-export' id="UtenzeAcqua"   ><i class='fa fa-download bigger-110 icon-only btn  btn-circle circle-blue'></i></a></td>
                    </tr>
                    <tr>
                        <td>Consumi gas</td>
                        <td class="small-left"><a href='#' class=' btn-export' id="UtenzeGas" ><i class='fa fa-download bigger-110 icon-only btn  btn-circle circle-blue'></i></a></td>
                    </tr>
                    <tr>
                        <td>Questionari Doc</td>
                        <td class="small-left"><a href='#' class=' btn-export' id="QuestionarioDoc" ><i class='fa fa-download bigger-110 icon-only btn  btn-circle circle-blue'></i></a></td>
                    </tr>
                    <tr>
                        <td>Questionari Formazione</td>
                        <td class="small-left"><a href='#' class=' btn-export' id="QuestionarioFormazione" ><i class='fa fa-download bigger-110 icon-only btn  btn-circle circle-blue'></i></a></td>
                    </tr>
                    <tr>
                        <td>Questionari Keluar</td>
                        <td class="small-left"><a href='#' class=' btn-export' id="QuestionarioKeluar" ><i class='fa fa-download bigger-110 icon-only btn  btn-circle circle-blue'></i></a></td>
                    </tr>
                    <tr>
                        <td>Questionari Sharing</td>
                        <td class="small-left"><a href='#' class=' btn-export' id="QuestionarioSharing" ><i class='fa fa-download bigger-110 icon-only btn  btn-circle circle-blue'></i></a></td>
                    </tr>
                    <tr>
                        <td>Questionari UnavacanzaUnaesperienza</td>
                        <td class="small-left"><a href='#' class=' btn-export' id="QuestionarioUnavacanza" ><i class='fa fa-download bigger-110 icon-only btn  btn-circle circle-blue'></i></a></td>
                    </tr>
                    <!--<tr>
                        <td>Questionari Junior</td>
                        <td class="small-left"><a href='#' class=' btn-export' id="QuestionarioJunior" ><i class='fa fa-download bigger-110 icon-only btn  btn-circle circle-blue'></i></a></td>
                    </tr>
                    <tr>
                        <td>Questionari Senior</td>
                        <td class="small-left"><a href='#' class=' btn-export' id="QuestionarioSenior" ><i class='fa fa-download bigger-110 icon-only btn  btn-circle circle-blue'></i></a></td>
                    </tr>
                    <tr>
                        <td>Questionari vacanza Studio</td>
                        <td class="small-left"><a href='#' class=' btn-export' id="QuestionarioStudio" ><i class='fa fa-download bigger-110 icon-only btn  btn-circle circle-blue'></i></a></td>
                    </tr>
                    <tr>
                        <td>Questionari Campus Formativi</td>
                        <td class="small-left"><a href='#' class=' btn-export' id="QuestionarioScientifici" ><i class='fa fa-download bigger-110 icon-only btn  btn-circle circle-blue'></i></a></td>
                    </tr>
                    <tr>
                        <td>Questionari Campus Sportivi</td>
                        <td class="small-left"><a href='#' class=' btn-export' id="SurveyStays" ><i class='fa fa-download bigger-110 icon-only btn  btn-circle circle-blue'></i></a></td>
                    </tr>-->
                    <tr>
                        <td>Questionari genitori junior</td>
                        <td class="small-left"><a href='#' class=' btn-export' id="QuestionarioGenitoriJunior" ><i class='fa fa-download bigger-110 icon-only btn  btn-circle circle-blue'></i></a></td>
                    </tr>
                    <tr>
                        <td>Questionari genitori senior</td>
                        <td class="small-left"><a href='#' class=' btn-export' id="QuestionarioGenitoriSenior" ><i class='fa fa-download bigger-110 icon-only btn  btn-circle circle-blue'></i></a></td>
                    </tr>
                    <tr>
                        <td>Questionari genitori vacanze studio</td>
                        <td class="small-left"><a href='#' class=' btn-export' id="QuestionarioGenitoriStudio" ><i class='fa fa-download bigger-110 icon-only btn  btn-circle circle-blue'></i></a></td>
                    </tr>
                    <tr>
                        <td>Questionari genitori Campus formativi</td>
                        <td class="small-left"><a href='#' class=' btn-export' id="QuestionarioGenitoriScientifici" ><i class='fa fa-download bigger-110 icon-only btn  btn-circle circle-blue'></i></a></td>
                    </tr>
                <?php endif; ?>

                <? //if ( in_array(Yii::app()->user->getId(), $default) || Yii::app()->MyUtils->getMenuPermition('CS')): ?>
                <?php if (Yii::app()->user->getState('group') == 'ADMIN' || Yii::app()->MyUtils->getMenuPermition('CS')): ?>
                    <tr>
                        <td>Preiscrizioni Campus San Paolo</td>
                        <td class="small-left"><a href='#' class=' btn-export' id="CaPreiscrizioni" ><i class='fa fa-download bigger-110 icon-only btn  btn-circle circle-blue'></i></a></td>
                    </tr>
                <?php endif; ?>

                <?php if ( Yii::app()->user->getState('group') == 'ADMIN' || Yii::app()->MyUtils->getMenuPermition('SP')): ?>
                    <tr>
                        <td>Preiscrizioni Stesso Piano</td>
                        <td class="small-left"><a href='#' class=' btn-export' id="SpPreiscrizioni" ><i class='fa fa-download bigger-110 icon-only btn  btn-circle circle-blue'></i></a></td>
                    </tr> 
                <?php endif; ?>

                <?php if (Yii::app()->user->getState('group') == 'ADMIN' || Yii::app()->MyUtils->getMenuPermition('SH')): ?>
                    <tr>
                        <td>Preiscrizioni Sharing</td>
                        <td class="small-left"><a href='#' class=' btn-export' id="ShPreiscrizioni" ><i class='fa fa-download bigger-110 icon-only btn  btn-circle circle-blue'></i></a></td>
                    </tr> 
                <?php endif; ?>

                <?php if (Yii::app()->user->getState('group') == 'ADMIN' || Yii::app()->MyUtils->getMenuPermition('FO')): ?>
                    <tr>
                        <td>Preiscrizioni Cascina Fossata</td>
                        <td class="small-left"><a href='#' class=' btn-export' id="FoPreiscrizioni" ><i class='fa fa-download bigger-110 icon-only btn  btn-circle circle-blue'></i></a></td>
                    </tr> 
                <?php endif; ?>

                <?php if (Yii::app()->user->getState('group') == 'ADMIN' || Yii::app()->MyUtils->getMenuPermition('SN')): ?>
                    <tr>
                        <td>Convegno Scuola Natura</td>
                        <td class="small-left"><a href='#' class=' btn-export' id="SnPreiscrizioni" ><i class='fa fa-download bigger-110 icon-only btn  btn-circle circle-blue'></i></a></td>
                    </tr> 
                <?php endif; ?>
                
                <?php if (Yii::app()->user->getState('group') == 'ADMIN' || Yii::app()->MyUtils->getMenuPermition('TIM')): ?>
                    <tr>
                        <td>Preiscrizioni soggiorni TIM</td>
                        <td class="small-left"><a href='#' class=' btn-export' id="TimPreiscrizioni" ><i class='fa fa-download bigger-110 icon-only btn  btn-circle circle-blue'></i></a></td>
                    </tr> 
                <?php endif; ?>
                <!--
                <tr>
                    <td>Preiscrizioni Convegno Scuola Natura</td>
                    <td class="small-left"><a href='#' class=' btn-export' id="SnPreiscrizioni" ><i class='fa fa-download bigger-110 icon-only btn  btn-circle circle-blue'></i></a></td>
                </tr>
                <tr>
                    <td>Questionari Torre Marina</td>
                     <td class="small-left"><a href='#' class=' btn-export' id="UtenzeGas" ><i class='fa fa-download bigger-110 icon-only btn  btn-circle circle-blue'></i></a></td>
                </tr>
                -->
            </tbody>
        </table>
    </div>
</div>