@extends('layouts.master')

@section('content')
<article class="row p-3 mx-1 my-3 border bg-white shadow-sm">
    <div class="col-md-12">
    
    <h5 class="mb-4">Ref : {{$article->reference}}</h5>
    <div class="row">
       
            <div class="col-12 col-lg-4 bg-light text-center py-2 border">
            @if(!empty($article->picture))
            <img class="shadow w-100" src="{{asset('images/'.$article->picture->link)}}" alt="{{$article->picture->title}}">
            @else
                <p class="text-center my-5 text-danger">"Pas d'image"</p>
            @endif
            </div>
        
        <div class="col">
            <h3 class="mb-4">Produit : {{$article->name}}</h3>
            <p><span class="fw-bold">Catégorie : </span><span class="text-uppercase">{{$article->category->name}}</span></p>
            <p><span class="fw-bold">Description :</span> {{$article->description}}</p>
            <p class="fw-bold">État de Produit :
                @if($article->status=='sale') <span class="text-danger border-start border-2 border-warning px-2">Promotion.</span> 
                @elseif($article->status=='standard') <span class="text-primary">Nouvelle Collection.</span> 
                @endif
            </p>
            <p class="fw-bold">Prix : <span class="text-secondary">{{$article->price}} €</span></p>
            <form action="{{route('success')}}">
            <!-- les champs invisibles -->
             <input id="name" name="name" type="hidden" value="{{$article->name}}" />
             <input id="genre" name="genre" type="hidden" value="@if($article->category_id==1) Homme. 
                                                                 @elseif($article->category_id==2) Femme. 
                                                                 @endif" />
             <input id="price" name="price" type="hidden" value="{{$article->price}} €" />
             <!-- les champs invisibles -->

                <label class="fw-bold" for="size-select">Taille : </label>
                <select name="size" id="size-select" required>
                <option value="">--Choisir la taille:--</option>
                @forelse($article->size as $size)
                    <option value="{{$size->size}}">{{$size->size}}</option>
                    @empty
                    <option>Stock épuisé</option>
                    @endforelse
                </select><br>
                <button class="fw-bold mx-3 my-5 w-25 btn btn-outline-primary">Acheter</button>
            </form>
        </div>
          
    </div>
   
    
    
 
 
    </div>
</article>


@endsection 