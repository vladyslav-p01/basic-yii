<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Comments */

$this->title = 'Update Comment: ' . ' ' . $model->id_comment;
$this->params['breadcrumbs'][] = [
    'label' => $model->post->title,
    'url' => ['post/view', 'id' => $model->post_id]];
$this->params['breadcrumbs'][] = 'Update comment';
?>
<div class="comments-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
