<h2 class="title icon-user">Información del perfil</h2>

<div class="card">
	<form action="{{route('usuarios.update', $user->id)}}" method="POST" id="send">
		{{ csrf_field() }}
		<div class="colum">
			<div class="form-container">
				<label>Nombre</label>
				<input type="text" name="name" value="{{$user->name}}">
			</div>
			<div class="form-container">
				<label>Correo electrónico</label>
				<input type="text" name="email" value="{{$user->email}}">
			</div>
			<div class="form-container">
				<label>Rol del usuario</label>
				<select name="rol">
					<option value="">Seleccionar..</option>
					<option value="Administrador" @if($user->rol == 'Administrador') selected @endif>Administrador</option>
					<option value="Usuario" @if($user->rol == 'Usuario') selected @endif>Usuario</option>
				</select>
			</div>
		</div>

		<div class="colum">
			<div class="form-container">
				<div class="swiche-app">
					<input type="checkbox" id="estado" name="estado" @if($user->estado == 'Si') checked @endif>
                	<label for="estado">Estado: Inactivo / Activo
						<swiche class="sw"></swiche>
                	</label>
				</div>
			</div>
			<div class="divider"></div>
			<div class="form-container">
				<label>Contraseña</label>
				<input type="password" name="password" placeholder="*********">
			</div>
			<div class="form-container">
				<label>Confirmar contraseña</label>
				<input type="password" name="password_confirmation" placeholder="*********">
			</div>
		</div>

		<div class="divider"></div>
		<button class="icon-save btn" type="submit">Guardar</button>
	</form>
</div>