<p>Ciao <?php echo $model->nome;?></p>
<p>E' stato creato un account a tuo nome sulla piattaforma Qualità di Cooperativa DOC.</p>
<p>Il tuo nome utente è: <?php echo $model->user;?></p>
<p>Per attivarlo segui le istruzioni riportate al seguente link:</p>
<a href="https://qualita.cooperativadoc.it/qualita_new/index.php/account/activation/<?php echo $model->activation_token;?>">https://qualita.cooperativadoc.it/qualita_new/index.php/account/activation/<?php echo $model->activation_token;?></a>

<p>Lo Staff Cooperativa DOC</p>