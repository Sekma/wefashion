@extends('back.layouts.master')

@section('content')
<form class="shadow-sm p-5 mt-5" action="{{route('category.update', $category->id)}}" method="post" enctype="multipart/form-data">
@method('PUT')
@csrf
<h2 class="text-center">Créer une nouvelle catégorie</h2>
    <div class="container mt-5 d-flex justify-content-center">
        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="name" class="col-form-label"><strong>Catégorie : </strong></label>
            </div>
            <div class="col-auto">
                <input type="text" name="name" value="{{$category->name}}" class="form-control" id="name" placeholder="Nom du catégorie" required>
                @if($errors->has('name')) <span class="error bg-warning text-warning">{{$errors->first('name')}}</span>@endif
            </div>
            <div class="col-auto">
                <input type="submit" value="Ajouter" class="form-control btn btn-outline-primary mt-2 shadow">
            </div>
        </div>
    </div>    
</form>
@endsection