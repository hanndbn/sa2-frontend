<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "job".
 *
 * @property string $id
 * @property string $tag
 * @property string $picture
 * @property string $cvform
 * @property string $ctime
 * @property integer $state
 * @property string $description
 * @property string $attachment
 * @property integer $star
 * @property integer $jobstatus
 * @property string $opentime
 * @property string $orgid
 * @property string $closedtime
 * @property integer $nview
 * @property string $lmtime
 * @property string $salary
 * @property string $interest
 * @property string $contact
 * @property integer $category
 * @property string $creator
 * @property integer $quantity
 * @property string $endtime
 * @property string $title
 * @property integer $color
 */
class Org extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'org';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name'], 'string'],
            [['picture'], 'string'],
            [['ctime'], 'date'],
            [['lmtime'], 'date']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'name' => 'name',
        ];
    }
}
