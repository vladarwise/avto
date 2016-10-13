<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Models\ModelsAuto;
use App\Models\MarksAuto;
use App\Models\Device;
use App\Models\Auto;
use App\Models\Zapros;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Input;
use Hash;
use Auth;
use Mockery\CountValidator\Exception;

class AdminsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('home');
    }
    public function users(){
        return view('app.users');
    }
    public function models(){
        return view('app.models');
    }
    public function apiUsers(){
        $results =  User::latest()->paginate(20);
        $results1 = array();
        foreach ($results as $result){
            $results1[$result->id] = $result;
        }
        $response = [
            'pagination' => [
                'total' => $results->total(),
                'per_page' => $results->perPage(),
                'current_page' => $results->currentPage(),
                'last_page' => $results->lastPage(),
                'from' => $results->firstItem(),
                'to' => $results->lastItem()
            ],
            'users' => $results1
        ];
        return $response;
    }
    public function deleteUser(Request $request){
        User::find($request->id)->delete();
    }
    public function EditUser(){
        if(Input::get('id')){
            $user = User::find(Input::get('id'));
            $user->name = Input::get('name');
            $user->email = Input::get('email');
            $user->type = Input::get('type');
            if(Input::get('pass')){
                $user->password = Hash::make(Input::get('pass'));
            }
            $user->save();
        }else{
            $user = array();
            $user['name'] = Input::get('name');
            $user['email'] = Input::get('email');
            $user['type'] = Input::get('type');
            $user['password'] = Hash::make(Input::get('pass'));
            User::create($user);
        }
    }
    public function apiModMark(){
        $results =  ModelsAuto::all();
        $results1 = array();
        foreach ($results as $result){
            $results1[$result->id] = $result;
        }
        $results =  MarksAuto::all();
        $results2 = array();
        foreach ($results as $result){
            $results2[$result->id] = $result;
        }
        $response = [
            'models_auto' => $results1,
            'marks_auto' => $results2
        ];
        return $response;
    }
    public function apiMarksWithModels(){
        $results =  MarksAuto::all();
        $results->load('models_auto');
        $results2 = array();
        foreach ($results as $result){
            $results2[$result->id] = $result;
        }
        $response = [
            'marks' => $results2
        ];
        return $response;
    }
    public function DeleteMarks(Request $request){
        MarksAuto::find($request->id)->delete();
        ModelsAuto::where('mark_id', $request->id)->delete();
    }
    public function DeleteModels(Request $request){
        ModelsAuto::find($request->id)->delete();
    }
    public function EditMarks(){
        if(Input::get('id')){
            MarksAuto::find(Input::get('id'))->update(Input::all());
        }else{
            MarksAuto::create(Input::all());
        }
    }
    public function EditModels(){
        if(Input::get('id')){
            ModelsAuto::find(Input::get('id'))->update(Input::all());
        }else{
            ModelsAuto::create(Input::all());
        }
    }
    public function autoApiMy(){
        $results =  Auto::Where('user_id', Auth::user()->id)->get();
        $results->load('model','mark','user');
        $results1 = array();
        foreach ($results as $result){
            $results1[$result->id] = $result;
        }
        $response = [
            'autos' => $results1
        ];
        return $response;
    }
    public function autoPage(){
        return view('app.auto');
    }
    public function autoApi(){
        $results = '';
        if(Auth::user()->type == 'admin'){
            $results =  Auto::latest()->paginate(20);
        }elseif(Auth::user()->type == 'manager'){
            $results =  Auto::Where('user_id', Auth::user()->id)->paginate(20);
        }elseif(Auth::user()->type == 'user'){
            $results =  Auto::Where('user_id', Auth::user()->id)->paginate(20);
        }
        $results->load('model','mark','user');
        $results1 = array();
        foreach ($results as $result){
            $results1[$result->id] = $result;
        }
        $response = [
            'pagination' => [
                'total' => $results->total(),
                'per_page' => $results->perPage(),
                'current_page' => $results->currentPage(),
                'last_page' => $results->lastPage(),
                'from' => $results->firstItem(),
                'to' => $results->lastItem()
            ],
            'autos' => $results1
        ];
        return $response;
    }
    public function autoDelete(Request $request){
        if (Auth::user()->type == 'admin') {
            Auto::find($request->id)->delete();
        }elseif(Auto::find($request->id)->user_id == Auth::user()->id){
            Auto::find($request->id)->delete();
        }
    }
    public function autoEdit(){
        if(Input::get('id')){
            if (Auth::user()->type == 'admin') {
                Auto::find(Input::get('id'))->update(Input::all());
            }elseif(Auto::find(Input::get('id'))->user_id == Auth::user()->id){
                $auto = Auto::find(Input::get('id'))->update(Input::all());
                $auto->user_id = Auth::user()->id;
                $auto->save();
            }
        }else{
            $auto = Auto::create(Input::all());
            $auto->user_id = Auth::user()->id;
            $auto->save();
        }
    }
    public function devicePage(){
        return view('app.device');
    }
    public function deviceApi(){
        $results = '';
        if(Auth::user()->type == 'admin'){
            $results =  Device::latest()->paginate(20);
        }elseif(Auth::user()->type == 'manager'){
            $results =  Device::Where('user_id', Auth::user()->id)->paginate(20);
        }elseif(Auth::user()->type == 'user'){
            $results =  Device::Where('user_id', Auth::user()->id)->paginate(20);
        }
        $results->load('model','mark','user');
        $results1 = array();
        foreach ($results as $result){
            $results1[$result->id] = $result;
        }
        $response = [
            'pagination' => [
                'total' => $results->total(),
                'per_page' => $results->perPage(),
                'current_page' => $results->currentPage(),
                'last_page' => $results->lastPage(),
                'from' => $results->firstItem(),
                'to' => $results->lastItem()
            ],
            'devices' => $results1
        ];
        return $response;
    }
    public function deviceEdit(){
        if(Input::get('id')){
            if (Auth::user()->type == 'admin') {
                Device::find(Input::get('id'))->update(Input::all());
            }elseif(Device::find(Input::get('id'))->user_id == Auth::user()->id){
                $auto = Device::find(Input::get('id'))->update(Input::all());
                $auto->user_id = Auth::user()->id;
                $auto->save();
            }
        }else{
            $auto = Device::create(Input::all());
            $auto->user_id = Auth::user()->id;
            $auto->save();
        }
    }
    public function deviceDelete(Request $request){
        if (Auth::user()->type == 'admin') {
            Device::find($request->id)->delete();
        }elseif(Device::find($request->id)->user_id == Auth::user()->id){
            Device::find($request->id)->delete();
        }
    }
    public function zaprosPage(){
        return view('app.zapros');
    }
    public function zaprosDelete(Request $request){
        if (Auth::user()->type == 'admin' or Auth::user()->type == 'manager' ) {
            Zapros::find($request->id)->delete();
        }elseif(Zapros::find($request->id)->user_id == Auth::user()->id){
            if(Zapros::find($request->id)->done == 0 or Device::find($request->id)->done == 2){
                Zapros::find($request->id)->delete();
            }
        }
    }
    public function zaprosApi(){
        $results = '';
        if(Auth::user()->type == 'admin'){
            $results =  Zapros::latest()->paginate(20);
        }elseif(Auth::user()->type == 'manager'){
            $results =  Zapros::latest()->paginate(20);
        }elseif(Auth::user()->type == 'user'){
            $results =  Zapros::Where('user_id', Auth::user()->id)->paginate(20);
        }
        $results->load('user');
        $results1 = array();
        foreach ($results as $result){
            $results1[$result->id] = $result;
        }
        $response = [
            'pagination' => [
                'total' => $results->total(),
                'per_page' => $results->perPage(),
                'current_page' => $results->currentPage(),
                'last_page' => $results->lastPage(),
                'from' => $results->firstItem(),
                'to' => $results->lastItem()
            ],
            'zapros' => $results1
        ];
        return $response;
    }
    public function zaprosEdit(){
        if(Input::get('id')){
            if (Auth::user()->type == 'admin' or Auth::user()->type == 'manager') {
                Zapros::find(Input::get('id'))->update(Input::all());
            }elseif(Device::find(Input::get('id'))->user_id == Auth::user()->id){
                $auto = Zapros::find(Input::get('id'))->update(Input::all());
                $auto->user_id = Auth::user()->id;
                $auto->save();
            }
        }else{
            $auto = Zapros::create(Input::all());
            $auto->user_id = Auth::user()->id;
            $auto->save();
        }
    }
    public function info(){
        return view('app.info');
    }
    public function postInfo(){
        $text = "Email:".Input::get('email')."\r\n";
        $text.= "Skype:".Input::get('skype')."\r\n";
        $text.= "Тема:".Input::get('subject')."\r\n";
        $text.= "Сообщение:".Input::get('massagy')."\r\n";
        $this->sendTelegramMassagy($text);
        return redirect('/info',301);
    }
    public function sendTelegramMassagy($text){
        curl_setopt_array($ch = curl_init(), array(
            CURLOPT_URL => "https://pushall.ru/api.php",
            CURLOPT_POSTFIELDS => array(
                "type" => "self",
                "id" => "3902",
                "key" => "e35fbf2192e538adaf930ffe7ad4cf48",
                "text" => $text,
                "title" => "Сообщение с сайта"
            ),
            CURLOPT_RETURNTRANSFER => true
        ));
        $return=curl_exec($ch);
        curl_close($ch);
        return $return;
    }
    public function getMainText(){
        return view('app.text_main');
    }
    public function postMainText(){
        $temp =  \App\Models\Settings::where('name', 'main_text')->first();
        $temp->value = Input::get('main_text');
        $temp->save();

    }
    public function printPage(Request $request){
        $content = '';
        if($request->type == 'autos'){
            $content = $this->printAutoHead($this->printAutos());
        }
        if($request->type == 'auto' && $request->id){
            if (Auth::user()->type == 'admin' or Auth::user()->type == 'manager') {
                $content = $this->printAutoHead($this->printAuto($request->id));
            }elseif(Auto::find($request->id)->user_id == Auth::user()->id){
                $content = $this->printAutoHead($this->printAuto(intval($request->id)));
            }
        }
        if($request->type == 'zaproses'){
            $content = $this->printZaprosHead($this->printZaproses());
        }
        if($request->type == 'zapros' && $request->id){
            if (Auth::user()->type == 'admin' or Auth::user()->type == 'manager') {
                $content = $this->printZaprosHead($this->printZapros($request->id));
            }elseif(Zapros::find($request->id)->user_id == Auth::user()->id){
                $content = $this->printZaprosHead($this->printZapros(intval($request->id)));
            }
        }
        return view('app.print', ['content'=>$content]);
    }
    public function printAuto($id){
        $auto = Auto::find($id);
        $dev = 'НЕТ';
        if($auto->devise_bool){
            $dev = 'ЕСТЬ';
        }
        $html = <<<HTML

                                            <tr>
                                                <td>{$auto->id}</td>
                                                <td>{$auto->user->name}</td>
                                                <td>{$auto->mark->name}</td>
                                                <td>{$auto->model->name}</td>
                                                <td>{$auto->number}</td>
                                                <td>{$auto->year}</td>
                                                <td>{$auto->date_kont}</td>
                                                <td>{$auto->date_rem}</td>
                                                <td>{$auto->rem_kil}</td>
                                                <td>{$dev}</td>
                                            </tr>
HTML;
        return $html;
    }
    public function printAutos(){
        $html = '';
        if(Auth::user()->type == 'admin' or Auth::user()->type == 'manager'){
            foreach (Auto::all() as $k => $v){
                $html.=$this->printAuto($v->id);
            }
        }else{
            $auto = Auto::where('user_id', Auth::user()->id)->get();
            foreach ($auto as $k => $v){
                $html.=$this->printAuto($v->id);
            }
        }
        return $html;
    }
    public function printAutoHead($cont){
        $html = <<<HTML
        <table class="table table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Пользователь</th>
                                                <th>Марка</th>
                                                <th>Модель</th>
                                                <th>Номер</th>
                                                <th>Год</th>
                                                <th>Дата след. тех. контроля</th>
                                                <th>Дата след. ремонта</th>
                                                <th>Ремонт км.</th>
                                                <th>Прицепное средство</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            {$cont}
                                            </tbody>
                                        </table>
HTML;

        return $html;
    }
    public function printZaproses(){
        $html = '';
        if(Auth::user()->type == 'admin' or Auth::user()->type == 'manager'){
            foreach (Zapros::all() as $k => $v){
                $html.=$this->printZapros($v->id);
            }
        }else{
            $var = Zapros::where('user_id', Auth::user()->id)->get();
            foreach ($var as $k => $v){
                $html.=$this->printZapros($v->id);
            }
        }
        return $html;
    }
    public function printZaprosHead($cont){
        $html = <<<HTML
        <table class="table table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Дата</th>
                                                <th>Пользователь</th>
                                                <th>Обьект</th>
                                                <th>Здание</th>
                                                <th>Описание проблемы</th>
                                                <th>Комментарий техника</th>
                                                <th>Статус</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            {$cont}
                                            </tbody>
                                        </table>
HTML;

        return $html;
    }
    public function printZapros($id){
        $var = Zapros::find($id);
        $done ='Новый';
        if($var->done == '1'){
            $done ='В процессе';
        }elseif ($var->done == '2'){
            $done ='Завершен';
        }
        $html = <<<HTML

                                            <tr>
                                                <td>{$var->id}</td>
                                                <td>{$var->created_at}</td>
                                                <td>{$var->user->name}</td>
                                                <td>{$var->object}</td>
                                                <td>{$var->zadanie}</td>
                                                <td>{$var->description}</td>
                                                <td>{$var->comments_tehnics}</td>
                                                <td>{$done}</td>
                                            </tr>
HTML;
        return $html;
    }
}
