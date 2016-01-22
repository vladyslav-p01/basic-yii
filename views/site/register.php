<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 28.12.15
 * Time: 21:27
 */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/**
 * @var $model
 */
?>

<h1>Создать нового пользователя:</h1>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'username') ?>
<?= $form->field($model, 'password')->passwordInput() ?>
<?= $form->field($model, 'passwordConfirm')
    ->passwordInput() ?>
<?= Html::submitButton('Register', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
<?php $form->end(); ?>