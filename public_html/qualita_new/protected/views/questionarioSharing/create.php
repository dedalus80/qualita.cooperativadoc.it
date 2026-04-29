<?php
$this->breadcrumbs = array('Questionario Sharing' => array('index'), 'statistiche',);
?>
<div class="row">
    <div class="panel panel-default panel-margin" style="">
        <div class="panel-heading">
            <h2><i class='fa fa-bar-chart-o'></i>&nbsp;sTATISTICHE <span class='orange return-block'><?= $nomeStruttura ?></span></h2>
            <div class="panel-ctrls">
                <ul class="demo-btns">
                    <li></li>
                    <li></li>
                </ul>
            </div>
        </div>
        <div class="panel-body" id="stats">
            <?php echo $this->renderPartial('_form', array('model' => $model, 'struttura' => $struttura, 'nomeStruttura' => $nomeStruttura)); ?>
        </div>
    </div>
</div>