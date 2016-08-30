<script type="text/javascript">
    $(document).ready(function() {
        var myParam = location.search.split('mail=')[1];
     //   $.post("http://localhost:8080/apply/subscriber/unsubscribe",
      //  $.post("http://192.168.53.68:8080/apply/subscriber/unsubscribe",
        $.post("/apply/subscriber/unsubscribe",
            {
                email: myParam
            });
    });
</script>
<div class="container">

    <div class="col-md-12">
        <div class="banner">
            <img class="ban_background" src="http://tinhvan.vn/wp-content/themes/tinhvan/images/tmp/recruitment_vi.jpg" width="100%" style="margin-top: 10px;">
        </div>
    </div>
</div>

<div class="container" style="margin-top: 30px; margin-bottom: 10px; ">

    <div class="col-md-12 col-sm-12" >
       <div>
           <h2><b>Bạn đã bỏ theo dõi mail tuyển dụng từ tinh vân </b></h2>
       </div>
    </div>

</div>

</div>