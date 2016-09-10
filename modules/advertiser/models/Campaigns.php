<?php

namespace app\modules\advertiser\models;

use Yii;

/**
 * This is the model class for table "{{%beta_campaigns}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $section_id
 * @property string $name
 * @property double $price
 * @property string $ban_site
 * @property string $ban_region
 * @property string $ban_country
 * @property string $ban_hour
 * @property string $ban_week_day
 * @property string $dataadd
 * @property string $type
 * @property string $OS
 * @property string $device
 * @property integer $status
 */
class Campaigns extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%beta_campaigns}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           // [['user_id', 'section_id', 'name', 'price', 'ban_site', 'ban_region', 'ban_country', 'ban_hour', 'ban_week_day', 'dataadd', 'type', 'OS', 'device', 'status'], 'required'],
            [['name','type'],'required'],
            [['user_id', 'section_id', 'status'], 'integer'],
            [['price'], 'number'],
            [['ban_site', 'ban_region', 'ban_country', 'ban_hour', 'ban_week_day'], 'safe'],
            [['dataadd'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 10],
            [['OS', 'device'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'section_id' => Yii::t('app', 'Section'),
            'name' => Yii::t('app', 'Name'),
            'price' => Yii::t('app', 'Price'),
            'ban_site' => Yii::t('app', 'Ban Site'),
            'ban_region' => Yii::t('app', 'Ban Region'),
            'ban_country' => Yii::t('app', 'Ban Country'),
            'ban_hour' => Yii::t('app', 'Ban Hour'),
            'ban_week_day' => Yii::t('app', 'Ban Week Day'),
            'dataadd' => Yii::t('app', 'Dataadd'),
            'type' => Yii::t('app', 'Type'),
            'OS' => Yii::t('app', 'Os'),
            'device' => Yii::t('app', 'Device'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
}
