<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property integer $id_category
 * @property string $title
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_category' => 'Id Category',
            'title' => 'Title',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */


    /*
     * //return $this->hasMany(Item::className(), ['id' => 'item_id'])
        //->viaTable('order_item', ['order_id' => 'id']);
     */

    /**
     * @return \yii\db\ActiveQuery
     * return $this->hasMany(Categories::className(),
    ['id_category' => 'category_id'])->viaTable('category_post', ['post_id' => 'id_post']);
     */
    public function getPosts()
    {
        return $this->hasMany(Posts::className(), ['id_post' => 'post_id'])
            ->viaTable('category_post', ['category_id' => 'id_category']);
    }

    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id_user' => 'author_id']);
    }


}
