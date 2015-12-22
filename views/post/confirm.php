<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 20.12.15
 * Time: 16:56
 */

use yii\helpers\Html;
use yii\helpers\Url;
/** @var $id
 *  @var $postTitle
 */
?>
<h1> Удалить "<?= $postTitle ?>"? </h1>
<a href="<?= Url::to(['post/delete', 'confirm' => $id]) ?>">Подтвердить</a>
<a href="javascript:history.back();">Отмена</a>