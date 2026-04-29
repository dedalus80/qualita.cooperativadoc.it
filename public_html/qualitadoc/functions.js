jQuery(document).ready(function($) {
    // Initialize datepickers
    $('#arrivo, #partenza').datepicker({
        format: 'dd/mm/yyyy',
        language: 'it',
        autoclose: true,
        todayHighlight: true
    });

    $('input[name="info"]').on('click', function() {
        //reset value of fields #dati-utente
        $('#nome, #cognome, #email, #cellulare').val('');
        $('#error_nome, #error_cognome, #error_email, #error_cellulare').text('');

        if ($(this).val() === 'S') {
            $("#dati-utente").fadeIn("slow");
        } else {
            $("#dati-utente").fadeOut("slow");
        }
    });

    // Aggiungi un contenitore per i messaggi di errore sopra il form
    if ($('#recaptcha-error-message').length === 0) {
        $('#form_questionario').before('<div id="recaptcha-error-message" style="display:none;color:#ce151e;font-weight:bold;"></div>');
    }

    // Form validation and submission
    $('#form_questionario').on('submit', function(e) {
        e.preventDefault();

        $('.btn-send').prop('disabled', true);
        
        // Clear previous errors
        $('.error').text('');
        
        // Validate required fields
        var isValid = true;
        var requiredFields = [
            'albergo',
            'arrivo',
            'partenza',
            'tipologia',
            'conoscenza',
            'viaggio_complessivo',
            'struttura_complessivo',
            'struttura_pulizia',
            'camera_complessivo',
            'ristorante_complessivo',
            'ristorante_servizio',
            'personale_complessivo',
            'personale_professionalita',
            'personale_animazione',
            'consiglia',
            'camera_comfort',
            'ristorante_qualita',
            'info',
            'informativa'
        ];

        requiredFields.forEach(function(field) {
            // Seleziona tutti gli elementi con id o name = field
            var $field = $('[name="' + field + '"]');
            
            // Se esiste un gruppo di checkbox
            if ($field.length > 1 && $field.first().attr('type') === 'radio' || $field.first().attr('type') === 'checkbox') {
                if (!$field.is(':checked')) {
                    $('#error_' + field).text('Obbligatorio');
                    isValid = false;
                } else {
                    $('#error_' + field).text('');
                }
            }
            // Singolo campo checkbox
            else if ($field.attr('type') === 'radio' || $field.attr('type') === 'checkbox') {
                if (!$field.is(':checked')) {
                    $('#error_' + field).text('Obbligatorio');
                    isValid = false;
                } else {
                    $('#error_' + field).text('');
                }
            }
            // Altri tipi di input
            else {
                if (!$field.val()) {
                    $('#error_' + field).text('Obbligatorio');
                    isValid = false;
                } else {
                    $('#error_' + field).text('');
                }
            }
        });

        if($('input[name="info"]:checked').val() === 'S') {
            var contactFields = [
                'nome',
                'cognome',
                'email',
                'cellulare'
            ];
            
            contactFields.forEach(function(field) {
                var $field = $('#' + field);

                if(!$field.val()) {
                    $('#error_' + field).text('Obbligatorio');
                    isValid = false;
                } else {
                    if(field === 'email') {
                        if(!$field.val().includes('@')) {
                            $('#error_' + field).text('Email non valida');
                            isValid = false;
                        }
                    }
                    if(field === 'cellulare') {
                        if(!$field.val().match(/^\d{10,16}$/)) {
                            $('#error_' + field).text('Cellulare non valido');
                            isValid = false;
                        }
                    }
                }
            });
        }
        
        if (!isValid) {
            $('.btn-send').prop('disabled', false);
            window.scrollTo({ top: 0, behavior: 'smooth' });
            return false;
        }

        grecaptcha.ready(function() {
            grecaptcha.execute(recaptchaSiteKey, {action: 'submit'}).then(function(token) {
                var formData = $('#form_questionario').serializeArray();
                formData.push({name: 'action', value: 'submit_qualitadoc_form'});
                formData.push({name: 'nonce', value: qualitadocAjax.nonce});
                formData.push({name: 'recaptcha_token', value: token});
                $.ajax({
                    url: qualitadocAjax.ajaxurl,
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            $('#recaptcha-error-message').hide();
                            $('#form_questionario')[0].reset();

                            $('#form_questionario').replaceWith('<div class="alert alert-success">Questionario inviato con successo!</div>');
                        } else {
                            if (response.data && response.data.toLowerCase().indexOf('recaptcha') !== -1) {
                                $('#recaptcha-error-message').text('Verifica anti-spam fallita. Riprova o aggiorna la pagina.').show();
                            } else {
                                $('#recaptcha-error-message').hide();
                                $('#recaptcha-error-message').text('Errore durante l\'invio del questionario: ' + response.data).show();
                            }

                            $('.btn-send').prop('disabled', false);
                        }
                    },
                    error: function() {
                        $('#recaptcha-error-message').hide();
                        $('#recaptcha-error-message').text('Errore durante l\'invio del questionario. Riprova più tardi.').show();
                        $('.btn-send').prop('disabled', false);
                    }
                });
            });
        });

        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
});
