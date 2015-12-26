<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 20.12.15
 * Time: 18:40
 */

/**
 * @var app\models\Posts $post
 */
use yii\helpers\Html;
use \yii\helpers\Url;
?>

<div>
    <b>Название:</b>
    <p><?= Html::encode($post->title)?> </p>
</div>
<div>
    <b>Описание:</b>
    <p><?= Html::encode($post->description) ?></p>
</div>
<!--'H' - возвратит час дня в 24-x часовом формате-->
<!--'i' - возвратит минуты-->
<!--'I' - возвратит день недели (длинная форма)-->
<!--'d' - возвратит день месяца-->
<!--'F' - полное название месяца-->
<div>
    <b>Дата создания поста:</b>
    <p><?= date( 'Hhi l d F', $post->time );
        ?></p>
</div>
<div> <b>Категории:</b>
    <?php
        $array = [];
        foreach ($post->categories as $category) {
            $array[] = $category->title;
        }
    ?>
    <?= implode(', ',$array) ?>
</div>
<a href="<?= Url::to(['comment/create', 'id' => $post->id_post]) ?>">Добавить комментарий</a>
<div>
    <?php if ($post->comments !== null): ?>
        <?php foreach ($post->comments as $comment): ?>
            <p style="border: 1px solid #000000"><?= $comment->body ?></p>
        <?php endforeach; ?>
    <?php endif ?>
</div>