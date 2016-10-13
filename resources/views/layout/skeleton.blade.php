<!DOCTYPE html>
<!--suppress HtmlUnknownTarget -->
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <?php $page_title = 'Личный кабинет'?>
    <title>{{$page_title}}</title>
    <link rel="stylesheet" href="{{asset('/service/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/service/css/font-awesome.min.css')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{'/favicon.ico'}}">
    <link rel="stylesheet" href="{{asset('/service/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('/service/css/style.min.css')}}">
    <link rel="stylesheet" href="{{asset("/service/css/plugins/toastr/toastr.min.css")}}">
    <link rel="stylesheet" href="{{asset('/service/css/plugins/datapicker/datepicker3.css')}}">
    <link rel="stylesheet" href="{{asset('/service/css/plugins/footable/footable.core.css')}}">
    <link rel="stylesheet" href="{{asset('/service/css/plugins/bootstrap-multiselect/bootstrap-multiselect.css')}}">

    <link href="{{asset('/service/css/plugins/daterangepicker/daterangepicker-bs3.css')}}" rel="stylesheet">

    <link href="{{asset("/service/css/plugins/summernote/summernote.css")}}" rel="stylesheet">
    <link href="{{asset("/service/css/plugins/summernote/summernote-bs3.css")}}" rel="stylesheet">
    @yield('content_styles')
</head>
<body class="md-skin">
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="/service/images/users/default_profile.jpg" width="48"
                                 height="48"/>
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong
                                            class="font-bold">{{Auth::user()->name}}</strong>
                             </span>  </span> </a>

                            <a href="/logout">Выйти</a>

                    </div>
                    <div class="logo-element">
                        EM
                    </div>
                </li>
                <li class="{{Request::is('home')? 'active':''}}">
                    <a href="{{URL::to('/home')}}"><i class="fa fa-th-large"></i> <span
                                class="nav-label">Рабочий стол</span></a></li>
                <li class="{{Request::is('zapros')? 'active':''}}">
                    <a href="{{URL::to('/zapros')}}"><i class="fa fa-bars"></i> <span
                                class="nav-label">Технические запросы</span></a></li>
                <li class="{{Request::is('auto')? 'active':''}}">
                    <a href="{{URL::to('/auto')}}"><i class="fa fa-car"></i> <span
                                class="nav-label">Транспортные средства</span></a></li>
                <li class="{{Request::is('device')? 'active':''}}">
                    <a href="{{URL::to('/device')}}"><i class="fa fa-list-ul"></i> <span
                                class="nav-label">Управление оборудованием</span></a></li>
                @if(Auth::user()->type == 'admin')
                    <li class="{{Request::is('models')? 'active':''}} {{Request::is('users')? 'active':''}}">
                        <a href="#"><i class="fa fa-cogs"></i> <span class="nav-label">Настройки</span><span
                                    class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li class="{{Request::is('models')? 'active':''}}">
                                <a href="{{URL::to('/models')}}"><i class="fa fa-car"></i> <span
                                            class="nav-label">Модели и марки</span></a></li>
                            <li class="{{Request::is('users')? 'active':''}}">
                                <a href="{{URL::to('/users')}}"><i class="fa fa-users"></i> <span
                                            class="nav-label">Пользователи</span></a></li>

                            <li class="{{Request::is('main_text')? 'active':''}}">
                                <a href="{{URL::to('/main_text')}}"><i class="fa fa-cog"></i> <span
                                            class="nav-label">Другие настройки</span></a></li>
                        </ul>
                    </li>


                    <li class="{{Request::is('info')? 'active':''}}">
                        <a href="{{URL::to('/info')}}"><i class="fa fa-info"></i> <span
                                    class="nav-label">Информация о системе</span></a></li>


                @endif
            </ul>
        </div>
    </nav>
    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i>
                    </a>

                    <form role="search" class="navbar-form-custom" action="#">
                        <div class="form-group">
                            <input type="text" disabled placeholder="" class="form-control"
                                   name="top-search" id="top-search">
                        </div>
                    </form>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <span class="m-r-sm text-muted welcome-message">Добро пожаловать, {{Auth::user()->name}}
                            </span>
                    </li>
                    <li>
                        <a  href="/logout">
                            <i class="fa fa-sign-out"></i> Выйти
                        </a>
                    </li>
                </ul>

            </nav>
        </div>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-sm-4">
                <h2>{{$page_title}}</h2>
            </div>
        </div>

        <div class="wrapper wrapper-content">
