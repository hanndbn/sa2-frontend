<?php use yii\helpers\Url; ?>
<div class="col-md-9">
    <div class="page-header" style="background: white">
        <div class="container fixcontainer">
            <h1 class="page-title">THÔNG TIN TUYỂN DỤNG</h1>
            <h2 class="page-subtitle"><strong> công việc đang tuyển dụng</strong></h2>
        </div>

    </div>
    <div class="container fixcontainer">
        <div class="tv_filters">

            <div class="search_jobs ">

                <div class="search_keywords col-lg-4">
                    <input type="text" name="keyword" id="keyword" placeholder="Nhập tiêu đề công việc" value="">
                </div>

                <div class="search_location col-lg-2">
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
                        </select></div>
                </div>

                <div class="search_categories col-lg-2">
                    <div class="select"><select name="company" id="company" class="search_region" style="border: 0px;">
                            <option value="0">Công ty</option>
                            <option class="level-0" value="1">Tinhvan Group</option>
                            <option class="level-0" value="2">Tinhvan Outsourcing</option>
                            <option class="level-0" value="3">Tinhvan Consulting</option>
                            <option class="level-0" value="4">Tinhvan eBooks</option>
                            <option class="level-0" value="5">Tinhvan Incubator</option>
                            <option class="level-0" value="6">Tinhvan Solutions</option>
                            <option class="level-0" value="7">MC Corp</option>
                            <option class="level-0" value="8">Tinhvan Telecom</option>
                        </select></div>
                </div>

                <div class="search_categories col-lg-2">
                    <div class="select"><select name="address" id="address" class="search_region" style="border: 0px;">
                            <option value="">Địa Điểm</option>
                            <option class="level-0" value="Hà Nội">Hà Nội</option>
                            <option class="level-0" value="Hồ Chí Minh">Hồ Chí Minh</option>
                        </select></div>
                </div>

                <div class="search_submit col-lg-2">
                    <input type="button" name="submit" id="search" value="Tìm kiếm">
                </div>

            </div>
        </div>
    </div>
    <div class="container fixcontainer" style="margin-top: 10px; margin-bottom: 60px; ">
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
        <div
            style="border: 1px solid #ccc; border-radius: 4px; overflow: hidden; border-top-right-radius:0;border-top-left-radius:0;">
            <div id="container" class="list-tv">

            </div>
            <div id="loading" style="text-align:center"></div>

        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.24/browser.min.js"></script>
<script type="text/babel">
    var User = React.createClass({
        render: function () {
            console.log(this.props.users);
            var userdetail = this.props.users.map(function (user) {//
                return (
                    <div>{user.id} name: {user.username}</div>
                )
            });
            return (
                <div className="user">{userdetail}</div>
            )
        }

    });
    var UserList = React.createClass({
        getInitialState: function () {
            return ({
                users: []
            });
        },
        componentWillMount: function () {
            this.loadUsers();
        },
        loadUsers: function () {
            $.ajax
            ({
                type: "GET",
                url: "<?=Url::toRoute('site/ajaxuser')?>",
                data: null,
                datatype: 'json',
                success: function (data) {
                    this.setState({users: JSON.parse(data)});
                }.bind(this),
                error: function (xhr, status, err) {
                    console.error(url, status, err.toString());
                }.bind(this)
            });
        },
        render: function () {
            var users = this.state.users;
            return (
                <div className="userList">
                    {<User users = {this.state.users}/>}
                </div>
            );
        }
    });
    ReactDOM.render(
        <UserList url="<?=Url::toRoute('site/ajaxuser') ?>"/>,
        document.getElementById("container")
    );
</script>
<script type="text/javascript">
    $(document).ready(function () {
        function loading_show() {
            $('#loading').html("<div class='loading-ajax'><img src='<?=Yii::$app->request->baseUrl?>/img/ajax-loader.gif'/></div>").fadeIn('fast');
        }

        function loading_hide() {
            $('#loading').fadeOut('fast');
        }

    });
</script>