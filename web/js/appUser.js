var UserFilter = React.createClass({
    _handleKeyWord: function (event) {
        this.props.handleKeyWord(event.target.value);
    },
    _handleStatus: function (event) {
        this.props.handleStatus(event.target.value);
    },
    _handleAddUser: function (isAdd) {
        this.props.handleAddUser(isAdd);
    },
    render: function () {
        var pointerEvent = this.props.isAddUser ? 'none' : '';
        return (
            <div className="tv_filters" style={{backgroundColor: 'transparent'}}>
                <div className="col-md-12"
                     style={{textAlign: 'center', backgroundColor: '#fafafa', marginBottom: '10px'}}>
                    <h2>MANAGER USER</h2>
                    <hr style={{marginTop: '0', marginBottom: '10px'}}/>
                </div>
                <div className="col-md-12" style={{backgroundColor: '#99cce6',}}>
                    <div className="col-md-2" style={{float: 'left', padding: '10px 0', pointerEvents: pointerEvent}}
                         onClick={this._handleAddUser.bind(null, true)}>
                        <span className="btn btn-success" id="add-user">
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
                                    <option style={{color: '#C7C7CD'}} value="" disabled="disabled" hidden="hidden">Nhập
                                        status
                                    </option>
                                    <option value=""> </option>
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
    handleDeleteUser: function (id) {
        this.props.handleDelete(id);
    },
    handleEditUser: function (index) {
        $(".mainAction").css({"pointer-events": 'none'});
        $(".chooseAction").css({"pointer-events": 'none'});
        $($(".mainAction")[index]).css({"display": 'none'});
        $($(".chooseAction")[index]).css({"display": '', "pointer-events": ''});
        $($(".fieldinput1")[index]).val($($(".labeluser1")[index]).html());
        $($(".fieldinput2")[index]).val($($(".labeluser2")[index]).html())
        $($(".fieldinput3")[index]).val($($(".labeluser3")[index]).html());
        $($(".fieldinput4")[index]).val($($(".labeluser4")[index]).html());
        $($(".fieldinput5")[index]).val($($(".labeluser5")[index]).html());
        $($(".fieldinput6")[index]).val($($(".labeluser6")[index]).html());

        this.handleStyle("fieldinput", "", index);
        this.handleStyle("labeluser", "none", index);
    },

    resetEvent: function (index) {
        $(".mainAction").css({"pointer-events": ''});
        $(".chooseAction").css({"pointer-events": ''});
        $($(".mainAction")[index]).css({"display": '', "pointer-events": ''});
        $($(".chooseAction")[index]).css({"display": 'none'});
        this.handleStyle("fieldinput", "none", index);
        this.handleStyle("labeluser", "", index);
    },
    handleChooseAction: function (user, doUpdate, index, action) {
        var username = $($(".fieldinput1")[index]).val();
        if (doUpdate == "0") {
            this.resetEvent(index);

            if (action == "add") {
                this.props.handleAddUser(false);
            }
        } else if (username != "") {
            this.resetEvent(index);
            user['username'] = $($(".fieldinput1")[index]).val();
            user['password'] = $($(".fieldinput2")[index]).val();
            user['fullname'] = $($(".fieldinput3")[index]).val();
            user['email'] = $($(".fieldinput4")[index]).val();
            user['role'] = $($(".fieldinput5")[index]).val();
            user['status'] = $($(".fieldinput6")[index]).val();
            if (action == "edit") {
                this.props.handleEdit(user);
            } else if (action == "add") {
                this.props.handleAdd(user);
            }
        }

    },
    handleStyle: function (selector, isDisplay, index) {
        for (var i = 1; i <= 6; i++) {
            $($('.' + selector + i)[index]).css({"display": isDisplay});
        }
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
        var isAddUser = this.props.isAddUser;
        var userdetail = rows.map(function (user, index) {
            var displayLabel = "";
            var displayInput = "none";
            var action = "edit";
            if (isAddUser && user.id == 0) {
                $(".mainAction").css({"pointer-events": 'none'});
                displayLabel = "none";
                displayInput = "";
                action = "add";
            }
            return (
                <tr key={user.id}>
                    <td>{index + 1}</td>
                    <td>
                        <div className="labeluser1" style={{display: displayLabel}}>{user.username}</div>
                        <input type="text" className="fieldinput1" style={{display: displayInput}}/></td>
                    <td>
                        <div className="labeluser2" style={{display: displayLabel}}>{user.password}</div>
                        <input type="password" className="fieldinput2" style={{display: displayInput,maxWidth:'120px', padding:'0'}}/></td>
                    <td>
                        <div className="labeluser3" style={{display: displayLabel}}>{user.fullname}</div>
                        <input type="text" className="fieldinput3" style={{display: displayInput}}/></td>
                    <td>
                        <div className="labeluser4" style={{display: displayLabel}}>{user.email}</div>
                        <input type="text" className="fieldinput4" style={{display: displayInput}}/></td>
                    <td>
                        <div className="labeluser5" style={{display: displayLabel}}>{user.role}</div>
                        <select className="fieldinput5" style={{display: displayInput}}>
                            <option value="ADMIN">ADMIN</option>
                            <option value="MEMBER">MEMBER</option>
                        </select>
                    </td>
                    <td style={{textAlign: 'center'}}>
                            <div className={user.status == "0" ? "label label-success labeluser6" : "label label-warning labeluser6"}>{user.status == "0" ? 'Active' : 'Inactive'}</div>
                            <select className="fieldinput6" style={{display: displayInput}}>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                    </td>
                    <td className="text-center mainAction" style={{display: displayLabel,textAlign:'center'}}>
                        {/*<div className="btn btn-info btn-circle" title="">
                         <i className="fa fa-list"/>
                         </div>
                         <div className="btn btn-success btn-circle" title="">
                         <i className="glyphicon glyphicon-eye-open"/>
                         </div>*/}
                        <div className="btn btn-primary btn-circle edit" title=""
                             onClick={self.handleEditUser.bind(null, index)}>
                            <i className="glyphicon glyphicon-edit"/>
                        </div>
                        <div className="btn btn-danger btn-circle"
                             onClick={self.handleDeleteUser.bind(null, user.id)}>
                            <i className="glyphicon glyphicon-trash"/>
                        </div>
                    </td>
                    <td className="text-center chooseAction" style={{display: displayInput,textAlign:'center'}}>
                        <div className="btn btn-success btn-circle" title=""
                             onClick={self.handleChooseAction.bind(null, user, 1, index, action)}>
                            <i className="glyphicon glyphicon-ok"/>
                        </div>
                        <div className="btn btn-danger btn-circle"
                             onClick={self.handleChooseAction.bind(null, user, 0, index, action)}>
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
                    <table className="table fixed" style={{tableLayout:'fixed'}}>
                        <thead>
                        <tr>
                            <th width="10px">STT</th>
                            <th width="50px">Username</th>
                            <th width="30px">Password</th>
                            <th width="50px">FullName</th>
                            <th width="50px">E-Mail</th>
                            <th width="25px">Role</th>
                            <th width="25px" style={{textAlign:'center'}}>Status</th>
                            <th width="25px" className="text-center"  style={{textAlign:'center'}}>Action</th>
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
        }
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
var UserList = React.createClass({
    getInitialState: function () {
        return ({
            users: [],
            pageSize: 10,
            currentPage: 1,
            maxNumberPage: 5,
            keyword: '',
            status: '',
            isAddUser: false
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
                self.setState({
                    users: JSON.parse(data),
                    isAddUser: false
                });
            }.bind(this),
            error: function (xhr, status, err) {
                console.error(url, status, err.toString());
            }.bind(this)
        });
    },
    handleDelete: function (id) {
        var data = {
            action: 'delete',
            id: id
        };
        this.loadUsers(data);
    },
    handleEdit: function (user) {
        var data = {
            action: 'edit',
            user: user
        };
        this.loadUsers(data);
    },
    handleAdd: function (user) {
        var data = {
            action: 'add',
            user: user,
        };
        this.loadUsers(data);
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
        })
    },
    handleKeyWord: function (keyword) {
        this.setState({keyword: keyword});
    },
    handleStatus: function (status) {
        this.setState({status: status});
    },
    handleAddUser: function (isAdd) {
        var users = this.state.users;
        if (isAdd) {
            var newUser = {
                id: 0,
                username: '',
                fullname: '',
                email: '',
                ctime: ''
            };
            users.unshift(newUser);
            console.log(users);
        } else {
            users.shift();
        }
        this.setState({
            users: users,
            isAddUser: isAdd
        });

    },
    render: function () {
        var users = this.state.users;
        return (
            <div>
                <div className="userList">
                    <UserFilter
                        handleKeyWord={this.handleKeyWord}
                        handleStatus={this.handleStatus}
                        keyword={this.state.keyword}
                        status={this.state.status}
                        handleAddUser={this.handleAddUser}
                        isAddUser={this.state.isAddUser}
                    />
                    {<User users={this.state.users}
                           handleDelete={this.handleDelete}
                           handleEdit={this.handleEdit}
                           handleAdd={this.handleAdd}
                           pageSize={this.state.pageSize}
                           currentPage={this.state.currentPage}
                           maxNumberPage={this.state.maxNumberPage}
                           handleChangePage={this.handleChangePage}
                           keyword={this.state.keyword}
                           status={this.state.status}
                           isAddUser={this.state.isAddUser}
                           handleAddUser={this.handleAddUser}
                    />}
                </div>
            </div>
        );
    }
});
ReactDOM.render(
    <UserList
        url="../web/ajaxuser"
        initialPageLength={5}
        pageLengthOptions={[5, 20, 50]}
    />
    ,
    document.getElementById("container")
);