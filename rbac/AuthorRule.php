<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 31.12.15
 * Time: 19:21
 */

namespace app\rbac;

use yii\rbac\Rule;

class AuthorRule extends Rule {

    public $name = 'isAuthor';

    /**
     * @param int|string $user
     * @param \yii\rbac\Item $item
     * @param array $params
     * @return bool
     */
    public function execute($user, $item, $params)
    {
        return isset($params['post']) ? $params['post']->author_id == $user : false;
    }
}