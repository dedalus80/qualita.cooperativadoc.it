<?php

class StessoPiano extends MySql_DB {
	
	var $lang ="it";
	
    function getSelect(){
		
		$this->lang =='en' ? $plus = "_en": $plus = "";
		$this->lang =='en' ? $pluslang = "_en": $pluslang = "_it";
		$select = array();
		$select['nazionalita'] = $this->CycleAssochId($this->Query("SELECT id, nome FROM doc_nazioni ORDER BY nome"));
		$select['provincie'] = $this->CycleAssochId($this->Query("SELECT id, nome FROM sp_province"));
		$select['occupazione'] = $this->CycleAssochId($this->Query("SELECT id, nome".$plus." as nome FROM sp_occupazione   "));
		$select['conoscienza'] = $this->CycleAssochId($this->Query("SELECT id, nome".$plus." as nome FROM sp_conoscenza   "));
		$select['camera'] = $this->CycleAssochId($this->Query("SELECT id, nome FROM sp_camera   "));
		$select['livello'] = $this->CycleAssochId($this->Query("SELECT id, nome".$plus." as nome FROM sp_livello   "));
		$select['quartieri'] = $this->CycleAssochId($this->Query("SELECT id, nome FROM sp_quartiere   "));
		$select['coabitare'] = $this->CycleAssochId($this->Query("SELECT id, nome".$plus." as nome FROM sp_coabitazione  "));
		$select['alloggi'] = $this->CycleAssochId($this->Query("SELECT id, nome".$pluslang." as nome FROM sp_alloggio  "));
		$select['amici_genere'] = $this->CycleAssochId($this->Query("SELECT id, nome".$pluslang." as nome FROM sp_amici_genere  "));
		$select['amici_occupazione'] = $this->CycleAssochId($this->Query("SELECT id, nome".$pluslang." as nome FROM sp_amici_occupazione  "));
		$select['amici_eta'] 		= $this->CycleAssochId($this->Query("SELECT id, nome".$pluslang." as nome FROM sp_amici_eta  "));
		$select['amici_animali'] 	= $this->CycleAssochId($this->Query("SELECT id, nome".$pluslang." as nome FROM sp_amici_animali  "));
		$select['amici_fumatori'] 	= $this->CycleAssochId($this->Query("SELECT id, nome".$pluslang." as nome FROM sp_amici_fumatori  "));
		$select['residenza'] 	= $this->CycleAssochId($this->Query("SELECT id, nome".$pluslang." as nome FROM sp_residenza WHERE active = 'Y'"));
		$select['amici_quanti'] 	= $this->CycleAssochId($this->Query("SELECT id, nome".$pluslang." as nome FROM sp_amici "));
		$select['appartamento'] 	= $this->CycleAssochId($this->Query("SELECT id, nome FROM sp_appartamento  "));	
		$select['lavoratore'] 	= $this->CycleAssochId($this->Query("SELECT id, tipo".$pluslang." as nome FROM sp_lavoratori"));
				
		return $select 	;
	}
}


$sp 		= new StessoPiano("localhost", "qualita_1_sito", "qualita_1_sito", '^B&FpWPQ7*;TDFm', true);
$sp->lang 	= $_SESSION['lang'];

$sel = $sp->getSelect();
?>