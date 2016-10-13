<?php $page_title = '';?>
@extends('layout.skeleton')
@section('content')
    <div class="row">
        <div class="panel">
            <div class="panel-body">
                <div class="col-lg-3">
                    <div class="widget style1 navy-bg">
                        <div class="row">
                            <div class="col-xs-4">
                                <i class="fa fa-car fa-5x"></i>
                            </div>
                            <div class="col-xs-8 text-right">
                                <span> Транспортных средств </span>
                                <h2 class="font-bold">
                                    @if(Auth::user()->type == 'admin' or Auth::user()->type == 'manager')
                                        <?php echo App\Models\Auto::count(); ?>
                                    @else
                                        <?php echo App\Models\Auto::where('user_id',Auth::user()->id)->count(); ?>
                                    @endif
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="widget style1 red-bg">
                        <div class="row">
                            <div class="col-xs-4">
                                <i class="fa fa-cloud fa-5x"></i>
                            </div>
                            <div class="col-xs-8 text-right">
                                <span> Новые запросы </span>
                                <h2 class="font-bold">
                                    @if(Auth::user()->type == 'admin' or Auth::user()->type == 'manager')
                                        <?php echo App\Models\Zapros::where('done','0')->count(); ?>
                                    @else
                                        <?php echo App\Models\Zapros::where('user_id',Auth::user()->id)->where('done','0')->count(); ?>
                                    @endif
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="widget style1 yellow-bg">
                        <div class="row">
                            <div class="col-xs-4">
                                <i class="fa fa-cloud fa-5x"></i>
                            </div>
                            <div class="col-xs-8 text-right">
                                <span> Запросы в работе </span>
                                <h2 class="font-bold">
                                    @if(Auth::user()->type == 'admin' or Auth::user()->type == 'manager')
                                        <?php echo App\Models\Zapros::where('done','1')->count(); ?>
                                    @else
                                        <?php echo App\Models\Zapros::where('user_id',Auth::user()->id)->where('done','1')->count(); ?>
                                    @endif
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="widget style1 navy-bg">
                        <div class="row">
                            <div class="col-xs-4">
                                <i class="fa fa-cloud fa-5x"></i>
                            </div>
                            <div class="col-xs-8 text-right">
                                <span> Завершенные запросы </span>
                                <h2 class="font-bold">
                                    @if(Auth::user()->type == 'admin' or Auth::user()->type == 'manager')
                                        <?php echo App\Models\Zapros::where('done','2')->count(); ?>
                                    @else
                                        <?php echo App\Models\Zapros::where('user_id',Auth::user()->id)->where('done','2')->count(); ?>
                                    @endif</h2>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>



        <div class="row" id="avto">
            <div class="col-sm-8">
                <div class="ibox">
                    <div class="ibox-content">
                        <h2>Технические запросы
                            <a data-toggle="tab" href="#edit" v-on:click="New()"  class="btn btn-primary btn-xs" style="float: right;">ДОБАВИТЬ</a>
                            <a href="/print/zaproses"  class="btn btn-primary btn-xs" style="float: right;margin-right: 10px;">ПЕЧАТЬ</a>
                        </h2>
                        <div class="clients-list">
                            <div class="tab-content">
                                <div id="tab-1" class="tab-pane active">
                                    <div class="full-height-scroll">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                <tr>
                                                    <th>Дата</th>
                                                    @if(Auth::user()->type != 'user')<th>ФИО</th>@endif
                                                    <th>Объект</th>
                                                    <th>Здание</th>
                                                    <th>Комментарий техника</th>
                                                    <th>Статус</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr v-for="var in zapros">
                                                    <td>@{{ var.created_at }}</td>
                                                    @if(Auth::user()->type != 'user')<td>@{{ var.user.name }}</td>@endif
                                                    <td>@{{ var.object}}</td>
                                                    <td>@{{ var.zadanie}}</td>
                                                    <td>@{{ this.kitcut(var.comments_tehnics)}}</td>
                                                    <td>
                                                        <span v-if="!var.done"  class="label label-danger">NEW</span>
                                                        <span v-if="var.done == '1'"  class="label label-warning">В процессе</span>
                                                        <span v-if="var.done == '2'" class="label label-primary">Завершен</span>
                                                    </td>
                                                    <td class="project-actions">
                                                        @if(Auth::user()->type == 'user')
                                                            <a data-toggle="tab" href="#edit" v-on:click="Viwe_zapros(var.id)"  class="btn btn-white btn-sm"><i class="fa fa-eye"></i></a>
                                                            <a v-if="var.done == '2'" v-on:click="Delete(var.id)"  class="btn btn-white btn-sm"><i class="fa fa-trash"></i></a>
                                                            <a v-if="!var.done" v-on:click="Delete(var.id)"  class="btn btn-white btn-sm"><i class="fa fa-trash"></i></a>
                                                        @endif
                                                        @if(Auth::user()->type == 'admin' or Auth::user()->type == 'manager')
                                                            <a data-toggle="tab" href="#edit" v-on:click="Edit(var.id)" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i></a>
                                                            <a v-on:click="Delete(var.id)"  class="btn btn-white btn-sm"><i class="fa fa-trash"></i></a>
                                                        @endif
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
                                        <h2>@{{ edit.title }}
                                            <a v-if="edit.action =='update'" href="/print/zapros/@{{ edit.id }}"  class="btn btn-primary btn-xs" style="float: right;margin-right: 10px;">ПЕЧАТЬ</a>
                                            <a  v-if="edit.viwes" href="/print/zapros/@{{ edit.id }}"  class="btn btn-primary btn-xs" style="float: right;margin-right: 10px;">ПЕЧАТЬ</a>

                                        </h2>
                                    </div>
                                </div>
                                <div class="client-detail">
                                    <div class="full-height-scroll">
                                        <div v-if="!edit.viwes" class="project-list">
                                            <div class="form-group">
                                                <label>Здание</label>
                                                <input type="text" placeholder="" v-model="edit.zadanie" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Объект</label>
                                                <input type="text" placeholder="" v-model="edit.object" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Описание проблемы</label>
                                                <textarea v-model="edit.description"  class="form-control"></textarea>
                                            </div>
                                            @if(Auth::user()->type != 'user')
                                                <div class="form-group">
                                                    <label>Коментарий техника</label>
                                                    <textarea v-model="edit.comments_tehnics"  class="form-control"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Статус</label>
                                                    <select class="form-control" v-model="edit.done">
                                                        <option value="0">Новый</option>
                                                        <option value="1">В процессе</option>
                                                        <option value="2">Завершен</option>
                                                    </select>
                                                </div>
                                            @endif
                                            <button data-toggle="tab" href="#groups-0" v-on:click="SaveData()" class="btn btn-primary " type="button"><i class="fa fa-check"></i>&nbsp;Сохранить</button>
                                        </div>

                                        <div v-if="edit.viwes" class="project-list">
                                            <div class="form-group">
                                                <label>Дата добавления:</label><br>
                                                @{{ edit.created_at }}
                                            </div>
                                            <div class="form-group">
                                                <label>Статус</label>
                                                <br>
                                                <span v-if="!edit.done"  class="label label-danger">NEW</span>
                                                <span v-if="edit.done == '1'"  class="label label-warning">В процессе</span>
                                                <span v-if="edit.done == '2'" class="label label-primary">Завершен</span>
                                            </div>
                                            <div class="form-group">
                                                <label>Здание:</label><br>
                                                @{{ edit.zadanie }}
                                            </div>
                                            <div class="form-group">
                                                <label>Объект</label><br>
                                                @{{ autos[edit.auto.mark_id].name}}
                                            </div>
                                            <div class="form-group">
                                                <label>Описание проблемы</label><br>
                                                @{{ edit.description }}
                                            </div>
                                            <div class="form-group">
                                                <label>Коментарий техника</label>
                                                <br>
                                                @{{ edit.comments_tehnics }}
                                            </div>
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
                            zapros: {},
                            edit:{
                                title:'Добавить',
                                viwes:''
                            },
                            autos:{}
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
                                this.$http.get('/zaprosApi/?page=' + page).then(function (response) {
                                    //look into the routes file and format your response
                                    this.$set('zapros', response.data.zapros);
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
                                x = window.confirm("Вы хотите удалить?");
                                if (x) {
                                    this.$http.post('/zaprosApi/delete/'+id).then(function(response) {
                                        this.fetchItems(this.pagination.current_page);
                                    });
                                }
                            },
                            Edit: function (id) {
                                this.edit={};
                                this.edit = this.zapros[id];
                                this.edit.title = 'Редактировать';
                                this.edit.action ='update';
                                this.edit.viwes = '';
                            },
                            Viwe_zapros: function (id) {
                                this.edit={};
                                this.edit = this.zapros[id];
                                this.edit.title = 'Просмотр';
                                this.edit.viwes = '1';
                            },
                            New: function (id) {
                                this.edit={};
                                this.edit.title = 'Добавить';
                                this.edit.action ='add';
                                this.edit.viwes = '';
                            },
                            SaveData: function(){
                                this.edit.user_id = '{{Auth::user()->id}}';
                                this.$http.post('/zaprosApi/edit', this.edit).then(function (response) {
                                    this.fetchItems(this.pagination.current_page);
                                });
                            },
                            kitcut: function (text) {
                                text = text.trim();
                                if( text.length <= 40) return text;
                                text = text.slice( 0, 40); // тупо отрезать по лимиту
                                lastSpace = text.lastIndexOf(" ");
                                if( lastSpace > 0) { // нашлась граница слов, ещё укорачиваем
                                    text = text.substr(0, lastSpace);
                                }
                                return text + "...";
                            }
                        }
                    });
                });

            </script>
@endsection
@section('content_styles')
@endsection