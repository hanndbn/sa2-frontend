<div class="login-align">
    <img alt="Apply2" src="http://apply.vuonuom.tv/res/Image/login.png">
    <h1>
      Đăng nhập
    </h1>
    <div id="error"></div>
  </div>
  <div class="login">
    <form action="#" method="POST">
      <div class="login-email">
       <input type="text" name="name" tabindex="1" id="username" placeholder="Tên đăng nhập" maxlength="113">
     </div>
     <div class="login-pass">
       <input style="border-radius: 0;" tabindex="2" name="password" type="password" id="password" placeholder="Mật khẩu">
     </div>
     <div class="form-group"><button type="button" tabindex="3" style="margin-top:10px" id="submit" name="submit"class="pull-right id_loginBt btn btn-login">Đăng nhập</button></div>
   </form>
 </div>
 <script type="text/javascript">
  $(document).ready(function(){
    function loading_show(){
      $('#loading').html("<div class='loading-ajax'><img src='<?=Yii::$app->homeUrl?>img/ajax-loader.gif'/></div>").fadeIn('fast');
    }
    function loading_hide(){
      $('#loading').fadeOut('fast');
    }
    function ser (obj, prefix) {
      if (typeof prefix === "undefined") { prefix = undefined; }
      var str = [];
      for (var p in obj) {
        var k = prefix ? prefix : p, v = obj[p];
        str.push(typeof v == "object" ? ser(v, k) : encodeURIComponent(k) + "=" + encodeURIComponent(v));
      }
      return str.join("&");
    };
    function validate(){
      var username = document.getElementById('username').value;
      var password = document.getElementById('password').value;
      if (username==null||username==''||password==null||password=='') {
        return false;
      }else{
        return true;
      }
    }
    function getCookie(cname) {
      var name = cname + "=";
      var ca = document.cookie.split(';');
      for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) != -1) return c.substring(name.length,c.length);
      }
      return "";
    }
    function submitLogin(){
      data={};
      data.username=document.getElementById('username').value;
      data.password= document.getElementById('password').value;
      var url = "<?=Yii::$app->homeUrl?>apply/user/login?"+ser(data);
      loading_show();
      $.ajax({
        type: "POST",
        url: url,
        data:null,
        async: true,
        cache: false,
        processData: false,
        contentType: false,
        error: function(xhr, status, error) {
          loading_hide();
          var coo = getCookie('authcode');
          if(coo!=''){
            window.location.href="<?=Yii::$app->homeUrl?>ui/html/";
          }else{
            $('#error').html('<h4 style="color:red">Tài khoản hoặc mật khẩu không đúng</h4>');
          }
        },
        success: function(msg)
        {
          loading_hide();
          window.location.href="<?=Yii::$app->homeUrl?>ui/html/";
        }
      });
    }
    $(document).on("keypress","#username", function(e) {
      if (e.keyCode == 13) {
        if (validate()) {
          submitLogin();
        }else{
          alert('Vui lòng nhập đầy đủ tài khoản và mật khẩu');
          return false;
        }
      }
    });
    $(document).on("keypress","#password", function(e) {
      if (e.keyCode == 13) {
        if (validate()) {
          submitLogin();
        }else{
          alert('Vui lòng nhập đầy đủ tài khoản và mật khẩu');
          return false;
        }
      }
    });
    $('#submit').click(function(){
      if (validate()) {
        submitLogin();
      }else{
        alert('Vui lòng nhập đầy đủ tài khoản và mật khẩu');
        return false;
      }

    });
  });
</script>