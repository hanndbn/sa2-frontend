<?php

namespace app\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord
{
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;

    public static function tableName()
    {
        return 'user';
    }
}
