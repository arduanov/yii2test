<?php

use yii\db\Schema;
use yii\db\Migration;

class m160112_140256_feedback extends Migration
{
    public function up()
    {
        $this->createTable('feedback', [
            'id' => Schema::TYPE_PK,
            'subject' => Schema::TYPE_STRING . ' NOT NULL',
            'body' => Schema::TYPE_TEXT . ' NOT NULL',
            'file' => Schema::TYPE_TEXT,
        ]);
    }

    public function down()
    {
        $this->dropTable('feedback');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
