@extends('layout.skeleton') @section('content')
    <div class="row" id="users_groups">
        <div class="col-sm-7">
            <div class="ibox">
                <div class="ibox-content">
                    <h2>Пользователи <a data-toggle="tab" href="#edit" v-on:click="NewUser()"  class="btn btn-primary btn-xs" style="float: right;">ДОБАВИТЬ</a></h2>


                    <div class="clients-list">
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="full-height-scroll">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <tbody>
                                            <tr v-for="user in users">
                                                <td>@{{ user.name }}</td>
                                                <td class="contact-type"><i class="fa fa-user"> </i></td>
                                                <td>@{{ user.email }}</td>
                                                <td>@{{ user.type }}</td>
                                                <td class="project-actions">
                                                    <a data-toggle="tab" href="#edit" v-on:click="EditUser(user.id)" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i></a>
                                                    <a v-on:click="DeleteUser(user.id)"  class="btn btn-white btn-sm"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <nav>
                            <ul class="pagination">
                                <li v-if="pagination.current_page > 1">
                                    <a href="#" aria-label="Previous" @click.prevent="changePage(pagination.current_page - 1)">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '']">
                                    <a href="#" @click.prevent="changePage(page)">@{{ page }}</a>
                                </li>
                                <li v-if="pagination.current_page < pagination.last_page">
                                    <a href="#" aria-label="Next" @click.prevent="changePage(pagination.current_page + 1)">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-5">
            <div class="ibox ">
                <div class="ibox-content">
                    <div class="tab-content full-height-scroll">
                        <div id="edit" class="tab-pane active">
                            <div class="row m-b-lg">
                                <div class="col-lg-12 text-center">
                                    <h2>@{{ edit.title }}</h2>
                                </div>
                            </div>
                            <div class="client-detail">
                                <div class="full-height-scroll">
                                    <div class="project-list">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" placeholder="Email" v-model="edit.email" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Имя</label>
                                            <input type="text" placeholder="Имя" v-model="edit.name" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Пароль</label>
                                            <input type="text" placeholder="Пароль" v-model="edit.pass" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Права пользователя</label>
                                            <select class="form-control" v-model="edit.type">
                                                <option value="admin">Администратор</option>
                                                <option value="manager">Менеджер</option>
                                                <option value="user">Пользователь</option>
                                            </select>
                                        </div>
                                        <button data-toggle="tab" href="#groups-0" v-on:click="SaveData()" class="btn btn-primary " type="button"><i class="fa fa-check"></i>&nbsp;Сохранить</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('content_scripts')
    <script>
        $(document).ready(function() {
            Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content')
            new Vue({
                el: '#users_groups',
                data: {
                    pagination: {
                        total: 0,
                        per_page: 7,
                        from: 1,
                        to: 0,
                        current_page: 1
                    },
                    offset: 4,// left and right padding from the pagination <span>,just change it to see effects
                    users: {},
                    edit:{
                        title:'Новый пользователь'
                    }
                },
                ready: function () {
                    this.fetchItems(this.pagination.current_page);
                },
                computed: {
                    isActived: function () {
                        return this.pagination.current_page;
                    },
                    pagesNumber: function () {
                        if (!this.pagination.to) {
                            return [];
                        }
                        var from = this.pagination.current_page - this.offset;
                        if (from < 1) {
                            from = 1;
                        }
                        var to = from + (this.offset * 2);
                        if (to >= this.pagination.last_page) {
                            to = this.pagination.last_page;
                        }
                        var pagesArray = [];
                        while (from <= to) {
                            pagesArray.push(from);
                            from++;
                        }
                        return pagesArray;
                    }
                },
                methods: {
                    fetchItems: function (page) {
                        var data = {page: page};
                        this.$http.get('/api/users/?page=' + page).then(function (response) {
                            //look into the routes file and format your response
                            this.$set('users', response.data.users);
                            this.$set('pagination', response.data.pagination);
                        }, function (error) {
                            // handle error
                        });
                    },
                    changePage: function (page) {
                        this.pagination.current_page = page;
                        this.fetchItems(page);
                    },
                    DeleteUser: function (id) {
                        x = window.confirm("Вы хотите удалить пользователя?");
                        if (x) {
                            this.$http.post('/api/user/delete/'+id).then(function(response) {
                                this.fetchItems(this.pagination.current_page);
                            });
                        }
                    },
                    EditUser: function (id) {
                        this.edit={};
                        this.edit = this.users[id];
                        this.edit.title = 'Редактировать';
                        this.edit.action ='update';
                    },
                    NewUser: function (id) {
                        this.edit={};
                        this.edit.title = 'Новый пользователь';
                        this.edit.action ='add';
                    },
                    SaveData: function(){
                        this.$http.post('/api/user/edit', this.edit).then(function (response) {
                            this.fetchItems(this.pagination.current_page);
                        });
                    }
                }
            });
        });

    </script>

@endsection
@section('content_styles')
    <style>
        .clients-list .tab-pane{
            max-height: 360px;
        }
        .client-detail{
            max-height: 430px;
        }
        .clients-list .top20 {
            margin-top: 20px;
        }
    </style>
@endsection



