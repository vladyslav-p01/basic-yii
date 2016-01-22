<?php

use yii\db\Schema;
use yii\db\Migration;

class m151231_200307_rbac_comments extends Migration
{

    public function up()
    {
        $auth = Yii::$app->authManager;

        $author = $auth->getRole('author');
        $createComment = $auth->createPermission('createComment');
        $auth->add($createComment);
        $auth->addChild($author, $createComment);

    }

    public function down()
    {
        $auth = Yii::$app->authManager;

        $createComment = $auth->getPermission('createComment');
        $author = $auth->getRole('author');
        $auth->removeChild($author, $createComment);
        $auth->remove($createComment);
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
