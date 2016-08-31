<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;
use app\common\Common;

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
    <link rel="icon" href="<?=Yii::$app->request->baseUrl?>/img/logo.ico" type="image/x-icon"/>
    <script src="<?=Yii::$app->homeUrl?>js/jquery-2.1.3.min.js"></script>
    <script src="<?=Yii::$app->homeUrl?>js/react.js"></script>
    <script src="<?=Yii::$app->homeUrl?>js/react-dom.js"></script>
    <script src="<?=Yii::$app->homeUrl?>js/bootstrap-multiselect.js"></script>
    <link rel="stylesheet" href="<?=Yii::$app->homeUrl?>css/bootstrap-multiselect.css" type="text/css"/>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
    <link rel="stylesheet" href="<?=Yii::$app->homeUrl?>css/datepicker.css"
          type="text/css" />
    <?= Html::csrfMetaTags() ?>
    <?php if(isset($this->title)):?>
        <title><?= Html::encode($this->title)?></title>
    <?php else:?>
        <title>Tinhvan Group - Chuyên trang tuyển dụng</title>
    <?php endif;?>
    <?php $this->head() ?>
</head>
<body>
<script type="text/javascript">

    $(document).ready(function(){
        if (location.hash) {
            var anchor = location.hash;
            $('body').html("<iframe  frameborder='0' width='100%' height='2000px' src='{{constant('URL')}}admin/"+anchor+"'></iframe>");
        };
        $('#position-select').multiselect({
            buttonWidth: '245px',
            nonSelectedText: 'Chọn vị trí bạn quan tâm'
        });

    });
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-56630009-1', 'auto');
    ga('send', 'pageview');

    function receiveEmail() {
        var list = $('#position-select').val();

        if (list) {
            if (validateEmail($('#txt_email').val())) {
                var postion = '';
                for(var i = 0; i< list.length; i++ ){
                    if(i==0){
                        postion += list[i];
                    }else{
                        postion += ','+list[i];
                    }
                }
                //          $.post("http://localhost:8080/apply/subscriber/add",
                $.post("/apply/subscriber/add",
                    {
                        email: $('#txt_email').val(),
                        position: postion
                    });
                alert('Bạn đã đăng ký nhận bản tin tuyển dụng Tinh Vân thành công');
            }
            else {
                alert('Định dạng email không đúng');
            }
        } else {
            alert('Vui lòng chọn công việc cần theo dõi');
        }
    };

    function validateEmail(emailVal) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(emailVal);
    }

</script>
<?php $this->beginBody() ?>
<div class="navbar navbar-default" role="navigation" style="border-radius: 0; border-bottom: 1px solid #ccc;  background: rgba(0,0,0,0.6); background: #fff; margin-bottom: 0; padding-top: 0; padding-bottom: 0;">
    <div class="container tvcom">
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-left">
                <li>
                    <a target="_blank" href="http://tinhvan.vn/gioi-thieu/gioi-thieu-chung/" class="text-header">
                        Giới thiệu</a></li>
                <li>
                    <a target="_blank" href="http://tinhvan.vn/san-pham/" class="text-header">
                        Sản phẩm</a>
                </li>
                <li>
                    <a target="_blank" href="http://tinhvan.vn/dich-vu/" class="text-header">
                        Dịch vụ</a></li>
                <li>
                    <a target="_blank" href="http://tinhvan.vn/category/tin-tuc/" class="text-header">
                        Tin tức</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a target="_blank" href="http://tinhvan.vn/doi-tac/" class="text-header">
                        Đối tác</a></li>
                <li>
                    <a target="_blank" href="http://tinhvan.vn/khach-hang/" class="text-header">
                        Khách hàng</a></li>
                <li class="active">
                    <a href="<?=Yii::$app->request->baseUrl?>" class="text-header" style="color: #fff !important;">
                        Tuyển dụng</a></li>
                <li>
                    <a target="_blank" href="http://my.tinhvan.com/" class="text-header">
                        MyTinhVan</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="navbar navbar-default" role="navigation" style="border-radius: 0; margin-bottom: 0;  border-bottom: 0;">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="/"><img src="<?=Yii::$app->request->baseUrl?>/img/logo.png" style="margin-left: 15px;"></a>
        </div>
        <div class="navbar-collapse collapse">
            <form id="form-search" class="navbar-form navbar-right" role="search" action="<?=Yii::$app->request->baseUrl?>/tuyendung/search">
                <div class="form-group">
                    <input type="text" class="form-control" name="key" placeholder="Tìm kiếm tên công việc..." value=""></div></form>
            <?php
            $data2 = json_decode(file_get_contents(Yii::$app->basePath.'/data.json'),true);
            $r=rand(1, 20);
            $quot = $data2[$r]['description'];
            $author = $data2[$r]['author'];
            ?>
            <div class="tv-quot navbar-right">“<?=$quot?>” - <b><?=$author?></b></div>
        </div>
    </div>
