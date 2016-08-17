<?php
$this->title = $job->title;
use yii\helpers\Html;
?>

<div class="upload-header">
	<div class="container">
		<h1 class="upload-title"><?= $job->title?></h1>
	</div>
</div>


<div id="upload" class="upload-content">
	<div class="container">
		<h3 style="text-align:center;font-weight:bold;font-size: 20px;margin: 10px 0 20px 0;">FORM ỨNG TUYỂN</h3>
		<input type="hidden" id="jobid" value="<?=$job->id?>">
		<div class="col-xs-offset-1 col-xs-10">
			<div class="col-xs-12">
				<div class="col-xs-6">
					<div class="form-group">
						<label>Họ và tên</label><span style="color:red">*</span>
						<input type="text" class="form-control required" name="name" id="account_name" placeholder="Nguyễn Văn A">
					</div>
					<div class="form-group">
						<label>Email</label><span style="color:red">*</span>
						<input type="email" name="email" class="form-control required" id="account_mail" placeholder="example@gmail.com">
					</div>
					<div class="form-group">
						<label>Số điện thoại</label><span style="color:red">*</span>
						<input type="text" class="form-control required" id="phone">
					</div>
					<div class="form-group">
						<label>Facebook</label>
						<input type="text" class="form-control" id="facebook-add">
					</div>

					<div id="container2"></div>
				</div>
				<div class="col-xs-6">
					<div class="form-group">
						<label>Ngày sinh</label><span style="color:red">*</span>
						<input type="date" class="form-control required" id="birth">
					</div>
					<div class="form-group">
						<label>Giới tính</label><span style="color:red">*</span>
						<select class="form-control" id="gender">
							<option value="1">Nam</option>
							<option value="0">Nữ</option>
						</select>
					</div>
					<div class="form-group">
						<label>Địa chỉ hiện tại</label><span style="color:red">*</span>
						<input type="text" class="form-control required" id="curent-add">
					</div>

					<div id="container2"></div>
				</div>
			</div>
			<br>
			<div class="col-xs-12">
				<div class="col-xs-12">
					<label>Trường đào tạo (chỉ ghi bằng cấp cao nhất)</label><span style="color:red">*</span>
				</div>
				<div class="col-xs-12">
				<div class="col-xs-6">
					<div class="form-group">
						<label>Tên trường</label><span style="color:red">*</span>
						<input type="text" class="form-control required" name="name" id="university-name">
					</div>
					<div class="form-group">
						<label>Hình thức đào tạo</label><span style="color:red">*</span>
						<input type="text" class="form-control required" name="name" id="type-of-trainning">
					</div>
				</div>
				<div class="col-xs-6">
					<div class="form-group">
						<label>Chuyên ngành</label><span style="color:red">*</span>
						<input type="text" class="form-control required" name="name" id="mayjor">
					</div>
					<div class="form-group">
						<label>Xếp loại</label><span style="color:red">*</span>
						<select class="form-control required" id="rank">
							<option value="Xuất sắc">
								Xuất sắc
							</option>
							<option value="Giỏi">
								Giỏi
							</option>
							<option value="Khá" selected>
								Khá
							</option>
							<option value="Trung bình">
								Trung bình
							</option>
						</select>
					</div>
				</div>
				</div>
			</div>
			<div class="col-xs-12">
				<div class="col-xs-6">
					<div class="form-group">
						<label>Các chứng chỉ, bằng cấp khác</label>
						<textarea class="form-control" name="name" id="otherquality" rows="5" placeholder="Ghi rõ thời gian học, tên chứng chỉ/khóa học, đơn vị đào tạo"></textarea>
					</div>
				</div>
			</div>
			<div class="col-xs-12">
				<div class="col-xs-6">
					<div class="form-group">
						<label>Vị trí ứng tuyển</label><span style="color:red">*</span>
						<select class="form-control required" id="spec">
							<option value="">Vui lòng chọn ...</option>
							<option value="Lập trình viên">
								Lập trình viên
							</option>
							<option value="Nhân viên kinh doanh">
								Nhân viên kinh doanh
							</option>
							<option value="PR / Marketting">
								PR / Marketting
							</option>
							<option value="Hành chính nhân sự">
								Hành chính nhân sự
							</option>
							<option value="QA / TEST">
								QA / TEST
							</option>
							<option value="Kế toán">
								Kế toán
							</option>
							<option value="Khác">
								Khác
							</option>
						</select>
					</div>

					<div class="form-group">
						<label>Quá trình công tác</label><span style="color:red">*</span>
						<textarea class="form-control required" name="name" id="exp" rows="5" placeholder="Ghi rõ từ ngày-đến ngày, vị trí, công ty"></textarea>
					</div>
				</div>
				<div class="col-xs-6">
					<div class="form-group">
						<label>Thời gian sẵn sàng làm việc</label><span style="color:red">*</span>
						<input type="date" class="form-control required" id="start-date">
					</div>
				</div>
			</div>
			<div class="col-xs-12">
				<div class="form-group">
					<label for="upload_cv">Gửi hồ sơ dưới dạng tệp tin hoặc link</label>
					<div style="width: 50%;margin: 10px 0 10px;">Nếu bạn không có mẫu CV thì có thể tải <a <?php if($job->cvform=="") :?>href="http://tuyendung.tinhvan.com/public/CV.doc"<?php else:?>href="<?=$job->cvform?>"<?php endif;?> title="">tại đây.</a></div>
					<div class="field upload_file">
						<input type="radio" id="r1" name="optionsRadios" class="optionsRadios" value="file" checked>
						<form id="submit-job-form" class="job-manager-form" enctype="multipart/form-data">
							<input type="file" id="file_cv" class="input-text" name="file_cv"  accept="docx|doc|pdf placeholder="">
						</form>
						<small class="description">
							Định dạng docx, doc, pdf dung lượng tối đa là 2MB. </small>
						</div>
						<input type="radio" id="r2" name="optionsRadios" class="optionsRadios" value="link" >
						<input type="text"  class="input-text form-control" name="link_website" id="link_website" placeholder="http://" value="" maxlength="" style="width: 95%;">
					</div>
					<div class="form-group">
						<div id="captcha"></div>
						<div id="loading"></div>
						<div style="text-align: center;">
							<button style="margin-top:20px" id="submit" class="btn btn-danger id_cvsubmit btn-lg"><img class="ut" src="<?=Yii::$app->request->baseUrl?>/img/tick.png" alt="">
								Ứng Tuyển</button> </div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<script type="text/javascript">
				$(document).ready(function(){
					function loadForm(){
						var id =document.getElementById('jobid').value;
						var data = "";
						$.ajax
						({
							type: "POST",
							//url: "http://tuyendung.tinhvan.com/apply/job/get?id="+id,
				//			url: "http://192.168.53.33:8080/apply/job/get?id="+id,
							url: "http://192.168.53.68:8080/apply/job/get?id="+id,
							success: function(msg)
							{
								a = JSON.parse(msg);
								objs = a.fields;
								var container = '#container2';
								$.each(objs,function(key,value){
									console.log("aaaaaa");
									data = '<div class="form-group"><label>'+value.name+'</label><input type="text" class="form-control required" name="'+value.id+'" value=""></div>';
									$(container).append(data);
									if(container === '#container2') container = '#container';
									else container = '#container2';
								});
							}
						});
					}
					function loadCaptCha(){
						var data = "";
						$.ajax
						({
							type: "POST",
					//		url: "http://tuyendung.tinhvan.com/apply/captcha/create",
					//		url: "http://192.168.53.33:8080/apply/captcha/create",
							url: "http://192.168.53.68:8080/apply/captcha/create",
							success: function(msg)
							{
								objs = JSON.parse(msg);
								data += '<label>CaptCha</label><div class="field"><div style="display: inherit;"><img src="'+objs['base64']+'"/><span id="refresh_captcha" style="margin-left: 10px;cursor: pointer;" class="fa fa-refresh"></span></div><input type="text" style="margin-top:8px; width:170px" class="input-text requiered" id="captchavalue" value=""><input type="text" style="display:none" id="captchaid" value="'+objs['id']+'"></div>';
								$("#captcha").html(data);
							}
						});
					}
			//		loadCaptCha();
			//		setInterval(function(){loadCaptCha()},300000);
					loadForm();
					var flag = false;
					function validate(){
						$('.required').each(function(){
							if (($(this).val())=="") {
								flag = true;
								$(this).focus();
								return false;
							}else{
								$(this).removeClass("error");
								flag = false;
							}
						});
						if (flag) {
							return false;
						}else{
							return true;
						}
					}
					function isValidEmailAddress(emailAddress) {
						var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
						return pattern.test(emailAddress);
					};
					function loading_show(){
						$('#loading').html("<div class='loading-ajax'><img src='<?=Yii::$app->request->baseUrl?>/img/ajax-loader.gif'/><div class='progress'><div class='progress-bar progress-bar-striped active' id='prb'  role='progressbar' aria-valuenow='45' aria-valuemin='0' aria-valuemax='100' style='width: 0%'></div></div></div>").fadeIn('fast');
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
					function submitForm(){
						var data={};
						var field = [];
						var infor = [];
						//data.capid=document.getElementById('captchaid').value;
						//data.cap=document.getElementById('captchavalue').value;
						data.jobid= $('#jobid').val();
						// var inputs = document.getElementsByTagName('input');
						data['name'] = $('#account_name').val();
						data.email = $('#account_mail').val();
						data.spec = $('#spec').val();
						data.exp = $('#exp').val();
						data.gender = $('#gender').val();
						data.phone = $('#phone').val();
						data.birth = $('#birth').val();
						data.address = $('#curent-add').val();
						data.facebook = $('#facebook-add').val();
						data.startTime = $("#start-date").val();
						data.schoolName = $("#university-name").val();
						data.typeOfTrainning = $("#type-of-trainning").val();
						data.mayjor = $("#mayjor").val();
						data.rank = $("#rank").val();
						data.otherQuality = $("#otherquality").val();

						var cbb = document.getElementById('r1');

						var formData;
						if(cbb.checked){
							var file = $('#submit-job-form')[0];
							var isfile = document.getElementById('file_cv').value;
							if (isfile==null||isfile=='') {
								alert('Vui lòng chọn file');
								return false;
							}else
							{
								formData = new FormData(file);
								data['type'] = "file";
							}
						}else{
							var l = $('#link_website').val();
							if (l==null||l=='') {
								alert('Vui lòng nhập link');
								return false;
							}else{
								formData = null;
								data['link'] = $('#link_website').val();
							}
						}
						var input1 = $('#container input');
						var input2 = $('#container2 input')
						for (var i = 0; i < input1.length; i++) {
							if(isNaN(input1[i]['name'])){

							}else{
								field.push(input1[i]['name']);
								infor.push(input1[i]['value']);
							}
						}
						for (var i = 0; i < input2.length; i++) {
							if(isNaN(input2[i]['name'])){

							}else{
								field.push(input2[i]['name']);
								infor.push(input2[i]['value']);
							}
						}
						data.field = field;
						data['info'] = infor;
						console.log(data);
				//		var url = "http://tuyendung.tinhvan.com/apply/candidate/create?"+ser(data);
				//		var url = "http://192.168.53.33:8080/apply/candidate/create?"+ser(data);
						var url = "http://192.168.53.68:8080/apply/candidate/create?"+ser(data);
						console.log(url);
						loading_show();
						$.ajax({
							type: "POST",
							url: url,
							async: true,
							cache: false,
							data: formData,
							processData: false,
							contentType: false,
							error: function(xhr, status, error) {
								loading_hide();
								alert("Địa chỉ mail không tồn tại!");
							},
							xhr:function(){
								myXhr = $.ajaxSettings.xhr();
								myXhr.upload.addEventListener("progress", function (evt) {
									var per = (evt.loaded / evt.total * 100)+'%';
									$('#prb').width(per);
								}, false);
								return myXhr;

							},
							success: function(msg)
							{
								loading_hide();
								$("#upload").html("<h4 style='color:blue;text-align:center'>Cảm ơn bạn đã gửi CV, Nếu CV của bạn đạt yêu cầu chúng tôi sẽ liên lạc với bạn</h4>");
							}
						});
					}
					$('#link_website').focus(function(){
						$('#r2').click();
					});
					$('#submit').click(function(e){
						if (validate()) {
							if(isValidEmailAddress($('#account_mail').val())) {
								if(checkFileExtension()){
									if(checkFileSize()){
										submitForm();
									}else{
										alert('Kích thước file phải nhỏ hơn 2MB');
									}
								}else{
									alert('Định dạng file đính kèm không đúng');
								}
							}
							else{
								alert('Địa chỉ email không hợp lệ');
							}
						}else{
							alert('Bạn chưa nhập đầy đủ thông tin');
						}
					});
					$(document).on('click','#refresh_captcha',function(){
						loadCaptCha();
					});
					function checkFileSize() {
						var oInput = $("#file_cv");
						var fileSize = oInput[0].files[0].size/1024/1024;
						alert(oInput[0].files[0].size/1024/1024 + "MB");
						if(fileSize > 2){
							return false;
						}
						return true;
					}
					function checkFileExtension(){
						var oInput = $("#file_cv");
						var _validFileExtensions = [".doc", ".docx", ".pdf"];
						var sFileName = oInput.val();
						if (sFileName.length > 0) {
							var blnValid = false;
							for (var j = 0; j < _validFileExtensions.length; j++) {
								var sCurExtension = _validFileExtensions[j];
								if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
									blnValid = true;
									break;
								}
							}

							if (!blnValid) {
								oInput.val("");
								return false;
							}
						}
						return true;
					}
				});
			</script>