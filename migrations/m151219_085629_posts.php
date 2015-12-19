<?php

use yii\db\Schema;
use yii\db\Migration;

class m151219_085629_posts extends Migration
{

    public function up()
    {
        $this->createTable('posts', [
            'id_post' => $this->PrimaryKey()->notNull(),
            'title' => $this->string()->notNull(),
            'description' => $this->text(),
            'time' => $this->integer(11)->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('posts');
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
