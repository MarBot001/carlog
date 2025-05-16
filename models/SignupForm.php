<?php

namespace app\models;

use Yii;
use yii\base\Model;

class SignupForm extends Model
{
    public $name;
    public $email;
    public $password;
    public $password_repeat;

    public function rules()
    {
        return [
            [['name', 'email', 'password', 'password_repeat'], 'required', 'message' => 'Kötelező mező!'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => User::class, 'message' => 'Ez az email már használatban van.'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => 'A jelszavak nem egyeznek.'],
        ];
    }

    public function signup()
    {
        if (!$this->validate()) return null;

        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->setPassword($this->password);       // biztonságos jelszó hash-elés
        $user->generateAuthKey();
        return $user->save() ? $user : null;
    }
}
