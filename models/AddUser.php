<?php
namespace app\models;

use app\models\User;
use app\models\AuthAssignment;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class AddUser extends Model
{
    public $username;
    public $email;
    public $password;
    public $repeatpassword;
    public $user_role;
    public $first_name;
    public $last_name;
    public $phone;
    public $status;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'unique', 'targetClass' => 'app\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => 'app\models\User', 'message' => 'This email address has already been taken.'],

            [['first_name','last_name','password', 'repeatpassword'] , 'required'],
            ['password','string','min'=>6],
           /* ['password','match', 'pattern' => '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,25}$/','message' => 'password must contains atleast 1 uppercase, 1 lowercase , 1 digit',],*/
			['repeatpassword','compare','compareAttribute'=>'password'],
            [['user_role','first_name','last_name','phone','status'],'safe']
			
        ];
    }

     public function attributeLabels()
    {
        return [
         
            'username' => Yii::t('app', 'Username'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'password' => Yii::t('app', 'Password'),
            'user_role' => Yii::t('app', 'User Role'),
            'repeatpassword' => Yii::t('app', 'Repeat Password'),
                        
        ];


    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function adduser()
    {
       
	    if ($this->validate()) {
            $user = new User();
            $user->first_name   = $this->first_name;
            $user->last_name    = $this->last_name;
            $user->username     = $this->email;
            $user->email        = $this->email;
            $user->phone        = $this->phone;
            $user->user_role    = $this->user_role;
            $user->status       = $this->status;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {

                $assignment = new AuthAssignment();
                $assignment->user_id    =   $user->id;
                if($this->user_role =='')
                {
                    $role  = 'customer';
                }
                else
                {

                    $role  = $this->user_role;
                }
                $assignment->item_name  =   $role;
                $assignment->save();
            
                return $user;
            }
        }

        return null;
    }
	
	
}
