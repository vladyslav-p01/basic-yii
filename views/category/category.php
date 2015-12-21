<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\grid\GridView;

/**
 * @var $dataProvider
 * @var $model
 */
?>

<h1 align="center">Категории постов</h1>

<?= GridView::widget(['dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'title',
    ]
]) ?>

<h1 align="center">Создание новой категории</h1>
<?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'title') ?>
    <?= Html::submitButton('Отправить',
    ['class' => 'btn btn-primary', 'id' => 'submit']) ?>
<?php $form->end();?>
<a href="<?= Url::to(['post/']) ?>">Все посты</a>