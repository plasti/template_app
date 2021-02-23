<div class="bar">
	<div class="dinamic" id="header_app_dinamic">
		{{-- <a href="#" class="icon-arrow-left"></a> --}}
		<strong class="title">Inicio</strong>
		{{-- <form>
			<input type="text" placeholder="Buscar">
			<button class="icon-arrow-right"></button>
		</form> --}}
	</div>
	<div class="lateral">
		<a href="#" class="icon-bell"></a>
		<a 
			class="icon-power cerrar-sesion"
			onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
			href="{{ route('logout') }}"
		>Cerrar sesión</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
	</div>
</div>