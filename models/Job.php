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
class Job extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'job';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ctime', 'opentime', 'closedtime', 'lmtime', 'endtime'], 'safe'],
            [['state', 'star', 'jobstatus', 'orgid', 'nview', 'category', 'creator', 'quantity', 'color'], 'integer'],
            [['description', 'attachment', 'interest', 'contact'], 'string'],
            [['tag'], 'string', 'max' => 10],
            [['picture', 'cvform', 'salary', 'title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tag' => 'Tag',
            'picture' => 'Picture',
            'cvform' => 'Cvform',
            'ctime' => 'Ctime',
            'state' => 'State',
            'description' => 'Description',
            'attachment' => 'Attachment',
            'star' => 'Star',
            'jobstatus' => 'Jobstatus',
            'opentime' => 'Opentime',
            'orgid' => 'Orgid',
            'closedtime' => 'Closedtime',
            'nview' => 'Nview',
            'lmtime' => 'Lmtime',
            'salary' => 'Salary',
            'interest' => 'Interest',
            'contact' => 'Contact',
            'category' => 'Category',
            'creator' => 'Creator',
            'quantity' => 'Quantity',
            'endtime' => 'Endtime',
            'title' => 'Title',
            'color' => 'Color',
        ];
    }
}
