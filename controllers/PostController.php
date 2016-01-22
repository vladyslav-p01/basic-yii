<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 19.12.15
 * Time: 12:48
 */

namespace app\controllers;

use app\models\Categories;
use app\models\Posts;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\PostSearch;
use app\components\ConfirmAccess;


class PostController extends Controller {

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ],

                ],
            ],

            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post']
                ],
            ]
        ];
    }

    public function actionCreate()
    {

        ConfirmAccess::check('createPost');
        $post = new Posts();

        if (Yii::$app->request->isPost) {
            if ($post->load(Yii::$app->request->post())) {
                $post->time = time();
                $post->author_id = Yii::$app->user->getId();
                $post->validate();
                $post->save();

                foreach ($post->categor as $element) {
                    $category = Categories::findOne($element);
                    $post->link('categories', $category);
                }
                return $this->redirect(['index']);
            }
        }

        $categories = Categories::find()->all();
        return $this->render('new-post', ['model' => $post,
            'categories' =>
                ArrayHelper::map($categories, 'id_category', 'title')]);
    }



    public function actionUpdate()
    {
        $post = Posts::findOne(Yii::$app->request->get('id'));

        ConfirmAccess::check('updatePost', ['object' => $post]);
        /** @var Posts $post */

        if (!$post) {
            throw new NotFoundHttpException('Post not founded');
        }



        if ($post->load(Yii::$app->request->post()) &&
            $post->validate()
    ) {

            $post->unlinkAll('categories', true);
            $post->save();

            foreach ($post->categor as $element) {
                $category = Categories::findOne($element);
                $post->link('categories', $category);
            }
            return $this->redirect(['view', 'id' => $post->id_post]);

        }

        // all categories
        $allCategories = Categories::find()->all();
        $post->categor = $post->categories; // categories read-only
        $allCategories = ArrayHelper::map($allCategories, 'id_category', 'title');
        return $this->render('edit-post', ['model' => $post,
            'categories' => $allCategories]);
    }

    public function actionIndex()
    {

        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $allCategories = Categories::find()->all();
        $allCategories = ArrayHelper::map($allCategories, 'id_category', 'title');
        return $this->render(
            'index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categories' => $allCategories
        ]);

    }

    /**
     * Finds the Posts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Posts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Posts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDelete($id)
    {
        /* @var Posts $post*/
        $post = $this->findModel($id);
        ConfirmAccess::check('deletePost', ['object' => $post]);

        $post->unlinkAll('categories', true);
        $post->unlinkAll('comments', true);
        $post->delete();
        return $this->redirect(['index']);

    }

    public function actionView()
    {   /* @var $post Posts*/
        $post = Posts::findOne(Yii::$app->request->get('id'));
        if ($post === null) {
            return $this->render('error', ['message' => 'Такого поста нет']);
        }

        return $this->render('view', ['post' => $post]);

    }
}