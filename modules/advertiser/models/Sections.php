<?php

namespace app\modules\advertiser\models;

use Yii;

/**
 * This is the model class for table "{{%beta_sections}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $price
 * @property integer $status
 */
class Sections extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%beta_sections}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'price', 'status'], 'required'],
            [['price'], 'number'],
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'price' => Yii::t('app', 'Price'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
}
