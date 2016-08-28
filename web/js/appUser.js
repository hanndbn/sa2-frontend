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
    //handle sort
    _handleSortField: function (field, value) {
        if (field == "username") {
            this.props.handleSortField("username", value);
        } else if (field == "fullname") {
            this.props.handleSortField("fullname", value);
        } else if (field == "email") {
            this.props.handleSortField("email", value);
        }
    },
    _processSortClass: function (value) {
        var className = '';
        if (value === 1) {
            className = "fa fa-sort-asc fa-fw";
        } else if (value === -1) {
            className = "fa fa-sort-desc fa-fw";
        } else {
            className = "fa fa-sort fa-fw";
        }
        return className;
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
                (keyword != "" && user.username.toLowerCase().indexOf(keyword.toLowerCase()) === -1) ||
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
                    displayStatusAdminLabel = "";
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
                     style={{borderBottom: '1px solid #e7e7e7'}} id="users-table-wrapper">
                    <table className="table fixed" style={{tableLayout: 'fixed'}}>
                        <thead>
                        <tr>
                            <th width="10px">
                                STT
                            </th>
                            <th width="50px">
                                Username
                                <span
                                    onClick={this._handleSortField.bind(null, "username", self.props.sortAction.sortUsername)}>
                                    <i className={this._processSortClass(self.props.sortAction.sortUsername)}></i>
                                </span>
                            </th>
                            <th width="35px">Password</th>
                            <th width="50px">FullName
                                <span
                                    onClick={this._handleSortField.bind(null, "fullname", self.props.sortAction.sortFullname)}>
                                    <i className={this._processSortClass(self.props.sortAction.sortFullname)}></i>
                                </span>
                            </th>
                            <th width="50px">E-Mail
                                <span
                                    onClick={this._handleSortField.bind(null, "email", self.props.sortAction.sortEmail)}>
                                    <i className={this._processSortClass(self.props.sortAction.sortEmail)}></i>
                                </span>
                            </th>
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
            },
            sortAction: {
                sortUsername: 0,
                sortFullname: 0,
                sortEmail: 0
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
    handleAdd: function () {
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
    handleSortField: function (field, value) {
        var users = this.state.users;
        var sortAction = {
            sortUsername: 0,
            sortFullname: 0,
            sortEmail: 0
        };
        var val = 0;
        var orderBy = "";
        var sortType = 0;
        if (value == 0) {
            val = -1;
            sortType = "desc";
        } else if (value == -1) {
            val = 1;
            sortType = "asc";
        }
        if (field == "username") {
            sortAction.sortUsername = val;
        } else if (field == "fullname") {
            sortAction.sortFullname = val;
        } else if (field == "email") {
            sortAction.sortEmail = val;
        }

        if (val != 0) {
            users = users.sort(function (a, b) {
                var fieldA = "";
                var fieldB = "";

                if (field == "username") {
                    fieldA = a.username.toLowerCase();
                    fieldB = b.username.toLowerCase();
                    sortAction.username = val;
                } else if (field == "fullname") {
                    fieldA = a.fullname.toLowerCase();
                    fieldB = b.fullname.toLowerCase();
                    sortAction.sortFullname = val;
                } else if (field == "email") {
                    fieldA = a.email.toLowerCase();
                    fieldB = b.email.toLowerCase();
                    sortAction.sortEmail = val;
                }
                if (sortType == "asc") {
                    if (fieldA < fieldB)
                        return -1;
                    if (fieldA > fieldB)
                        return 1;
                } else if (sortType == "desc") {
                    if (fieldA < fieldB)
                        return 1;
                    if (fieldA > fieldB)
                        return -1;
                }
                return 0;
            });
        } else {
            users = users.sort(function (a, b) {
                var fieldA = a.role.toLowerCase();
                var fieldB = b.role.toLowerCase();
                if (fieldA < fieldB)
                    return -1;
                if (fieldA > fieldB)
                    return 1;
                return 0;
            });
        }
        this.setState({
            sortAction: sortAction,
            users: users
        })
    },
    render: function () {
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
                                <Filter
                                    headerFilter={this.props.headerFilter}
                                    handleKeyWord={this.handleKeyWord}
                                    handleStatus={this.handleStatus}
                                    keyword={this.state.keyword}
                                    status={this.state.status}
                                    handleAdd={this.handleAdd}
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
                                      handleAdd={this.handleAdd}

                                      selectAction={this.state.selectAction}
                                      handleMainAction={this.handleMainAction}
                                      handleChooseAction={this.handleChooseAction}
                                      handleField={this.handleField}
                                      handleShowPass={this.handleShowPass}
                                      handleSortField={this.handleSortField}
                                      sortAction={this.state.sortAction}
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
window.Pagination;
//Division
var Division = React.createClass({
    _handleShowPass: function () {
        this.props.handleShowPass();
    },
    _handleMainAction: function (action, index) {
        this.props.handleMainAction(action, index);
    },
    _handleChooseAction: function (division, doAction, action) {
        this.props.handleChooseAction(division, doAction, action);
    },
    _handleName: function (index, event) {
        this.props.handleField("name", event.target.value, index);
    },
    _handleDescription: function (index, event) {
        this.props.handleField("description", event.target.value, index);
    },
    _handleLink: function (index, event) {
        this.props.handleField("link", event.target.value, index);
    },
    _handleLogo: function (action, index, event) {
        var reader = new FileReader();
        var self = this;
        reader.onload = function () {
            self.props.handleField("logo", reader.result, index);
        };
        if (action == "add") {
            reader.readAsDataURL(event.target.files[0]);
        } else if (action == "delete") {
            self.props.handleField("logo", '', index);
        }
    },
    _handleStatus: function (index, event) {
        this.props.handleField("status", event.target.value, index);
    },
    //handle sort
    _handleSortField: function (field, value) {
        if (field == "name") {
            this.props.handleSortField("name", value);
        } else if (field == "description") {
            this.props.handleSortField("description", value);
        } else if (field == "link") {
            this.props.handleSortField("link", value);
        }
    },
    _processSortClass: function (value) {
        var className = '';
        if (value === 1) {
            className = "fa fa-sort-asc fa-fw";
        } else if (value === -1) {
            className = "fa fa-sort-desc fa-fw";
        } else {
            className = "fa fa-sort fa-fw";
        }
        return className;
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
        this.props.divisions.map(function (division, index) {
            if (
                (keyword != "" && division.name.toLowerCase().indexOf(keyword.toLowerCase()) === -1) ||
                (status != "" && division.status != status)) {
            } else {
                rowFilter.push(division);
            }
        });
        rowFilter.map(function (division, index) {
            if (((currentPage - 1) * pageSize <= index) && (index < (currentPage * pageSize))) {
                rows.push(division);
            }
        });
        var divisionCount = rowFilter.length;
        var totalPage = parseInt((divisionCount / pageSize)) + 1;
        if (divisionCount >= pageSize && divisionCount % pageSize == 0) {
            totalPage = totalPage - 1;
        }
        var divisiondetail = rows.map(function (division, index) {
            var displayLabel = "";
            var displayInput = "none";
            var displayMainController = "";
            var displayChooseController = "none";
            var poiterEventMainController = "";
            var poiterChooseController = "";

            if (action !== "") {
                if (indexSelected == index) {
                    if (action == "delete") {
                        displayLabel = "";
                        displayInput = "none";
                    } else if (action == "add" || action == "edit") {
                        displayLabel = "none";
                        displayInput = "";
                    }
                    displayMainController = "none";
                    displayChooseController = "";
                    poiterEventMainController = "";
                    poiterChooseController = "";
                } else {
                    displayLabel = "";
                    displayInput = "none";
                    displayMainController = "";
                    displayChooseController = "none";
                    poiterEventMainController = "none";
                    poiterChooseController = "none";
                }
            }
            var displayImg = (division.logoTmp == 'data:image/jpeg;base64,\r\n') ? "none" : "";
            return (
                <tr key={division.id}>
                    <td style={{textAlign: 'center'}}>{index + 1}</td>
                    <td>
                        <div style={{display: displayLabel, textAlign: 'center'}}>{division.name}</div>
                        <input type="text"
                               style={{display: displayInput, width: '60px'}}
                               value={division.nameTmp}
                               onChange={self._handleName.bind(null, index)}
                        />
                    </td>
                    <td>
                        <div style={{display: displayLabel}}>{division.description}</div>
                        <input type="text"
                               style={{display: displayInput, width: '130px'}}
                               value={division.descriptionTmp}
                               onChange={self._handleDescription.bind(null, index)}
                        />
                    </td>
                    <td>
                        <div style={{display: displayLabel, textAlign: 'left'}}><a href={division.linkSite}
                                                                                   alt="#">{division.linkSite}</a></div>
                        <input type="text"
                               style={{display: displayInput, width: '330px'}}
                               value={division.linkSiteTmp}
                               onChange={self._handleLink.bind(null, index)}
                        />
                    </td>
                    <td style={{textAlign: 'center', padding: '10px 0px'}}>
                        <div style={{display: (division.logo == '\r\n') ? "none" : ""}}>
                            <div style={{display: displayLabel}}><img style={{width: '200px', height: '75px'}}
                                                                      src={"data:image/jpeg;base64," + division.logo}
                                                                      alt="TVi"/></div>
                        </div>
                        <input type="file" accept="image/*"
                               style={{display: displayInput, marginTop: '0px'}}
                               onChange={self._handleLogo.bind(null, "add", index)}
                        />
                        <div style={{display: (division.logoTmp == 'data:image/jpeg;base64,\r\n') ? "none" : ""}}>
                            <img id="output" src={division.logoTmp}
                                 style={{display: displayInput, width: '200px', height: '75px'}}/>
                            <span
                                style={{display: displayInput}}
                                onClick={self._handleLogo.bind(null, "delete", index)}
                            ><i className="glyphicon glyphicon-remove"/></span>
                        </div>

                    </td>
                    <td style={{textAlign: 'center'}}>
                        <div
                            className={division.status == "0" ? "label label-success" : "label label-warning"}
                            style={{display: displayLabel}}>{division.status == "0" ? 'Active' : 'Inactive'}
                        </div>
                        <select
                            style={{display: displayInput}}
                            value={division.statusTmp}
                            onChange={self._handleStatus.bind(null, index)}
                        >
                            <option value="0">Active</option>
                            <option value="1">Inactive</option>
                        </select>
                    </td>
                    <td className="text-center"
                        style={{
                            display: displayMainController,
                            textAlign: 'center',
                            pointerEvents: poiterEventMainController
                        }}
                    >
                        <div className="btn btn-primary btn-circle edit" title=""
                             onClick={self._handleMainAction.bind(null, "edit", index)}>
                            <i className="glyphicon glyphicon-edit"/>
                        </div>
                        <div className="btn btn-danger btn-circle"
                             onClick={self._handleMainAction.bind(null, "delete", index)}>
                            <i className="glyphicon glyphicon-trash"/>
                        </div>
                    </td>
                    <td className="text-center"
                        style={{
                            display: displayChooseController,
                            textAlign: 'center',
                            pointerEvents: poiterChooseController
                        }}>
                        <div className="btn btn-success btn-circle" title=""
                             onClick={self._handleChooseAction.bind(null, division, 1, action)}>
                            <i className="glyphicon glyphicon-ok"/>
                        </div>
                        <div className="btn btn-danger btn-circle"
                             onClick={self._handleChooseAction.bind(null, division, 0, action)}>
                            <i className="glyphicon glyphicon-remove"/>
                        </div>
                    </td>
                </tr>
            )
        });
        return (
            <div>
                <div className="table-responsive top-border-table"
                     style={{borderBottom: '1px solid #e7e7e7'}} id="users-table-wrapper">
                    <table className="table fixed logo" style={{tableLayout: 'fixed'}}>
                        <thead>
                        <tr>
                            <th width="10px" style={{textAlign: 'center'}}>
                                STT
                            </th>
                            <th width="18px" style={{textAlign: 'center'}}>
                                Name
                                <span
                                    onClick={this._handleSortField.bind(null, "name", self.props.sortAction.sortName)}>
                                    <i className={this._processSortClass(self.props.sortAction.sortName)}/>
                                </span>
                            </th>
                            <th width="30px">Description
                                <span
                                    onClick={this._handleSortField.bind(null, "description", self.props.sortAction.sortDescription)}>
                                    <i className={this._processSortClass(self.props.sortAction.sortDescription)}/>
                                </span>
                            </th>
                            <th width="70px">Link
                                <span
                                    onClick={this._handleSortField.bind(null, "link", self.props.sortAction.sortLink)}>
                                    <i className={this._processSortClass(self.props.sortAction.sortLink)}/>
                                </span>
                            </th>
                            <th width="70px" style={{textAlign: 'center'}}>Logo</th>
                            <th width="15px" style={{textAlign: 'center'}}>Status</th>
                            <th width="15px" className="text-center" style={{textAlign: 'center'}}>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        {divisiondetail}
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
var DivisionList = React.createClass({
        getInitialState: function () {
            return ({
                divisions: [],
                pageSize: 10,
                currentPage: 1,
                maxNumberPage: 5,
                keyword: '',
                status: '',
                selectAction: {
                    action: '',
                    indexSelected: -1,
                },
                sortAction: {
                    sortName: 0,
                    sortDescription: 0,
                    sortLink: 0
                }
            });
        },
        componentWillMount: function () {
            var data = {action: 'init'};
            this.loadDivisions(data);
        },
        loadDivisions: function (data) {
            var self = this;
            $.ajax
            ({
                type: "POST",
                url: self.props.url,
                data: data,
                datatype: 'json',
                success: function (data) {
                    var divisionTmp = JSON.parse(data);
                    //add default value for input field
                    var divisions = [];
                    divisionTmp.forEach(function (division) {
                        division.nameTmp = division.name;
                        division.descriptionTmp = division.description;
                        division.linkSiteTmp = division.linkSite;
                        division.logoTmp = "data:image/jpeg;base64," + division.logo;
                        division.statusTmp = division.status;
                        divisions.push(division);
                    });
                    //get info from first element
                    var action = divisions[0].action;
                    var statusProcess = divisions[0].statusProcess;
                    var msg;
                    if (action != "init") {
                        msg = action.charAt(0).toUpperCase() + action.slice(1) + " Record " + (statusProcess === "1" ? "Success" : "Fail") + "!!!";
                        this.handleMsgInfo(msg, statusProcess);
                    }
                    //delete first element
                    divisions.shift();
                    self.setState({
                        divisions: divisions,
                        selectAction: {
                            action: '',
                            indexSelected: -1
                        }
                    });
                }.bind(this),
                error: function (xhr, status, err) {
                    console.error(xhr, status, err.toString());
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
        handleAdd: function () {
            var divisions = this.state.divisions;
            var newDivision = {
                id: 0,
                name: '',
                description: '',
                linkSite: '',
                logo: '',
                status: '0',
                nameTmp: '',
                descriptionTmp: '',
                linkSiteTmp: '',
                logoTmp: '',
                statusTmp: '0',
            };
            divisions.unshift(newDivision);
            this.setState({
                divisions: divisions,
                selectAction: {
                    action: 'add',
                    indexSelected: 0,
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
        handleMainAction: function (action, index) {
            this.setState({
                selectAction: {
                    action: action,
                    indexSelected: index,
                }
            });
        },
        handleChooseAction: function (division, doAction, action) {
            var selectAction = {
                action: '',
                indexSelected: -1,
            };
            var data = {};
            if (doAction === 0) {
                if (action == "add") {
                    var divisions = this.state.divisions;
                    divisions.shift();
                    this.setState({
                        divisions: divisions,
                        selectAction: selectAction
                    });
                } else {
                    this.setState({selectAction: selectAction});
                }
            } else if (action == "add") {
                var msg = '';
                var statusProcess = 1;
                if (division.nameTmp !== "") {
                    division.name = division.nameTmp;
                    division.description = division.descriptionTmp;
                    division.linkSite = division.linkSiteTmp;
                    division.logo = division.logoTmp;
                    division.status = division.statusTmp;
                    data = {
                        action: 'add',
                        division: division
                    };
                    this.loadDivisions(data);
                } else {
                    msg = "Please Fill Fields: " + (division.nameTmp == "" ? "Name Division" : "");
                    statusProcess = 0;
                    this.handleMsgInfo(msg, statusProcess);
                }
            } else if (action == "edit") {
                if (division.nameTmp !== "") {
                    division.name = division.nameTmp;
                    division.description = division.descriptionTmp;
                    division.linkSite = division.linkSiteTmp;
                    division.logo = division.logoTmp;
                    division.status = division.statusTmp;
                    data = {
                        action: 'edit',
                        division: division
                    };
                    this.loadDivisions(data);
                }
                else {
                    msg = "Please Fill Fields: " + (division.nameTmp == "" ? "Name Division" : "");
                    statusProcess = 0;
                    this.handleMsgInfo(msg, statusProcess)
                }
            } else if (action == "delete") {
                data = {
                    action: 'delete',
                    division: division
                };
                this.loadDivisions(data);
            }

        },
        handleField: function (field, value, index) {
            var divisions = this.state.divisions;
            if (field == "name") {
                divisions[index].nameTmp = value;
            } else if (field == "description") {
                divisions[index].descriptionTmp = value;
            } else if (field == "logo") {
                divisions[index].logoTmp = value;
            } else if (field == "link") {
                divisions[index].linkSiteTmp = value;
            } else if (field == "status") {
                divisions[index].statusTmp = value;
            }
            this.setState({
                divisions: divisions,
            })
        }
        ,
        handleSortField: function (field, value) {
            var divisions = this.state.divisions;
            var sortAction = {
                sortName: 0,
                sortDescription: 0,
                sortLink: 0
            };
            var val = 0;
            var sortType = '';
            if (value == 0) {
                val = -1;
                sortType = "desc";
            } else if (value == -1) {
                val = 1;
                sortType = "asc";
            }
            if (field == "name") {
                sortAction.sortName = val;
            } else if (field == "description") {
                sortAction.sortDescription = val;
            } else if (field == "link") {
                sortAction.sortLink = val;
            }

            if (val != 0) {
                divisions = divisions.sort(function (a, b) {
                    var fieldA = "";
                    var fieldB = "";

                    if (field == "name") {
                        fieldA = a.name.toLowerCase();
                        fieldB = b.name.toLowerCase();
                        sortAction.sortName = val;
                    } else if (field == "description") {
                        fieldA = a.description.toLowerCase();
                        fieldB = b.description.toLowerCase();
                        sortAction.sortDescription = val;
                    } else if (field == "link") {
                        fieldA = a.linkSite.toLowerCase();
                        fieldB = b.linkSite.toLowerCase();
                        sortAction.sortLink = val;
                    }
                    if (sortType == "asc") {
                        if (fieldA < fieldB)
                            return -1;
                        if (fieldA > fieldB)
                            return 1;
                    } else if (sortType == "desc") {
                        if (fieldA < fieldB)
                            return 1;
                        if (fieldA > fieldB)
                            return -1;
                    }
                    return 0;
                });
            } else {
                divisions = divisions.sort(function (a, b) {
                    var fieldA = a.id;
                    var fieldB = b.id;
                    if (fieldA < fieldB)
                        return -1;
                    if (fieldA > fieldB)
                        return 1;
                    return 0;
                });
            }
            this.setState({
                sortAction: sortAction,
                divisions: divisions
            })
        }
        ,
        render: function () {
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
                                    <Filter
                                        headerFilter={this.props.headerFilter}
                                        handleKeyWord={this.handleKeyWord}
                                        handleStatus={this.handleStatus}
                                        keyword={this.state.keyword}
                                        status={this.state.status}
                                        handleAdd={this.handleAdd}
                                        selectAction={this.state.selectAction}
                                    />
                                    <div style={{display: 'none', textAlign: 'center', padding: '5px', color: 'white'}}
                                         className="label-success msgInfo">
                                    </div>
                                    <Division divisions={this.state.divisions}
                                              pageSize={this.state.pageSize}
                                              currentPage={this.state.currentPage}
                                              maxNumberPage={this.state.maxNumberPage}
                                              handleChangePage={this.handleChangePage}
                                              keyword={this.state.keyword}
                                              status={this.state.status}
                                              handleAdd={this.handleAdd}

                                              selectAction={this.state.selectAction}
                                              handleMainAction={this.handleMainAction}
                                              handleChooseAction={this.handleChooseAction}
                                              handleField={this.handleField}
                                              handleSortField={this.handleSortField}
                                              sortAction={this.state.sortAction}
                                    />
                                </div>
                            </div>
                            <div id="loading" style={{textAlign: "center"}}></div>

                        </div>
                    </div>
                </div>

            );
        }
    })
    ;
//Division end

//login start
var Login = React.createClass({
    getInitialState: function () {
        return ({
            username: '',
            password: '',
            msg: ''
        });
    },
    _handleUsername: function (event) {
        this.setState({username: event.target.value})
    },
    _handlePassword: function (event) {
        this.setState({password: event.target.value})
    },
    _handleCookie: function (isLogin, role) {
        if (isLogin) {
            var username = this.state.username;
            this.props.handleCookie(isLogin, username, role);
        } else {
            $(".info").delay(3000).fadeOut('slow');
            this.setState({msg: "Invalid Username or Password"})
        }
    },
    handleLogin: function (event) {
        event.preventDefault();
        var username = this.state.username;
        var password = this.state.password;
        console.log(username, password);
        var data = {
            username: username,
            password: password
        };
        var self = this;
        $.ajax
        ({
            type: "POST",
            url: self.props.url,
            data: data,
            datatype: 'json',
            success: function (role) {
                if (role != "") {
                    this._handleCookie(true, role);
                } else {
                    this._handleCookie(false, role);
                }
            }.bind(this),
            error: function (xhr, status, err) {
                console.error(url, status, err.toString());
            }.bind(this)
        });
    },
    render: function () {
        var self = this;
        var displayMsg = "";
        if (this.props.isLogin) {
            displayMsg = 'none';
        }
        return (
            <div className="col-md-12 top-margin">
                <div className="container" style={{width: '400px'}}>
                    <div className="row">
                        <div className="col-md-12 center-block-e">
                            <div className="login-page-header">
                                Login Adminisrator
                            </div>
                            <div className="btn-warning info"
                                 style={{display: displayMsg, textAlign: 'center'}}>{self.state.msg}
                            </div>
                            <div className="login-page">
                                <div className="input-group">
                                        <span className="input-group-addon white-form-bg"><span><i
                                            className="glyphicon glyphicon-user"/></span></span>
                                    <input type="text" className="form-control" value={self.state.username}
                                           onChange={this._handleUsername}
                                           placeholder="Username"/>
                                </div>
                                <br/>

                                <div className="input-group">
                                        <span className="input-group-addon white-form-bg"><span><i
                                            className="glyphicon glyphicon-lock"/></span></span>
                                    <input type="password" name="pass" className="form-control"
                                           value={self.state.password}
                                           onChange={this._handlePassword}
                                           placeholder="Password"/>
                                </div>
                                <p className="decent-margin">
                                    <button className="btn btn-primary form-control" onClick={this.handleLogin}>
                                        Login
                                    </button>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        )
    }
});


//login end

var Menu = React.createClass({
    _handleMenuSelected(selected){
        "use strict";
        this.props.handleMenuSelected(selected);
    },
    render: function () {
        var self = this;
        var menuPage = [];
        var role = this.props.role;
        this.props.pageMenu.map(function (menu, index) {
            var className = "";
            var classSelect = "";
            if (menu == "Main") {
                className = "fa fa-dashboard fa-fw";
            } else if (menu == "Users Manager" && role == "ADMIN") {
                className = "fa fa-users fa-fw";
            } else if (menu == "Division Manager") {
                className = "fa fa-list-alt fa-fw";
            }
            if (index === self.props.selected) {
                classSelect = "active open";
            }
            if (menu != "Users Manager" || (menu == "Users Manager" && role == "ADMIN")) {
                menuPage.push(
                    <li className={classSelect} key={index} onClick={self._handleMenuSelected.bind(null, index)}>
                        <a href="#" className="">
                            <i className={className}/>{menu}
                        </a>
                    </li>
                );
            }
        });
        return (
            <div className="col-md-2">
                <div className="navbar-default sidebar" style={{border: 'none'}} role="navigation">
                    <div className="sidebar-nav navbar-collapse"
                         style={{marginTop: '-4px', borderTop: '1px solid #DCB7B7'}}>
                        <ul className="nav" id="side-menu">
                            <li className="sidebar-avatar" style={{borderBottom: '1px solid #DCB7B7'}}>
                                <div className="dropdown">
                                    <div>
                                        <img alt="image" className="img-circle" width="100%" style={{maxWidth: "200px"}}
                                             src="../img/logoAdmin.png"/>
                                    </div>
                                </div>
                            </li>
                            {menuPage}
                        </ul>
                    </div>
                </div>
            </div>
        );
    }
});

var PAGEMENU = ["Users Manager", "Division Manager"];
var Page = React.createClass({
    getInitialState: function () {
        return ({
            selected: 0,
            isLogin: false,
            role: ''
        });
    },
    componentWillMount: function () {
        var isLogin = false;
        var username = this.getCookie("username");
        var role = this.getCookie("role");
        if (username != "") {
            this.setCookie("username", username, 5);
            isLogin = true;
        }
        this.setState({isLogin: isLogin, role: role});
    },
    handleMenuSelected: function (selected) {
        this.setState({
            selected: selected,
        });
    },
    handleCookie: function (isLogin, username, role) {
        var selected = this.state.selected;
        if(role == "HR"){
            selected++;
        }
        if (isLogin) {
            this.setState({
                isLogin: isLogin,
                role: role,
                selected:selected
            });
            this.setCookie("username", username, 5);
            this.setCookie("role", role, 5);
        }
    },
    setCookie: function (cname, cvalue, exminutes) {
        var d = new Date();
        d.setTime(d.getTime() + (exminutes * 1 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + "; " + expires;
    },
    getCookie: function (cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    },
    render: function () {
        var component = [];
        if (!this.state.isLogin) {
            $("body").css("background", "url(img/bg2.jpg) #0F1F2D no-repeat center center fixed");
            component.push(<Login
                key="-1"
                url="../web/authenlogin"
                handleCookie={this.handleCookie}
                isLogin={this.state.isLogin}
            />);
        } else {
            $("body").css("background", "none");
            component.push(<Menu
                key="0"
                pageMenu={PAGEMENU}
                selected={this.state.selected}
                handleMenuSelected={this.handleMenuSelected}
                role={this.state.role}
            />);
            if (this.state.selected === 0) {
                component.push(<UserList
                    key="1"
                    url="../web/ajaxuser"
                    headerFilter="user"
                />)
            } else if (this.state.selected === 1) {
                component.push(<DivisionList
                    key="2"
                    url="../web/ajaxdivision"
                    headerFilter="division"
                />)
            }
        }
        return (
            <div>
                {component}
            </div>
        )
    }
});

var Filter = React.createClass({
    _handleKeyWord: function (event) {
        this.props.handleKeyWord(event.target.value);
    },
    _handleStatus: function (event) {
        this.props.handleStatus(event.target.value);
    },
    _handleAdd: function () {
        this.props.handleAdd();
    },
    render: function () {
        var pointerEvent = "";
        if (this.props.selectAction.action != '') {
            pointerEvent = 'none';
        }
        var filterName = '';
        if (this.props.headerFilter == "user") {
            filterName = 'username';
        } else if (this.props.headerFilter == "division") {
            filterName = 'division';
        }
        return (
            <div className="tv_filters"
                 style={{backgroundColor: 'transparent', paddingTop: '0px', marginTop: '7px', paddingBottom: '0px'}}>
                <div className="col-md-12"
                     style={{
                         color: '#39428C',
                         backgroundColor: 'rgb(245, 247, 253)',
                         marginBottom: '10px',
                         marginTop: '0px',
                         height: '75px'
                     }}>
                    <h2>MANAGER {this.props.headerFilter.toUpperCase()}</h2>
                </div>
                <div className="col-md-12" style={{backgroundColor: 'rgb(153, 186, 204)'}}>
                    <div className="col-md-2 addUser"
                         style={{float: 'left', padding: '10px 0'}}>
                        <span className="btn btn-success" id="add-user" onClick={this._handleAdd}
                              style={{pointerEvents: pointerEvent}}
                        >
                            <i className="glyphicon glyphicon-plus"/>
                            Add {this.props.headerFilter.toUpperCase()}
                        </span>
                    </div>
                    <div className="col-md-4" style={{float: 'right', padding: '10px 0'}}>
                        <div className="search_keywords col-md-7">
                            <input type="text" name="keyword" id="keyword" placeholder={"Nhập " + filterName}
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
ReactDOM.render(
    <Page
    />
    ,
    document.getElementById("container")
);