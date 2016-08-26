<?php

namespace app\models;

use yii\db\ActiveRecord;

class Org extends ActiveRecord
{
    public static function tableName()
    {
        return 'org';
    }
}
