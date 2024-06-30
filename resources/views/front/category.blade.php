@extends('layouts.master')

@section('content')
<div class="d-flex justify-content-between align-items-center">
    <h4 class="m-3">Catégorie <span class="text-uppercase">{{$category->name}}</span>.</h4>
    <h6 class="m-3">{{$articles->count()}} résultats</h6>
</div>

<div class="container shadow-sm">
   
        <div class="row border mb-4">
        @forelse($clothes as $article)
        
            <div class="col-12 col-md-6 col-lg-4 bg-body my-1 p-2 border">
                <a class="text-decoration-none text-start btn btn-outline-light" href="{{route('article', $article->id)}}">
                    @if(!empty($article->picture))
                    
                    <img class="shadow rounded" width="170" src="{{asset('images/'.$article->picture->link)}}" alt="{{$article->picture->title}}">

                    @else
                    <div class="shadow bg-secondary text-center text-white pt-5" style="height: 240px; width:170px">
                        <p>"Pas d'image"</p>
                    </div>
                     @endif

                    <h4 class="text-dark mt-4">{{$article->name}}</h4>
                    <h6 class="text-dark">Prix : <span class="text-secondary">{{$article->price}} €</span></h6>
                    
                    @if($article->status=="sale")
                    <h6 class="text-danger border-start border-2 border-warning px-2 fw-bold">Promotion</h6>
                    @endif
                   
                </a>   
            </div>
        
            @empty
        <p>Désolé pour l'instant aucun article n'est publié sur le site</p>
            @endforelse
        </div>    
</div>
<div class="d-flex justify-content-end">
    {{$clothes->links()}}
</div>
@endsection 