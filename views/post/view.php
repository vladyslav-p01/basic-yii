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
$this->title = $post->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['post/index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<?php if (Yii::$app->user->can('updatePost', ['object' => $post])): ?>
<?= Html::a('Update post', ['update', 'id' => $post->id_post], ['class' => 'btn btn-success']) ?>
&nbsp;
<?= Html::a('Delete post', ['delete', 'id' => $post->id_post], ['class' => 'btn btn-danger']) ?>
<?php endif ?>


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
    <p><?= date( 'H:h:i l d F', $post->time );
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
<a href="<?= Url::to(['comment/create', 'id' => $post->id_post]) ?>" class="btn btn-default">Добавить комментарий</a>
<div style='margin:5px;'>
    <?php if ($post->comments !== null): ?>

        <?php foreach ($post->comments as $comment): ?>
            <div>
                <p style="border: 1px solid #000000; margin: 2px;">
                    <?= $comment->body ?>
                </p>
                <p style="text-align: right">
                    <?php if(Yii::$app->user->can('updateComment', ['object' => $comment])): ?>
                        <?= Html::a('update', ['comment/update', 'id' => $comment->id_comment]) ?>
                    <?php endif ?>
                    <?php if(Yii::$app->user->can('deleteComment', ['object' => $comment])): ?>
                        <?= Html::a('delete',
                            [
                            'comment/delete',
                            'id' => $comment->id_comment,
                            ], [
                                'data' => [
                                    'confirm' => 'Are you really want to delete this comment',
                                    'method' => 'post'
                                ]
                            ]) ?>
                    <?php endif ?>

                </p>
            </div>
        <?php endforeach; ?>
    <?php endif ?>
</div>