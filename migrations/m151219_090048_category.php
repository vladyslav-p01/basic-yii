<?php

use yii\db\Schema;
use yii\db\Migration;

class m151219_090048_category extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('categories', [
            'id_category' => $this->primaryKey()->notNull(),
            'title' => $this->string(30)->notNull()
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('categories');
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
