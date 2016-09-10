<?php

namespace app\models;

use Yii;
use app\models\AuthAssignment;
use app\models\AuthItemChild;
/**
 * This is the model class for table "{{%auth_item}}".
 *
 * @property string $name
 * @property integer $type
 * @property string $description
 * @property string $rule_name
 * @property string $data
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property AuthAssignment[] $authAssignments
 * @property AuthRule $ruleName
 * @property AuthItemChild[] $authItemChildren
 */
class AuthItem extends \yii\db\ActiveRecord
{
	const TYPE_ROLE = 1;
	const TYPE_PERMISSION= 2;
	public	$child;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%auth_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'created_at', 'updated_at'], 'integer'],
            [['description', 'data'], 'string'],
			['type','in', 'range' => [self::TYPE_ROLE,self::TYPE_PERMISSION]],
            [['name', 'rule_name'], 'string', 'max' => 64],
			['child','safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'type' => 'Type',
            'description' => 'Description',
            'rule_name' => 'Rule Name',
            'data' => 'Data',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthAssignments()
    {
        return $this->hasMany(AuthAssignment::className(), ['item_name' => 'name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRuleName()
    {
        return $this->hasOne(AuthRule::className(), ['name' => 'rule_name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthItemChildren()
    {
        return $this->hasMany(AuthItemChild::className(), ['child' => 'name']);
    }
	
	 
	
	 public function getTotalUser($data)
    {

					$name 	=	$data->name;
					$total 	=	AuthAssignment::find()->where(['item_name'=>$name])->all();
					return count($total);
	}


	 public function getLevel($data)
    {

					$name 	=	$data->name;
					$total 	=	AuthItemChild::find()->where(['parent'=>$name])->all();
					return count($total);
	}
	
	
	
	

}
