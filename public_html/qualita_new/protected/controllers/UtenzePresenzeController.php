<?php

class UtenzePresenzeController extends Controller {

    public $layout = '//layouts/column2';

    public function init()
    {
        parent::init();
        
        Yii::app()->clientScript->registerScriptFile('https://code.highcharts.com/highcharts.js');
        Yii::app()->clientScript->registerScriptFile('https://code.highcharts.com/modules/series-label.js');
        Yii::app()->clientScript->registerScriptFile('https://code.highcharts.com/modules/exporting.js');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/grafici_percentuale.js');
    }

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin', 'delete', 'view', 'esporta', 'verifica', 'statistiche','esporta','stats','stampaGrafici','stampaGraficiStrutture'),
                'users' => Yii::app()->MyUtils->getPermition('azioni'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    
    public function actionEsporta($anno = null) {
        $model = new UtenzePresenze;
        $model->datiEsportazione = $model->getEsportazione($anno);
        $this->renderPartial('_esporta', array('model' => $model));
    }
    
    public function actionVerifica() {

        $exist = Yii::app()->db->createCommand("SELECT id FROM utenze_presenze WHERE anno ='" . $_POST['anno'] . "'AND  struttura ='" . $_POST['struttura'] . "' ")->queryScalar();
        header('Content-Type: application/json; charset="UTF-8"');
        echo CJSON::encode(array('exist' => $exist));
        Yii::app()->end();
    }

    public function actionView($id) {

        $model = $this->loadModel($id);
        $model->struttura_nome = Yii::app()->MyUtils->getSelectValue($model->struttura, "doc_unita");
        $this->render('view', array('model' => $model));
    }

    public function actionStatistiche($struttura = null) 
    {    
        $model = new UtenzePresenze;
        $model->setSelect();
        
        //$user = Yii::app()->MyUtils->getUserInfo();
        //$user['user_type'] == '3' ? $struttura = $user['user_unita'] : $admin = 'Y';

        if(Yii::app()->user->getState('group') != 'ADMIN') {
            if(!$struttura) {
                $struttura = implode(',', Yii::app()->user->getState('strutture'));
                $struttura = Yii::app()->user->getState('strutture')[0];
            }
            else {
                if($struttura && !in_array($struttura, Yii::app()->user->getState('strutture'))) {
                    throw new CHttpException(403, Yii::t('app', 'You are not allowed to perform this action.'));
                }
            }
        }
        
        //$admin = Yii::app()->user->getState('group') == 'ADMIN' ? 'Y' : '';

        $stat = $model->setStatistiche($struttura);

        $grafici = array(
            "acqua" => array("tipo" => 'acqua',"stats" => "consumi" , "titolo" => '<i class="fa fa-tint" style="color: #8dc9e8"></i><span style="color:#999">&nbsp;Consumi Acqua</span>' , "dati" => "Mc" ),
            "gas"   => array("tipo" => 'gas'  ,"stats" => "consumi" , "titolo" => '<i class="fa fa-fire" style="color: #8dc9e8"></i><span style="color:#999">&nbsp;Consumi gas</span>' , "dati" => "Mc" ),
            "luce"  => array("tipo" => 'luce' ,"stats" => "consumi" , "titolo" => '<i class="fa fa-plug" style="color: #8dc9e8"></i><span style="color:#999">&nbsp;Consumi energetici</span>' , "dati" => "Kwh " ),
            "acqua_costi" => array("tipo" => 'acqua',"stats" => "costi"   , "titolo" => '<i class="fa fa-tint" style="color: #8dc9e8"></i><span style="color:#999">&nbsp;Consumi Acqua</span>' , "dati" => "Euro" ),
            "gas_costi"   => array("tipo" => 'gas'  ,"stats" => "costi"   , "titolo" => '<i class="fa fa-fire" style="color: #8dc9e8"></i><span style="color:#999">&nbsp;Consumi gas</span>' , "dati" => "Euro" ),
            "luce_costi"  => array("tipo" => 'luce' ,"stats" => "costi"   , "titolo" => '<i class="fa fa-plug" style="color: #8dc9e8"></i><span style="color:#999">&nbsp;Consumi energetici</span>' , "dati" => "Euro" ),
            "chimici"  => array("tipo" => 'chimici' ,"stats" => "consumi"   , "titolo" => '<i class="fa fa-flask" style="color: #8dc9e8"></i><span style="color:#999">&nbsp;Consumi sostanze chimiche</span>' , "dati" => "Mc" ),
            "chimici_costi"  => array("tipo" => 'chimici' ,"stats" => "costi"   , "titolo" => '<i class="fa fa-flaskfa-plug" style="color: #8dc9e8"></i><span style="color:#999">&nbsp;Consumi sostanze chimiche</span>' , "dati" => "Euro" ),
            "rifiuti"  => array("tipo" => 'rifiuti' ,"stats" => "costi"   , "titolo" => '<i class="fa fa-trash" style="color: #8dc9e8"></i><span style="color:#999">&nbsp;Consumi rifiuti</span>' , "dati" => "Euro" ),
        );

        $jsCharts = "";
        foreach($grafici as $titolo => $dati) {  
        
            if(count($stat[$dati['tipo']][$dati['stats']])) {

                $tt = str_replace("-","_",$titolo);

                $jsCharts .= <<<JS
svgToPng(grafico_$tt, function(pngData) {
    $.ajax({
        url: 'https://qualita.cooperativadoc.it/qualita_new/grafici/save.php',
        type: 'post',
        data: {
            'grafico': pngData,
            'nome':'$titolo',
            'anno': anno,
            'struttura': struttura,
            'tipo': tipo
        },
        success: function (result) { 
            console.log('Saved $titolo:', result)
        },
        error: function (result) {
            console.log('Error $titolo:', result)
        }

    });
});\n\n
JS;
            }
        }

        Yii::app()->clientScript->registerScript('grafico_charts', "
                var anno        = $('#struttura-anno').val()
                var struttura   = $('#struttura-utente').val()
                var tipo        = $('#tipo-grafico').val()
                
                // Coda per serializzare le esportazioni
                var chartQueue = [];
                var isProcessing = false;
                
                function processQueue() {
                    if (isProcessing || chartQueue.length === 0) return;
                    
                    isProcessing = true;
                    var item = chartQueue.shift();
                    var chart = item.chart;
                    
                    // Estrai SVG dal DOM (più affidabile di getSVG())
                    var svgElement = chart.container.querySelector('svg');
                    if (!svgElement) {
                        isProcessing = false;
                        processQueue();
                        return;
                    }
                    
                    // Clona e prepara l'SVG
                    var svgClone = svgElement.cloneNode(true);
                    svgClone.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
                    svgClone.setAttribute('width', chart.chartWidth);
                    svgClone.setAttribute('height', chart.chartHeight);
                    var svg = new XMLSerializer().serializeToString(svgClone);
                    
                    // Converti SVG in PNG usando canvas
                    var canvas = document.createElement('canvas');
                    var ctx = canvas.getContext('2d');
                    var img = new Image();
                    
                    var svgBase64 = btoa(unescape(encodeURIComponent(svg)));
                    var dataUrl = 'data:image/svg+xml;base64,' + svgBase64;
                    
                    img.onload = function() {
                        canvas.width = img.width * 2;
                        canvas.height = img.height * 2;
                        ctx.fillStyle = '#FFFFFF';
                        ctx.fillRect(0, 0, canvas.width, canvas.height);
                        ctx.scale(2, 2);
                        ctx.drawImage(img, 0, 0);
                        
                        var pngBase64 = canvas.toDataURL('image/png').split(',')[1];
                        item.callback(pngBase64);
                        
                        isProcessing = false;
                        processQueue();
                    };
                    
                    img.onerror = function() {
                        isProcessing = false;
                        processQueue();
                    };
                    
                    img.src = dataUrl;
                }
                
                // Funzione per esportare il grafico in PNG
                function svgToPng(chart, callback) {
                    if (!chart || !chart.container) return;
                    chartQueue.push({ chart: chart, callback: callback });
                    processQueue();
                }
            
                $(document).ready(function(){
                    // Attendi che Highcharts completi il rendering e le animazioni
                    setTimeout(function() {
                        ".$jsCharts."
                    }, 1500);
                });
            ",
            CClientScript::POS_END
        );

        $this->render('statistiche', array(
            'model' => $model,
            'stat' => $stat,
            'grafici'=> $grafici,
            //'admin' => $admin 
        ));
    }
    
    
    public function actionStampaGrafici() 
    {
        $model = new UtenzePresenze;
        $_POST['struttura']  ? $model->struttura = $_POST['struttura']: "" ;
        
        $model->struttura ? $nome = Yii::app()->db->createCommand("SELECT nome FROM doc_unita WHERE id ='".$model->struttura."'" )->queryScalar() : "";
        $model->struttura ? $file = 'statistiche-consumi-'.str_replace(" ","_",$nome) : $file ='statistiche-consumi' ;
        
        $html = $this->renderPartial(
                    '_grafici',
                    array(
                        'stats'     => $model->setStatistiche($model->struttura), 
                        'model'     => $model,
                        'struttura' => $model->struttura,
                        'nome'      => $nome
                    ), 
                    true
                );

        $html2pdf = Yii::app()->ePdf->HTML2PDF('L', 'A4', 'en', false, 'ISO-8859-15', array(mL, mT, mR, mB));
        $html2pdf->WriteHTML($html);
        $html2pdf->Output( YiiBase::getPathOfAlias('webroot').'/protected/stampe/consumi/'.$file.'.pdf', 'F');
        
        header('Content-Type: application/json; charset="UTF-8"');
        echo CJSON::encode(array('stampa' => '/protected/stampe/consumi/'.$file.'.pdf?ver='.time()));
        
        Yii::app()->end();
    }
        
    
    public function actionStats($anno = null, $tipo = null) {
        
        $model = new UtenzePresenze;
        $user = Yii::app()->MyUtils->getUserInfo();
        $user['user_type'] =='3' ? $struttura = $user['user_unita']: "" ;
        
        $struttura ? $model->struttura  = $struttura :"";
        $anno      ? $model->anno       = $anno      : $model->anno = date("Y");    
        $tipo      ? $model->tipo       = $tipo      : $model->tipo = "c";    
        
        $model->setSelect();
        
        $consumi = array("utenze_gas","utenze_acqua","utenze_luce","utenze_rifiuti","utenze_chimici");
        foreach($consumi AS $val)
            $model->stats[$val]    = Yii::app()->MyStats->getStatsConsumiNew($val, $model->anno , $model->tipo);
        
        $this->render('stats', array('model' => $model));
    }
    
   
    public function actionStampaGraficiStrutture() {
        
        $model          = new UtenzePresenze;
        $model->tipo    = $_POST['tipo'] ;
        $model->anno    = $_POST['anno'] ;
        
        $model->tipo =='c' ? $file = 'statistiche-consumi-'.$model->anno : $file = 'statistiche-costi-'.$model->anno;
        
        $consumi = array("utenze_gas","utenze_acqua","utenze_luce","utenze_rifiuti","utenze_chimici");
        
        
        foreach($consumi AS $val){
            $model->stats[$val]    = Yii::app()->MyStats->getStatsConsumiNew($val, $model->anno , $model->tipo);
        }
            
        $html2pdf  = Yii::app()->ePdf->HTML2PDF('L', 'A4', 'en', false, 'ISO-8859-15', array(mL, mT, mR, mB));
        $html2pdf->WriteHTML($this->renderPartial('_graficiStrutture', array('model' => $model,'anno'=>$model->anno , 'tipo' => $model->tipo), true));
        
        $html2pdf->Output( YiiBase::getPathOfAlias('webroot').'/protected/stampe/consumi/'.$file.'.pdf', 'F');
        header('Content-Type: application/json; charset="UTF-8"');
        echo CJSON::encode(array('stampa' => '/protected/stampe/consumi/'.$file.'.pdf?ver='.time()));
        Yii::app()->end();
        
    }
    
    
    public function actionCreate() {
        $model = new UtenzePresenze;
        $model->setSelect();
        if (isset($_POST['UtenzePresenze'])) {
            $model->attributes = $_POST['UtenzePresenze'];
            $model->setAttribute('totale', $model->setTotale());
            if ($model->save()) {
                $model->setAttribute('totale', $model->setTotale());
                $model->save();
                
                // INVIO NOTIFICHE PUSH
                Yii::app()->MyPush->newNotificaton($model->tableName(), "up", "create", $model->id);
                
                $model->struttura_nome = Yii::app()->MyUtils->getSelectValue($model->struttura, "doc_unita");

                Yii::app()->user->setFlash('opResultOK', 'Nuove presenze <b>' . $model->struttura_nome . ' ' . $model->anno . ' </b> inserite con successo');
                $this->redirect(array('admin'));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionUpdate($id) {

        $model = $this->loadModel($id);
        $model->setSelect();

        if (isset($_POST['UtenzePresenze'])) {
            $model->attributes = $_POST['UtenzePresenze'];
            $model->setAttribute('totale', $model->setTotale());
            if ($model->save()) {
                
                // INVIO NOTIFICHE PUSH
                Yii::app()->MyPush->newNotificaton($model->tableName(), "up", "update", $model->id);
                
                Yii::app()->user->setFlash('opResultOK', 'Presenze <b>' . $model->struttura_nome . ' ' . $model->anno . ' </b> aggiornate con successo');
                $this->redirect(array('admin'));
            }
        }

        $this->render('update', array('model' => $model,));
    }

    public function actionDelete($id) {

        $model = $this->loadModel($id);
        // INVIO NOTIFICHE PUSH
        Yii::app()->MyPush->newNotificaton($model->tableName(), "up", "delete", $model->id);
        
        $model->struttura_nome = Yii::app()->MyUtils->getSelectValue($model->struttura, "doc_unita");
        Yii::app()->user->setFlash('opResultOK', 'Presenze <b>' . $model->struttura_nome . ' ' . $model->anno . ' </b> rimosse con successo');

        $model->delete();
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('UtenzePresenze');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin() {
        $model = new UtenzePresenze('search');
        $model->unsetAttributes();  // clear any default values

        $model->setSelect();
        $model->setAttribute('anno', date("Y"));

        if (isset($_POST['UtenzePresenze']))
            $model->attributes = $_POST['UtenzePresenze'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function loadModel($id) {
        $model = UtenzePresenze::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'utenze-presenze-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
