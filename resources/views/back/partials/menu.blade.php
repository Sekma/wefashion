<nav class="navbar navbar-expand-lg" style="background-color: rgba(0, 0, 0, 0.1);">
    <div class="container-fluid">
            
            <span class="navbar-brand  bg-body-tertiary p-2 rounded fw-bold" style="color: #66EB9A;">{{config('app.name')}}</span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

           
          
            
        
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <span class="nav-link fw-bold">SOLDES</span>
                @forelse($categories as $id => $name)
                <span class="nav-link text-uppercase fw-bold">{{$name}}</span>
                @empty 
                <p>Aucun category pour l'instant</p>
                @endforelse
            
            
            </div>
        </div>
        <a class="btn btn-outline-primary me-2" href="{{route('admin')}}">Admin</a>
        <a class="btn btn-outline-secondary me-2" href="{{route('clothes.index')}}">Produits</a>
        <a class="btn btn-outline-secondary me-2" href="{{route('categories.index')}}">Catégories</a>
        <a class="btn btn-outline-success me-2" href="{{route('home')}}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i> Voir</a>
    </div>
</nav>
