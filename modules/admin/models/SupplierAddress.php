<?php

namespace app\modules\admin\models;

use Yii;
use app\models\User;

/**
 * This is the model class for table "{{%supplier_address}}".
 *
 * @property integer $Id
 * @property integer $UserId
 * @property string $Url
 * @property string $Status
 */
class SupplierAddress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%supplier_address}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['UserId'], 'integer'],
            [['Url'], 'required'],
            [['Url'], 'string', 'max' => 255],
            [['Status'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => Yii::t('app', 'ID'),
            'UserId' => Yii::t('app', 'User ID'),
            'Url' => Yii::t('app', 'Url'),
            'Status' => Yii::t('app', 'Status'),
        ];
    }

     public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'UserId']);
    }
}
