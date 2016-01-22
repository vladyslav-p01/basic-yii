<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comments".
 *
 * @property integer $id_comment
 * @property string $body
 * @property integer $time
 * @property integer $post_id
 *
 * @property Posts[] $posts
 */
class Comments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['body'], 'string'],
            [['post_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_comment' => 'Id Comment',
            'body' => 'Body',
            'time' => 'Time',
            'post_id' => 'Post ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Posts::className(), ['id_post' => 'post_id']);
    }

    public function beforeSave($insert)
    {
        $this->time = time();
        if ($this->isNewRecord) {
            $this->author_id = Yii::$app->user->getId();
        }

        return parent::beforeSave($insert);
    }
}
