<h2 class="title icon-user">Información del perfil</h2>

<div class="card">
	<div class="colum">
		<form action="{{route('perfil.save')}}" method="POST" id="send">
			{{ csrf_field() }}
			<div class="form-container">
				<label>Nombre</label>
				<input type="text" name="name" value="{{Auth::user()->name}}">
			</div>
			<div class="form-container">
				<label>Correo electrónico</label>
				<input type="text" name="email" value="{{Auth::user()->email}}">
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
			<button class="icon-save btn" type="submit">Guardar</button>
		</form>
	</div>
</div>