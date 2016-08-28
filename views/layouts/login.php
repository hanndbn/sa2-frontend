<?php session_start();?>
<!DOCTYPE html>
<html>
<head data-gwd-animation-mode="quickMode">
  <title>Tinhvan Group - Chuyên Trang Tuyển Dụng</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="generator" content="Google Web Designer 1.1.2.0814">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <!-- <link href="http://static.wapmaker.net/9741/css/bootstrap.min.css" rel="stylesheet"> -->
  <link href="<?=Yii::$app->homeUrl?>css/bootstrap.min.css" rel="stylesheet">
  <script src="http://apply.vuonuom.tv/res/js/jquery.js"></script>
  <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
  <!-- <script src="https://code.jquery.com/jquery.js"></script>-->
  <script src="<?=Yii::$app->homeUrl?>js/bootstrap.min.js"></script>
  <link href="<?=Yii::$app->homeUrl?>css/fontawesome.css" rel="stylesheet">
  <link href="<?=Yii::$app->homeUrl?>css/tdstyle.css" rel="stylesheet">
  <link href="<?=Yii::$app->homeUrl?>css/detail.css" rel="stylesheet">
  <link rel="icon" href="<?=Yii::$app->homeUrl?>img/logo.ico" type="image/x-icon"/>
</head>



<style type="text/css">
  .login {
    width: 400px;
    padding: 40px 40px;
    text-align: center;
    margin: 0 auto;
  }

  .login input {
    margin-bottom: 6px;
  }

  .login-align {
   text-align: center;
   margin-top: 40px;
 }

 .login input[type=text], .login input[type=password] {
  color: #212121;
  border: 1px solid #bababa;
  background-color: rgba(255,255,255,.8);
  font-size: 16px;
  padding: 10px 14px;
  width: 100%;
}

.login input[type=submit] {
  width: 100%;
  display: block;
  margin-bottom: 10px;
  z-index: 1;
  position: relative;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
}

.remember {
  float: left;
  overflow: hidden;
}

.login-button {
  border: 1px solid #2f5bb7;
  color: #fff;
  text-shadow: 0 1px rgba(0,0,0,0.3);
  background-color: #357ae8;
}

.btn-login {
  color: #fff;
  background-color: #d9534f;
  border-color: #d43f3a;
  padding: 10px 16px;
  font-size: 18px;
  line-height: 1.33;
  border-radius: 0px;
}


</style>

</head>

<body>
<div class="container">
<?=$content?>
</div>
<div class="container" style="text-align: center; margin-top: 80px;">
  <div class="foot-login">
    © 2014 Tinhvan.com, Tinhvan Group. All rights reserved.
  </div>

</div>
</body>
</html>