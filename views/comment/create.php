<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Comments */
/* @var $id */

$this->title = 'Create Comment';
$this->params['breadcrumbs'][] = [
    'label' => $model->post->title,
    'url' => ['post/view', 'id' => $model->post_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comments-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
