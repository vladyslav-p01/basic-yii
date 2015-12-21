<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 19.12.15
 * Time: 14:08
 */

namespace app\controllers;


use Yii;
use app\models\Categories;
use yii\web\Controller;
use yii\data\ActiveDataProvider;

class CategoryController extends Controller {

    public function actionEntry()
    {
        $categoryModel = new Categories();

        if (Yii::$app->request->isPost) {
            if ($categoryModel->load(Yii::$app->request->post()) &&
                $categoryModel->validate()
            ) {
                $categoryModel->save();
            }
        }

        $category = Categories::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $category,
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);
        return $this->render('category', ['dataProvider' => $dataProvider,
            'model' => $categoryModel]);
    }
}