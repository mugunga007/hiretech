<?php
/**
 * Created by PhpStorm.
 * User: shema
 * Date: 2018/12/24
 * Time: 10:41
 */

namespace frontend\models;
use yii\base\Model;
use Yii;


class UserLoginForm extends Model
{

    public $email;
    public $password;
    public $role;

    private $_user;

    public function rules()
    {
        return [
            [['email','password'],'required'],
            [['password'],'validatePassword'],
        ];
    }
    /*
     *
     * get the user using the provided email
     */
    public function getUser(){

        if ($this->_user === null) {
            $this->_user = Provider::findOne('email',$this->email);
        }

        return $this->_user;

    }

    /*
     * validate the provided password
     */
    public function validatePassword($attribute){
        if (!$this->hasErrors()) {
            if (!$this->getUser()->password == $this->password) {
                $this->addError($attribute, 'Invalid Username or Password');
            }
        }
    }
    /*
     * logs in the user using provided username and password
     */
    public function login(){
        if($this->validate()){
            return Yii::$app->user->login($this->getUser(),3600);
        }
    }

}