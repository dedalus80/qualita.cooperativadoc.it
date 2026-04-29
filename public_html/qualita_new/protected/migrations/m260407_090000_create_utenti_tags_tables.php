<?php

class m260407_090000_create_utenti_tags_tables extends CDbMigration
{
    public function up()
    {
        $this->createTable('utenti_tags', array(
            'id' => 'pk',
            'nome' => 'VARCHAR(100) NOT NULL',
        ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');

        $this->createIndex('idx_utenti_tags_nome', 'utenti_tags', 'nome', true);

        $this->createTable('utenti_tags_assoc', array(
            'utente_id' => 'INT(11) NOT NULL',
            'tag_id' => 'INT(11) NOT NULL',
            'PRIMARY KEY (`utente_id`, `tag_id`)',
        ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');

        $this->createIndex('idx_utenti_tags_assoc_tag', 'utenti_tags_assoc', 'tag_id', false);
        $this->addForeignKey('fk_utenti_tags_assoc_utente', 'utenti_tags_assoc', 'utente_id', 'utenti', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_utenti_tags_assoc_tag', 'utenti_tags_assoc', 'tag_id', 'utenti_tags', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_utenti_tags_assoc_tag', 'utenti_tags_assoc');
        $this->dropForeignKey('fk_utenti_tags_assoc_utente', 'utenti_tags_assoc');
        $this->dropTable('utenti_tags_assoc');
        $this->dropTable('utenti_tags');
    }
}
