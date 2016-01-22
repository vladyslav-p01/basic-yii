<?php

use yii\db\Schema;
use yii\db\Migration;

class m151231_192143_change_roles extends Migration
{
    public function up()
    {
        $auth = Yii::$app->authManager;

        $author = $auth->getRole('author');


        $auth->remove($author);

        $rule = new app\rbac\DefaultRule();
        $auth->add($rule);

        $author2 = $auth->createRole('author');
        $author2->ruleName = $rule->name;
        $auth->add($author2);

        $admin = $auth->getRole('admin');
        $auth->addChild($admin, $author2);

    }

    public function down()
    {

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