<?php
                        $lic = '';
                        if( Cache::has('lic') ) {
                            $lic = Cache::get('lic');
                        }elseif(Cache::has('lic2')){
                            $lic = Cache::get('lic2');
                        }elseif(Cache::has('lic3')){
                            $lic = Cache::get('lic3');
                        }
                        $lic = json_decode($lic);
                        if($lic){
                            if($lic->show_ads){
                                ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-content">
                               <?php echo $lic->blocks->main_block; ?>

                </div>
            </div>
        </div>
    </div>
    <?php
                            }
                        }
?>

            @yield('content')

    <?php
    $lic = '';
    if( Cache::has('lic') ) {
        $lic = Cache::get('lic');
    }elseif(Cache::has('lic2')){
        $lic = Cache::get('lic2');
    }elseif(Cache::has('lic3')){
        $lic = Cache::get('lic3');
    }
    $lic = json_decode($lic);
    if($lic){
        if($lic->show_ads){
    ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-content">
                    <?php echo $lic->blocks->main_block2; ?>
                </div>
            </div>
        </div>
    </div>
    <?php
        }
    }
    ?>
        </div>
        <div class="footer">
            <div class="pull-right">
            </div>

            <?php
            $lic = '';
            if( Cache::has('lic') ) {
                $lic = Cache::get('lic');
            }elseif(Cache::has('lic2')){
                $lic = Cache::get('lic2');
            }elseif(Cache::has('lic3')){
                $lic = Cache::get('lic3');
            }
            $lic = json_decode($lic);
            if($lic){
            if($lic->copyright){
            ?>
            <div>
                <strong>Copyright</strong> <a href="http://wiseweb.pro">WiseWEB</a> &copy; 2016
            </div>
            <?php
            }
            }
            ?>


        </div>
    </div>
</div>

<!-- Mainly scripts -->
<script type="text/javascript" src="{{asset('/service/js/jquery-2.1.1.js')}}"></script>
<script type="text/javascript" src="{{asset('/service/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/service/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
<script type="text/javascript" src="{{asset('/service/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
<script type="text/javascript" src="{{asset("/service/js/plugins/toastr/toastr.min.js")}}"></script>
<script type="text/javascript" src="{{asset("/service/js/plugins/jquery.inputmask/inputmask/inputmask.min.js")}}"></script>
<script type="text/javascript" src="{{asset("/service/js/plugins/jquery.inputmask/inputmask/jquery.inputmask.min.js")}}"></script>
<script type="text/javascript" src="{{asset("/service/js/plugins/iCheck/icheck.min.js")}}"></script>
<script type="text/javascript" src="{{asset("/service/js/plugins/bootstrap-multiselect/bootstrap-multiselect.js")}}"></script>
<!-- Custom and plugin javascript -->
<script type="text/javascript" src="{{asset("/service/js/plugins/daterangepicker/daterangepicker.js")}}"></script>
<script type="text/javascript" src="{{asset('/service/js/inspinia.js')}}"></script>
<script type="text/javascript" src="{{asset('/service/js/plugins/pace/pace.min.js')}}"></script>
<script type="text/javascript" src="{{asset("/service/js/scopes/global/insolution.js")}}"></script>

<script src="{{asset("/service/js/plugins/datapicker/bootstrap-datepicker.js")}}"></script>
<script src="{{asset("/service/js/plugins/jasny/jasny-bootstrap.min.js")}}"></script>
<script src="{{asset("/service/js/plugins/summernote/summernote.min.js")}}"></script>
<script type="text/javascript" src="{{asset('/service/js/vue.js')}}"></script>
<script type="text/javascript" src="{{asset("/service/js/vue-resource.js")}}"></script>



@yield('content_scripts')
</body>
</html>
