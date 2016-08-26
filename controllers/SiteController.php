<?php

namespace app\controllers;

use app\models\Org;
use app\models\User;
use app\models\Org;
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
        $sql = 'SELECT * FROM job j join org o on j.orgid = o.id WHERE j.id NOT IN (0,1,2,3,4) AND j.state NOT IN(-1) AND jobstatus IN(2,4) ORDER BY star DESC, opentime DESC LIMIT 17';
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
        $sql_org= 'select * from org where id = 1';
        $org = Org::findOne($job->orgid);
        $sql = 'SELECT * FROM job WHERE id NOT IN (0,1,2,3,4,' . $id . ') AND state NOT IN(-1) AND jobstatus IN(2,4) ORDER BY star DESC, opentime DESC LIMIT 3';
        $other_jobs = Job::findBySql($sql)->all();
        return $this->render('detail', ['job' => $job, 'other_jobs' => $other_jobs , 'org' => $org]);
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
            ->where(['username' => $username, 'password' => md5($password)])
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
        $statusProcess = "1";
        $action = '';
        if (isset($_POST['action'])) {
            $action = $_POST['action'];
        }
        if ($action == "init") {
        } elseif ($action == "delete") {
            $id = $_POST['user']['id'];
            $user = User::find()->where(['id' => $id])->one();
            if ($user) {
                $isdelete = $user->delete();
                if ($isdelete > 0) {
                    $statusProcess = "1";
                } else {
                    $statusProcess = "0";
                }
            }
        } elseif ($action == "edit") {
            $userEdit = $_POST['user'];
            $password = $userEdit['password'];
            if ($password != "") {
                $password = md5($userEdit['password']);
            }
            $status = $userEdit['status'];
            $strSql = "UPDATE user SET username = :username,";
            if ($password != "") {
                $strSql = $strSql . "password= :password,";
                $strSql = $strSql . "lastpwchanged= now(),";
            }
            $strSql = $strSql . "fullname = :fullname, email = :email, role = :role, status = :status WHERE id = :id";
            $sql = \Yii::$app->db->createCommand($strSql);
            $sql->bindValue(':username', $userEdit['username'])
                ->bindValue(':fullname', $userEdit['fullname'])
                ->bindValue(':email', $userEdit['email'])
                ->bindValue(':role', $userEdit['role'])
                ->bindValue(':status', $status)
                ->bindValue(':id', $userEdit['id']);
            if ($password != "") {
                $sql->bindValue(':password', md5($userEdit['password']));
            }
            $isEdit = $sql->execute();
            if ($isEdit > 0) {
                $statusProcess = "1";
            } else {
                $statusProcess = "0";
            }
        } elseif ($action == "add") {
            $userAdd = $_POST['user'];
            $password = md5($userAdd['password']);
            $status = $userAdd['status'];
            $sql = \Yii::$app->db->createCommand(
                "INSERT INTO user (fullname, ctime, state, email, username, password, lastpwchanged, status, initial, role, avatar, lmtime) 
                VALUES (:fullname, now(), '0', :email, :username, :password, now(), :status, 'TPK', :role,  '/ui/avatars/avatar.png', now())");
            $sql->bindValue(':fullname', $userAdd['fullname'])
                ->bindValue(':email', $userAdd['email'])
                ->bindValue(':username', $userAdd['username'])
                ->bindValue(':password', $password)
                ->bindValue(':status', $status)
                ->bindValue(':role', $userAdd['role']);
            $isAdd = $sql->execute();
            if ($isAdd > 0) {
                $statusProcess = "1";
            } else {
                $statusProcess = "0";
            }

        }
        $sqlSelect = "SELECT id,username, '********' as password, fullname, email, status, role FROM user ORDER BY role ASC,ctime DESC";
        $listUsers = User::findBySql($sqlSelect)->asArray()->all();
        $arrayMsg = array('action' => $action, 'statusProcess' => $statusProcess);
        array_unshift($listUsers, $arrayMsg);
        return Json::encode($listUsers);
    }

    public function actionAjaxdivision()
    {
        $statusProcess = "1";
        $action = '';
        if (isset($_POST['action'])) {
            $action = $_POST['action'];
        }
        if ($action == "init") {
        } elseif ($action == "delete") {
            $id = $_POST['division']['id'];
            $division = Org::find()->where(['id' => $id])->one();
            if ($division) {
                $isdelete = $division->delete();
                if ($isdelete > 0) {
                    $statusProcess = "1";
                } else {
                    $statusProcess = "0";
                }
            }
        } elseif ($action == "edit") {
            $divisionEdit = $_POST['division'];
            $strSql = "UPDATE org SET name = :name,description = :description, linkSite = :linkSite, status = :status WHERE id = :id";
            $sql = \Yii::$app->db->createCommand($strSql);
            $sql->bindValue(':name', $divisionEdit['name'])
                ->bindValue(':description', $divisionEdit['description'])
                ->bindValue(':linkSite', $divisionEdit['linkSite'])
                //->bindValue(':logo', $divisionEdit['logo'])
                ->bindValue(':status', $divisionEdit['status'])
                ->bindValue(':id', $divisionEdit['id']);
            $isEdit = $sql->execute();
            if ($isEdit > 0) {
                $statusProcess = "1";
            } else {
                $statusProcess = "0";
            }
        } elseif ($action == "add") {
            $divisionAdd = $_POST['division'];
            $sql = \Yii::$app->db->createCommand(
                "INSERT INTO org (name, ctime, state, picture, description, linkSite, status, logo, lmtime) 
                VALUES (:name, now(), '0', '', :description, :linkSite, :status, null, now())");
            $sql->bindValue(':name', $divisionAdd['name'])
                ->bindValue(':description', $divisionAdd['description'])
                ->bindValue(':linkSite', $divisionAdd['linkSite'])
                ->bindValue(':role', $divisionAdd['role'])
                ->bindValue(':status', $divisionAdd['status']);
            $isAdd = $sql->execute();
            if ($isAdd > 0) {
                $statusProcess = "1";
            } else {
                $statusProcess = "0";
            }

        }
        $sqlSelect = "SELECT id,name,description,linkSite, logo,status FROM org ORDER BY id DESC";
        $listDivisions = Org::findBySql($sqlSelect)->asArray()->all();
        foreach ($listDivisions as &$division){
            $division['logo'] = chunk_split(base64_encode($division['logo']));
        }

        $arrayMsg = array('action' => $action, 'statusProcess' => $statusProcess);
        array_unshift($listDivisions, $arrayMsg);
        return Json::encode($listDivisions);
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
