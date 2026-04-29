<?php
class m2406xx_01_add_logo_privacy_footer_to_questionnaires extends CDbMigration
{
    public function up()
    {
        $this->addColumn('questionnaires', 'logo', 'VARCHAR(255) NULL');
        $this->addColumn('questionnaires', 'link_privacy', 'VARCHAR(255) NULL');
        $this->addColumn('questionnaires', 'footer_description', 'TEXT NULL');
    }

    public function down()
    {
        $this->dropColumn('questionnaires', 'logo');
        $this->dropColumn('questionnaires', 'link_privacy');
        $this->dropColumn('questionnaires', 'footer_description');
    }
} 