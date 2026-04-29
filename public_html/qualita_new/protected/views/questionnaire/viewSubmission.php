<?php
/* @var $this QuestionnaireController */
/* @var $participant QuestionnaireParticipant */
/* @var $answers Answer[] */

$this->breadcrumbs=array(
    'Questionari'=>array('index'),
    'Compilazioni'=>array('submissions'),
    'Dettagli Compilazione',
);
?>

<div class="page-header">
    <h1><i class="fa fa-eye"></i> Dettagli Compilazione #<?php echo $participant->id; ?></h1>
</div>

<div class="row">
    <div class="col-md-12">
        
        <!-- Informazioni Partecipante -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-user"></i> Informazioni Partecipante</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-striped">
                            <tr>
                                <td><strong>Questionario:</strong></td>
                                <td><?php echo $participant->questionnaire ? $participant->questionnaire->title : '-'; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Versione:</strong></td>
                                <td><?php echo $participant->version ? 'v' . $participant->version->version_number : '-'; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Nome:</strong></td>
                                <td><?php echo $participant->name ? CHtml::encode($participant->name) : '-'; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Cognome:</strong></td>
                                <td><?php echo $participant->surname ? CHtml::encode($participant->surname) : '-'; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Email:</strong></td>
                                <td><?php echo $participant->email ? CHtml::encode($participant->email) : '-'; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Telefono:</strong></td>
                                <td><?php echo $participant->phone ? CHtml::encode($participant->phone) : '-'; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Coordinatore Nome:</strong></td>
                                <td><?php echo $participant->coordinator_name ? CHtml::encode($participant->coordinator_name) : '-'; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Coordinatore Cognome:</strong></td>
                                <td><?php echo $participant->coordinator_surname ? CHtml::encode($participant->coordinator_surname) : '-'; ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-striped">
                            <tr>
                                <td><strong>Età:</strong></td>
                                <td><?php echo $participant->age ? $participant->age : '-'; ?></td>
                            </tr>
                            
                            <tr>
                                <td><strong>Gruppo:</strong></td>
                                <td><?php echo $participant->group_name ? CHtml::encode($participant->group_name) : '-'; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Tipo Corso:</strong></td>
                                <td><?php echo $participant->type_course_id ? CHtml::encode($participant->type_course_id) : '-'; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Titolo Corso:</strong></td>
                                <td><?php echo $participant->title_course_id ? CHtml::encode($participant->title_course_id) : '-'; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Data Corso:</strong></td>
                                <td><?php echo $participant->date_course ? date('d/m/Y', strtotime($participant->date_course)) : '-'; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Organizzazione/Ente:</strong></td>
                                <td><?php echo $participant->affiliated_organisation ? CHtml::encode($participant->affiliated_organisation) : '-'; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Data Compilazione:</strong></td>
                                <td><?php echo DateTimeHelper::formatItalianDateTimeFull($participant->created_at); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informazioni Tecniche -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-cog"></i> Informazioni Tecniche</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-striped">
                            <tr>
                                <td><strong>Indirizzo IP:</strong></td>
                                <td><?php echo $participant->ip_address ? CHtml::encode($participant->ip_address) : '-'; ?></td>
                            </tr>
                            <tr>
                                <td><strong>User Agent:</strong></td>
                                <td>
                                    <?php if ($participant->browser_agent): ?>
                                        <div style="word-break: break-all; font-family: monospace; font-size: 12px;">
                                            <?php echo CHtml::encode($participant->browser_agent); ?>
                                        </div>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Risposte -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i> Risposte (<?php echo count($answers); ?>)</h3>
            </div>
            <div class="panel-body">
                <?php if (empty($answers)): ?>
                    <p class="text-muted">Nessuna risposta trovata.</p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="60">ID</th>
                                    <th width="200">Domanda</th>
                                    <th width="100">Tipo</th>
                                    <th>Risposta</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($answers as $answer): ?>
                                    <tr>
                                        <td><?php echo $answer->question_id; ?></td>
                                        <td>
                                            <?php 
                                            $question = Question::model()->findByPk($answer->question_id);
                                            echo $question ? CHtml::encode($question->text) : 'Domanda non trovata';
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                            if ($question) {
                                                switch ($question->type) {
                                                    case 'text':
                                                        echo 'Testo';
                                                        break;
                                                    case 'textarea':
                                                        echo 'Area di testo';
                                                        break;
                                                    case 'radio':
                                                        echo 'Scelta singola';
                                                        break;
                                                    case 'checkbox':
                                                        echo 'Scelta multipla';
                                                        break;
                                                    case 'select':
                                                        echo 'Menu a tendina';
                                                        break;
                                                    default:
                                                        echo ucfirst($question->type);
                                                }
                                            } else {
                                                echo '-';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                            if ($answer->value) {
                                                if ($question && in_array($question->type, ['radio', 'checkbox', 'select'])) {
                                                    // Per domande con opzioni, mostra il testo dell'opzione
                                                    $values = explode(',', $answer->value);
                                                    $optionTexts = array();
                                                    foreach ($values as $value) {
                                                        $option = QuestionOption::model()->findByPk(trim($value));
                                                        if ($option) {
                                                            $optionTexts[] = CHtml::encode($option->option_text);
                                                        } else {
                                                            $optionTexts[] = CHtml::encode(trim($value));
                                                        }
                                                    }
                                                    echo implode(', ', $optionTexts);
                                                } else {
                                                    echo CHtml::encode($answer->value);
                                                }
                                            } else {
                                                echo '<span class="text-muted">-</span>';
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Pulsanti Azione -->
        <div class="panel panel-default">
            <div class="panel-body">
                <a href="<?php echo Yii::app()->createUrl('questionnaire/submissions'); ?>" class="btn btn-default">
                    <i class="fa fa-arrow-left"></i> Torna all'elenco
                </a>
                <a href="<?php echo Yii::app()->createUrl('questionnaire/submissions', array('id' => $participant->questionnaire_id)); ?>" class="btn btn-info">
                    <i class="fa fa-list"></i> Compilazioni di questo questionario
                </a>
            </div>
        </div>

    </div> <!-- col -->
</div> <!-- row --> 