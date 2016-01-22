<?php

use yii\db\Schema;
use yii\db\Migration;

class m151231_011557_rbac_configuring extends Migration
{
    public function up()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
        $rule = new app\rbac\OwnerRule();
        $auth->add($rule);

        //Post
        $createPost = $auth->createPermission('createPost');
        $auth->add($createPost);

        $updatePost = $auth->createPermission('updatePost');
        $auth->add($updatePost);

        $deletePost = $auth->createPermission('deletePost');
        $auth->add($deletePost);

        $updateOwnPost = $auth->createPermission('updateOwnPost');
        $updateOwnPost->ruleName = $rule->name;
        $auth->add($updateOwnPost);
        $auth->addChild($updateOwnPost, $updatePost);

        $deleteOwnPost = $auth->createPermission('deleteOwnPost');
        $deleteOwnPost->ruleName = $rule->name;
        $auth->add($deleteOwnPost);
        $auth->addChild($deleteOwnPost, $deletePost);

        //Comment
        $createComment = $auth->createPermission('createComment');
        $auth->add($createComment);

        $updateComment = $auth->createPermission('updateComment');
        $auth->add($updateComment);

        $deleteComment = $auth->createPermission('deleteComment');
        $auth->add($deleteComment);

        $updateOwnComment = $auth->createPermission('updateOwnComment');
        $updateOwnComment->ruleName = $rule->name;
        $auth->add($updateOwnComment);
        $auth->addChild($updateOwnComment, $updateComment);

        $deleteOwnComment = $auth->createPermission('deleteOwnComment');
        $deleteOwnComment->ruleName = $rule->name;
        $auth->add($deleteOwnComment);
        $auth->addChild($deleteOwnComment, $deleteComment);

        //category
        $createCategory = $auth->createPermission('createCategory');
        $auth->add($createCategory);

        $updateCategory = $auth->createPermission('updateCategory');
        $auth->add($updateCategory);

        $deleteCategory = $auth->createPermission('deleteCategory');
        $auth->add($deleteCategory);

        $updateOwnCategory = $auth->createPermission('updateOwnCategory');
        $updateOwnCategory->ruleName = $rule->name;
        $auth->add($updateOwnCategory);
        $auth->addChild($updateOwnCategory, $updateCategory);

        $deleteOwnCategory = $auth->createPermission('deleteOwnCategory');
        $deleteOwnCategory->ruleName = $rule->name;
        $auth->add($deleteOwnCategory);
        $auth->addChild($deleteOwnCategory, $deleteCategory);

        //author
        $author = $auth->createRole('author');
        $auth->add($author);

        $auth->addChild($author, $createPost);
        $auth->addChild($author, $updateOwnPost);
        $auth->addChild($author, $deleteOwnPost);

        $auth->addChild($author, $createComment);
        $auth->addChild($author, $updateOwnComment);
        $auth->addChild($author, $deleteOwnComment);

        $auth->addChild($author, $createCategory);
        $auth->addChild($author, $updateOwnCategory);
        $auth->addChild($author, $deleteOwnCategory);

        //admin
        $admin = $auth->createRole('admin');
        $auth->add($admin);

        $auth->addChild($admin, $updatePost);
        $auth->addChild($admin, $deletePost);

        $auth->addChild($admin, $updateComment);
        $auth->addChild($admin, $deleteComment);

        $auth->addChild($admin, $updateCategory);
        $auth->addChild($admin, $deleteCategory);

        $auth->addChild($admin, $author);

        $auth->assign($admin, 1);
        $auth->assign($author, 2);


    }

    public function down()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
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
