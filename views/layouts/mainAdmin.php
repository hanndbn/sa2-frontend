<?php

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

    <link rel="icon" href="<?= Yii::$app->request->baseUrl ?>/img/logo.ico" type="image/x-icon"/>
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
<script type="text/javascript">

    $(document).ready(function () {
        if (location.hash) {
            var anchor = location.hash;
            $('body').html("<iframe  frameborder='0' width='100%' height='2000px' src='{{constant('URL')}}admin/" + anchor + "'></iframe>");
        }
        ;
    });
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-56630009-1', 'auto');
    ga('send', 'pageview');


</script>
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
        <div class="navbar-collapse collapse">

            <?php
            $data2 = json_decode(file_get_contents(Yii::$app->basePath . '/data.json'), true);
            $r = rand(1, 20);
            $quot = $data2[$r]['description'];
            $author = $data2[$r]['author'];
            ?>
            <div class="tv-quot navbar-right">“<?= $quot ?>” - <b><?= $author ?></b></div>
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

<!--Start of Zopim Live Chat Script-->
<script type="text/javascript">
    window.$zopim || (function (d, s) {
        var z = $zopim = function (c) {
            z._.push(c)
        }, $ = z.s =
            d.createElement(s), e = d.getElementsByTagName(s)[0];
        z.set = function (o) {
            z.set._.push(o)
        };
        z._ = [];
        z.set._ = [];
        $.async = !0;
        $.setAttribute('charset', 'utf-8');
        $.src = '//v2.zopim.com/?2Z2Mu6WK0sGZTBwCLAYNpogsDfhYWUIQ';
        z.t = +new Date;
        $.type = 'text/javascript';
        e.parentNode.insertBefore($, e)
    })(document, 'script');
</script>
<!--End of Zopim Live Chat Script-->

<div class="container" style="line-height: 39px;">
    <div class="col-xs-12">
        <div style="border-top: 1px solid #ccc;border-bottom: 1px solid #ccc; overflow: hidden;">
            <div class="foot-left" title="develop by Đàm Xuân Lập">
                © 2014 Tinhvan.com, Tinhvan Group. All rights reserved.
            </div>
            <div>

                <div class="foot_so" style="float:right">
                    <a target="_blank" href="https://www.facebook.com/TinhvanGroup"><img src="./icon/linkedin.png"
                                                                                         pagespeed_url_hash="473393423"></a>
                    <a target="_blank" href="https://twitter.com/tinhvangroup"><img src="./icon/twitter.png"
                                                                                    pagespeed_url_hash="1842586480"></a>
                    <a target="_blank" href="https://www.linkedin.com/company/tinh-van-corp"><img
                            src="./icon/facebook.png" pagespeed_url_hash="2923697231"></a>
                </div>
                <div class="foot_find" style="float:right;margin-right: 20px;">
                    <p>
                        Find us: </p>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
