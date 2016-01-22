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
 * @property integer $author_id
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
            ['author_id', 'required']
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
            'categor' => 'Categories'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Categories::className(),
            ['id_category' => 'category_id'])->viaTable('category_post', ['post_id' => 'id_post']);
    }

    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['post_id' => 'id_post']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id_user' => 'author_id']);
    }
}
