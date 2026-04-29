<?php

class m260407_100000_create_formazione_corsi_tags_table extends CDbMigration
{
    public function up()
    {
        $this->createTable('formazione_corsi_tags', array(
            'corso_id' => 'INT(11) NOT NULL',
            'tag_id' => 'INT(11) NOT NULL',
            'PRIMARY KEY (`corso_id`, `tag_id`)',
        ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');

        $this->createIndex('idx_formazione_corsi_tags_tag', 'formazione_corsi_tags', 'tag_id', false);
        $this->addForeignKey('fk_formazione_corsi_tags_corso', 'formazione_corsi_tags', 'corso_id', 'db_formazione', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_formazione_corsi_tags_tag', 'formazione_corsi_tags', 'tag_id', 'utenti_tags', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_formazione_corsi_tags_tag', 'formazione_corsi_tags');
        $this->dropForeignKey('fk_formazione_corsi_tags_corso', 'formazione_corsi_tags');
        $this->dropTable('formazione_corsi_tags');
    }
}
