@extends('back.layouts.master')

@section('content')
<form class="shadow-sm p-5 mt-5" action="{{route('category.store')}}" method="post" enctype="multipart/form-data">
@csrf
<h2 class="text-center">Créer une nouvelle catégorie</h2>
    <div class="container mt-5 d-flex justify-content-center">
        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="name" class="col-form-label"><strong>Catégorie : </strong></label>
            </div>
            <div class="col-auto">
                <input type="text" name="name" value="" class="form-control" id="name" placeholder="Nom du catégorie" required>
            </div>
            <div class="col-auto">
                <input type="submit" value="Ajouter" class="form-control btn btn-outline-primary mt-2 shadow">
            </div>
        </div>
    </div>    
</form>
@endsection