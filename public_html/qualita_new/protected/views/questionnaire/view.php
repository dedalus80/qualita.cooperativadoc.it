<?php
/* @var $this QuestionnaireController */
/* @var $model Questionnaire */

$this->breadcrumbs=array(
    'Questionari'=>array('index'),
    $model->title,
);
?>

<div class="page-header">
    <h1><i class="fa fa-file-text"></i> Questionario: <?php echo CHtml::encode($model->title); ?></h1>
</div>

<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Dettagli Questionario</h3>
            </div>
            <div class="panel-body">

                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tbody>
                            <tr>
                                <th style="white-space: nowrap;"><?php echo CHtml::encode($model->getAttributeLabel('id')); ?></th>
                                <td><?php echo CHtml::encode($model->id); ?></td>
                            </tr>
                            <tr>
                                <th style="white-space: nowrap;"><?php echo CHtml::encode($model->getAttributeLabel('title')); ?></th>
                                <td><?php echo CHtml::encode($model->title); ?></td>
                            </tr>
                            <tr>
                                <th style="white-space: nowrap;"><?php echo CHtml::encode($model->getAttributeLabel('description')); ?></th>
                                <td><?php echo CHtml::encode($model->description); ?></td>
                            </tr>
                            <tr>
                                <th style="white-space: nowrap;"><?php echo CHtml::encode($model->getAttributeLabel('questionnaire_type')); ?></th>
                                <td><?php 
                                switch ($model->questionnaire_type) {
                                    case 'SP':
                                        echo 'Soggiorno Partecipante';
                                        break;
                                    case 'SG':
                                        echo 'Soggiorno Genitore';
                                        break;
                                    case 'Q':
                                        echo 'Questionario';
                                        break;
                                    case 'A':
                                        echo 'Anonimo (dati anagrafici non richiesti)';
                                        break;
                                    case 'F':
                                        echo 'Formazione';
                                        break;
                                }
                                ?>
                            </tr>
                            <tr>
                                <th style="white-space: nowrap;"><?php echo CHtml::encode($model->getAttributeLabel('logo')); ?></th>
                                <td>
                                    <?php if (!empty($model->logo)): ?>
                                        <img src="<?php echo CHtml::encode($model->getLogoUrl()); ?>" alt="Logo" class="img-thumbnail" style="max-width:150px;max-height:100px;">
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th style="white-space: nowrap;"><?php echo CHtml::encode($model->getAttributeLabel('link_privacy')); ?></th>
                                <td>
                                    <?php if (!empty($model->link_privacy)): ?>
                                        <a href="<?php echo CHtml::encode($model->link_privacy); ?>" target="_blank"><?php echo CHtml::encode($model->link_privacy); ?></a>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th style="white-space: nowrap;"><?php echo CHtml::encode($model->getAttributeLabel('footer_description')); ?></th>
                                <td>
                                    <?php if (!empty($model->footer_description)): ?>
                                        <div class="small"><?php echo nl2br(CHtml::encode($model->footer_description)); ?></div>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th style="white-space: nowrap;"><?php echo CHtml::encode($model->getAttributeLabel('client_id')); ?></th>
                                <td><?php echo $model->client ? CHtml::encode($model->client->nome) : '-'; ?></td>
                            </tr>
                            <tr>
                                <th style="white-space: nowrap;"><?php echo CHtml::encode($model->getAttributeLabel('slug')); ?></th>
                                <td>
                                    <?php 
                                    $baseUrl = Yii::app()->request->hostInfo . Yii::app()->request->baseUrl;
                                    $fullUrl = $baseUrl . '/index.php/survey/questionnaire/' . $model->slug;
                                    echo CHtml::link(CHtml::encode($fullUrl), $fullUrl, array('target' => '_blank'));
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th style="white-space: nowrap;"><?php echo CHtml::encode($model->getAttributeLabel('is_public')); ?></th>
                                <td><?php echo $model->is_public ? 'Sì' : 'No'; ?></td>
                            </tr>
                            <tr>
                                <th style="white-space: nowrap;"><?php echo CHtml::encode($model->getAttributeLabel('email_notification')); ?></th>
                                <td><?php echo CHtml::encode($model->email_notification); ?></td>
                            </tr>
                            <tr>
                                <th style="white-space: nowrap;"><?php echo CHtml::encode($model->getAttributeLabel('email_contact')); ?></th>
                                <td><?php echo CHtml::encode($model->email_contact); ?></td>
                            </tr>
                            <tr>
                                <th style="white-space: nowrap;"><?php echo CHtml::encode($model->getAttributeLabel('created_at')); ?></th>
                                <td><?php echo DateTimeHelper::formatItalianDateTimeFull($model->created_at); ?></td>
                            </tr>
                            <tr>
                                <th style="white-space: nowrap;"><?php echo CHtml::encode($model->getAttributeLabel('updated_at')); ?></th>
                                <td><?php echo DateTimeHelper::formatItalianDateTimeFull($model->updated_at); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <?php 
                // Verifica se il questionario ha partecipanti (risposte)
                $hasParticipants = QuestionnaireParticipant::model()->exists('questionnaire_id = :questionnaire_id', array(':questionnaire_id' => $model->id));
                ?>
                
                <?php if ($hasParticipants): ?>
                <div class="alert alert-warning">
                    <i class="fa fa-exclamation-triangle"></i>
                    <strong>Attenzione:</strong> Questo questionario ha già ricevuto risposte e non può essere eliminato. 
                    <br><br>
                    <strong>Opzioni disponibili:</strong>
                    <ul>
                        <li>Elimina tutte le compilazioni per poi eliminare il questionario</li>
                        <li>Visualizza le compilazioni per analizzarle</li>
                    </ul>
                </div>
                <?php endif; ?>
                
                <div class="form-group">
                    <?php echo CHtml::link('<i class="fa fa-pencil"></i> Aggiorna', array('update', 'id'=>$model->id), array('class'=>'btn btn-warning')); ?>
                    <?php echo CHtml::link('<i class="fa fa-plus"></i> Crea Versione', array('questionnaireVersion/create', 'questionnaire_id'=>$model->id), array('class'=>'btn btn-success')); ?>
                    <?php echo CHtml::link('<i class="fa fa-list"></i> Lista Versioni', array('questionnaireVersion/index', 'questionnaire_id'=>$model->id), array('class'=>'btn btn-primary')); ?>
                    <?php echo CHtml::link('<i class="fa fa-list-alt"></i> Visualizza Compilazioni', array('submissions', 'id'=>$model->id), array('class'=>'btn btn-info')); ?>
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#cloneQuestionnaireModal">
                        <i class="fa fa-copy"></i> Clona Questionario
                    </button>
                    <?php if ($hasParticipants): ?>
                        <?php echo CHtml::link('<i class="fa fa-trash-o"></i> Elimina Compilazioni', '#', array(
                            'submit'=>array('deleteSubmissions','id'=>$model->id),
                            'confirm'=>'ATTENZIONE: Questa azione eliminerà definitivamente tutte le compilazioni e le risposte di questo questionario. Questa operazione non può essere annullata. Sei sicuro di voler procedere?',
                            'class'=>'btn btn-warning',
                        )); ?>
                    <?php endif; ?>
                    <?php if (!$hasParticipants): ?>
                        <?php echo CHtml::link('<i class="fa fa-trash"></i> Elimina Questionario', '#', array(
                            'submit'=>array('delete','id'=>$model->id),
                            'confirm'=>'Sei sicuro di voler eliminare questo questionario? Questa azione eliminerà definitivamente il questionario e tutti i dati correlati (versioni, sezioni, domande, opzioni).',
                            'class'=>'btn btn-danger',
                        )); ?>
                    <?php endif; ?>
                    <?php echo CHtml::link('<i class="fa fa-arrow-left"></i> Torna all\'elenco', array('index'), array('class'=>'btn btn-default')); ?>
                </div>

            </div> <!-- panel-body -->
        </div> <!-- panel -->

    </div> <!-- col -->
