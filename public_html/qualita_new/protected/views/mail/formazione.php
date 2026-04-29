<p>Ciao <?php echo $name;?></p>
<p><?php echo $model->descrizione;?></p>
Il corso si svolgerà<br />
<?php echo ($model->tipo_accesso=='P'?'in presenza in '.$model->address_accesso:'on-line al link <a href="'.$model->link_accesso.'" target="_blank">'.$model->link_accesso.'</a>' );?><br />
il <?php echo date('d-m-Y', strtotime($model->data));?> alle ore <?php echo $model->ora;?><br /><br />
Per ogni esigenza ti invitiamo a scrivere a <a href="mailto:formazione@cooperativadoc.it" target="_blank">formazione@cooperativadoc.it</a>
</p>
<p>Gruppo Formazione</p>