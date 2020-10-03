<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Alert;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //Autentifikasi
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Menampilkan Data User
    public function view(){
        if(Gate::authorize('isAdmin')){
            $user = User::orderBy('updated_at', 'DESC')->paginate(5);
            return view('data-user.ViewUser', compact('user'));
        }
    }

    //Menampilkan form input user
    public function add(){
        if(Gate::authorize('isAdmin')){
            return view('data-user.register');
        }
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'level' => ['required', 'string', 'max:15'],
            'no_telp' => ['required', 'string', 'max:15']
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'level' => $data['level'],
            'no_telp' => $data['no_telp']
        ]);
    }

    //Menyimpan data user
    public function store(Request $request){
        $this->validator($request->all())->validate();
        $this->create($request->all());

        Alert::toast('Data User Berhasil Ditambahkan', 'success');
        return redirect('/data-user');
    }

    //Menampilkan form reset
    public function reset($id){
        if(Gate::authorize('isAdmin')){
            $user = User::find($id);
            return view('data-user.reset', compact('user'));
        }
    }

    //Reset password
    public function update($id, Request $request){
        $request->validate($this->rules(), $this->validationErrorMessages());

        $user = User::find($id);
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->save();

        Alert::toast('Password Berhasil Di Reset', 'success');
        return redirect('/data-user');
    }

    protected function rules()
    {
        return [
            'username' => 'required',
            'password' => 'required|confirmed|min:8',
        ];
    }

    protected function validationErrorMessages()
    {
        return [];
    }

    //Hapus user
    public function destroy($id){
        $user = User::find($id);
        $user->delete();

        Alert::toast('Data User Berhasil Dihapus', 'success');
        return back();
    }

}
