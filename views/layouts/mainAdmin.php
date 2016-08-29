<?php
session_start();
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= Yii::$app->homeUrl ?>css/app.min-1da9dc4f65.css" type="text/css"/>
    <link rel="stylesheet" href="<?= Yii::$app->homeUrl ?>css/bootstrap.min.css" type="text/css"/>

    <script src="<?= Yii::$app->homeUrl ?>js/jquery-2.1.3.min.js"></script>
    <script src="<?= Yii::$app->homeUrl ?>js/react.js"></script>
    <script src="<?= Yii::$app->homeUrl ?>js/react-dom.js"></script>
    <script src="../js/react-with-addons.js"></script>
    <?= Html::csrfMetaTags() ?>
    <?php if (isset($this->title)): ?>
        <title><?= Html::encode($this->title) ?></title>
    <?php else: ?>
        <title>Tinhvan Group - Chuyên trang tuyển dụng</title>
    <?php endif; ?>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="navbar navbar-default" role="navigation"
     style="border-radius: 0; border-bottom: 1px solid #ccc;  background: rgba(0,0,0,0.6); background: #fff; margin-bottom: 0; padding-top: 0; padding-bottom: 0;">
</div>
<div class="navbar navbar-default" role="navigation"
     style="border-radius: 0; margin-bottom: 0;  border-bottom: 0;">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="/"><img src="<?= Yii::$app->request->baseUrl ?>/img/logo.png"
                             style="margin-left: 15px;"></a>
        </div>
    </div>
</div>
<div>
    <div class="navbar navbar-default" role="navigation"
         style="border-radius: 0; border-bottom: 0px solid #ccc;  background:#242F67;  margin-bottom: 0; padding-top: 0; padding-bottom: 0;">
        <div class="container td_tinhvan">
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-left">
                    <li class="active">
                        <a href="<?= Yii::$app->homeUrl ?>" style="color: #fff !important; font-size: 0;">
                            <img src="<?= Yii::$app->request->baseUrl ?>/img/House.png" alt="Search"
                                 style="width: 20px; vertical-align: top;">
                            Trang chủ</a></li>
                    <li><a href="<?= Url::toRoute('site/gioithieu') ?>" class="td-text">Về Tinh Vân </a></li>
                    <li><a href="<?= Url::toRoute('site/danhsach') ?>" class="td-text">Cơ hội nghề nghiệp</a></li>
                    <li><a href="<?= Url::toRoute('site/help') ?>" class="td-text">Trợ giúp</a></li>
                    <li><a target="_blank" href="http://vuonuomtinhvan.com/" class="td-text">Vườn ươm</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="test">
    <?= $content ?>
</div>
<!--End of Zopim Live Chat Script-->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
