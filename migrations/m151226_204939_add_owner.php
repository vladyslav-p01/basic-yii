<?php

use yii\db\Schema;
use yii\db\Migration;

class m151226_204939_add_owner extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('users', [
           'id_user' => $this->primaryKey(),
           'login' => $this->string()->notNull(),
            'password_hash' => $this->string(30)->notNull(),
            'auth_key' => $this->string()
        ], $tableOptions);

        $this->addColumn('posts', 'author_id', $this->integer(11));
        $this->addColumn('comments', 'author_id', $this->integer(11));
// addForeignKey($name, $table, $columns, $refTable, $refColumns
        $this->addForeignKey(
            'FK-posts-author_id',
            'posts',
            'author_id',
            'users',
            'id_user'
            );

        $this->addForeignKey(
            'FK-comments-author_id',
            'comments',
            'author_id',
            'users',
            'id_user'
        );
    }


    public function down()
    {
        $this->dropForeignKey('FK-posts-author_id', 'posts');
        $this->dropForeignKey('FK-comments-author_id', 'comments');
        $this->dropTable('users');
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
