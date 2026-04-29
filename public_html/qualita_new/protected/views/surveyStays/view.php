<?php
$this->breadcrumbs = array(
    'Questionario '.$model->tipologia->tipologia.' '.$model->anno => array('survey-stays/admin/'.$model->tipologia_id),
    $model->nome_coordinatore . " " . $model->cognome_coordinatore,
);
?>
<?php $form = $this->beginWidget('CActiveForm', array('action' => Yii::app()->createUrl($this->route), 'method' => 'post', 'id' => 'search-form-int')); ?>
<div class="panel panel-default panel-margin">
    <div class="panel-heading">
        <h2><i class='fa fa-question'></i>&nbsp; Questionario Junior <?php echo $model->anno;?> <span class='orange return-block'><?= $model->nome_coordinatore . " " . $model->cognome_coordinatore ?></h2>
    </div>
    <div class="panel-body question-body">
        <div id="detail">
            <div class="row"> 
                <div class="col-xs-6 col-sm-4">
                    <?= $form->labelEx($model, 'nome'); ?>:&nbsp;&nbsp;<span class="bold"><?= $model->nome; ?></span>
                </div>
                <div class="col-xs-6 col-sm-4">
                    <?= $form->labelEx($model, 'cognome'); ?>:&nbsp;&nbsp;<span class="bold"><?= $model->cognome; ?></span>
                </div>
                <div class="col-xs-6 col-sm-4">
                    <?= $form->labelEx($model, 'eta'); ?>:&nbsp;&nbsp;<span class="bold"><?= $model->eta; ?> anni</span>
                </div>
            </div>
            <div class="row"> 
                <div class="col-xs-6 col-sm-4">
                    <?= $form->labelEx($model, 'nome_coordinatore'); ?>:&nbsp;&nbsp;<span class="bold"><?= $model->nome_coordinatore; ?></span>
                </div>
                <div class="col-xs-6 col-sm-4">
                    <?= $form->labelEx($model, 'cognome_coordinatore'); ?>:&nbsp;&nbsp;<span class="bold"><?= $model->cognome_coordinatore; ?></span>
                </div>
                <div class="col-xs-6 col-sm-4">
                    <?= $form->labelEx($model, 'nome_gruppo'); ?>:&nbsp;&nbsp;<span class="bold"><?= $model->nome_gruppo; ?></span>
                </div>
            </div>
            <div class="row"> 
                <div class="col-xs-6 col-sm-4">
                    <?= $form->labelEx($model, 'data_restituzione'); ?>:&nbsp;&nbsp;<span class="bold"><?php echo Yii::app()->dateFormatter->format("d-MM-y",strtotime($model->data_restituzione)); ?></span>
                </div>
                <div class="col-xs-6 col-sm-4">
                    <?= $form->labelEx($model, 'soggiorno'); ?>:&nbsp;&nbsp;<span class="bold"><?php echo $centro; ?></span> <?php echo $model->turno . " Turno"; ?>
                </div>
                <div class="col-xs-6 col-sm-4">
                    <?= $form->labelEx($model, 'organizzatore'); ?>:&nbsp;&nbsp;<span class="bold"><?php echo $cliente;?></span>
                </div>
            </div> 
        </div>

        <div class="row title">
            <div class="col-xs-12 col-sm-12">
				<span class="bold">QUESITI PER IL PARTECIPANTE</span>
			</div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-6">
				<span class="bold"><?php echo $form->labelEx($model, 'divertimento');?></span>
			</div>
            <div class="col-xs-12 col-sm-6">
				<?php echo Tools::surveyRadioAnswer($model->divertimento);?>
			</div>
		</div>
        <div class="row">
            <div class="col-xs-12 col-sm-6">
				<span class="bold"><?php echo $form->labelEx($model, 'educatori');?></span>
			</div>
            <div class="col-xs-12 col-sm-6">
				<?php echo Tools::surveyRadioAnswer($model->educatori);?>
			</div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-6">
				<span class="bold"><?php echo $form->labelEx($model, 'compagni'); ?></span>
			</div>
            <div class="col-xs-12 col-sm-6">
				<?php echo Tools::surveyRadioAnswer($model->compagni);?>
			</div>
		</div>
        <div class="row">
            <div class="col-xs-12 col-sm-6">
				<span class="bold"><?php echo $form->labelEx($model, 'giochi'); ?></span>
			</div>
			<div class="col-xs-12 col-sm-6">
				<?php echo Tools::surveyRadioAnswer($model->giochi);?>
			</div>
		</div>
        <div class="row">
            <div class="col-xs-12 col-sm-6">
				<span class="bold"><?php echo $form->labelEx($model, 'gite'); ?></span>
			</div>
            <div class="col-xs-12 col-sm-6">
				<?php echo Tools::surveyRadioAnswer($model->gite);?>
			</div>
        </div>

		<?php if($model->tipologia_id == 3):?>
		<div class="row title">
            <div class="col-xs-12 col-sm-12">
				<span class="bold">QUESITI PER LE VACANZE STUDIO</span>
			</div>
        </div>
		<div class="row">
            <div class="col-xs-12 col-sm-6">
				<span class="bold"><?= $form->labelEx($model, 'studio_localita'); ?></span>
			</div>
            <div class="col-xs-12 col-sm-6">
				<?php echo Tools::surveyRadioAnswer($model->studio_localita);?>
			</div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-6">
				<span class="bold"><?= $form->labelEx($model, 'studio_college'); ?></span>
			</div>
            <div class="col-xs-12 col-sm-6">
				<?php echo Tools::surveyRadioAnswer($model->studio_college);?>
			</div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-6">
				<span class="bold"><?= $form->labelEx($model, 'studio_corso'); ?></span>
			</div>
			<div class="col-xs-12 col-sm-6">
				<?php echo Tools::surveyRadioAnswer($model->studio_corso);?>
			</div>
		</div>
        <!--<div class="row">
            <div class="col-xs-12 col-sm-6">
				<span class="bold"><?= $form->labelEx($model, 'studio_aspetto_vacanza'); ?></span>
			</div>
            <div class="col-xs-12 col-sm-6">
				<?= $model->studio_aspetto_vacanza ? strtoupper(substr($model->studio_aspetto_vacanza, 0,1)).strtolower(substr($model->studio_aspetto_vacanza, 1))    :"<br />" ?>
			</div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-6">
				<span class="bold"><?= $form->labelEx($model, 'studio_attivita_utile'); ?></span>
			</div>
            <div class="col-xs-12 col-sm-6">
				<?= $model->studio_attivita_utile ? strtoupper(substr($model->studio_attivita_utile, 0,1)).strtolower(substr($model->studio_attivita_utile, 1))    :"<br />" ?>
			</div>
        </div>-->
		<?php endif;?>

		<?php if($model->tipologia_id == 4):?>
		<div class="row title">
            <div class="col-xs-12 col-sm-12">
				<span class="bold">QUESITI PER I CAMPUS SCIENTIFICI</span>
			</div>
        </div>
		<div class="row">
            <div class="col-xs-12 col-sm-6">
				<span class="bold"><?= $form->labelEx($model, 'scientifici_school_subject'); ?></span>
			</div>
            <div class="col-xs-12 col-sm-6">
				<?php echo $model->scientifici_school_subject;?>
			</div>
        </div>
		<div class="row">
            <div class="col-xs-12 col-sm-6">
				<span class="bold"><?= $form->labelEx($model, 'scientifici_modules_liked'); ?></span>
			</div>
			<div class="col-xs-12 col-sm-6">
				<?php echo Tools::surveyRadioAnswer($model->scientifici_modules_liked);?>
			</div>
		</div>
		<div class="row">
            <div class="col-xs-12 col-sm-6">
				<span class="bold"><?= $form->labelEx($model, 'scientifici_involvement'); ?></span>
			</div>
			<div class="col-xs-12 col-sm-6">
				<?php echo Tools::surveyRadioAnswer($model->scientifici_involvement);?>
			</div>
		</div>
		<?php endif;?>

		<?php if($model->tipologia_id == 5):?>
		<div class="row title">
            <div class="col-xs-12 col-sm-12">
				<span class="bold">QUESITI PER I CAMPUS SPORTIVI</span>
			</div>
        </div>
		<div class="row">
            <div class="col-xs-12 col-sm-6">
				<span class="bold"><?= $form->labelEx($model, 'sport_chosen'); ?></span>
			</div>
            <div class="col-xs-12 col-sm-6">
				<?php echo $model->sport_chosen;?>
			</div>
        </div>
		<div class="row">
            <div class="col-xs-12 col-sm-6">
				<span class="bold"><?= $form->labelEx($model, 'sport_organization'); ?></span>
			</div>
			<div class="col-xs-12 col-sm-6">
				<?php echo Tools::surveyRadioAnswer($model->sport_organization);?>
			</div>
		</div>
		<div class="row">
            <div class="col-xs-12 col-sm-6">
				<span class="bold"><?= $form->labelEx($model, 'sport_involvement'); ?></span>
			</div>
			<div class="col-xs-12 col-sm-6">
				<?php echo Tools::surveyRadioAnswer($model->sport_involvement);?>
			</div>
		</div>
		<?php endif;?>

		<div class="row title">
            <div class="col-xs-12 col-sm-12">
				<span class="bold">SUGGERIMENTI</span>
			</div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-6">
				<?php echo $form->labelEx($model, 'suggerimenti');?>
            </div>
			<div class="col-xs-12 col-sm-6">
				<?= $model->suggerimenti ? strtoupper(substr($model->suggerimenti, 0,1)).strtolower(substr($model->suggerimenti, 1))    :"<br />" ?>
			</div>
        </div>
		
		<?php if($model->osservazioni):?>
       	<div class="row title">
            <div class="col-xs-12">
				<span class="bold">OSSERVAZIONI</span>
            </div>
        </div>
        <div class="row">
			<div class="col-xs-12 col-sm-6">
				<?= $form->labelEx($model, 'osservazioni'); ?>
			</div>
            <div class="col-xs-12 col-sm-6">
                <?= $model->osservazioni ? strtoupper(substr($model->osservazioni, 0,1)).strtolower(substr($model->osservazioni, 1)) :"<br />" ?>
            </div>
        </div>
		<?php endif;?>
    </div>
</div>
<?php $this->endWidget(); ?> 