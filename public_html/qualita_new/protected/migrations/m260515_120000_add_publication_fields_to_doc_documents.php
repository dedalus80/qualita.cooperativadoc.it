<?php

class m260515_120000_add_publication_fields_to_doc_documents extends CDbMigration
{
	public function up()
	{
		$this->addColumn('doc_documents', 'description', 'TEXT NULL AFTER titolo');
		$this->addColumn('doc_documents', 'publication_date', 'DATE NULL AFTER description');
		$this->addColumn('doc_documents', 'external_url', 'VARCHAR(255) NULL AFTER publication_date');

		$this->execute("UPDATE doc_documents SET description = COALESCE(NULLIF(titolo, ''), 'Documento') WHERE description IS NULL OR description = ''");
		$this->execute("UPDATE doc_documents SET publication_date = COALESCE(NULLIF(data_inserimento, '0000-00-00'), NULLIF(data_revisione, '0000-00-00'), CURDATE()) WHERE publication_date IS NULL");
		$this->alterColumn('doc_documents', 'description', 'TEXT NOT NULL');
		$this->alterColumn('doc_documents', 'publication_date', 'DATE NOT NULL');

		$this->alterColumn('doc_documents', 'funzione_responsabile_id', 'INT(11) NULL');
		$this->alterColumn('doc_documents', 'sgq', 'VARCHAR(255) NULL');
		$this->alterColumn('doc_documents', 'tipologia', 'VARCHAR(255) NULL');
		$this->alterColumn('doc_documents', 'codice', 'VARCHAR(255) NULL');
		$this->alterColumn('doc_documents', 'numero', 'VARCHAR(255) NULL');
		$this->alterColumn('doc_documents', 'revisione', 'VARCHAR(255) NULL');
		$this->alterColumn('doc_documents', 'data_revisione', 'DATE NULL');
		$this->alterColumn('doc_documents', 'redige', 'VARCHAR(255) NULL');
		$this->alterColumn('doc_documents', 'archivia', 'VARCHAR(255) NULL');
		$this->alterColumn('doc_documents', 'riesamina', 'VARCHAR(255) NULL');
		$this->alterColumn('doc_documents', 'autorizza', 'VARCHAR(255) NULL');
		$this->alterColumn('doc_documents', 'approva', 'VARCHAR(255) NULL');
		$this->alterColumn('doc_documents', 'periodicita_riesame', 'VARCHAR(255) NULL');
		$this->alterColumn('doc_documents', 'modalita_archiviazione', 'VARCHAR(255) NULL');
		$this->alterColumn('doc_documents', 'luogo_archiviazione', 'VARCHAR(255) NULL');
	}

	public function down()
	{
		$this->execute("UPDATE doc_documents SET funzione_responsabile_id = COALESCE(funzione_responsabile_id, (SELECT id FROM doc_funzione ORDER BY id LIMIT 1), 0) WHERE funzione_responsabile_id IS NULL");
		$this->execute("UPDATE doc_documents SET data_revisione = COALESCE(data_revisione, publication_date, data_inserimento, CURDATE()) WHERE data_revisione IS NULL");

		$legacyColumns = array(
			'sgq',
			'tipologia',
			'codice',
			'numero',
			'revisione',
			'redige',
			'archivia',
			'riesamina',
			'autorizza',
			'approva',
			'periodicita_riesame',
			'modalita_archiviazione',
			'luogo_archiviazione',
		);

		foreach($legacyColumns as $column) {
			$this->execute("UPDATE doc_documents SET {$column} = '' WHERE {$column} IS NULL");
		}

		$this->dropColumn('doc_documents', 'external_url');
		$this->dropColumn('doc_documents', 'publication_date');
		$this->dropColumn('doc_documents', 'description');

		$this->alterColumn('doc_documents', 'funzione_responsabile_id', 'INT(11) NOT NULL');
		$this->alterColumn('doc_documents', 'sgq', 'VARCHAR(255) NOT NULL');
		$this->alterColumn('doc_documents', 'tipologia', 'VARCHAR(255) NOT NULL');
		$this->alterColumn('doc_documents', 'codice', 'VARCHAR(255) NOT NULL');
		$this->alterColumn('doc_documents', 'numero', 'VARCHAR(255) NOT NULL');
		$this->alterColumn('doc_documents', 'revisione', 'VARCHAR(255) NOT NULL');
		$this->alterColumn('doc_documents', 'data_revisione', 'DATE NOT NULL');
		$this->alterColumn('doc_documents', 'redige', 'VARCHAR(255) NOT NULL');
		$this->alterColumn('doc_documents', 'archivia', 'VARCHAR(255) NOT NULL');
		$this->alterColumn('doc_documents', 'riesamina', 'VARCHAR(255) NOT NULL');
		$this->alterColumn('doc_documents', 'autorizza', 'VARCHAR(255) NOT NULL');
		$this->alterColumn('doc_documents', 'approva', 'VARCHAR(255) NOT NULL');
		$this->alterColumn('doc_documents', 'periodicita_riesame', 'VARCHAR(255) NOT NULL');
		$this->alterColumn('doc_documents', 'modalita_archiviazione', 'VARCHAR(255) NOT NULL');
		$this->alterColumn('doc_documents', 'luogo_archiviazione', 'VARCHAR(255) NOT NULL');
	}
}
