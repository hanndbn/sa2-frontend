<?php

namespace app\controllers;

use app\models\User;
use Yii;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\i18n\GettextMessageSource;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\helpers\Html;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Job;
use app\models\JobPosition;
use yii\web\JsonParser;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $sql = 'SELECT * FROM job WHERE id NOT IN (0,1,2,3,4) AND state NOT IN(-1) AND jobstatus IN(2,4) ORDER BY star DESC, opentime DESC LIMIT 17';
        $jobs = Job::findBySql($sql)->all();
        $sql = 'SELECT * FROM job WHERE id NOT IN (0,1,2,3,4) AND state NOT IN(-1) AND jobstatus IN(2,4) ORDER BY star DESC, opentime DESC LIMIT 3';
        $banner_jobs = Job::findBySql($sql)->all();

//        s
//        $doc = new DOMDocument();
//        @$doc->loadHTML($html);
//        $tags = $doc->getElementsByTagName('article')->item(0);

//        foreach ($tags as $tag) {
//            echo $tag->getAttribute('src');
//        }

        return $this->render('index', ['jobs' => $jobs, 'banner_jobs' => $banner_jobs]);
    }

    public function actionLogin()
    {
        $this->layout = 'login';
        return $this->render('login');
    }

    public function actionHelp()
    {
        return $this->render('help');
    }

    public function actionDanhsach()
    {
        $sql = 'SELECT COUNT(*) FROM job WHERE id NOT IN (0,1,2,3,4) AND state NOT IN(-1) AND jobstatus IN(2,4)';
        //sql select job positions
        $sqlSelect = 'SELECT * FROM jobposition';
        $count = Yii::$app->db->createCommand($sql)->queryScalar();
        $lstPosition = JobPosition::findBySql($sqlSelect)->all();
        return $this->render('list', ['count' => $count, 'lstPosition' => $lstPosition]);
    }

    public function actionGioithieu()
    {
        return $this->render('about');
    }

    public function actionUnsubcribe()
    {
        return $this->render('unsubcribe');
    }

    public function actionVitri($id)
    {
        $job = Job::findOne($id);
        $job->nview++;
        $job->save();
        $sql = 'SELECT * FROM job WHERE id NOT IN (0,1,2,3,4,' . $id . ') AND state NOT IN(-1) AND jobstatus IN(2,4) ORDER BY star DESC, opentime DESC LIMIT 3';
        $other_jobs = Job::findBySql($sql)->all();
        return $this->render('detail', ['job' => $job, 'other_jobs' => $other_jobs]);
    }

    public function actionSearch()
    {
        $key = '';
        if (isset($_GET['key'])) $key = $_GET['key'];
        $sql = 'SELECT * FROM job WHERE id NOT IN (0,1,2,3,4) AND state NOT IN(-1) AND jobstatus IN(2,4) AND ( title LIKE "' . $key . '" OR description LIKE "' . $key . '") ORDER BY star DESC, opentime DESC';
        $jobs = Job::findBySql($sql)->all();
        return $this->render('search', ['jobs' => $jobs]);
    }

    public function actionUngtuyen($id)
    {
        $job = Job::findOne($id);
        return $this->render('apply', ['job' => $job]);
    }

    public function actionAjaxjob()
    {
        if (isset($_POST['page'])) {
            $page = $_POST['page'];
            $org = $_POST['org'];
            $currentpage = $page;
            $page -= 1;
            $prv = true;
            $next = true;
            $end = 10;
            $start = $page * $end;
            $key = strip_tags($_POST['keyword']);
            $add = strip_tags($_POST['address']);
            $sal = strip_tags($_POST['salary']);
            $position = strip_tags($_POST['position']);
            $key = '%' . $key . '%';
            $add = '%' . $add . '%';
            $sql = 'SELECT * FROM job WHERE id NOT IN (0,1,2,3,4) AND state NOT IN(-1) AND jobstatus IN(2,4) AND ( title LIKE "' . $key . '" OR description LIKE "' . $key . '") AND (contact LIKE "' . $add . '")';
            $sql_count = 'SELECT COUNT(*) FROM job WHERE id NOT IN (0,1,2,3,4) AND state NOT IN(-1) AND jobstatus IN(2,4) AND ( title LIKE "' . $key . '" OR description LIKE "' . $key . '") AND (contact LIKE "' . $add . '")';
            if ($sal != '' && $sal != NULL) {
                $sql .= ' AND salary = "' . $sal . '"';
                $sql_count .= ' AND salary = "' . $sal . '"';
            }
            if ($position != null && $position != '') {
                $sql .= ' AND position = "' . $position . '"';
                $sql_count .= ' AND position = "' . $position . '"';
            }
            if ($org != 0) {
                $sql .= ' AND orgid = ' . $org;
                $sql_count .= ' AND orgid = ' . $org;
            }
            $sql .= ' ORDER BY star DESC, opentime DESC LIMIT ' . $start . ',' . $end;
            $jobs = Job::findBySql($sql)->all();
            $msg = "<div style='border-bottom: 1px #ccc solid;'>";
            if (!empty($jobs)) {
                foreach ($jobs as $job) {
                    $msg .= '
                    <div class="tv-item">
                       <div class="content col-xs-12 col-sm-10 col-md-7 col-lg-5">'
                        . Html::a('<h4>' . $job->title . '</h4>', ['/site/vitri', 'id' => $job->id]) . '
                    </div>

                    <div class="thumb col-xs-12 col-md-3 col-lg-2">
                        <span class="tv-salary tt" data-placement="left">' . $job->quantity . '</span>
                    </div>
                    <div class="thumb col-sm-2 col-md-3 col-lg-3">';
                    switch ($job->orgid) {
                        case 2:
                            $msg .= "<a target='_blank' href='http://tvo.vn/'>Tinhvan Outsourcing</a>";
                            break;
                        case 3:
                            $msg .= "<a target='_blank' href='http://tinhvanconsulting.com/'>Tinhvan Consulting</a>";
                            break;
                        case 4:
                            $msg .= "<a target='_blank' href='http://tinhvan.com/'>Tinhvan eBooks</a>";
                            break;
                        case 5:
                            $msg .= "<a target='_blank' href='http://vuonuomtinhvan.com/'>Tinhvan Incubator</a>";
                            break;
                        case 6:
                            $msg .= "<a target='_blank' href='http://tinhvan.com/'>Tinhvan Solutions</a>";
                            break;
                        case 7:
                            $msg .= "<a target='_blank' href='http://mc-corp.vn/'>Minh Chau Corp</a>";
                            break;
                        case 8:
                            $msg .= "<a target='_blank' href='http://tinhvan.com/'>Tinhvan Telecom</a>";
                            break;

                        default:
                            $msg .= "<a target='_blank' href='http://tinhvan.com/'>Tinhvan Group</a>";
                            break;
                    }
                    $msg .= "</div><div class='thumb col-lg-2'>";
                    $msg .= "<span class='tv-deadline tt' data-placement='top'>" . date('d-m-Y', strtotime($job->endtime)) . "</span></div></div>";
                }
                $count = Yii::$app->db->createCommand($sql_count)->queryScalar();
                $numberpage = ceil($count / $end);
                if ($currentpage >= 7) {
                    $start_loop = $currentpage - 3;
                    if ($numberpage > $currentpage + 3)
                        $end_loop = $currentpage + 3;
                    else if ($currentpage <= $numberpage && $currentpage > $numberpage - 6) {
                        $start_loop = $numberpage - 6;
                        $end_loop = $numberpage;
                    } else {
                        $end_loop = $numberpage;
                    }
                } else {
                    $start_loop = 1;
                    if ($numberpage > 7)
                        $end_loop = 7;
                    else
                        $end_loop = $numberpage;
                }
                $msg .= " </div><div class='page-paging'>
                <div class='pagination js-pagination'>
                    <ul class='pagination__list' style='margin-right: 19px;'>";
                if ($prv && $currentpage > 1) {
                    $pre = $currentpage - 1;
                    $msg .= "<li p='" . $pre . "' class='active pagination_previous'><b>Prev</b></li>";
                } else if ($prv) {
                    $msg .= "<li class='inactive pagination_page-current' style='display:none'><b>Prev</b></li>";
                }

                for ($i = $start_loop; $i <= $end_loop; $i++) {
                    if ($end_loop > $start_loop) {
                        if ($currentpage == $i)
                            $msg .= "<li p='" . $i . "' class='active pagination_page-current'>" . $i . "</li>";
                        else
                            $msg .= "<li p='" . $i . "'  class='active pagination_page'>" . $i . "</li> ";
                    }

                }
                if ($next && $currentpage < $numberpage) {
                    $nex = $currentpage + 1;
                    $msg .= "<li p='" . $nex . "' class='active pagination_next'><b>Next</b></li>";
                } else if ($next) {
                    $msg .= "<li class='inactive pagination_page-current' style='display:none'><b>Next</b></li>";
                }

                $msg .= "</ul>
                    </div>
                </div>";
            } else $msg = '<h4 style="text-align:center">Không có công việc nào</h4>';
            echo $msg;
        }
    }

    public function actionLoginphp()
    {
        $this->layout = 'login';
        return $this->render('loginphp');
    }

    public function actionAuthenlogin()
    {
        if (isset($_POST['username'])) {
            $username = $_POST['username'];
        }
        if (isset($_POST['password'])) {
            $password = $_POST['password'];
        }

        $list = User::find()
            ->where(['username' => $username, 'password' => hash('sha256', $password)])
            ->asArray()
            ->count();
        if ($list > 0) {
            return "success";
        } else {
            return "fail";
        }
    }

    public function actionAdmin()
    {
        $this->layout = 'mainAdmin';
        return $this->render('admin');
    }

    public function actionAjaxuser()
    {
        if (isset($_POST['action'])) {
            $action = $_POST['action'];
        }
        if ($action == "init"){
            $listUsers = User::find()->orderBy("id")->asArray()->all();
        }elseif ($action == "delete"){
            $id = $_POST['id'];
            $user = User::find()->where(['id'=>$id])->one();
            if($user){
                $user->delete();
            }
            $listUsers = User::find()->orderBy("id")->asArray()->all();
        }elseif ($action == "edit"){
            $userEdit = $_POST['user'];
            $user = User::find()->where(['id'=>$userEdit['id']])->one();
           $user->setAttributes($userEdit);
            if($user){
                $attributeNames =
                $user->update([
                    'username'=> $userEdit['username'],
                    'fullname'=> $userEdit['fullname'],
                    'email'=> $userEdit['email'],
                    'ctime'=> $userEdit['ctime']
                ]);
            }
            $listUsers = User::find()->orderBy("id")->asArray()->all();
        }
        return Json::encode($listUsers);
    }

    /**Get source data from site my.tinhvan.com
     * @return string
     */
    public function actionGetsourcedata()
    {
        $url = $_POST['url'];
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSLVERSION, 3);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        $ret = curl_exec($curl);
        $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($http_status == 503) {
            $data = array('article' => '', 'image' => '', 'msg' => $ret);
            $result = json_encode($data);
            return $result;
        }
        curl_close($curl);
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $article = '';
        $src = '';
        if (isset($dom)) {
            $dom->loadHTML($ret);
            $data = $dom->getElementsByTagName('article')->item(0);
            if (isset($data)) {
                $article = $data->getElementsByTagName('section')->item(0)->nodeValue;
                $image = $data->getElementsByTagName('img')->item(0);
                if (isset($image)) {
                    $src = $image->getAttribute('src');
                }
            }
        }
        $data = array('article' => $article, 'image' => $src, 'msg' => $ret);
        $result = json_encode($data);
        return $result;
    }
}
