<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_login_log}}".
 *
 * @property integer $LogId
 * @property integer $UserId
 * @property string $LoginAt
 * @property string $LogoutAt
 * @property string $LoginIp
 */
class LoginLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%login_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          //  [['UserId', 'LogoutAt', 'LoginIp'], 'required'],
            [['UserId'], 'integer'],
            [['LoginAt', 'LogoutAt'], 'safe'],
            [['LoginIp'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'LogId' => 'Log ID',
            'UserId' => 'User ID',
            'LoginAt' => 'Login At',
            'LogoutAt' => 'Logout At',
            'LoginIp' => 'Login Ip',
        ];
    }
}
