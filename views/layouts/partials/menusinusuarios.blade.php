<div class="menu-lateral">
    <div class="card-user">
        <div class="container-avatar">
            {!!Auth::user()->avatar()!!}
        </div>
        <strong>{{Auth::user()->name}}</strong>
        <a href="#" id="go" url="{{route('perfil')}}">Perfil <i class="icon-arrow-right"></i></a>
    </div>
    <div class="menu">
        <span>Dashboar</span>
        <ul>
            <li>
                <a 
                    href="#" 
                    id="go" 
                    url="{{route('home2')}}" 
                    class="icon-home"
                    active="home"
                >Inicio</a>
            </li>
        </ul>
        <span>Soporte</span>
        <ul>
            <li><a href="https://wa.me/573136103601?text=Hola, necesito ayuda con la plataforma" target="_blank" class="icon-whatsapp">Whatsapp</a></li>
            <li><a href="mailto:desarrollo@plastimedia.com" target="_blank" class="icon-google">Gmail</a></li>
            <li><a href="callto:573136103601" target="_blank" class="icon-phone">Llamar</a></li>
        </ul>
    </div>
</div>