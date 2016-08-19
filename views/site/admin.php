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
        handleDeleteUser: function (id) {
            this.props.handleDelete(id);
        },
        handleEditUser: function (index) {
            $($(".field1")[index]).html("<input type='text' value='" + $($(".field1")[index]).html() + "'/>");
            $($(".field2")[index]).html("<input type='text' value='" + $($(".field2")[index]).html() + "'/>");
            $($(".field3")[index]).html("<input type='text' value='" + $($(".field3")[index]).html() + "'/>");
            $($(".field4")[index]).html("<input type='text' value='" + $($(".field4")[index]).html() + "'/>");
            $(".mainAction").css({"display":'none'});
            $(".chooseAction").css({"display":'block'});
        },
        handleChooseAction: function (user,doUpdate,index) {
            $($(".field1")[index]).html($($(".field1")[index]).find("input").val());
            $($(".field2")[index]).html($($(".field2")[index]).find("input").val());
            $($(".field3")[index]).html($($(".field3")[index]).find("input").val());
            $($(".field4")[index]).html($($(".field4")[index]).find("input").val());
            $(".mainAction").css({"display":'block'});
            $(".chooseAction").css({"display":'none'});
            if(doUpdate == "1"){
                this.props.handleEdit(user);
            }
            console.log(doUpdate);
        },
        render: function () {
            var self = this;
            var userdetail = this.props.users.map(function (user,index) {
                return (
                    <tr key={user.id}>
                        <td>{user.id}</td>
                        <td className="field1">{user.username}</td>
                        <td className="field2">{user.fullname}</td>
                        <td className="field3">{user.email}</td>
                        <td className="field4">{user.ctime}</td>
                        <td>
                            <span className={user.status=="0" ? "label label-success" : "label label-warning"}>{user.status=="0" ? 'Active' : 'Deactive'}</span>
                        </td>
                        <td className="text-center mainAction">
                            <div className="btn btn-info btn-circle" title="" >
                                <i className="fa fa-list"></i>
                            </div>
                            <div className="btn btn-success btn-circle" title="">
                                <i className="glyphicon glyphicon-eye-open"></i>
                            </div>
                            <div className="btn btn-primary btn-circle edit" title="" onClick={self.handleEditUser.bind(null,index)}>
                                <i className="glyphicon glyphicon-edit"></i>
                            </div>
                            <div className="btn btn-danger btn-circle" onClick={self.handleDeleteUser.bind(null,user.id)}>
                                <i className="glyphicon glyphicon-trash"></i>
                            </div>
                        </td>
                        <td className="text-center chooseAction" style={{display:'none'}} >
                            <div className="btn btn-success btn-circle" title="" onClick={self.handleChooseAction.bind(null,user,1,index)}>
                                <i className="glyphicon glyphicon-ok"></i>
                            </div>
                            <div className="btn btn-danger btn-circle" onClick={self.handleChooseAction.bind(null,user,0,index)}>
                                <i className="glyphicon glyphicon-remove"></i>
                            </div>
                        </td>
                    </tr>
                )
            });
            return (
                <div className="table-responsive top-border-table" id="users-table-wrapper">
                    <table className="table">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>Username</th>
                            <th>Full Name</th>
                            <th>E-Mail</th>
                            <th>Registration Date</th>
                            <th>Status</th>
                            <th className="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        {userdetail}
                        </tbody>
                    </table>
                </div>
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
            var data = {
                action:'init'
            };
            this.loadUsers(data);
        },
        loadUsers: function (data) {
            var self = this;
            $.ajax
            ({
                type: "POST",
                url: "<?=Url::toRoute('site/ajaxuser')?>",
                data: data,
                datatype: 'json',
                success: function (data) {
                    self.setState({users: JSON.parse(data)});
                },
                error: function (xhr, status, err) {
                    console.error(url, status, err.toString());
                }
            });
        },
        handleDelete: function (id) {
            var data = {
                action:'delete',
                id:id
            };
            this.loadUsers(data);
        },
        handleEdit: function (user) {
            var data = {
                action:'edit',
                user:user
            };
            this.loadUsers(data);
        },
        render: function () {
            var users = this.state.users;
            return (
                <div className="userList">
                    {<User users={this.state.users}
                           handleDelete = {this.handleDelete}
                           handleEdit = {this.handleEdit}
                    />}
                </div>
            );
        }
    });
    ReactDOM.render(
        <UserList url="<?=Url::toRoute('site/ajaxuser') ?>"/>
        ,
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