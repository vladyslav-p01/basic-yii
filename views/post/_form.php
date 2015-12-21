<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 21.12.15
 * Time: 16:45
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
/**
 * @var $model
 * @var $categories
 */
?>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'categor')
    ->widget(Select2::className(),
        [
            'data' => $categories,
            'options' => ['multiple' => true]
        ],
        ['promt' => 'Выберите категорию сайта', 'multiple' => true]
    ) ?>
<?= $form->field($model, 'title'); ?>
<?= $form->field($model, 'description'); ?>
<?= Html::submitButton('Отправить',
    ['class' => 'btn btn-primary', 'id' => 'submit']) ?>
<?php $form->end();