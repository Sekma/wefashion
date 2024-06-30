@extends('back.layouts.master')

@section('content')
<div class="row">
    <div class="col-md-6">
        <h5><strong>Réf</strong> : {{$article->reference}}.</h5>
        <h3><strong>Produit</strong> : {{$article->name}}.</h3>
	    <p><strong>Catégorie : </strong>{{$article->category->name?? 'aucun'}}.</p>
        <p><strong>Date de création : </strong> : {{$article->created_at}}.</p>
        <p><strong>Date de mise à jour : </strong> : {{$article->updated_at}}.</p>
        <p><strong>Status : </strong> {{$article->status}}.</p>
        <p><strong>Visibilité : </strong> {{$article->visibility}}.</p>
        <p><strong>Prix : </strong> {{$article->price}} €.</p>
        <h2>Les tailles :</h2>
        <p><strong>Nombre de(s) taille(s) disponible(s)</strong> : {{count($article->size)}} .</p>
        <ul>
            
        @forelse($article->size as $size)
            <li>{{$size->size}}</li>
        @empty
        Stock épuisé
        @endforelse
        </ul>
    </div>
    <div class="col-md-6">
    <h2><strong>Image</strong></h2>
    
        <div class="col-xs-6 col-md-3">
        @if(!empty($article->picture))
        <img class="shadow" width="170" src="{{asset('images/'.$article->picture->link)}}" alt="{{$article->picture->title}}">
            @else
                <p class="text-center my-5 text-danger">"Pas d'image"</p>
            @endif
        </div>
    
    </div>
</div>
@endsection 
