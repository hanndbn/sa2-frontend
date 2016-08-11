<div class="container">
	<h1 class="page-title">Kết quả tìm kiếm </h1>
  <h2 class="page-subtitle"><strong></strong></h2>
</div>

</div>
<div class="container" style="margin-top: 60px; margin-bottom: 60px;">
 <div class="list-tv col-xs-12">
   <div class="col-md-12 header-list">
     <div class="col-md-6">
       <span>Tên công việc </span>
     </div>
     <div class="col-md-2">
      <span>Công ty</span>
    </div>
    <div class="col-md-2">
     <span>Số lượng</span>
   </div>

   <div class="col-md-2">
    <span>Ngày hết hạn</span>
  </div>
</div>
<div style="border: 1px solid #ccc; border-radius: 4px;overflow: hidden;">
<?php if(!empty($jobs)):?>
<?php foreach ($jobs as $job):?>
 <div class="tv-item">
  <div class="content col-xs-12 col-sm-10 col-md-7 col-lg-6">
  <?=Html::a('<h4>'.$job->title.'</h4>',['/site/vitri','id'=>$job->id])?>
 </div>
 <div class="thumb col-sm-2 col-md-2 col-lg-2">
  <?php if($job->orgid == 8):?>
  <a target="_blank" href="http://tinhvan.com/">Tinhvan Telecom</a>
  <?php elseif($job->orgid == 2):?>
  <a target="_blank" href="http://tvo.vn/">Tinhvan Outsourcing</a>
  <?php elseif($job->orgid == 3):?>
  <a target="_blank" href="http://tinhvanconsulting.com/">Tinhvan Consulting</a>
  <?php elseif($job->orgid == 4):?>
  <a target="_blank" href="http://tinhvan.com/">Tinhvan eBooks</a>
  <?php elseif($job->orgid == 5):?>
  <a target="_blank" href="http://vuonuomtinhvan.com/">Tinhvan Incubator</a>
  <?php elseif($job->orgid == 6):?>
  <a target="_blank" href="http://tinhvan.com/">Tinhvan Solutions</a>
  <?php elseif($job->orgid == 7):?>
  <a target="_blank" href="http://mobay.vn/">MC Corp</a>
  <?php else:?>
  <a target="_blank" href="http://tinhvan.com/">Tinhvan Group</a>
  <?php endif;?>
</div>
<div class="thumb col-xs-12 col-md-3 col-lg-2">
 <span class="tv-salary tt" data-placement="left"><?=$job->quantity?></span>
</div>

<div class="thumb col-lg-2">
  <span class="tv-deadline tt" data-placement="top"><?=date('d-m-Y',strtotime($job->endtime))?>
  </span>
</div>
</div>
<?php endforeach;?>
<?php else:?>
<h1 style="text-align:center">Không tìm thấy công việc phù hợp với yêu cầu của bạn</h1>
<?php endif;?>
</div>
</div>
</div>
