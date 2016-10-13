@extends('layout.skeleton') @section('content')
    <div class="row" id="users_groups">
        <div class="col-sm-5">
            <div class="ibox ">
                <div class="ibox-content">
                    <div class="tab-content full-height-scroll">
                        <div id="all_models" class="tab-pane active">
                            <div class="row m-b-lg">
                                <div class="col-lg-12 text-center">
                                    <h2>Все модели @{{ edit.title }} <a data-toggle="tab" href="#edit" v-on:click="NewModel()" class="btn btn-primary btn-xs" style="float: right;">ДОБАВИТЬ</a></h2>
                                    <div>
                                        <input type="text" v-model="search_model" placeholder="Поиск" class="input form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="client-detail">
                                <div class="full-height-scroll">
                                    <div class="project-list">
                                        <table class="table table-hover">
                                            <tbody>
                                            <tr v-for="model in models | orderBy 'created_at' -1 | filterBy search_model">
                                                <td class="project-title">
                                                    @{{ model.name }}
                                                </td>
                                                <td class="project-actions">
                                                    <a  data-toggle="tab" href="#edit" v-on:click="EditModel(model.id)" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i></a>
                                                    <a v-on:click="DeleteModel(model.id)"  class="btn btn-white btn-sm"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="models_for_marks" class="tab-pane">
                            <div class="row m-b-lg">
                                <div class="col-lg-12 text-center">
                                    <h2>Модели                               @{{ edit.title }} <a data-toggle="tab" href="#edit" v-on:click="NewModel()" class="btn btn-primary btn-xs" style="float: right;">ДОБАВИТЬ</a></h2>

                                    <div>
                                        <input type="text" v-model="search_model" placeholder="Поиск" class="input form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="client-detail">
                                <div class="full-height-scroll">
                                    <div class="project-list">
                                        <table class="table table-hover">
                                            <tbody>
                                            <tr v-for="model in models | orderBy 'created_at' -1 | filterBy search_model" v-if="model.mark_id == models_for_marks">
                                                <td class="project-title">
                                                    @{{ model.name }}
                                                </td>
                                                <td class="project-actions">
                                                    <a  data-toggle="tab" href="#edit" v-on:click="EditModel(model.id)" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i></a>
                                                    <a v-on:click="DeleteModel(model.id)"  class="btn btn-white btn-sm"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="edit" class="tab-pane">
                            <div class="row m-b-lg">
                                <div class="col-lg-12 text-center">
                                    <h2>@{{ edit.title }} <a data-toggle="tab" href="#edit" v-on:click="NewModel()" class="btn btn-primary btn-xs" style="float: right;">ДОБАВИТЬ</a></h2>
                                </div>
                            </div>
                            <div class="client-detail">
                                <div class="full-height-scroll">
                                    <div class="project-list">
                                        <div class="form-group">
                                            <label>Название</label>
                                            <input type="text" placeholder="Название" v-model="edit.name" class="form-control">
                                        </div>
                                        <div v-if="edit.type == 'models'" class="form-group">
                                            <label>Марка авто</label>
                                            <select class="form-control" v-model="edit.mark_id">
                                                <option v-for="mark in marks" value="@{{ mark.id }}">@{{ mark.name }}</option>
                                            </select>
                                        </div>
                                        <button data-toggle="tab" href="#all_models" v-on:click="SaveData()" class="btn btn-primary " type="button"><i class="fa fa-check"></i>&nbsp;Сохранить</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-7">
            <div class="ibox">
                <div class="ibox-content">
                    <h2>Марки авто
                        <a data-toggle="tab" href="#edit" v-on:click="NewMarks()" class="btn btn-primary btn-xs" style="float: right;">ДОБАВИТЬ</a></h2>
                    <div class="clients-list">
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="full-height-scroll">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <tbody>
                                            <tr v-for="mark in marks">
                                                <td><a data-toggle="tab" href="#models_for_marks" v-on:click="models_for_marks=mark.id" class="client-link">@{{ mark.name }}</a></td>
                                                <td class="project-actions">
                                                    <a data-toggle="tab" href="#edit" v-on:click="EditMarks(mark.id)" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i></a>
                                                    <a v-on:click="DeleteMarks(mark.id)"  class="btn btn-white btn-sm"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
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
            Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');

            new Vue({
                el: '#users_groups',
                data: {
                    models:{},
                    marks:{},
                    edit:{},
                    models_for_marks: ''
                },
                ready: function() {
                    this.ReloadData();
                },
                methods: {
                    ReloadData: function() {
                        this.$http.get('/api/mod_mark').then(function(response) {
                            this.models = response.json().models_auto;
                            this.marks = response.json().marks_auto;
                        });
                    },
                    DeleteMarks: function(id){
                        x = window.confirm("Вы хотите удалить марку авто?");
                        if (x) {
                            this.$http.post('/api/marks/delete/'+id).then(function(response) {
                                this.ReloadData();
                            });
                        }
                    },
                    DeleteModel: function(id){
                        x = window.confirm("Вы хотите удалить модель авто?");
                        if (x) {
                            this.$http.post('/api/models/delete/'+id).then(function(response) {
                                this.ReloadData();
                            });
                        }
                    },

                    EditMarks: function(id){
                        this.edit = {};
                        this.edit = this.marks[id];
                        this.edit.action = 'update';
                        this.edit.type = 'marks';
                        this.edit.title = 'Редактировать';
                        $('#edit').tab('show');
                    },
                    NewMarks: function(){
                        this.edit = {};
                        this.edit.action = 'add';
                        this.edit.type = 'marks';
                        this.edit.title = 'Новая марка';
                        $('#edit').tab('show');
                    },
                    EditModel: function(id){
                        this.edit = {};
                        this.edit = this.models[id];
                        this.edit.action = 'update';
                        this.edit.type = 'models';
                        this.edit.title = 'Редактировать';
                        $('#edit').tab('show');
                    },
                    NewModel: function(){
                        this.edit = {};
                        this.edit.action = 'add';
                        this.edit.type = 'models';
                        this.edit.title = 'Новая модель';
                        $('#edit').tab('show');
                    },
                    SaveData: function(){
                        action = this.edit.type;
                        this.$http.post('/api/'+action+'/edit', this.edit).then(function (response) {
                            this.ReloadData();
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



