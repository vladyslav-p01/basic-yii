<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Comments */
/* @var $form yii\widgets\ActiveForm */
/* @var $id */
?>

<div class="comments-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'post_id')->hiddenInput(['value' => $model->post_id])->label(false) ?>

    <div class="form-group">
        <?php if ($model->isNewRecord): ?>
            <?= Html::submitButton('Create', ['class' => 'btn btn-primary']) ?>
        <?php else: ?>
            <?= Html::submitButton('Update', ['class' => 'btn btn-success']) ?>
        <?php endif ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