</div> <!-- row -->

<!-- Modal per clonare il questionario -->
<div class="modal fade" id="cloneQuestionnaireModal" tabindex="-1" role="dialog" aria-labelledby="cloneQuestionnaireModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="cloneQuestionnaireModalLabel">
                    <i class="fa fa-copy"></i> Clona Questionario
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Chiudi">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <?php echo CHtml::beginForm('', 'post', array('id' => 'cloneQuestionnaireForm')); ?>
            <div class="modal-body">
                <div class="alert alert-info">
                    <i class="fa fa-info-circle"></i>
                    <strong>Informazioni:</strong> Verrà creato un nuovo questionario con i dati modificati e la versione selezionata verrà clonata con tutte le sue sezioni e domande.
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Questionnaire_title">Titolo *</label>
                            <input type="text" class="form-control" id="Questionnaire_title" name="Questionnaire[title]" 
                                   value="<?php echo CHtml::encode($model->title); ?>" required>
                            <div class="invalid-feedback" id="title-error"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Questionnaire_slug">Slug URL *</label>
                            <input type="text" class="form-control" id="Questionnaire_slug" name="Questionnaire[slug]" 
                                   value="<?php echo CHtml::encode($model->slug); ?>" required>
                            <div class="invalid-feedback" id="slug-error"></div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="Questionnaire_description">Descrizione</label>
                    <textarea class="form-control" id="Questionnaire_description" name="Questionnaire[description]" rows="3"><?php echo CHtml::encode($model->description); ?></textarea>
                </div>
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="Questionnaire_questionnaire_type">Tipo Questionario *</label>
                            <select class="form-control" id="Questionnaire_questionnaire_type" name="Questionnaire[questionnaire_type]" required>
                                <option value="SP" <?php echo $model->questionnaire_type === 'SP' ? 'selected' : ''; ?>>Soggiorno Partecipante</option>
                                <option value="SG" <?php echo $model->questionnaire_type === 'SG' ? 'selected' : ''; ?>>Soggiorno Genitore</option>
                                <option value="Q" <?php echo $model->questionnaire_type === 'Q' ? 'selected' : ''; ?>>Questionario</option>
                                <option value="A" <?php echo $model->questionnaire_type === 'A' ? 'selected' : ''; ?>>Anonimo</option>
                                <option value="F" <?php echo $model->questionnaire_type === 'F' ? 'selected' : ''; ?>>Formazione</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="Questionnaire_client_id">Cliente</label>
                            <select class="form-control" id="Questionnaire_client_id" name="Questionnaire[client_id]">
                                <option value="">Seleziona cliente</option>
                                <?php foreach (Clienti::model()->findAll(array('order' => 'nome ASC')) as $client): ?>
                                    <option value="<?php echo $client->id; ?>" <?php echo $model->client_id == $client->id ? 'selected' : ''; ?>>
                                        <?php echo CHtml::encode($client->nome); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="Questionnaire_is_public">Pubblico</label>
                            <select class="form-control" id="Questionnaire_is_public" name="Questionnaire[is_public]">
                                <option value="1" <?php echo $model->is_public ? 'selected' : ''; ?>>Sì</option>
                                <option value="0" <?php echo !$model->is_public ? 'selected' : ''; ?>>No</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="version_id">Versione da clonare *</label>
                    <select class="form-control" id="version_id" name="version_id" required>
                        <option value="">Seleziona la versione da clonare</option>
                        <?php foreach ($model->versions as $version): ?>
                            <option value="<?php echo $version->id; ?>">
                                Versione <?php echo $version->version_number; ?> - <?php echo CHtml::encode($version->description); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback" id="version-error"></div>
                </div>
                
                <div id="clone-errors" class="alert alert-danger" style="display: none;">
                    <i class="fa fa-exclamation-triangle"></i>
                    <strong>Errore:</strong> <span id="clone-error-message"></span>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
                <button type="submit" class="btn btn-primary" id="clone-submit-btn">
                    <i class="fa fa-copy"></i> Clona Questionario
                </button>
            </div>
            <?php echo CHtml::endForm(); ?>
        </div>
    </div>
