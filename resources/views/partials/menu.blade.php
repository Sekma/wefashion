<nav class="navbar navbar-expand-lg bg-white shadow-sm mt-1" style="border-bottom: 1px solid #66EB9A">
    <div class="container-fluid">
            
            <a class="navbar-brand py-1 px-4 mx-5 fw-bold btn btn-outline-light" href="{{route('home')}}" style="color: #66EB9A;">{{config('app.name')}}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

           
          
            
        
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link fw-bold px-4 btn btn-outline-light" style="color: #adb5bd;" onmouseover="this.style.color='#000'" onmouseleave="this.style.color='#adb5bd'" href="{{url('sale')}}">SOLDES</a>
                @forelse($categories as $id => $name)
                <a class="nav-link text-uppercase fw-bold px-4 btn btn-outline-light" style="color: #adb5bd;" onmouseover="this.style.color='#000'" onmouseleave="this.style.color='#adb5bd'" href="{{url('category', $id)}}">{{$name}}</a>
                @empty 
                <p>Aucun category pour l'instant</p>
                @endforelse
            
            
            </div>
        </div>
    </div>
</nav>
