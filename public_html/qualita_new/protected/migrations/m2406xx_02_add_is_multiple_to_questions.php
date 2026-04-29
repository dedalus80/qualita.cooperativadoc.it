<?php

class m2406xx_02_add_is_multiple_to_questions extends CDbMigration
{
    public function up()
    {
        $this->addColumn('questions', 'is_multiple', 'TINYINT(1) NOT NULL DEFAULT 0 COMMENT "Permette risposte multiple per domande di tipo custom"');
    }

    public function down()
    {
        $this->dropColumn('questions', 'is_multiple');
    }
} 