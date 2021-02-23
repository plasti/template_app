<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use Auth;

class UsersController extends Controller
{
    
	public function index()
	{
		$users = User::where('tipo', '<>', 'admin')->paginate(10);
		return [
			'status' => 'Ok',
			'title' => 'Usuarios',
			'active' => 'usuarios',
			'data' => view('usuarios.index', ['users'=> $users])->render(),
		];
	}

	public function edit($id)
	{
		$user = User::find($id);
		return [
			'status' => 'Ok',
			'title' => 'Editar usuario',
			'active' => 'usuarios',
			'back' => route('usuarios'), 
			'data' => view('usuarios.edit', ['user'=> $user])->render(),
		];
	}


	public function update(Request $request, $id)
	{
		$data = $request->validate([
    		'name' => 'max:250|required',
    		'email' => 'max:150|required|unique:users,email,'.$id,
    		'password' => 'max:100|confirmed',
    		'rol' => 'required',
    	], [
    		'name.max' => 'El nombre no debe superar los 250 caracteres.',
    		'name.required' => 'El nombre es requerido.',
    		'email.required' => 'El correo es requerido.',
    		'email.max' => 'El correo no debe superar los 150 caracteres.',
    		'email.unique' => 'El correo ya esta registrado.',
    		'password.max' => 'La contraseña no debe superar los 100 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'rol.required' => 'Selecciona un rol para el usuario',
    	]);

		$user = User::find($id);
		$user->name = $data['name'];
    	$user->email = $data['email'];
    	$user->rol = $data['rol'];
    	$user->estado = ($request->estado == 'on') ? 'Si' : 'No';
		if ($request->password != null) {
    		$user->password = Hash::make($data['password']);	
    	}
    	$user->update();
    	return [
    		'status' => 'Ok',
    		'msg' => 'Usuario actualizado',
    		'active' => 'usuarios',
    		'redirect' => route('usuarios'),
    	];
	}

}
