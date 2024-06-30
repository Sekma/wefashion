@extends('back.layouts.master')
@section('content')
<div class="container">
<h1 class="mt-4">Welcome : {{Auth::user()->name}}</h1>
    <div class="row border mt-4">
        <h2>La partie administration</h2>
        <h4>Liste des produits : <a class="btn btn-outline-dark" href="{{route('clothes.index')}}">Produits</a></h4>
        <h4>Liste des Catégories : <a class="btn btn-outline-dark" href="{{route('categories.index')}}">Catégories</a></h4>
    </div>
</div>
@endsection 