</div>
<div class="navbar navbar-default" role="navigation" style="border-radius: 0; border-bottom: 0px solid #ccc;  background:#242F67;  margin-bottom: 0; padding-top: 0; padding-bottom: 0;">
    <div class="container td_tinhvan">
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-left">
                <li class="active">
                    <a href="<?=Yii::$app->homeUrl?>" style="color: #fff !important; font-size: 0;">
                        <img src="<?=Yii::$app->request->baseUrl?>/img/House.png" alt="Search" style="width: 20px; vertical-align: top;">
                        Trang chủ</a></li>
                <li><a target="_blank" href="http://tinhvan.vn/gioi-thieu/gioi-thieu-chung/" class="td-text">Về Tinh Vân </a></li>
                <li><a href="<?=Url::toRoute('site/danhsach')?>" class="td-text">Cơ hội nghề nghiệp</a></li>
                <li><a href="<?=Url::toRoute('site/help')?>" class="td-text">Trợ giúp</a></li>
                <!--                           <li><a target="_blank" href="http://vuonuomtinhvan.com/" class="td-text">Vườn ươm</a></li>-->
            </ul>
        </div>
    </div>
</div>
</div>
<div class="test">
    <?= $content ?>
</div>

<!--Start of Zopim Live Chat Script-->
<!--                <script type="text/javascript">-->
<!--                  window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=-->
<!--                    d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.-->
<!--                      _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');-->
<!--                      $.src='//v2.zopim.com/?2Z2Mu6WK0sGZTBwCLAYNpogsDfhYWUIQ';z.t=+new Date;$.-->
<!--                      type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');-->
<!--                    </script>-->
<!--End of Zopim Live Chat Script-->
<div class="footer">

    <div class="container tv-foot">
        <div class="col-xs-12 col-sm-6 col-md-4">
            <div class="tv-email" style="background: transparent;">
                <span style="font-size: 16px;font-weight: bold;">Bản tin tuyển dụng</span>
                <div class="subscribe" style="color: #34348f;">
                    Theo dõi thông tin của chúng tôi qua Email
                </div>
                <div class="mail_box">
                    <div class="email_form clearfix">
                        <div class="keyword">
                            <div>
                                <input style="border-radius: 0px; width: 100%; margin-bottom: 5px; padding:0 10px 0 10px !important" id="txt_email" class="col-xs-12 txt_email" placeholder="Địa chỉ email" type="email">
                            </div>
                            <div>
                                <select id="position-select"  style="height: 31px; margin-bottom: 5px" multiple="multiple" >
                                    <?php
                                    $positions = Common::getListJob();
                                    foreach ($positions as $position){
                                        echo "<option value='".$position["id"]."'>".$position["name"]."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div>
                                <button style="margin-top: 5px; margin-left: 175px" id="btn_email"  class="col-xs-2 btn btn_email" onclick="receiveEmail();"><p>Submit</p></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-6 col-md-4">

            <ul class="list-foot">
                <li class="tv-loc">
                    <span>Trụ sở chính</span>
                </li>
                <li class="tv-link">
                    <b>Địa chỉ:</b> Tầng 8, Khách sạn Thể Thao, Làng Sinh viên Hacinco, Quận Thanh Xuân, Hà Nội <br/>
                    <b>Điện thoại:</b> (04) 3558 9970<br/>
                    <b>Fax:</b> (04) 3558 9971<br/>
                    <b>Email:</b>  info@tinhvan.com
                </li>
            </ul>

            <ul class="list-foot">
                <li class="tv-loc">
                    <span>Chi nhánh Tinh Vân TP. Hồ Chí Minh</span>
                </li>
                <li class="tv-link">
                    <b>Địa chỉ:</b>
                    Lầu 2 – D1 Tòa nhà Mirae Business,  268 Tô Hiến Thành  Phường 15, Quận 10, Tp. Hồ Chí Minh <br/>
                    <b>Điện thoại:</b> (08) 6296 6481<br/>
                    <b>Fax:</b> (08) 6296 6482<br/>
                    <b>Email:</b>  hcm@tinhvan.com
                </li>
            </ul>



        </div>

        <div class="col-xs-12 col-sm-6 col-md-4">

            <div class="fb-like-box" data-href="https://www.facebook.com/tuyendung.tinhvan" data-width="350px" data-height="250px" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="true"></div>
        </div>

    </div>

    <div class="container" style="line-height: 39px;">
        <div class="col-xs-12">
            <div style="border-top: 1px solid #ccc;border-bottom: 1px solid #ccc; overflow: hidden;">
                <div class="foot-left" title="develop by Đàm Xuân Lập">
                    © 2014 Tinhvan.com, Tinhvan Group. All rights reserved.
                </div>
                <div>

                    <div class="foot_so" style="float:right">
                        <a target="_blank" href="https://www.facebook.com/TinhvanGroup"><img src="./icon/facebook.png" pagespeed_url_hash="473393423"></a>
                        <a target="_blank" href="https://twitter.com/tinhvangroup"><img src="./icon/twitter.png" pagespeed_url_hash="1842586480"></a>
                        <a target="_blank" href="https://www.linkedin.com/company/tinh-van-corp"><img src="./icon/linkedin.png" pagespeed_url_hash="2923697231"></a>
                    </div>
                    <div class="foot_find" style="float:right;margin-right: 20px;">
                        <p>
                            Find us:                     </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div id="fb-root"></div>
<script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=721254621281061&version=v2.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<!--                    live chat-->

<div id="fb-root"></div>
<script>
    $(document).ready(function() {
        var raido = $(".wrap").attr("data-toggle");
        $(".wrap").css("width","289px");
        if(raido==1){
            $(".vnk-tuvan").css("display","none");$(".x").click(function(){
                $(".wrap").slideToggle();$(".vnk-tuvan").slideToggle();});
            $(".vnk-tuvan").click(function(){
                $(".wrap").slideToggle();$(this).slideToggle();}); }
        else{$(".wrap").css("display","none");
            $(".x").click(function(){$(".wrap").slideToggle();
                $(".vnk-tuvan").slideToggle();});
            $(".vnk-tuvan").click(function(){$(".wrap").slideToggle();$(this).slideToggle();});}
        $(".vnk-tuvan").click(function(){
            $("._5rto").remove();
        });
    })

</script>
<style>
    .wrap{position:fixed;
        width:300px;
        height: 400px; z-index:9999999;
        right:0px; bottom:0px;}
    .x{font-family: arial, helvetica;
        background: rgba(78,86,101,0.8) none repeat scroll 0 0;
        font-size:14px;
        font-weight:bold;
        color: #fff;display: inline-block;
        height: 25px;line-height: 25px;position: absolute;
        right: 18px;text-align: center;
        top: -19px;width: 25px;z-index: 99999999;}
    .x:hover{cursor: pointer;}
    .pxem{text-align:left;height:20px;margin-bottom: 0;
        margin-top: 0;background: #34495E;width:100%;
        bottom: 0;display: block;
        left: 0px;position: absolute;z-index: 999999999;
        border-left: 1px solid #fff;}
    .pxem a.axem{color: #fff;font-family: arial,helvetica;
        font-size: 12px;line-height: 23px;padding-left: 5px;text-decoration: none;}
    .pxem a.axem:hover{text-decoration: underline;}
    .alogo{position: absolute;bottom: 0;right: 0px;z-index: 999999999999;
        width: 75px;height: 20px;
        display: inline-block;
        background:#34495E;border-left:2px solid #2c3e50;
        padding-right: 0px;padding-left: 5px}
    .vnk-tuvan{position:fixed;
        width: 170px !important;background:#4189f0;z-index:99999999;
        right:15px;bottom:0px;
        border-color: #2c3e50}
    .vnk-tuvan p{color: #fff;font-size: 15px;margin: 0;
        padding: 0 13px; text-align: left;}
    .vnk-tuvan p a{color: #fff;font-size: 15px;
        padding: 5px 0px 7px;margin: 0;
        font-family: arial, helvetica;text-decoration: none;}
    .vnk-tuvan p a:hover{text-decoration: underline;cursor: pointer;}
    .vnk-tuvan p img {float: right;margin-top: 10px;
</style>
<div data-toggle="0" class="wrap" style="position:fixed; width:270px; height: 300px; ">
    <span class="x" style="">X</span>
    <div class="fb-page" data-adapt-container-width="true"
         data-height="300"
         data-hide-cover="false"
         data-href="https://www.facebook.com/tuyendung.tinhvan/"
         data-show-facepile="true" data-hide-cta="true" data-show-posts="false"
         data-small-header="false" data-tabs="messages" data-width="270"
         style="position:relative; z-index:9999999; marin-right 10px; right:0px; bottom:21px;border-left: 1px solid #fff;border-top: 1px solid #fff;">
    </div>
</div>
<div class="vnk-tuvan" style="width: 268px;" >
    <p style=" ">
        <i class="fa fa-envelope" style="padding-right: 5px;"></i><a style="">Chat với chúng tôi</a>
    </p>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
