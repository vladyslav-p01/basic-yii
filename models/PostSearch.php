<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 19.12.15
 * Time: 18:45
 */

namespace app\models;


use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * PostSearch represents the model behind the search form about `app\models\Posts`.
 */
class PostSearch extends Posts {

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'categor'], 'safe'],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Posts::find();

        //$query->joinWith('categories');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->categor = $this->categories;
        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'title', $this->title]);

        if ($this->categor !== '') {
            $query->joinWith('categories');
            $query->andFilterWhere(['like', 'description', $this->description])
                ->andFilterWhere(['id_category' => $this->categor]);
        }

        return $dataProvider;
    }
}