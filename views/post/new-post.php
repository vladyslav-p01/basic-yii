<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Posts;

/**
 * @var $model
 * @var $categories
 */
?>

<h1 align="center">Добавление нового поста</h1>

<?= $this->render('_form', ['model' => $model, 'categories' => $categories]); ?>
