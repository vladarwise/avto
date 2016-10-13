@extends('layout.skeleton') @section('content')
    <div class="row" id="avto">
        <div class="col-sm-8">
            <div class="ibox">
                <div class="ibox-content">
                    <h2>Оборудование <a data-toggle="tab" href="#edit" v-on:click="New()"  class="btn btn-primary btn-xs" style="float: right;">ДОБАВИТЬ</a></h2>
                    <div class="clients-list">
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="full-height-scroll">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th>Категория</th>
                                                <th>Марка</th>
                                                <th>Модель</th>
                                                <th>Версия</th>
                                                <th>Год</th>
                                                <th>Дата след. тех. контроля</th>
                                                <th>Дата след. ремонта</th>
                                                <th>Ремонт час.</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="var in devices">
                                                <td>@{{ var.category }}</td>
                                                <td>@{{ var.mark.name }}</td>
                                                <td>@{{ var.model.name}}</td>
                                                <td>@{{ var.version}}</td>
                                                <td>@{{ var.year}}</td>
                                                <td>@{{ var.date_kont}}</td>
                                                <td>@{{ var.date_rem}}</td>
                                                <td>@{{ var.rem_time}}</td>
                                                <td class="project-actions">
                                                    <a data-toggle="tab" href="#edit" v-on:click="Edit(var.id)" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i></a>
                                                    <a v-on:click="Delete(var.id)"  class="btn btn-white btn-sm"><i class="fa fa-trash"></i></a>
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
        <div class="col-sm-4">
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
                                            <label>Категория</label>
                                            <input type="text" v-model="edit.category" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Марка</label>
                                            <select class="form-control" v-model="edit.mark_id">
                                                <option v-for="mark in marks" value="@{{ mark.id }}">@{{ mark.name }}</option>
                                            </select>
                                        </div>
                                        <div v-if='edit.mark_id' class="form-group">
                                            <label>Модель</label>
                                            <select class="form-control" v-model="edit.model_id">
                                                <option v-for="model in marks[edit.mark_id].models_auto" value="@{{ model.id }}">@{{ model.name }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Версия</label>
                                            <input type="text" v-model="edit.version" class="form-control">
                                        </div>
                                        <div class="form-group" id="data_year">
                                            <label>Год</label>
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input type="text" class="form-control" data-mask="9999" v-model="edit.year">
                                            </div>
                                        </div>

                                        <div class="form-group" id="data_1">
                                            <label>Дата следующего тех контроля</label>
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input type="text" class="form-control" v-model="edit.date_kont">
                                            </div>
                                        </div>
                                        <div class="form-group" id="data_2">
                                            <label>Дата следующего ремонта</label>
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input type="text" class="form-control" v-model="edit.date_rem">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Ремонт часов</label>
                                            <input type="text" v-model="edit.rem_time" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Коментарий</label>
                                            <textarea v-model="edit.comments"  class="form-control"></textarea>
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
                el: '#avto',
                data: {
                    pagination: {
                        total: 0,
                        per_page: 7,
                        from: 1,
                        to: 0,
                        current_page: 1
                    },
                    offset: 4,// left and right padding from the pagination <span>,just change it to see effects
                    devices: {},
                    edit:{
                        title:'Добавить'
                    },
                    marks:{}
                },
                ready: function () {
                    this.fetchItems(this.pagination.current_page);
                    this.ReloadData();
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
                    ReloadData: function() {
                        this.$http.get('/marks_with').then(function(response) {
                            this.marks = response.json().marks;
                        });
                    },
                    fetchItems: function (page) {
                        var data = {page: page};
                        this.$http.get('/deviceApi/?page=' + page).then(function (response) {
                            //look into the routes file and format your response
                            this.$set('devices', response.data.devices);
                            this.$set('pagination', response.data.pagination);
                        }, function (error) {
                            // handle error
                        });
                    },
                    changePage: function (page) {
                        this.pagination.current_page = page;
                        this.fetchItems(page);
                    },
                    Delete: function (id) {
                        x = window.confirm("Вы хотите удалить данное оборудование?");
                        if (x) {
                            this.$http.post('/deviceApi/delete/'+id).then(function(response) {
                                this.fetchItems(this.pagination.current_page);
                            });
                        }
                    },
                    Edit: function (id) {
                        this.edit={};
                        this.edit = this.devices[id];
                        this.edit.title = 'Редактировать';
                        this.edit.action ='update';
                    },
                    New: function (id) {
                        this.edit={};
                        this.edit.title = 'Добавить';
                        this.edit.action ='add';
                    },
                    SaveData: function(){
                        this.edit.user_id = '{{Auth::user()->id}}';
                        this.$http.post('/deviceApi/edit', this.edit).then(function (response) {
                            this.fetchItems(this.pagination.current_page);
                        });
                    }
                }
            });
        });
        $('#data_1 .input-group.date').datepicker({
            todayBtn: "linked",
            format: 'yyyy-mm-dd',
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });
        $('#data_2 .input-group.date').datepicker({
            todayBtn: "linked",
            format: 'yyyy-mm-dd',
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
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