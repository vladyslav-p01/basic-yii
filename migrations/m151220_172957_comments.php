<?php

use yii\db\Schema;
use yii\db\Migration;

class m151220_172957_comments extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('comments',
                [
                    'id_comment' => $this->primaryKey(),
                    'body' => $this->text(),
                    'time' => $this->integer(),
                    'post_id' => $this->integer(),
                    'author_id' => $this->integer(),
                ],
            $tableOptions
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
        $this->dropForeignKey('FK-comments-author_id', 'comments');

        $this->dropTable('comments');
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
