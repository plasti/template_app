<h2 class="title icon-user">Información del perfil</h2>

<div class="card">
	
	<div class="container-avatar">
		{!!Auth::user()->avatar()!!}
		<form action="{{route('perfil.avatar')}}" method="POST" accept-charset="utf-8" enctype="multipart/form-data" id="send">
			{{ csrf_field() }}
			<div class="icon-edit-2 cambiar">
				<input type="file" name="avatar" id="avatar_change" accept="image/*">
			</div>
		</form>
	</div>


	<div class="colum">
		<div class="form-container">
			<label>Nombre</label>
			<input type="text" value="{{Auth::user()->name}}" readonly>
		</div>
		<div class="form-container">
			<label>Correo electrónico</label>
			<input type="text" value="{{Auth::user()->email}}" readonly>
		</div>
		<div class="form-container">
			<label>Estado</label>
			<input type="text" value="{{(Auth::user()->estado == 'Si') ? 'Activo' : 'Inactivo'}}" readonly>
		</div>

		<a href="#" id="go" url="{{route('perfil.edit')}}" class="icon-edit-2 btn">Editar</a>

	</div>
</div>