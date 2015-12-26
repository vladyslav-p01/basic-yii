<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 19.12.15
 * Time: 12:48
 */

namespace app\controllers;

use app\models\Categories;
use app\models\CategoriesSearch;
use app\models\Posts;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\PostSearch;


class PostController extends Controller {

    public function actionCreate()
    {

        $post = new Posts();

        if (Yii::$app->request->isPost) {
            if ($post->load(Yii::$app->request->post())) {
                $post->time = time();
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
        $array = [];
        foreach ($categories as $category) {
            $array[$category->id_category] = $category->title;
        }
        return $this->render('new-post', ['model' => $post,
            'categories' => $array]);
    }

    public function actionEdit()//Update
    {
        /** @var Posts $post */
        $post = Posts::findOne(Yii::$app->request->get('id'));

        if (!$post) {
            return "Not found";
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
            return $this->redirect(['index']);

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

    public function actionDelete()
    {
        /* @var Posts $post*/
        if ($id = Yii::$app->request->get('confirm')) {
            $post = Posts::findOne($id);
            $post->unlinkAll('categories', true);
            $post->unlinkAll('comments', true);
            $post->delete();
            return $this->redirect(['index']);

        }

        $post = Posts::findOne(Yii::$app->request->get('id'));
        if ($post) {
            return $this->render('confirm', ['postTitle' => $post->title, 'id' => $post->id_post]);
        }
        return $this->render('error', ['message' => 'Такого поста нет']);
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