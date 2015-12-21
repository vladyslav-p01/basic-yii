<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Posts;
use kartik\select2\Select2;
/**
 * @var $model
 * @var $categories
 */
?>

<h1 align="center">Редактирование поста</h1>

<?= $this->render('_form', ['model' => $model, 'categories' => $categories]); ?>


