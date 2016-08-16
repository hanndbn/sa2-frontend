<?php
/**
 * Created by PhpStorm.
 * User: sonta
 * Date: 8/15/2016
 * Time: 5:51 PM
 */
namespace app\common;

use app\models\Job;
use app\models\JobPosition;

class Common{
    public static function getListJob(){
        $sqlSelect = 'SELECT * FROM jobposition';
        $lstPosition = JobPosition::findBySql($sqlSelect)->all();
        return $lstPosition;
    }
}