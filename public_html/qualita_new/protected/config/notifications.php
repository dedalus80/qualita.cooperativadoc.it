<link rel="manifest" href="https://qualita.cooperativadoc.it/manifest.json" />
<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async></script>
<script>
    
    var OneSignal = OneSignal || [];
    OneSignal.push(["sendTag", "user", "<?= Yii::app()->user->getId() ?>"])
    OneSignal.push(["sendTag", "ruolo", "<?= $userDetail['user_type'] ?>"])
    OneSignal.push(["sendTag", "q_keluar", "<?= $userDetail['q_keluar'] =='Y' ? "1":"2"  ?>"])
    OneSignal.push(["sendTag", "q_doc", "<?= $userDetail['q_doc'] =='Y' ? "1":"2"?>"])
    OneSignal.push(["sendTag", "q_formazione", "<?= $userDetail['q_formazione'] =='Y' ? "1":"2" ?>"])
    OneSignal.push(["sendTag", "q_studio", "<?= $userDetail['q_studio'] =='Y' ? "1":"2" ?>"])
    OneSignal.push(["sendTag", "q_scientifici", "<?= $userDetail['q_scientifici'] =='Y' ? "1":"2"?>"])
    OneSignal.push(["sendTag", "q_sharing", "<?= $userDetail['q_sharing'] =='Y' ? "1":"2" ?>"])
    OneSignal.push(["sendTag", "q_junior", "<?= $userDetail['q_junior'] =='Y' ? "1":"2" ?>"])
    OneSignal.push(["sendTag", "q_senior", "<?= $userDetail['q_senior'] =='Y' ? "1":"2" ?>"])
    OneSignal.push(["sendTag", "q_campus", "<?= $userDetail['q_campus'] =='Y' ? "1":"2" ?>"])
    OneSignal.push(["sendTag", "q_vacanza", "<?= $userDetail['q_vacanza'] =='Y' ? "1":"2" ?>"])
    OneSignal.push(["sendTag", "preiscrizione_cm", "<?= $userDetail['preiscrizione_cm'] =='Y' ? "1":"2" ?>"])
    OneSignal.push(["sendTag", "preiscrizione_tim", "<?= $userDetail['preiscrizione_tim'] =='Y' ? "1":"2" ?>"])
    OneSignal.push(["sendTag", "preiscrizione_sh", "<?= $userDetail['preiscrizione_sh'] =='Y' ? "1":"2" ?>"])
    OneSignal.push(["sendTag", "preiscrizione_cs", "<?= $userDetail['preiscrizione_cs'] =='Y' ? "1":"2" ?>"])
    OneSignal.push(["sendTag", "struttura", "<?= $userDetail['user_unita'] =='Y' ? "1":"2" ?>"])
    OneSignal.push(["setDefaultTitle", "Custom Default Title"])        
    OneSignal.push(["init", {
            appId: "9e208e47-0f90-4222-8f94-7f3aa7596f4d",
            autoRegister: true,
            persistNotification: false, // Automatically dismiss the notification after ~20 seconds in Chrome Deskop v47+
            welcomeNotification: {
                disable: true
            }
            /*
            notifyButton: {
                enable: true, // Required to use the notify button
                size: 'medium', // One of 'small', 'medium', or 'large'
                theme: 'default', // One of 'default' (red-white) or 'inverse" (white-red)
                position: 'bottom-right', // Either 'bottom-left' or 'bottom-right'
                offset: {
                    bottom: '5px',
                    left: '0px', // Only applied if bottom-left
                    right: '5px' // Only applied if bottom-right
                },
                prenotify: true, // Show an icon with 1 unread message for first-time site visitors
                showCredit: false, // Hide the OneSignal logo
                text: {
                    'tip.state.unsubscribed': 'Attiva notifiche',
                    'tip.state.subscribed': "Notifiche attive",
                    'tip.state.blocked': "Notifiche bloccate",
                    'message.prenotify': 'clicca per le notifiche',
                    'message.action.subscribed': "Grazie per esserti registrato",
                    'message.action.resubscribed': "Notifiche attive",
                    'message.action.unsubscribed': "Non riceverai pi&ugrave; notifiche",
                    'dialog.main.title': 'Notifiche Cooperativadoc Qualit&agrave;',
                    'dialog.main.button.subscribe': 'Abilita',
                    'dialog.main.button.unsubscribe': 'Disabilita',
                    'dialog.blocked.title': 'Sblocca notitiche',
                    'dialog.blocked.message': "Segui le informazioni per abilitare le notifiche:"
                },
                colors: { // Customize the colors of the main button and dialog popup button
'circle.background': 'rgb(46,67,86)',
'circle.foreground': 'white',
'badge.background': 'rgb(46,67,86)',
'badge.foreground': 'white',
'badge.bordercolor': 'white',
'pulse.color': 'white',
'dialog.button.background.hovering': 'rgb(91, 180, 229)',
'dialog.button.background.active': 'rgb(141, 201, 232)',
'dialog.button.background': 'rgb(46,67,86)',
'dialog.button.foreground': 'white'
}

            } */
        }
    ]); 
</script>