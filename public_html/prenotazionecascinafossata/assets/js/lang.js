
//~ var it_IT = {
    //~ STR:"John",
    //~ GEN:"Doe",
    //~ CO:46 ,
    //~ NV:46 ,
    //~ NVD:46 ,
    //~ PR:46 ,
    //~ CS:FH ,
    //~ FA:46 ,
    //~ FC:46 ,
    //~ FC:46 ,
    //~ FC:46 ,
//~ };

//~ var en_GB = {
    //~ firstName:"John",
    //~ lastName:"Doe",
    //~ age:46 };


function getErrorText(text) {

    var resp = ''
    var lang = $('#language').val();

    switch (text) {
        case "STR":
            switch (lang) {
                case "it_IT":
                    resp = "Selezionare la struttura";
                    break;
                case "en_GB":
                    resp = "Select accommodation";
                    break;
                case "es_ES":
                    resp = "obligatorio";
                    break;

            }
            break;
        case "GEN":
            switch (lang) {
                case "it_IT":
                    resp = "Verificare i campi evidenziati";
                    break;
                case "en_GB":
                    resp = "Check the highlighted fields";
                    break;
                case "es_ES":
                    resp = "Revise los campos resaltados";
                    break;
            }
            break;
        case "CO":
            switch (lang) {
                case "it_IT":
                    resp = "Obbligatorio";
                    break;
                case "en_GB":
                    resp = "Required";
                    break;
                case "es_ES":
                    resp = "obligatorio";
                    break;
            }
            break;
        case "NV":
            switch (lang) {
                case "it_IT":
                    resp = "Non valido";
                    break;
                case "en_GB":
                    resp = "Invalid value";
                    break;
                case "es_ES":
                    resp = "Valor no válido";
                    break;
            }
            break;
        case "NVD":
            switch (lang) {
                case "it_IT":
                    resp = "Non valido gg-mm-aaaa";
                    break;
                case "en_GB":
                    resp = "Invalid value dd-mm-yyyy";
                    break;
                case "es_ES":
                    resp = "Valor no válido dd-mm-aaaa";
                    break;
            }
            break;
        case "PR":
            switch (lang) {
                case "it_IT":
                    resp = '<br />&Egrave; necessario dare il consenso al trattamento dei dati';
                    break;
                case "en_GB":
                    resp = "<br />You need to give consent to the processing of data";
                    break;
                case "es_ES":
                    resp = "<br />Usted necesita dar su consentimiento al tratamiento de los datos";
                    break;
            }
            break;
        case "CS":
            switch (lang) {
                case "it_IT":
                    resp = "Indicare come si &egrave; venuti a conoscienza di sharing.to.it";
                    break;
                case "en_GB":
                    resp = "Indicate how did you hear about sharing.to.it";
                    break;
                case "es_ES":
                    resp = "Indique c&oacute;mo se enter&oacute; de sharing.to.it";
                    break;

            }
            break;
        case "FA":
            switch (lang) {
                case "it_IT":
                    resp = "Indicare la formula abitativa";
                    break;
                case "en_GB":
                    resp = "Enter the housing formula";
                    break;
                case "es_ES":
                    resp = "Introduzca la vivienda f&oacute;rmula";
                    break;

            }

            break;
        case "FC":
            switch (lang) {
                case "it_IT":
                    resp = "Indicare tipo campus";
                    break;
                case "en_GB":
                    resp = "Indicate campus type";
                    break;
                case "es_ES":
                    resp = "Indique el campus";
                    break;

            }
            break;
        case "FH":
            switch (lang) {
                case "it_IT":
                    resp = "Indicare tipo housing";
                    break;
                case "en-GB":
                    resp = "Indicate housing type";
                    break;
                case "es-ES":
                    resp = "Indique el housing";
                    break;

            }
            break;
        case "PR":
            switch (lang) {
                case "it-IT":
                    resp = '&Egrave; necessario dare il consenso al trattamento dei dati';
                    break;
                case "en-GB":
                    resp = "You need to give consent to the processing of data";
                    break;
                case "es-ES":
                    resp = "Usted necesita dar su consentimiento al tratamiento de los datos";
                    break;

            }
            break;
        case "CD":
            switch (lang) {
                case "it-IT":
                    resp = 'Completare periodo soggiorno';
                    break;
                case "en-GB":
                    resp = "Complete period of stay";
                    break;
                case "es-ES":
                    resp = "Per&iacute;odo completo de la estancia";
                    break;

            }
            break;
        case "NOR":
            switch (lang) {
                case "it-IT":
                    resp = 'Dimostrare di non essere un robot';
                    break;
                case "en-GB":
                    resp = "Dimostrare di non essere un robot";
                    break;
                case "es-ES":
                    resp = "Dimostrare di non essere un robot";
                    break;

            }
            break;
        case "CAP":
            switch (lang) {
                case "it-IT":
                    resp = 'Riportare l\'immagine di controllo';
                    break;
                case "en-GB":
                    resp = "Devuelva la imagen de control";
                    break;
                case "es-ES":
                    resp = "Return the Control image";
                    break;

            }
            break;
        case "CAPN":
            switch (lang) {
                case "it-IT":
                    resp = 'Immagine di controllo non valida';
                    break;
                case "en-GB":
                    resp = "The control image is not valid";

                    break;
                case "es-ES":
                    resp = "La imagen de control no es valida";
                    break;

            }
            break;
        case "INFO":
            switch (lang) {
                case "it-IT":
                    resp = "&Egrave; neccessario accettare l'informativa sulla privacy";
                    break;
                case "en-GB":
                    resp = "&Egrave; neccessario accettare l'informativa sulla privacy";
                    break;
                case "es-ES":
                    resp = "&Egrave; neccessario accettare l'informativa sulla privacy";
                    break;

            }
            break;
    }
    return resp;

}
