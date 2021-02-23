<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Image;

class PerfilController extends Controller
{
    public function index()
    {
    	return [
    		'status' => 'Ok',
    		'title' => 'Perfil',
    		'active' => 'nothing',
    		'data' => view('auth.perfil')->render()
    	];
    }

    public function avatar(Request $request)
    {
    	$mensaje = '';
		$user = User::find(Auth::user()->id);
		if ($request->hasFile('avatar')) {
			$imagen = $request->file('avatar');
			if ( $imagen->getClientOriginalExtension() == 'jpg' || 
				 $imagen->getClientOriginalExtension() == 'png' ||
				 $imagen->getClientOriginalExtension() == 'jpeg' 
			) {
				if (!file_exists(public_path( 'img/users/'))) {
				mkdir(public_path( 'img/users/'));
				}

				if($user->avatar <> null){
                    unlink(public_path( 'img/users/'.$user->avatar)); //eliminar imagen 
                }

				$filename = $user->id.'_'.date_format(date_create(), 'h-i-s-d-m-Y').'_'.'.'.$imagen->getClientOriginalExtension();
				Image::make($imagen)->fit(300)->save( public_path( 'img/users/'.$filename ) );
				$user->avatar = $filename;
				$user->update();
			}else {
				$mensaje = 'La imagen no es soportada';
			}
		}else {
			$mensaje = 'Selecciona una imagen';
		}

		return [
    		'status' => ($mensaje == '') ? 'Ok' : 'Fail',
    		'msg' => ($mensaje == '') ? 'Imagen actualizada' : $mensaje,
    		'redirect' => route('perfil'),
    		'update_component' => [
    			'component' => '.menu-lateral > .card-user > .container-avatar',
    			'newComponent' => $user->avatar()
    		],
    	];
    }


    public function edit()
    {
    	return [
    		'status' => 'OK',
    		'title' => 'Editar perfil',
    		'back' => route('perfil'),
    		'data' => view('auth.edit')->render(),
    	];
    }

    public function save(Request $request)
    {
    	$data = $request->validate([
    		'name' => 'max:250|required',
    		'email' => 'max:150|required|unique:users,email,'.Auth::user()->id,
    		'password' => 'max:100|confirmed',
    	], [
    		'name.max' => 'El nombre no debe superar los 250 caracteres.',
    		'name.required' => 'El nombre es requerido.',
    		'email.required' => 'El correo es requerido.',
    		'email.max' => 'El correo no debe superar los 150 caracteres.',
    		'email.unique' => 'El correo ya esta registrado.',
    		'password.max' => 'La contraseña no debe superar los 100 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
    	]);
    	$user = User::find(Auth::user()->id);
    	$user->name = $data['name'];
    	$user->email = $data['email'];
    	if ($request->password != null) {
    		$user->password = Hash::make($data['password']);	
    	}
    	$user->update();
    	return [
    		'status' => 'Ok',
    		'msg' => 'Información guardada',
    		'redirect' => route('perfil'),
    	];
    }

}
