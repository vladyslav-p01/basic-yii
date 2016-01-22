<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 31.12.15
 * Time: 19:21
 */

namespace app\rbac;

use yii\rbac\Rule;

class OwnerRule extends Rule {

    public $name = 'isOwner';

    /**
     * @param int|string $user
     * @param \yii\rbac\Item $item
     * @param array $params
     * @return bool
     */
    public function execute($user, $item, $params)
    {
        return isset($params['object']) ? $params['object']->author_id == $user : false;
    }
}