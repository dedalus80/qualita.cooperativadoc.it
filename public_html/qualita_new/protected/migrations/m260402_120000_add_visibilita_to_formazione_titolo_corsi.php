<?php

class m260402_120000_add_visibilita_to_formazione_titolo_corsi extends CDbMigration
{
	public function up()
	{
		$this->addColumn('doc_formazione_titolo_corsi', 'visibilita', "VARCHAR(20) NOT NULL DEFAULT 'ENTRAMBI' AFTER attivo");
	}

	public function down()
	{
		$this->dropColumn('doc_formazione_titolo_corsi', 'visibilita');
	}
}
