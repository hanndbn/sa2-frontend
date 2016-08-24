var UserFilter = React.createClass({
    _handleKeyWord: function (event) {
        this.props.handleKeyWord(event.target.value);
    },
    _handleStatus: function (event) {
        this.props.handleStatus(event.target.value);
    },
    _handleAddUser: function () {
        this.props.handleAddUser();
    },
    render: function () {
        var pointerEvent = "";
        if (this.props.selectAction.action != '') {
            pointerEvent = 'none';
        }
        return (
            <div className="tv_filters" style={{backgroundColor: 'transparent', paddingTop: '0px'}}>
                <div className="col-md-12"
                     style={{textAlign: 'center', backgroundColor: '#DEE1EC', marginBottom: '10px'}}>
                    <h2>MANAGER USER</h2>
                </div>
                <div className="col-md-12" style={{backgroundColor: '#99cce6',}}>
                    <div className="col-md-2 addUser"
                         style={{float: 'left', padding: '10px 0'}}>
                        <span className="btn btn-success" id="add-user" onClick={this._handleAddUser}
                              style={{pointerEvents: pointerEvent}}
                        >
                            <i className="glyphicon glyphicon-plus"/>
                            Add User
                        </span>
                    </div>
                    <div className="col-md-4" style={{float: 'right', padding: '10px 0'}}>
                        <div className="search_keywords col-md-7">
                            <input type="text" name="keyword" id="keyword" placeholder="Nhập username"
                                   onChange={this._handleKeyWord} value={this.props.keyword}/>
                        </div>

                        <div className="search_categories col-md-5">
                            <div className="select">
                                <select className="search_status" style={{border: '0'}}
                                        onChange={this._handleStatus}
                                        value={this.props.status}>
                                    <option value="" disabled="disabled" hidden="hidden">
                                        Choose status
                                    </option>
                                    <option value=""></option>
                                    <option value="0">Active</option>
                                    <option value="1">Deactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
});
var User = React.createClass({
    _handleShowPass: function () {
        this.props.handleShowPass();
    },
    _handleMainAction: function (action, index) {
        this.props.handleMainAction(action, index);
    },
    _handleChooseAction: function (user, doAction, action) {
        this.props.handleChooseAction(user, doAction, action);
    },
    _handleUsername: function (index, event) {
        this.props.handleField("username", event.target.value, index);
    },
    _handlePassword: function (index, event) {
        this.props.handleField("password", event.target.value, index);
    },
    _handleFullName: function (index, event) {
        this.props.handleField("fullname", event.target.value, index);
    },
    _handleEmail: function (index, event) {
        this.props.handleField("email", event.target.value, index);
    },
    _handleRole: function (index, event) {
        this.props.handleField("role", event.target.value, index);
    },
    _handleStatus: function (index, event) {
        this.props.handleField("status", event.target.value, index);
    },
    render: function () {
        var self = this;
        var rows = [];
        var pageSize = this.props.pageSize;
        var currentPage = this.props.currentPage;
        var maxNumberPage = this.props.maxNumberPage;

        var rowFilter = [];
        var keyword = this.props.keyword;
        var status = this.props.status;
        //controller action add edit delete
        var action = this.props.selectAction.action;
        var indexSelected = this.props.selectAction.indexSelected;
        var isShow = this.props.selectAction.isShow;
        var isDisplayShow = this.props.selectAction.isDisplayShow;
        this.props.users.map(function (user, index) {
            if (
                (keyword != "" && user.username.indexOf(keyword) === -1) ||
                (status != "" && user.status != status)) {
            } else {
                rowFilter.push(user);
            }
        });
        rowFilter.map(function (user, index) {
            if (((currentPage - 1) * pageSize <= index) && (index < (currentPage * pageSize))) {
                rows.push(user);
            }
        });
        var userCount = rowFilter.length;
        var totalPage = parseInt((userCount / pageSize)) + 1;
        if (userCount >= pageSize && userCount % pageSize == 0) {
            totalPage = totalPage - 1;
        }
        var userdetail = rows.map(function (user, index) {
            var displayLabel = "";
            var displayInput = "none";
            var displayMainController = "";
            var displayChooseController = "none";
            var displayDivInputPass = "none";
            var poiterEventMainController = "";
            var poiterChooseController = "";

            //custom display admin
            var displayDeleteAdmin = '';
            var displayStatusAdminInput = 'none';
            var displayStatusAdminLabel = '';

            if (action !== "") {
                if (indexSelected == index) {
                    if (action == "delete") {
                        displayLabel = "";
                        displayInput = "none";
                        displayStatusAdminLabel = "";
                        displayStatusAdminInput = "none"
                    } else if (action == "add" || action == "edit") {
                        displayLabel = "none";
                        displayInput = "";
                        displayStatusAdminLabel = "none";
                        displayStatusAdminInput = "";
                        displayDivInputPass = "inline-block";
                    }
                    displayMainController = "none";
                    displayChooseController = "";
                    poiterEventMainController = "";
                    poiterChooseController = "";
                } else {
                    displayLabel = "";
                    displayInput = "none";
                    displayStatusAdminLabel = ""
                    displayStatusAdminInput = "none";
                    displayMainController = "";
                    displayChooseController = "none";
                    poiterEventMainController = "none";
                    poiterChooseController = "none";
                }
            }

            if (user.role == "ADMIN") {
                displayDeleteAdmin = "hidden";
                displayStatusAdminInput = 'none';
                displayStatusAdminLabel = '';
            }

            return (
                <tr key={user.id}>
                    <td>{index + 1}</td>
                    <td>
                        <div className="labeluser1" style={{display: displayLabel}}>{user.username}</div>
                        <input type="text"
                               className="fieldinput1"
                               style={{display: displayInput}}
                               value={user.usernameTmp}
                               onChange={self._handleUsername.bind(null, index)}
                        />
                    </td>
                    <td>
                        <div className="labeluser2" style={{display: displayLabel}}>{user.password}</div>
                        <div className="divInputPass"
                             style={{display: displayDivInputPass, border: 'solid 1px darkgrey', height: "25px"}}>
                            <input type={isShow ? "text" : "password"}
                                   className="fieldinput2"
                                   style={{
                                       display: displayInput,
                                       maxWidth: '100px',
                                       padding: '0',
                                       border: 'none',
                                       borderRadius: '0'
                                   }}
                                   value={user.passwordTmp}
                                   onChange={self._handlePassword.bind(null, index)}
                            />
                            <div className="fieldShowPass"
                                 onClick={self._handleShowPass}
                                 style={{display: isDisplayShow, padding: '5px'}}>
                                <i className={isShow ? "glyphicon glyphicon-eye-close" : "glyphicon glyphicon-eye-open" }/>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div className="labeluser3" style={{display: displayLabel}}>{user.fullname}</div>
                        <input type="text"
                               className="fieldinput3"
                               style={{display: displayInput}}
                               value={user.fullnameTmp}
                               onChange={self._handleFullName.bind(null, index)}
                        />
                    </td>
                    <td>
                        <div className="labeluser4" style={{display: displayLabel}}>{user.email}</div>
                        <input type="text"
                               className="fieldinput4"
                               style={{display: displayInput}}
                               value={user.emailTmp}
                               onChange={self._handleEmail.bind(null, index)}
                        />
                    </td>
                    <td>
                        <div className="labeluser5" style={{display: ''}}>{user.role}</div>
                        <select className="fieldinput5"
                                style={{display: 'none'}}
                                value={user.roleTmp}
                                onChange={self._handleRole.bind(null, index)}
                        >
                            <option value="ADMIN">ADMIN</option>
                            <option value="HR">HR</option>
                        </select>
                    </td>
                    <td style={{textAlign: 'center'}}>
                        <div
                            className={user.status == "0" ? "label label-success labeluser6" : "label label-warning labeluser6"}
                            style={{display: displayStatusAdminLabel}}>{user.status == "0" ? 'Active' : 'Inactive'}
                        </div>
                        <select className="fieldinput6"
                                style={{display: displayStatusAdminInput}}
                                value={user.statusTmp}
                                onChange={self._handleStatus.bind(null, index)}
                        >
                            <option value="0">Active</option>
                            <option value="1">Inactive</option>
                        </select>
                    </td>
                    <td className="text-center mainAction"
                        style={{
                            display: displayMainController,
                            textAlign: 'center',
                            pointerEvents: poiterEventMainController
                        }}
                    >
                        <div className="btn btn-primary btn-circle edit" title=""
                             onClick={self._handleMainAction.bind(null, "edit", index, isShow)}>
                            <i className="glyphicon glyphicon-edit"/>
                        </div>
                        <div className="btn btn-danger btn-circle"
                             style={{visibility: displayDeleteAdmin}}
                             onClick={self._handleMainAction.bind(null, "delete", index, isShow)}>
                            <i className="glyphicon glyphicon-trash"/>
                        </div>
                    </td>
                    <td className="text-center chooseAction"
                        style={{
                            display: displayChooseController,
                            textAlign: 'center',
                            pointerEvents: poiterChooseController
                        }}>
                        <div className="btn btn-success btn-circle" title=""
                             onClick={self._handleChooseAction.bind(null, user, 1, action)}>
                            <i className="glyphicon glyphicon-ok"/>
                        </div>
                        <div className="btn btn-danger btn-circle"
                             onClick={self._handleChooseAction.bind(null, user, 0, action)}>
                            <i className="glyphicon glyphicon-remove"/>
                        </div>
                    </td>
                </tr>
            )
        });
        return (
            <div>
                <div className="table-responsive top-border-table"
                     style={{minHeight: '550px', borderBottom: '1px solid #e7e7e7'}} id="users-table-wrapper">
                    <table className="table fixed" style={{tableLayout: 'fixed'}}>
                        <thead>
                        <tr>
                            <th width="10px">STT</th>
                            <th width="50px">Username</th>
                            <th width="35px">Password</th>
                            <th width="50px">FullName</th>
                            <th width="50px">E-Mail</th>
                            <th width="25px">Role</th>
                            <th width="25px" style={{textAlign: 'center'}}>Status</th>
                            <th width="25px" className="text-center" style={{textAlign: 'center'}}>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        {userdetail}
                        </tbody>
                    </table>
                </div>
                <div style={{display: 'table', margin: '0 auto'}}>
                    <Pagination
                        className="pagination pull-right"
                        currentPage={currentPage}
                        totalPage={totalPage}
                        maxNumberPage={maxNumberPage}
                        handleChangePage={this.props.handleChangePage}
                    />
                </div>
            </div>
        )
    }
});
var UserList = React.createClass({
    getInitialState: function () {
        return ({
            users: [],
            pageSize: 10,
            currentPage: 1,
            maxNumberPage: 5,
            keyword: '',
            status: '',
            selectAction: {
                action: '',
                indexSelected: -1,
                isShow: false,
                isDisplayShow: 'none'
            }
        });
    },
    componentWillMount: function () {
        var data = {
            action: 'init'
        };
        this.loadUsers(data);
    },
    loadUsers: function (data) {
        var self = this;
        $.ajax
        ({
            type: "POST",
            url: self.props.url,
            data: data,
            datatype: 'json',
            success: function (data) {
                var userTmp = JSON.parse(data);
                //add default value for input field
                var users = [];
                userTmp.forEach(function (user) {
                    user.usernameTmp = user.username;
                    user.passwordTmp = "";
                    user.fullnameTmp = user.fullname;
                    user.emailTmp = user.email;
                    user.roleTmp = user.role;
                    user.statusTmp = user.status;
                    users.push(user);
                });
                //get info from first element
                var action = users[0].action;
                var statusProcess = users[0].statusProcess;
                var msg;
                if (action != "init") {
                    msg = action.charAt(0).toUpperCase() + action.slice(1) + " Record " + (statusProcess === "1" ? "Success" : "Fail") + "!!!";
                    this.handleMsgInfo(msg, statusProcess);
                }
                //delete first element
                users.shift();
                self.setState({
                    users: users,
                    selectAction: {
                        action: '',
                        indexSelected: -1,
                        isShow: false,
                        isDisplayShow: 'none'
                    }
                });
            }.bind(this),
            error: function (xhr, status, err) {
                console.error(url, status, err.toString());
            }.bind(this)
        });
    },
    handleChangePage: function (key, totalPage) {
        var currentPage = this.state.currentPage;
        if (key == "next") {
            if (currentPage == totalPage) {
                currentPage = totalPage
            } else {
                currentPage = currentPage + 1;
            }
        } else if (key == "prev") {
            if (currentPage == 1) {
                currentPage = 1;
            } else {
                currentPage = currentPage - 1;
            }
        }
        else if (key == "first") {
            currentPage = 1;
        } else if (key == "last") {
            currentPage = totalPage;
        } else {
            currentPage = key;
        }
        this.setState({
            currentPage: currentPage
        });
    },
    handleKeyWord: function (keyword) {
        this.setState({keyword: keyword});
    },
    handleStatus: function (status) {
        this.setState({status: status});
    },
    handleAddUser: function () {
        var users = this.state.users;
        var newUser = {
            id: 0,
            username: '',
            password: '',
            fullname: '',
            email: '',
            role: 'HR',
            status: '0',
            usernameTmp: '',
            passwordTmp: '',
            fullnameTmp: '',
            emailTmp: '',
            roleTmp: 'HR',
            statusTmp: '0',
        };
        users.unshift(newUser);
        this.setState({
            users: users,
            selectAction: {
                action: 'add',
                indexSelected: 0,
                isShow: false,
                isDisplayShow: 'none'
            }
        });
    },
    handleMsgInfo: function (msg, statusProcess) {
        var msgInfo = $(".msgInfo");
        var className = statusProcess == "1" ? "label-success msgInfo" : "label-warning msgInfo";
        msgInfo.html(msg);
        msgInfo.attr("class", className);
        var delayTime = 1000;
        if (msg !== "" && statusProcess !== "") {
            delayTime = 3000;
        }
        msgInfo.fadeIn();
        msgInfo.delay(delayTime).fadeOut('slow');
    },
    handleMainAction: function (action, index, isShow) {
        this.setState({
            selectAction: {
                action: action,
                indexSelected: index,
                isShow: isShow,
                isDisplayShow: 'none'
            }
        });
    },
    handleChooseAction: function (user, doAction, action) {
        var selectAction = {
            action: '',
            indexSelected: -1,
            isShow: false,
            isDisplayShow: 'none'
        };
        if (doAction === 0) {
            if (action == "add") {
                var users = this.state.users;
                users.shift();
                this.setState({
                    users: users,
                    selectAction: selectAction
                });
            } else {
                this.setState({selectAction: selectAction});
            }
        } else if (action == "add") {
            console.log(action);
            var msg = '';
            var data = {};
            var statusProcess = 1;
            if (user.usernameTmp !== "" && user.passwordTmp !== "") {
                user.username = user.usernameTmp;
                user.password = user.passwordTmp;
                user.fullname = user.fullnameTmp;
                user.email = user.emailTmp;
                user.role = user.roleTmp;
                user.status = user.statusTmp;
                data = {
                    action: 'add',
                    user: user,
                };
                this.loadUsers(data);
            } else {
                msg = "Please Fill Fields: " + (user.usernameTmp == "" ? "Username" : "") + (user.passwordTmp == "" ? ", Password" : "");
                statusProcess = 0;
                this.handleMsgInfo(msg, statusProcess);
            }
        } else if (action == "edit") {
            if (user.usernameTmp !== "") {
                if (
                    user.username == user.usernameTmp &&
                    user.passwordTmp == "" &&
                    user.fullname == user.fullnameTmp &&
                    user.email == user.emailTmp &&
                    user.role == user.roleTmp &&
                    user.status == user.statusTmp) {
                    msg = "No Thing To Change !!!";
                    this.setState({selectAction: selectAction});
                    statusProcess = 1;
                    this.handleMsgInfo(msg, statusProcess);
                } else {
                    user.username = user.usernameTmp;
                    user.password = user.passwordTmp;
                    user.fullname = user.fullnameTmp;
                    user.email = user.emailTmp;
                    user.role = user.roleTmp;
                    user.status = user.statusTmp;
                    data = {
                        action: 'edit',
                        user: user,
                    };
                    this.loadUsers(data);
                }
            }
            else {
                msg = "Please Fill Fields: " + (user.usernameTmp == "" ? "Username" : "");
                statusProcess = 0;
                this.handleMsgInfo(msg, statusProcess)
            }
        } else if (action == "delete") {
            data = {
                action: 'delete',
                user: user,
            };
            this.loadUsers(data);
        }

    },
    handleField: function (field, value, index) {
        var users = this.state.users;
        var selectAction = this.state.selectAction;
        if (field == "username") {
            users[index].usernameTmp = value;
        } else if (field == "password") {
            users[index].passwordTmp = value;
            if (value.length > 0) {
                selectAction.isDisplayShow = 'inline';
            } else {
                selectAction.isDisplayShow = 'none';
            }
        } else if (field == "fullname") {
            users[index].fullnameTmp = value;
        } else if (field == "email") {
            users[index].emailTmp = value;
        } else if (field == "role") {
            users[index].roleTmp = value;
        } else if (field == "status") {
            users[index].statusTmp = value;
        }
        this.setState({
            users: users,
            selectAction: selectAction
        })
    },
    handleShowPass: function () {
        var selectAction = this.state.selectAction;
        selectAction.isShow = !selectAction.isShow;
        this.setState({
            selectAction: selectAction
        });
    },
    render: function () {
        var users = this.state.users;
        return (
            <div className="col-md-9" style={{paddingLeft: '5px'}}>
                <div className="container fixcontainer" style={{marginTop: '10px', marginBottom: '60px'}}>
                    <div
                        style={{
                            border: '1px solid #ccc',
                            borderRadius: '4px',
                            overflow: 'hidden',
                            borderTopRightRadius: '0',
                            borderTopLeftRadius: '0'
                        }}>
                        <div className="list-tv">


                            <div className="userList">
                                <UserFilter
                                    handleKeyWord={this.handleKeyWord}
                                    handleStatus={this.handleStatus}
                                    keyword={this.state.keyword}
                                    status={this.state.status}
                                    handleAddUser={this.handleAddUser}
                                    selectAction={this.state.selectAction}
                                />
                                <div style={{display: 'none', textAlign: 'center', padding: '5px', color: 'white'}}
                                     className="label-success msgInfo">
                                </div>
                                <User users={this.state.users}
                                      pageSize={this.state.pageSize}
                                      currentPage={this.state.currentPage}
                                      maxNumberPage={this.state.maxNumberPage}
                                      handleChangePage={this.handleChangePage}
                                      keyword={this.state.keyword}
                                      status={this.state.status}
                                      handleAddUser={this.handleAddUser}

                                      selectAction={this.state.selectAction}
                                      handleMainAction={this.handleMainAction}
                                      handleChooseAction={this.handleChooseAction}
                                      handleField={this.handleField}
                                      handleShowPass={this.handleShowPass}
                                />
                            </div>
                        </div>
                        <div id="loading" style={{textAlign: "center"}}></div>

                    </div>
                </div>
            </div>

        );
    }
});
var Pagination = React.createClass({
    _handleChangePage: function (key) {
        var totalPage = this.props.totalPage;
        this.props.handleChangePage(key, totalPage)
    },
    render: function () {
        var self = this;
        var currentPage = this.props.currentPage;
        var totalPage = this.props.totalPage;
        var maxNumberPage = this.props.maxNumberPage;
        var rows = [];

        var style = {
            pointerEvents: currentPage == 1 ? "none" : ""
        };
        rows.push(
            <li key="first" style={{pointerEvents: currentPage == 1 ? "none" : ""}}
                onClick={this._handleChangePage.bind(null, "first")}>
                <span className=" disabled page-number">&laquo;</span>
            </li>);
        rows.push(
            <li key="prev" style={{pointerEvents: currentPage == 1 ? "none" : ""}}
                onClick={this._handleChangePage.bind(null, "prev")}>
                <span className="page-number">&lsaquo;</span>
            </li>);

        // process phan trang
        var diff = Math.floor(maxNumberPage / 2);
        var start = Math.max(currentPage - diff, 1);
        var end = 0;
        if (start == 1) {
            end = Math.min(totalPage, maxNumberPage);
        } else {
            end = Math.min(totalPage, start + maxNumberPage - 1);
        }
        for (var i = start; i <= end; i++) {
            rows.push(
                <li key={i} className={i == currentPage ? "active" : ""}
                    onClick={this._handleChangePage.bind(null, i)}>
                    <span className="page-number">{i}</span>
                </li>);
        }
        rows.push(
            <li key="next" style={{pointerEvents: currentPage == totalPage ? "none" : ""}}
                onClick={this._handleChangePage.bind(null, "next")}>
                <span className="page-number">&rsaquo;</span>
            </li>);
        rows.push(
            <li key="last" style={{pointerEvents: currentPage == totalPage ? "none" : ""}}
                onClick={this._handleChangePage.bind(null, "last")}>
                <span className="page-number">&raquo;</span>
            </li>);
        return (
            <ul className="pagination">
                {rows}
            </ul>
        )
    }
});

var Menu = React.createClass({
    render: function () {
        return (
            <div className="col-md-2">
                <div className="navbar-default sidebar" style={{border: 'none'}} role="navigation">
                    <div className="sidebar-nav navbar-collapse"
                         style={{marginTop: '-4px', borderTop: '1px solid #DCB7B7'}}>
                        <ul className="nav" id="side-menu">
                            <li className="sidebar-avatar" style={{borderBottom: '1px solid #DCB7B7'}}>
                                <div className="dropdown">
                                    <div>
                                        <img alt="image" className="img-circle" width="100%"
                                             src="../img/logoAdmin.png"/>
                                    </div>
                                </div>
                            </li>
                            <li className="">
                                <a href="#" className="">
                                    <i className="fa fa-dashboard fa-fw"></i> Main
                                </a>
                            </li>
                            <li className="active open">
                                <a href="#" className="active">
                                    <i className="fa fa-users fa-fw"></i> Users Manager
                                </a>
                            </li>

                            <li className="">
                                <a href="#" className="">
                                    <i className="fa fa-list-alt fa-fw"></i> Unit Manager
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        );
    }
});
var Page = React.createClass({
    render: function () {
        var component = [];
        component.push(<Menu/>);
        if (1) {
            component.push(<UserList
                url="../web/ajaxuser"
            />)
        }
        return (
            <div>
                {component}
            </div>
        )
    }
});

ReactDOM.render(
    <Page/>
    ,
    document.getElementById("container")
);