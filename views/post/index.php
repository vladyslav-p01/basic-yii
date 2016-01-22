<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 19.12.15
 * Time: 17:19
 * @var $dataProvider
 *
 */
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var $searchModel
 * @var $categories
 */
?>



<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => '\yii\grid\SerialColumn'],
        'title',
        [
            'attribute' => 'categor',
            'filter' => $categories,
            'format' => 'html',
            'value' => function($data) {
                $array = [];
                foreach ($data->categories as $category) {
                    $array[] = Html::tag('li',$category->title);
                }

                return Html::tag('ul',implode('', $array));
            }
        ],
        [

            'attribute' => 'Action',
            'format' => 'html',
            'value' => function ($data) {
                $string = Html::tag('a',
                    'Просмотр',
                    [
                        'href' => Url::to(['post/view', 'id'
                        => $data->id_post])
                    ]);
                $string .= '&nbsp';
                $string .= Html::tag('a',
                    'Редактировать',
                    [
                        'href' => Url::to(['post/update', 'id'
                        => $data->id_post])
                    ]);
                $string .= '&nbsp';
                $string .= Html::tag('a',
                    'Удалить',
                    [
                        'href' => Url::to(['post/delete', 'id'
                        => $data->id_post])
                    ],
                    [
                        'data' => [
                            'confirm' => 'Are you really want to delete this post?',
                            'method' => 'post',
                        ]
                    ]
                    );
                return $string;
            }

        ]
    ]

]) ?>
<?= Html::a('Create post', ['create'], ['class' => 'btn btn-success']) ?>
&nbsp;