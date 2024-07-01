<nav class="navbar navbar-expand-lg bg-white shadow-sm mt-1" style="border-bottom: 1px solid #66EB9A">
    <div class="container-fluid">
            
            <span class="navbar-brand py-1 px-4 mx-5 fw-bold" style="color: #66EB9A; text-shadow: 2px 2px rgba(0,0,0,0.1);">{{config('app.name')}}</span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link fw-bold px-3 btn btn-outline-light" href="{{route('admin')}}">Admin</a>
                <a class="nav-link fw-bold px-3 btn btn-outline-light" href="{{route('clothes.index')}}">PRODUITS</a>
                <a class="nav-link fw-bold px-3 btn btn-outline-light" href="{{route('categories.index')}}">CATÉGORIES</a>
            </div>
        </div>
        <a class="btn btn-outline-success me-2" href="{{route('home')}}" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i> Voir</a>
    </div>
</nav>
