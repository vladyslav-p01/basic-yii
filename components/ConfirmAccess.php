<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 06.01.16
 * Time: 11:09
 */

namespace app\components;


use yii\base\Component;
use yii\web\NotFoundHttpException;
use Yii;

class ConfirmAccess extends Component {

    public static function check($permission, $params = [])
    {
        if (!Yii::$app->authManager->getPermission($permission)) {
            throw new NotFoundHttpException('Such permission does not exist');
        }
        if (!Yii::$app->user->can($permission, $params)) {
            throw new NotFoundHttpException('Access denied');
        }
    }

}