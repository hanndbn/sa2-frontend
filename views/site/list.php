<?php use yii\helpers\Url;?>
<div class="page-header">
	<div class="container">
		<h1 class="page-title">THÔNG TIN TUYỂN DỤNG</h1>
		<h2 class="page-subtitle"><strong><?=$count?> công việc đang tuyển dụng</strong></h2>
	</div>

</div>
<div class="container">
	<div class="tv_filters">

		<div class="search_jobs ">

			<div class="search_keywords col-lg-2" style="width: 20%;">
				<input type="text" name="keyword" id="keyword" placeholder="Nhập tiêu đề công việc" value="" style="width: 100%;">
			</div>
			<div class="col-lg-2" style="width: 20%;">
				<div class="select" >
					<select name="position" id="position" class="search_region" style="border: 0px;">
						<option value="">Vị Trí</option>
						<?php foreach ($lstPosition as $item){?>
							<option class="level-0" value="<?=$item->id?>"><?=$item->name?></option>
						<?php }?>
					</select>
				</div>
			</div>

			<div class="search_location col-lg-2" style="display:none">
				<div class="select"><select name="salary" id="salary" class="search_region" style="border: 0px;">
					<option value="">Mức Lương</option>
					<option class="level-0" value="Thỏa thuận">Thỏa thuận</option>
					<option class="level-0" value="3-5 triệu">3-5 triệu</option>
					<option class="level-0" value="5-7 triệu">5-7 triệu</option>
					<option class="level-0" value="7-10 triệu">7-10 triệu</option>
					<option class="level-0" value="10-15 triệu">10-15 triệu</option>
					<option class="level-0" value="15-20 triệu">15-20 triệu</option>
					<option class="level-0" value="20-30 triệu">20-30 triệu</option>
					<option class="level-0" value="Trên 30 triệu">Trên 30 triệu</option>
				</select></div></div>

				<div class="search_categories col-lg-2" style="width: 20%;">
					<div class="select"><select name="company" id="company" class="search_region" style="border: 0px;">
						<option value="0">Công ty</option>
							<?php foreach ($org as $org) :?>
								<option class="level-0" value="<?=$org['id']?>"><?=$org['description']?></option>
							<?php endforeach;?>
					</select></div>
				</div>

				<div class="search_categories col-lg-2" style="width: 20%;">
					<div class="select"><select name="address" id="address" class="search_region" style="border: 0px;">
						<option value="">Địa Điểm</option>
						<option class="level-0" value="Hà Nội">Hà Nội</option>
						<option class="level-0" value="Hồ Chí Minh">Hồ Chí Minh</option>
						<option class="level-0" value="Đà Nẵng">Đà Nẵng</option>
						<option class="level-0" value="Japan">Japan</option>
					</select></div>
				</div>

				<div class="search_submit col-lg-2" style="width: 20%;">
					<input type="button" name="submit" id="search" value="Tìm kiếm">
				</div>

			</div>
		</div>
	</div>
	<div class="container" style="margin-top: 10px; margin-bottom: 60px; ">
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
			<div id="container"  class="list-tv">

			</div>
			<div id="loading" style="text-align:center"></div>

		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			function loading_show(){
				$('#loading').html("<div class='loading-ajax'><img src='<?=Yii::$app->request->baseUrl?>/img/ajax-loader.gif'/></div>").fadeIn('fast');
			}
			function loading_hide(){
				$('#loading').fadeOut('fast');
			}
			function loadData(page,keyword,org,address,salary,position){
                    loading_show();
                    var csrfToken = $('meta[name="csrf-token"]').attr("content");
                    $.ajax
                    ({
                    	type: "POST",
                    	url: "<?=Url::toRoute('site/ajaxjob')?>",
                    	data: {
                    		page: page,
                    		keyword: keyword,
                    		org: org,
                    		address: address,
                    		salary: salary,
							position: position,
                    		_csrf : csrfToken
                    	},
                    	success: function(msg)
                    	{
                    		loading_hide();
                    		$("#container").html(msg);
                    		console.log(msg);
                    	}
                    });
                }
                var salary = $('#salary').val();
                var address= $('#address').val();
                var company = $('#company').val();
                var keyword = $('#keyword').val();
				var position = $('#position').val();
                loadData(1,keyword,company,address,salary,position);  // For first time page load default results
                $(document).on('click','#container li.active',function(){
                	var page = $(this).attr('p');
                	var salary = $('#salary').val();
                	var address= $('#address').val();
                	var company = $('#company').val();
					var keyword = $('#keyword').val();
					var position = $('#position').val();
                	loadData(page,keyword,company,address,salary,position);

                });
                $(document).on('click','#search',function(){
                	var salary = $('#salary').val();
                	var address= $('#address').val();
                	var company = $('#company').val();
                	var keyword = $('#keyword').val();
					var position = $('#position').val();
                	loadData(1,keyword,company,address,salary,position);

                });
                $(document).on("keypress",'#keyword', function(e) {
                	if (e.keyCode == 13) {
                		var salary = $('#salary').val();
                		var address= $('#address').val();
                		var company = $('#company').val();
                		var keyword = $('#keyword').val();
						var position = $('#position').val();
                		loadData(1,keyword,company,address,salary,position);

                	}
                });
            });
        </script>