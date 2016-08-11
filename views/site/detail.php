<?php
$this->title = $job->title;
use yii\helpers\Html;
?>
<?php if($job!=null):?>
	<div class="page-header">
		<div class="container">
			<h1 class="page-title"><?=$job->title?></h1>
			<h2 class="page-subtitle">
				<ul>
					<?php if($job->category==1):?>
						<li class="tv-job apply-time">Part Time</li>
					<?php elseif($job->category == 2):?>
						<li class="tv-job apply-time" style="background-color: #3399cc;">Full time</li>
					<?php else: ?>
						<li class="tv-job apply-time" style="background-color: #f08d3c;">Internship</li>
					<?php endif;?>
					<li class="job-company">
						<?php if($job->orgid==8):?>
							<a target="_blank" href="http://tinhvan.com/">Tinhvan Telecom</a>
						<?php elseif($job->orgid==2):?>
							<a target="_blank" href="http://tvo.vn/">Tinhvan Outsourcing</a>
						<?php elseif($job->orgid==3):?>
							<a target="_blank" href="http://tinhvanconsulting.com/">Tinhvan Consulting</a>
						<?php elseif($job->orgid==4):?>
							<a target="_blank" href="http://tinhvan.com/">Tinhvan eBooks</a>
						<?php elseif($job->orgid==5):?>
							<a target="_blank" href="http://vuonuomtinhvan.com/">Tinhvan Incubator</a>
						<?php elseif($job->orgid==6):?>
							<a target="_blank" href="http://tinhvan.com/">Tinhvan Solutions</a>
						<?php elseif($job->orgid==7):?>
							<a target="_blank" href="http://mc-corp.vn/">Minh Chau Corp</a>
						<?php else:?>
							<a target="_blank" href="http://tinhvan.com/">Tinhvan Group</a>
						<?php endif;?>
					</li>
					<li class="job-location"><i class="icon-location"></i> <?= $job->nview+100?> lượt xem</li>
					<li class="job-date-posted"><i class="icon-calendar"></i>
						<date>
							<?php
							$day_ago = time()-date('U',strtotime($job->opentime));
							$day_ago /= 86400;
							echo floor($day_ago).' ngày trước';
							?>
						</date>
					</li>
				</ul>
			</h2>
		</div>

	</div>


	<div class="entry-content">
		<div class="container">
			<div class="tv-meta-top">

				<div class="col-md-4 col-sm-6 col-xs-12">
					<a href="#" target="_blank">
						<?php if($job->picture == null):?>
							<img class="company_logo" src="<?=Yii::$app->request->baseUrl?>/img/tvi.png" alt="TVi">
						<?php else:?>
							<img style="max-width:130px" class="company_logo" src="<?=Yii::$app->request->baseUrl.$job->picture?>" alt="TVi">
						<?php endif;?>
					</a>
				</div>
				<div class="col-md-4 col-sm-6 col-xs-12">
					<div>
						<p>
							<b>Bắt đầu nhận hồ sơ:</b> <?=date('d-m-Y',strtotime($job->opentime))?>
						</p>
						<p>
							<b>Kết thúc:</b> <?=date('d-m-Y',strtotime($job->endtime))?>
						</p>
						<p><b>Số lượng cần tuyển:</b> <?=$job->quantity?> người</p>
					</div>

				</div>
				<div class="col-md-4 col-sm-6 col-xs-12">
					<?=Html::a('<img style="margin-right: 6px;" class="ut" src="'.Yii::$app->request->baseUrl.'/img/tick.png" alt="">Ứng tuyển',['/site/ungtuyen','id'=>$job->id],['class'=>'btn btn-danger id_apply btn-lg','style'=>'margin-left:75px']);?>
				</div>

			</div>

			<div class="tv-overview-content">
				<div itemprop="description" class="tv-overview col-md-12 col-sm-12">
					<?php if(strpos($job->description,'<img') === false):?>
					<div class="des-align">
						<h2 class="tv-overview-title">Mô tả công việc</h2>
						<?=$job->description?>
					</div>
					<div class="des-align">
						<h2 class="tv-overview-title">Quyền lợi</h2>
						<?=$job->interest?>
						<p><b>- Mức lương: <?=$job->salary?><br/>- Địa điểm làm việc: <?=$job->contact?></b></p>
					</div>
					<div class="des-align">
						<h2 class="tv-overview-title">Yêu cầu</h2>
						<?= $job->attachment?>
					</div>
				<?php else: ?>
					<div class="full-image">
						<?=$job->description?>
					</div>
				<?php endif;?>
					<div style="text-align:center">
						<?=Html::a('<img style="margin-right: 6px;" class="ut" src="'.Yii::$app->request->baseUrl.'/img/tick.png" alt="">Ứng tuyển',['/site/ungtuyen','id'=>$job->id],['class'=>'btn btn-danger id_apply btn-lg']);?>
					</div>
				</div>
			</div>

		</div>
		<div class="container">
			<div class="list-tv col-xs-12">
				<h2>Tin tuyển dụng khác</h2>
				<div class="col-md-12 header-list">
					<div class="col-md-6">
						<span>Tên công việc </span>
					</div>
					<div class="col-md-2">
						<span>Số lượng</span>
					</div>
					<div class="col-md-2">
						<span>Công ty</span>
					</div>
					<div class="col-md-2">
						<span>Ngày hết hạn</span>
					</div>
				</div>
				<div style="border: 1px solid #ccc; border-radius: 4px;overflow:hidden;border-top-right-radius:0;border-top-left-radius:0;">
					<?php if(!empty($other_jobs)):?>
						<?php foreach ($other_jobs as $job) :?>
							<div class="tv-item">
								<div class="content col-xs-12 col-sm-10 col-md-7 col-lg-6">
									<?=Html::a('<h4>'.$job->title.'</h4>',['/site/vitri','id'=>$job->id]);?>
								</div>
								<div class="thumb col-xs-12 col-md-3 col-lg-2">
									<span class="tv-salary tt" data-placement="left" ><?=$job->quantity?></span>
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
										<a target="_blank" href="http://mc-corp.vn/">Minh Chau Corp</a>
									<?php else:?>
										<a target="_blank" href="http://tinhvan.com/">Tinhvan Group</a>
									<?php endif;?>
								</div>
								<div class="thumb col-lg-2">
									<span class="tv-deadline tt" data-placement="top"><?=date('d-m-Y',strtotime($job->endtime))?>
									</span>
								</div>

							</div>
						<?php endforeach;?>
					<?php endif;?>
				</div>
			</div>

		</div>

	</div>

<?php else:?>
	<h1 style="text-align:center">Không tìm thấy việc này</h1>
<?php endif;?>
