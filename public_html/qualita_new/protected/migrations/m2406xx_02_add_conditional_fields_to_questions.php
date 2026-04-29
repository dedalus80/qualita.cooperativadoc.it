<?php

/**
 * Migration per aggiungere i campi condizionali alla tabella questions
 */
class m2406xx_02_add_conditional_fields_to_questions extends CDbMigration
{
    public function up()
    {
        // Aggiungi i campi condizionali alla tabella questions
        $this->addColumn('questions', 'condition_question_id', 'INT UNSIGNED NULL');
        $this->addColumn('questions', 'condition_operator', 'VARCHAR(10) NULL');
        $this->addColumn('questions', 'condition_value', 'VARCHAR(255) NULL');
        
        // Aggiungi foreign key per condition_question_id
        $this->addForeignKey(
            'fk_questions_condition_question', 
            'questions', 
            'condition_question_id', 
            'questions', 
            'id', 
            'SET NULL', 
            'CASCADE'
        );
    }

    public function down()
    {
        // Rimuovi foreign key
        $this->dropForeignKey('fk_questions_condition_question', 'questions');
        
        // Rimuovi i campi condizionali
        $this->dropColumn('questions', 'condition_value');
        $this->dropColumn('questions', 'condition_operator');
        $this->dropColumn('questions', 'condition_question_id');
    }
} 