</div>

<?php
// Registra gli stili CSS per gli errori
Yii::app()->clientScript->registerCss('clone-form-errors', "
    .form-control.is-invalid {
        border-color: #dc3545 !important;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
    }
    
    .form-control.is-invalid:focus {
        border-color: #dc3545 !important;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
    }
    
    .invalid-feedback {
        display: none;
        width: 100%;
        margin-top: 0.25rem;
        font-size: 0.875em;
        color: #dc3545;
    }
    
    .invalid-feedback.d-block {
        display: block !important;
    }
    
    .form-group.has-error label {
        color: #dc3545;
        font-weight: bold;
    }
    
    .form-group.has-error .form-control {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }
    
    .alert-danger {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
        padding: 0.75rem 1.25rem;
        margin-bottom: 1rem;
        border: 1px solid transparent;
        border-radius: 0.25rem;
    }
    
    .alert-danger strong {
        font-weight: bold;
    }
    
    .alert-danger i {
        margin-right: 0.5rem;
    }
");

Yii::app()->clientScript->registerScript('clone-questionnaire', "
$(document).ready(function() {
    // Gestione del click sul pulsante submit
    $('#clone-submit-btn').on('click', function(e) {
        console.log('Submit button clicked');
        e.preventDefault();
        e.stopPropagation();
        
        // Nascondi eventuali errori precedenti
        $('#clone-errors').hide();
        $('.invalid-feedback').removeClass('d-block');
        
        // Disabilita il pulsante di submit
        $('#clone-submit-btn').prop('disabled', true).html('<i class=\"fa fa-spinner fa-spin\"></i> Clonazione in corso...');
        
        $.ajax({
            url: '" . $this->createUrl("cloneQuestionnaire", array("id" => $model->id)) . "',
            type: 'POST',
            data: $('#cloneQuestionnaireForm').serialize(),
            dataType: 'json',
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
            success: function(response) {
                console.log('Response received:', response);
                
                // Verifica che la risposta sia un oggetto valido
                if (typeof response !== 'object' || response === null) {
                    $('#clone-error-message').text('Risposta non valida dal server.');
                    $('#clone-errors').show();
                    return;
                }
                
                // Se la risposta ha errori di validazione (formato Yii standard)
                if (Object.keys(response).length > 0 && !response.hasOwnProperty('success')) {
                    // Nascondi errori generali
                    $('#clone-errors').hide();
                    
                    // Mostra gli errori per ogni campo
                    $.each(response, function(fieldId, errors) {
                        console.log('Error for field:', fieldId, 'Errors:', errors);
                        
                        // Estrai il nome del campo dall'ID (es: Questionnaire_title -> title)
                        var fieldName = fieldId.replace('Questionnaire_', '');
                        
                        if (fieldName === 'title') {
                            $('#title-error').text(errors[0]).addClass('d-block');
                            $('#Questionnaire_title').addClass('is-invalid');
                            $('#Questionnaire_title').closest('.form-group').addClass('has-error');
                        } else if (fieldName === 'slug') {
                            $('#slug-error').text(errors[0]).addClass('d-block');
                            $('#Questionnaire_slug').addClass('is-invalid');
                            $('#Questionnaire_slug').closest('.form-group').addClass('has-error');
                        } else if (fieldName === 'questionnaire_type') {
                            $('#Questionnaire_questionnaire_type').addClass('is-invalid');
                            $('#Questionnaire_questionnaire_type').closest('.form-group').addClass('has-error');
                        } else if (fieldName === 'client_id') {
                            $('#Questionnaire_client_id').addClass('is-invalid');
                            $('#Questionnaire_client_id').closest('.form-group').addClass('has-error');
                        } else if (fieldName === 'is_public') {
                            $('#Questionnaire_is_public').addClass('is-invalid');
                            $('#Questionnaire_is_public').closest('.form-group').addClass('has-error');
                        } else {
                            // Errori generici
                            $('#clone-error-message').text(errors[0]);
                            $('#clone-errors').show();
                        }
                    });
                    return;
                }
                
                // Se la risposta ha errori nel formato personalizzato (success: false, errors: {...})
                if (response.success === false && response.errors) {
                    // Nascondi errori generali
                    $('#clone-errors').hide();
                    
                    // Mostra gli errori per ogni campo
                    $.each(response.errors, function(fieldName, errorMsg) {
                        console.log('Error for field:', fieldName, 'Error:', errorMsg);
                        
                        if (fieldName === 'title') {
                            $('#title-error').text(errorMsg).addClass('d-block');
                            $('#Questionnaire_title').addClass('is-invalid');
                            $('#Questionnaire_title').closest('.form-group').addClass('has-error');
                        } else if (fieldName === 'slug') {
                            $('#slug-error').text(errorMsg).addClass('d-block');
                            $('#Questionnaire_slug').addClass('is-invalid');
                            $('#Questionnaire_slug').closest('.form-group').addClass('has-error');
                        } else if (fieldName === 'version_id') {
                            $('#version-error').text(errorMsg).addClass('d-block');
                            $('#version_id').addClass('is-invalid');
                            $('#version_id').closest('.form-group').addClass('has-error');
                        } else if (fieldName === 'questionnaire_type') {
                            $('#Questionnaire_questionnaire_type').addClass('is-invalid');
                            $('#Questionnaire_questionnaire_type').closest('.form-group').addClass('has-error');
                        } else if (fieldName === 'client_id') {
                            $('#Questionnaire_client_id').addClass('is-invalid');
                            $('#Questionnaire_client_id').closest('.form-group').addClass('has-error');
                        } else if (fieldName === 'is_public') {
                            $('#Questionnaire_is_public').addClass('is-invalid');
                            $('#Questionnaire_is_public').closest('.form-group').addClass('has-error');
                        } else {
                            // Errori generici
                            $('#clone-error-message').text(errorMsg);
                            $('#clone-errors').show();
                        }
                    });
                    return;
                }
                
                // Se non ci sono errori di validazione, controlla se è un successo
                if (response.success) {
                    // Reindirizza alla lista dei questionari
                    window.location.href = '" . $this->createUrl("index") . "';
                } else if (response.message) {
                    $('#clone-error-message').text(response.message);
                    $('#clone-errors').show();
                } else {
                    // Fallback per errori non strutturati
                    $('#clone-error-message').text('Errore sconosciuto durante la clonazione.');
                    $('#clone-errors').show();
                }
            },
            error: function(xhr, status, error) {
                console.log('AJAX Error:', xhr.responseText, status, error);
                
                // Prova a parsare la risposta come JSON per vedere se ci sono errori strutturati
                try {
                    var errorResponse = JSON.parse(xhr.responseText);
                    if (errorResponse.errors) {
                        $.each(errorResponse.errors, function(field, errorMsg) {
                            if (field === 'title') {
                                $('#title-error').text(errorMsg).addClass('d-block');
                            } else if (field === 'slug') {
                                $('#slug-error').text(errorMsg).addClass('d-block');
                            } else if (field === 'version_id') {
                                $('#version-error').text(errorMsg).addClass('d-block');
                            } else {
                                $('#clone-error-message').text(errorMsg);
                                $('#clone-errors').show();
                            }
                        });
                    } else if (errorResponse.message) {
                        $('#clone-error-message').text(errorResponse.message);
                        $('#clone-errors').show();
                    } else {
                        $('#clone-error-message').text('Errore di comunicazione con il server. Riprova.');
                        $('#clone-errors').show();
                    }
                } catch (e) {
                    // Se non è JSON valido, mostra un errore generico
                    $('#clone-error-message').text('Errore di comunicazione con il server. Riprova.');
                    $('#clone-errors').show();
                }
            },
            complete: function() {
                // Riabilita il pulsante di submit
                $('#clone-submit-btn').prop('disabled', false).html('<i class=\"fa fa-copy\"></i> Clona Questionario');
            }
        });
    });
    
    // Genera automaticamente lo slug dal titolo
    $('#Questionnaire_title').on('input', function() {
        var title = $(this).val();
        var slug = title.toLowerCase()
            .replace(/[^a-z0-9\\s-]/g, '') // Rimuovi caratteri speciali
            .replace(/\\s+/g, '-') // Sostituisci spazi con trattini
            .replace(/-+/g, '-') // Rimuovi trattini multipli
            .replace(/^-|-$/g, ''); // Rimuovi trattini all'inizio e alla fine
        $('#Questionnaire_slug').val(slug);
        
        // Pulisci l'errore del titolo quando l'utente modifica
        $('#title-error').removeClass('d-block');
    });
    
    // Pulisci gli errori quando l'utente modifica i campi
    $('#Questionnaire_slug').on('input', function() {
        $('#slug-error').removeClass('d-block');
        $(this).removeClass('is-invalid');
        $(this).closest('.form-group').removeClass('has-error');
    });
    
    $('#version_id').on('change', function() {
        $('#version-error').removeClass('d-block');
        $(this).removeClass('is-invalid');
        $(this).closest('.form-group').removeClass('has-error');
    });
    
    $('#Questionnaire_title').on('input', function() {
        $('#title-error').removeClass('d-block');
        $(this).removeClass('is-invalid');
        $(this).closest('.form-group').removeClass('has-error');
    });
    
    $('#Questionnaire_questionnaire_type').on('change', function() {
        $(this).removeClass('is-invalid');
        $(this).closest('.form-group').removeClass('has-error');
    });
    
    $('#Questionnaire_client_id').on('change', function() {
        $(this).removeClass('is-invalid');
        $(this).closest('.form-group').removeClass('has-error');
    });
    
    $('#Questionnaire_is_public').on('change', function() {
        $(this).removeClass('is-invalid');
        $(this).closest('.form-group').removeClass('has-error');
    });
    
    // Pulisci errori generali quando si modifica qualsiasi campo
    $('input, select, textarea').on('input change', function() {
        $('#clone-errors').hide();
        // Rimuovi tutte le classi di errore
        $('.form-control').removeClass('is-invalid');
        $('.form-group').removeClass('has-error');
        $('.invalid-feedback').removeClass('d-block');
    });
});
", CClientScript::POS_READY);
?>

