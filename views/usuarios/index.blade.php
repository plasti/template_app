<h2 class="title icon-users">Lista de usuarios</h2>

@if($users->count() > 0)
	<div class="header-lista">
		<span>Nombre</span>
		<span>Correo</span>
		<span>ID</span>
		<span>Estado</span>
		<span>Acción</span>
	</div>
	@foreach($users as $user)
		<div class="item-lista">
			<span>{!!$user->avatar()!!}{{$user->name}}</span>
			<span>{{$user->email}}</span>
			<a href="#">{{$user->id}}</a>
			<span class="{{($user->estado != 'Si') ? 'Inactivo' : 'Activo'}}">{{($user->estado != 'Si') ? 'Inactivo' : 'Activo'}}</span>
			<span><a href="{{route('usuarios.edit', $user->id)}}" class="icon-eye"></a></span>
		</div>
	@endforeach	
	{{$users->links()}}
@endif


