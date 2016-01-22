<?php

use yii\db\Schema;
use yii\db\Migration;

class m151231_173635_UpdateOwn extends Migration
{
    public function up()
    {
        $auth = Yii::$app->authManager;

        $rule = new app\rbac\AuthorRule;
        $auth->add($rule);

        $updateOwn = $auth->createPermission('UpdateOwn');
        $updateOwn->ruleName = $rule->name;
        $updateOwn->description = 'only authors can update post';
        $auth->add($updateOwn);

        $update = $auth->getPermission('updatePost');
        $auth->addChild($updateOwn, $update);

        $author = $auth->getRole('author');
        $auth->addChild($author, $updateOwn);
    }

    public function down()
    {

        $auth = Yii::$app->authManager;

        $updateOwn = $auth->getPermission('UpdateOwn');
        $update = $auth->getPermission('updatePost');
        $auth->removeChild($updateOwn, $update);

        $auth->remove($updateOwn);

        $rule = new app\rbac\AuthorRule;
        $auth->remove($rule);

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
