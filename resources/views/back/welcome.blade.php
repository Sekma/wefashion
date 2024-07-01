@extends('back.layouts.master')
@section('content')
<h3 class="m-4">Welcome : {{Auth::user()->name}}</h3>
<div class="container shadow-sm bg-body p-4">
    <h4 class="mx-4">La partie administration</h4>
  <ul class="list-group my-4">
    <li class="list-group-item d-flex justify-content-around"><span class="fw-bold pt-1">Liste des produits : </span><a class="btn btn-outline-primary shadow" href="{{route('clothes.index')}}">Produits</a></li>
    <li class="list-group-item d-flex justify-content-around"><span class="fw-bold pt-1">Liste des Catégories : </span><a class="btn btn-outline-primary shadow" href="{{route('categories.index')}}">Catégories</a></li>
  </ul>
        
        
    
</div>
@endsection 