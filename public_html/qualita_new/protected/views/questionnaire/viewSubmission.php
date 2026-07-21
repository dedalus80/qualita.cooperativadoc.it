<?php
/* @var $this QuestionnaireController */
/* @var $participant QuestionnaireParticipant */
/* @var $sections QuestionnaireSection[] */
/* @var $answersByQuestionId Answer[] */
/* @var $answerCount int */

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
                <h3 class="panel-title"><i class="fa fa-list"></i> Risposte (<?php echo $answerCount; ?>)</h3>
            </div>
            <div class="panel-body">
                <?php if ($answerCount === 0): ?>
                    <p class="text-muted">Nessuna risposta trovata.</p>
                <?php else: ?>
                    <?php
                    $displayedQuestionIds = array();
                    foreach ($sections as $section):
                        $sectionHasAnswers = false;
                        foreach ($section->questions as $question) {
                            if (isset($answersByQuestionId[$question->id])) {
                                $sectionHasAnswers = true;
                                break;
                            }
                        }
                        if (!$sectionHasAnswers) {
                            continue;
                        }
                    ?>
                        <div class="panel panel-default" style="margin-bottom: 20px;">
                            <div class="panel-heading">
                                <h4 class="panel-title"><i class="fa fa-folder-open-o"></i> <?php echo CHtml::encode($section->title); ?></h4>
                            </div>
                            <div class="panel-body" style="padding: 0;">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" style="margin-bottom: 0;">
                                        <thead>
                                            <tr>
                                                <th width="35%">Domanda</th>
                                                <th width="15%">Tipo</th>
                                                <th>Risposta</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($section->questions as $question): ?>
                                                <?php
                                                if (!isset($answersByQuestionId[$question->id])) {
                                                    continue;
                                                }
                                                $answer = $answersByQuestionId[$question->id];
                                                $displayedQuestionIds[$question->id] = true;
                                                $formattedAnswer = $this->formatAnswerValue($answer);
                                                ?>
                                                <tr>
                                                    <td><?php echo CHtml::encode($question->text); ?></td>
                                                    <td><?php echo CHtml::encode($this->getQuestionTypeLabel($question)); ?></td>
                                                    <td>
                                                        <?php if ($formattedAnswer === '-'): ?>
                                                            <span class="text-muted">-</span>
                                                        <?php else: ?>
                                                            <?php echo CHtml::encode($formattedAnswer); ?>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <?php
                    $orphanAnswers = array();
                    foreach ($answersByQuestionId as $questionId => $answer) {
                        if (!isset($displayedQuestionIds[$questionId])) {
                            $orphanAnswers[$questionId] = $answer;
                        }
                    }
                    ?>

                    <?php if (!empty($orphanAnswers)): ?>
                        <div class="panel panel-default" style="margin-bottom: 0;">
                            <div class="panel-heading">
                                <h4 class="panel-title"><i class="fa fa-question-circle"></i> Altre risposte</h4>
                            </div>
                            <div class="panel-body" style="padding: 0;">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" style="margin-bottom: 0;">
                                        <thead>
                                            <tr>
                                                <th width="35%">Domanda</th>
                                                <th width="15%">Tipo</th>
                                                <th>Risposta</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($orphanAnswers as $answer): ?>
                                                <?php
                                                $question = $answer->question ?: Question::model()->findByPk($answer->question_id);
                                                $formattedAnswer = $this->formatAnswerValue($answer);
                                                ?>
                                                <tr>
                                                    <td><?php echo $question ? CHtml::encode($question->text) : 'Domanda non trovata'; ?></td>
                                                    <td><?php echo $question ? CHtml::encode($this->getQuestionTypeLabel($question)) : '-'; ?></td>
                                                    <td>
                                                        <?php if ($formattedAnswer === '-'): ?>
                                                            <span class="text-muted">-</span>
                                                        <?php else: ?>
                                                            <?php echo CHtml::encode($formattedAnswer); ?>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
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