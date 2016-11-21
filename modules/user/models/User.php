<?php

namespace app\modules\user\models;

use Yii;
use yii\base\Security;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property string $avatar
 * @property string $status
 * @property string $created_at
 * @property string $last_login_at
 * @property string $auth_key
 */
class User extends ActiveRecord implements IdentityInterface
{
    public $rememberMe;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'string'],
            [['created_at', 'last_login_at'], 'safe'],
            [['first_name', 'last_name', 'email', 'password', 'avatar', 'auth_key'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'email' => 'Email',
            'password' => 'Password',
            'avatar' => 'Avatar',
            'status' => 'Status',
            'created_at' => 'Registration time',
            'last_login_at' => 'Last login time',
        ];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
                'value' => date('Y-m-d H:i:s')
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['accessToken' => $token]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
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
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this, $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * @param $userData
     * @return User
     */
    public function create($userData)
    {
        $this->first_name = $userData->firstName;
        $this->last_name = $userData->lastName;
        $this->email = $userData->email;
        $this->password = Yii::$app->security->generatePasswordHash($userData->password);
        $this->auth_key = Yii::$app->security->generateRandomString();

        $this->save();

        $auth = Yii::$app->authManager;
        $userRole = $auth->getRole('user');
        $auth->assign($userRole, $this->getId());

        return $this;
    }
}
