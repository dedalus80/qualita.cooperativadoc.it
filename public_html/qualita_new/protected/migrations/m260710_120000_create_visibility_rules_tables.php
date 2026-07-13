<?php

class m260710_120000_create_visibility_rules_tables extends CDbMigration
{
    public function up()
    {
        $this->createTable('visibility_rulesets', array(
            'id' => 'pk',
            'target_type' => "ENUM('question','section') NOT NULL",
            'target_id' => 'INT UNSIGNED NOT NULL',
            'combine_operator' => "ENUM('and','or') NOT NULL DEFAULT 'and'",
            'created_at' => 'DATETIME NULL',
            'updated_at' => 'DATETIME NULL',
        ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');

        $this->createIndex('idx_visibility_rulesets_target', 'visibility_rulesets', 'target_type, target_id', true);

        $this->createTable('visibility_rules', array(
            'id' => 'pk',
            'ruleset_id' => 'INT NOT NULL',
            'sort_order' => 'INT NOT NULL DEFAULT 0',
            'source_type' => "ENUM('participant_field','question_answer') NOT NULL",
            'source_key' => 'VARCHAR(50) NOT NULL',
            'operator' => "VARCHAR(10) NOT NULL",
            'value' => 'VARCHAR(255) NOT NULL DEFAULT ''',
        ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');

        $this->createIndex('idx_visibility_rules_ruleset', 'visibility_rules', 'ruleset_id');
        $this->addForeignKey(
            'fk_visibility_rules_ruleset',
            'visibility_rules',
            'ruleset_id',
            'visibility_rulesets',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey('fk_visibility_rules_ruleset', 'visibility_rules');
        $this->dropTable('visibility_rules');
        $this->dropTable('visibility_rulesets');
    }
}
