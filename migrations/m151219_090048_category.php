<?php

use yii\db\Schema;
use yii\db\Migration;

class m151219_090048_category extends Migration
{
    public function up()
    {
        $this->createTable('categories', [
            'id_category' => $this->primaryKey()->notNull(),
            'title' => $this->string(30)->notNull()
        ]);
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
