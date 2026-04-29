<?php
$this->breadcrumbs = array(
    'Questionari' => array('questionnaire/index'),
    $model->questionnaire->title => array('questionnaire/view', 'id' => $model->questionnaire_id),
    'Versione ' . $model->version_number => array('questionnaireVersion/view', 'id' => $model->id),
    'Anteprima'
);
?>

<div class="page-header">
    <h1 class="no-margin">
        Anteprima Questionario
        <small>Versione <?php echo $model->version_number; ?></small>
    </h1>
</div>
<?php $questionnaireType = $model->questionnaire->questionnaire_type; ?>

<?php if ($questionnaireType !== 'A'): // Nascondi per tipo Anonimo ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <strong>Dati Partecipante</strong>
    </div>
    <div class="panel-body">
        <?php if ($questionnaireType === 'F'): // Tipo Formazione ?>
            <div class="row">
                <div class="form-group col-md-4">
                    <label>Data corso</label>
                    <input type="date" class="form-control" disabled>
                </div>
                <div class="form-group col-md-4">
                    <label>Tipologia corso</label>
                    <select class="form-control" disabled>
                        <option>Seleziona il tipo di corso</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label>Titolo corso</label>
                    <select class="form-control" disabled>
                        <option>Seleziona il titolo del corso</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label>Nome</label>
                    <input type="text" class="form-control" placeholder="Nome" disabled>
                </div>
                <div class="form-group col-md-4">
                    <label>Cognome</label>
                    <input type="text" class="form-control" placeholder="Cognome" disabled>
                </div>
                <div class="form-group col-md-4">
                    <label>Ente/organizzazione di appartenenza</label>
                    <input type="text" class="form-control" placeholder="Ente/organizzazione" disabled>
                </div>
            </div>
        
        <?php elseif ($questionnaireType === 'SP' || $questionnaireType === 'SG'): // Tipo Soggiorno Padre/Gruppo ?>
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Nome</label>
                    <input type="text" class="form-control" placeholder="Nome" disabled>
                </div>
                <div class="form-group col-md-6">
                    <label>Cognome</label>
                    <input type="text" class="form-control" placeholder="Cognome" disabled>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label>Età</label>
                    <input type="number" class="form-control" placeholder="Età" disabled>
                </div>
                <div class="form-group col-md-4">
                    <label>Email</label>
                    <input type="email" class="form-control" placeholder="Email" disabled>
                </div>
                <div class="form-group col-md-4">
                    <label>Cellulare</label>
                    <input type="tel" class="form-control" placeholder="Cellulare" disabled>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Nome Coordinatore</label>
                    <input type="text" class="form-control" placeholder="Nome Coordinatore" disabled>
                </div>
                <div class="form-group col-md-6">
                    <label>Cognome Coordinatore</label>
                    <input type="text" class="form-control" placeholder="Cognome Coordinatore" disabled>
                </div>
            </div>
            <?php if ($questionnaireType === 'SP'): ?>
            <div class="row">
                <div class="form-group col-md-12">
                    <label>Gruppo</label>
                    <input type="text" class="form-control" placeholder="Nome Gruppo" disabled>
                </div>
            </div>
            <?php endif; ?>
            <div class="row">
                <div class="form-group col-md-4">
                    <label>Tipologia Soggiorno</label>
                    <select class="form-control" disabled>
                        <option>Seleziona tipologia</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label>Soggiorno</label>
                    <select class="form-control" disabled>
                        <option>Seleziona soggiorno</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label>Turno</label>
                    <select class="form-control" disabled>
                        <option>Seleziona turno</option>
                    </select>
                </div>
            </div>
        
        <?php else: // Tipo Q (Questionario generico) o altri ?>
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Nome</label>
                    <input type="text" class="form-control" placeholder="Nome" disabled>
                </div>
                <div class="form-group col-md-6">
                    <label>Cognome</label>
                    <input type="text" class="form-control" placeholder="Cognome" disabled>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Email</label>
                    <input type="email" class="form-control" placeholder="Email" disabled>
                </div>
                <div class="form-group col-md-6">
                    <label>Cellulare</label>
                    <input type="tel" class="form-control" placeholder="Cellulare" disabled>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>

<?php foreach ($sections as $sectionIndex => $section): ?>
    <div class="panel panel-default section-block">
        <div class="panel-heading">
            <strong><?php echo CHtml::encode($section->title); ?></strong>
        </div>
        <div class="panel-body">
            <?php $questionNumber = 1; ?>
            <?php foreach ($section->questions as $question): ?>
                <div class="form-group">
                    <!-- Riga domanda con numerazione -->
                    <label><strong><?php echo $questionNumber++ . '. ' . CHtml::encode($question->text); ?></strong></label>

                    <!-- Riga risposte -->
                    <div>
                        <?php if ($question->type == 'text'): ?>
                            <textarea class="form-control" placeholder="Risposta libera" disabled></textarea>

                        <?php elseif ($question->type == 'option'): ?>
                            <?php
                            $options = ['Poco', 'Abbastanza', 'Molto'];
                            $selected = 'Abbastanza'; // Esempio statico
                            foreach ($options as $opt): ?>
                                <label class="radio-inline">
                                    <input type="radio" disabled <?php echo ($opt == $selected) ? 'checked' : ''; ?>>
                                    <?php echo $opt; ?>
                                </label>
                            <?php endforeach; ?>

                        <?php elseif ($question->type == 'range'): ?>
                            <?php
                            $rangeLabels = ['1','2','3','4','5'];
                            $selected = '3'; // Esempio statico
                            foreach ($rangeLabels as $val): ?>
                                <label class="radio-inline">
                                    <input type="radio" disabled <?php echo ($val == $selected) ? 'checked' : ''; ?>>
                                    <?php echo $val; ?>
                                </label>
                            <?php endforeach; ?>
                            <p class="help-block"><small>1 = Poco soddisfatto, 5 = Estremamente soddisfatto</small></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endforeach; ?>

<!-- Pulsanti di navigazione -->
<div class="form-group text-right">
    <?php echo CHtml::link('<i class="fa fa-chevron-left"></i> Torna alla Versione', array('view', 'id' => $model->id), array('class' => 'btn btn-default')); ?>
    <?php echo CHtml::link('<i class="fa fa-list"></i> Elenco Questionari', array('questionnaire/index'), array('class' => 'btn btn-primary')); ?>
</div>
