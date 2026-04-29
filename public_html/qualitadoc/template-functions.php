<?php
/**
 * Functions for the Qualita DOC questionnaire template
 */

// Add AJAX actions
add_action('wp_ajax_submit_qualitadoc_form', 'handle_qualitadoc_form_submission');
add_action('wp_ajax_nopriv_submit_qualitadoc_form', 'handle_qualitadoc_form_submission');

/**
 * Handle form submission
 */
function handle_qualitadoc_form_submission() {
    // Verify nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'qualitadoc_form_nonce')) {
        wp_send_json_error('Invalid nonce');
    }

    // Get form data
    $form_data = $_POST;
    unset($form_data['action']);
    unset($form_data['nonce']);

    // Validate required fields
    $required_fields = array(
        'albergo',
        'arrivo',
        'partenza',
        'tipologia',
        'conoscenza',
        'viaggio_complessivo',
        'struttura_complessivo',
        'struttura_pulizia',
        'camera_complessivo',
        'camera_comfort',
        'ristorante_complessivo',
        'ristorante_servizio',
        'ristorante_qualita',
        'personale_complessivo',
        'personale_professionalita',
        'personale_animazione',
        'consiglia',
        'info',
        'informativa'
    );

    foreach ($required_fields as $field) {
        if (empty($form_data[$field])) {
            wp_send_json_error('Missing required field: ' . $field);
        }
    }

    // Verifica reCAPTCHA v3
    $recaptcha_secret = '6LfsKGUrAAAAAJwNay5mkSM3dK8lOMr-IeQjMrWN';
    $recaptcha_token = isset($_POST['recaptcha_token']) ? $_POST['recaptcha_token'] : '';
    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $response = wp_remote_post($recaptcha_url, array(
        'body' => array(
            'secret' => $recaptcha_secret,
            'response' => $recaptcha_token
        )
    ));
    $response_body = wp_remote_retrieve_body($response);
    $result = json_decode($response_body, true);

    if (empty($result['success']) || $result['score'] < 0.5) {
        wp_send_json_error('Verifica reCAPTCHA fallita. Riprova.');
    }

    try {
        //execute curl post request to send data to api
        $url = 'https://api.cooperativadoc.it/api/survey';
        $data = array(
            'struttura_nome'             => 19,
            'data_arrivo'                => date('Y-m-d', strtotime(str_replace('/', '-', $form_data['arrivo']))),
            'data_partenza'              => date('Y-m-d', strtotime(str_replace('/', '-', $form_data['partenza']))),
            'vacanza'                    => $form_data['viaggio_complessivo'],
            'tipologia_cliente'          => $form_data['tipologia'],
            'conoscenza'                 => $form_data['conoscenza'],
            'struttura_pulizia'          => $form_data['struttura_pulizia'],
            'struttura_complessivo'      => $form_data['struttura_complessivo'],
            'stanza_complessivo'         => $form_data['camera_complessivo'],
            'stanza_confort'             => $form_data['camera_comfort'],
            'ristorante_servizio'        => $form_data['ristorante_servizio'],
			'ristorante_cibo'            => $form_data['ristorante_qualita'],
            'ristorante_complessivo'     => $form_data['ristorante_complessivo'],
            'personale_cortesia'         => $form_data['personale_cortesia'],
            'personale_professionalita'  => $form_data['personale_professionalita'],
			'personale_complessivo'      => $form_data['personale_complessivo'],
            'personale_animazione'       => $form_data['personale_animazione'],
            'consiglia'                  => $form_data['consiglia'],
            'suggerimenti'               => $form_data['suggerimenti'],
            'info'                       => $form_data['info'],
            'lingua'                     => 'it-IT',
            'nome'                       => $form_data['nome'],
            'cognome'                    => $form_data['cognome'],
            'email'                      => $form_data['email'],
            'cellulare'                  => $form_data['cellulare']
        );

        $api_key = '61673387-b413-4b9b-a68e-9460c8445316';

        // Inizializza cURL
        $ch = curl_init($url);

        // Imposta le opzioni cURL per una POST JSON
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $api_key));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        // Esegui la richiesta
        $api_response = curl_exec($ch);

        // Gestisci eventuali errori
        if ($api_response === false) {
            $error = curl_error($ch);
            curl_close($ch);
            wp_send_json_error('Errore nella richiesta API: ' . $error);
        }

        $api_result = json_decode($api_response, true);

        if (isset($api_result['success']) && !$api_result['success']) {
            wp_send_json_error('Errore API: ' . $api_result['message']);
        }

        curl_close($ch);

        wp_send_json_success('Form submitted successfully');
    } catch (Exception $e) {
        wp_send_json_error('Database error: ' . $e->getMessage());
    }
}

