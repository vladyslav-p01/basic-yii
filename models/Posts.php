<?php

namespace app\models;

use Yii;
use app\models\Categories;

/**
 * This is the model class for table "posts".
 *
 * @property integer $id_post
 * @property string $title
 * @property string $description
 * @property integer $time
 *
 * @property CategoryPost[] $categoryPosts
 */
class Posts extends \yii\db\ActiveRecord
{
    public $categor;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'time'], 'required'],
            [['description'], 'string'],
            [['time'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['categor'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_post' => 'Id Post',
            'title' => 'Title',
            'description' => 'Description',
            'time' => 'Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        //return $this->hasMany(Item::className(), ['id' => 'item_id'])
        //->viaTable('order_item', ['order_id' => 'id']);
        return $this->hasMany(Categories::className(),
            ['id_category' => 'category_id'])->viaTable('category_post', ['post_id' => 'id_post']);
    }

    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['post_id' => 'id_post']);
    }
}
