<?php
namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\helpers\Html;
use app\models\LoginLog;


/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    public $oldpassword;
    public $password;
    public $repeatpassword;
   
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],

            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'unique', 'targetClass' => 'app\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => 'app\models\User', 'message' => 'This email address has already been taken.'],

            [['first_name','last_name'] , 'required'],
            ['password','string','min'=>6],
           /* ['password','match', 'pattern' => '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,25}$/','message' => 'password must contains atleast 1 uppercase, 1 lowercase , 1 digit',],*/
            ['repeatpassword','compare','compareAttribute'=>'password'],
            [['user_role','first_name','last_name','phone','ResetKey','KeyDate'],'safe'],

             [['oldpassword','password','repeatpassword'] , 'required','on'=>'changeP'],
            
			
           
          
			
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
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
	 public function getStatus($data)
    {
		if($data->status == 10)

        return 'Active';
		if($data->status == 0)
		return 'Deactive';
    }


	public function getLast($data)
        {
           
                    $userId     =       $data->id;
            
            $log    =   LoginLog::find()->where(['UserId'=>$userId])->orderBy(['LogId'=>SORT_DESC])->all();
            if(count($log)>0){
            foreach($log as $l){

               $last =  $l->LoginAt;
                      
                
                
            $etime = strtotime(date('Y-m-d H:i:s')) - strtotime($last);

      

            if ($etime < 1)
            {
                return $etime;//'0 seconds';
            }

            $a = array( 365 * 24 * 60 * 60  =>  'year',
                         30 * 24 * 60 * 60  =>  'month',
                              24 * 60 * 60  =>  'day',
                                   60 * 60  =>  'hour',
                                        60  =>  'minute',
                                         1  =>  'second'
                        );
            $a_plural = array( 'year'   => 'years',
                               'month'  => 'months',
                               'day'    => 'days',
                               'hour'   => 'hours',
                               'minute' => 'minutes',
                               'second' => 'seconds'
                        );

            foreach ($a as $secs => $str)
            {
                $d = $etime / $secs;
                if ($d >= 1)
                {
                    $r = round($d);
                    return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
                }
            }

        }
        }else{

                return 'Never';
            }

        
            }
}
