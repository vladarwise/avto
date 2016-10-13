@extends('layout.skeleton') @section('content')

<div class="row animated fadeInRight">
    <div class="col-md-4">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Информация</h5>
            </div>
            <div>
                <div class="contact-box">
                        <div class="col-sm-12">
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
                            if($lic->info_page){
                            ?>
                                <?php echo $lic->info_page->lic_text; ?>
<div class="text-center">
                                <script type="text/javascript" src="https://zadarma.com/swfobject.js"></script>
                                <script type="text/javascript">
                                    var flashvars = {};
                                    flashvars.phone="362706";
                                    flashvars.img1="https://zadarma.com/images/but/call2_green_ru_free.png";
                                    flashvars.img2="https://zadarma.com/images/but/call2_green_ru_connecting.png";
                                    flashvars.img3="https://zadarma.com/images/but/call2_green_ru_reset.png";
                                    flashvars.img4="https://zadarma.com/images/but/call2_green_ru_error.png";
                                    var params = {};
                                    params.wmode="transparent";
                                    var attributes = {};
                                    swfobject.embedSWF("https://zadarma.com/pbutton.swf", "myAlternativeContent", "215", "138", "9.0.0", false, flashvars, params, attributes);
                                </script>
                                <div id="myAlternativeContent">
                                    <a href="http://www.adobe.com/go/getflashplayer">
                                        <img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" />
                                    </a>
                                </div>
</div>
                            <?php
                            }
                            }
                            ?>
                        </div>
                        <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Написать разработчику</h5>
            </div>
            <div class="ibox-content">
                <form class="form-horizontal" action="/info" method="post">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Ваш Email</label>
                        <div class="col-lg-10">
                            <input type="email" name="email" placeholder="Email" value="{{Auth::user()->email}}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Skype</label>
                        <div class="col-lg-10">
                            <input type="text" name="skype" placeholder="Skype" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Тема письма</label>
                        <div class="col-lg-10">
                            <input type="text" name="subject" placeholder="Тема письма" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Сообщение</label>
                        <div class="col-lg-10">
                            <textarea name="massagy" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12">
                            <button class="btn btn-primary block full-width m-b" type="submit">Отправить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>



@endsection
@section('content_scripts')
@endsection
@section('content_styles')
@endsection



