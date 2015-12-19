<?php

use yii\db\Schema;
use yii\db\Migration;

class m151219_092402_category_post extends Migration
{
    public function up()
    {

        $this->createTable('category_post', [
            'id_category_post' => $this->primaryKey()->notNull(),
            'post_id' => $this->integer(11)->notNull(),
            'category_id' => $this->integer(11)->notNull(),
        ]);

        //addForeignKey($name, $table, $columns, $refTable, $refColumns
        $this->addForeignKey('fk-category-post-post_id',
            'category_post',
            'post_id',
            'posts',
            'id_post'
            );

        $this->addForeignKey('fk-category-post-category_id',
            'category_post',
            'category_id',
            'categories',
            'id_category'
            );

    }



    public function down()
    {
        $this->dropForeignKey('fk-category-post-post_id', 'category_post');
        $this->dropForeignKey('fk-category-post-category_id', 'category_post');
        $this->dropTable('category_post');
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
