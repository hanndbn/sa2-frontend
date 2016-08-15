<?php use yii\helpers\Html;?>
<div id="carousel-example-generic" class="container carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">

    <div class="item active">
      <div class="carousel-thumb col-xs-12 col-md-12">
        <a href="#">
          <img src="<?=$banner_jobs[0]->picture?>" alt="Apply" class="img-responsive" style="height: 228px;">
        </a>
      </div>
      <div class="carousel-des col-xs-12 col-md-12">
        <?php if(isset($banner_jobs[0])):?>
          <?=Html::a('<div class="carousel-text" style="padding-bottom: 0;">
            <h4 class="title-slider">
              '.$banner_jobs[0]->title.'
            </h4>
            <div class="des-slider"></div>
          </div>', ['/site/vitri','id'=>$banner_jobs[0]->id])?>
          <?=Html::a('<span>Chi tiết</span>', ['/site/vitri','id'=>$banner_jobs[0]->id],['class'=>'more-hot'])?>
        <?php endif;?>
      </div>
    </div>

    <div class="item">
      <div class="carousel-thumb col-xs-12 col-md-12">
        <a href="#">
            <img src="<?=$banner_jobs[1]->picture?>" alt="Apply" class="img-responsive" style="height: 228px;">
        </a>
      </div>
      <div class="carousel-des col-xs-12 col-md-12">
        <?php if(isset($banner_jobs[1])):?>
          <?=Html::a('<div class="carousel-text" style="padding-bottom: 0;">
            <h4 class="title-slider">
              '.$banner_jobs[1]->title.'
            </h4>
            <div class="des-slider"></div>
          </div>', ['/site/vitri','id'=>$banner_jobs[1]->id])?>
          <?=Html::a('<span>Chi tiết</span>', ['/site/vitri','id'=>$banner_jobs[1]->id],['class'=>'more-hot'])?>
        <?php endif;?>
      </div>
    </div>

    <div class="item">
      <div class="carousel-thumb col-xs-12 col-md-12">
        <a href="#">
            <img src="<?=$banner_jobs[2]->picture?>" alt="Apply" class="img-responsive" style="height: 228px;">
        </a>
      </div>
      <div class="carousel-des col-xs-12 col-md-12">
        <?php if(isset($banner_jobs[2])):?>
          <?=Html::a('<div class="carousel-text" style="padding-bottom: 0;">
            <h4 class="title-slider">
              '.$banner_jobs[2]->title.'
            </h4>
            <div class="des-slider"></div>
          </div>', ['/site/vitri','id'=>$banner_jobs[2]->id])?>
          <?=Html::a('<span>Chi tiết</span>', ['/site/vitri','id'=>$banner_jobs[2]->id],['class'=>'more-hot'])?>
        <?php endif;?>
      </div>

    </div>
  </div>
  <div class="blur"></div>

</div>
<script type="text/javascript">
  $('.des-banner').find('*').removeAttr('style');
</script>
<?php
function get_url_contents($url){
    $crl = curl_init();
    $timeout = 5;
    curl_setopt ($crl, CURLOPT_URL,$url);
    curl_setopt ($crl, CURLOPT_RETURNTRANSFER, 1);
    //curl_setopt ($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
    $ret = curl_exec($crl);
    curl_close($crl);
    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML($ret);
    $data = $dom->getElementsByTagName('article')->item(0);
    $article = $data->getElementsByTagName('section')->item(0)->nodeValue;
    return $article;
}

function get_url_image($url){
    $crl = curl_init();
    $timeout = 5;
    curl_setopt ($crl, CURLOPT_URL,$url);
    curl_setopt ($crl, CURLOPT_RETURNTRANSFER, 1);
    //curl_setopt ($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
    $ret = curl_exec($crl);
    curl_close($crl);
    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML($ret);
    $data = $dom->getElementsByTagName('article')->item(0);
    $image = $data->getElementsByTagName('img')->item(0);
    $src = $image->getAttribute('src');
    return $src;
}
//
//echo file_get_contents("http://my.tinhvan.com/category/nguoi_tinhvan/feed/"); ?>
<div class="container" style="margin-top: 15px; margin-bottom: 0;">
 <div class="col-md-9">
   <div class="list-tv">
     <h3 class="main-title caption-home">VIỆC LÀM TIÊU BIỂU</h3>
     <div class="col-md-12 header-list">
       <div class="col-md-5">
         <span>Tên công việc </span>
       </div>
       <div class="col-md-2">
         <span>Số lượng</span>
       </div>
       <div class="col-md-3">
        <span>Công ty</span>
      </div>
      <div class="col-md-2">
        <span>Ngày hết hạn</span>
      </div>
    </div>
    <div style="border: 1px solid #ccc; border-radius: 4px; overflow: hidden; border-top-right-radius:0;border-top-left-radius:0;">
      <?php if(!empty($jobs)):?>
       <?php foreach ($jobs as $job) :?>
         <div class="tv-item">
          <div class="content col-lg-5">
            <?=Html::a('<h4>'.$job->title.'</h4>', ['/site/vitri','id'=>$job->id])?>
            <?php if($job->star):?>
             <span style="float: left;width: 10%;"><img style="width: 24px;margin-bottom: 1px;" src="<?=Yii::$app->request->baseUrl?>/img/hot.png" alt=""></span>
           <?php endif;?>
         </a>
       </div>

       <div class="thumb col-lg-2">
         <span class="tv-salary tt" data-placement="left" ><?=$job->quantity?></span>
       </div>
       <div class="thumb col-lg-3">
         <?php if($job->orgid == 8):?>
           <a target="_blank" href="http://tinhvan.com/">Tinhvan Telecom</a>
         <?php elseif($job->orgid==2): ?>
           <a target="_blank" href="http://tvo.vn/">Tinhvan Outsourcing</a>
         <?php elseif($job->orgid==3) :?>
           <a target="_blank" href="http://tinhvanconsulting.com/">Tinhvan Consulting</a>
         <?php elseif($job->orgid==4) :?>
           <a target="_blank" href="http://tinhvan.com/">Tinhvan eBooks</a>
         <?php elseif($job->orgid==5) :?>
           <a target="_blank" href="http://vuonuomtinhvan.com/">Tinhvan Incubator</a>
         <?php elseif($job->orgid==6) :?>
           <a target="_blank" href="http://tinhvan.com/">Tinhvan Solutions</a>
         <?php elseif($job->orgid==7) :?>
           <a target="_blank" href="http://mc-corp.vn/">Minh Chau Corp</a>
         <?php else: ?>
           <a target="_blank" href="http://tinhvan.com/">Tinhvan Group</a>
         <?php endif?>
       </div>
       <div class="thumb col-lg-2" style="font-size: 13px;">
         <?=date('d-m-Y',strtotime($job->endtime))?>
       </div>
     </div>
   <?php endforeach;?>
 <?php else:?>
  <h1 style="text-align:center">Hiện tại không có vị trí tuyển dụng nào</h1>
<?php endif;?>
</div>
<div class="tv-job-more">
  <?=Html::a('Xem thêm', ['/site/danhsach'])?>
</div>
<div style="text-align:center">
  <?=Html::a('<img style="margin-right: 6px;" class="ut" src="'.Yii::$app->request->baseUrl.'/img/tick.png" alt="">Ứng tuyển', ['/site/ungtuyen','id'=>4],['class'=>'btn btn-danger id_apply btn-lg'])?>
  <div style="margin-top: 5px;font-size: 13px;"><span>Ứng tuyển vào bất kì vị trí nào bạn muốn</span></div>
</div>
</div>
</div>
<div class="col-md-3" style="margin-bottom: 25px;">
 <h3 class="caption-home">
   MY TINH VÂN
 </h3>
 <ul style="">
   <li class="slogan" style="">
    <h3><span>Người Tinh Vân</span></h3>
    <p style="text-align: justify; font-style: italic;float:left">
      <a target="_blank" href="http://my.tinhvan.com/category/nguoi_tinhvan/"><img src="<?php echo get_url_image("http://my.tinhvan.com/category/nguoi_tinhvan/");?>" alt="Sếp" style='width:120px;padding-right:10px;float:left;'></a>
      <span style="font-size: 13px;"><?php echo get_url_contents("http://my.tinhvan.com/category/nguoi_tinhvan/");?></span>
    </li>
    <li>
      <h3 style=''><span>Xa Lộ Tinh Vân</span></h3>
        <a target="_blank" href="http://my.tinhvan.com/category/xa-lo-tinh-van/"><img src="<?php echo get_url_image("http://my.tinhvan.com/category/xa-lo-tinh-van/");?>" alt="Sếp" style='width:120px;padding-right:10px;float:left;'></a>
        <span style="font-size: 13px;"><?php echo get_url_contents("http://my.tinhvan.com/category/xa-lo-tinh-van/");?></span>
    </li>
    <li>
      <h3 style=''><span>Hành Trình Tuổi 20</span></h3>
        <a target="_blank" href="http://my.tinhvan.com/category/hanh_trinh_tuoi_20/"><img src="<?php echo get_url_image("http://my.tinhvan.com/category/hanh_trinh_tuoi_20/");?>" alt="Sếp" style='width:120px;padding-right:10px;float:left;'></a>
        <span style="font-size: 13px;"><?php echo get_url_contents("http://my.tinhvan.com/category/hanh_trinh_tuoi_20/");?></span>
    </li>

  </ul>
</div>
</div>
