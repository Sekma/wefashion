@extends('back.layouts.master')

@section('content')
<form class="mb-4 mt-4" action="{{route('clothes.store')}}" method="post" enctype="multipart/form-data">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2 class="mt-4">Créer un nouveau produit :  </h2>
                
                @csrf
                    <div class="form">
                        <div class="form-group">
                            <label for="name"><strong>Produit :</strong></label>
                            <input type="text" name="name" value="" class="form-control" id="name" placeholder="Nom du produit" required>
                        </div>
                        <div class="form-group">
                            <label for="description"><strong>Description :</strong></label>
                            <textarea type="text" name="description"class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-inline mt-2">
                    <label for="category"><strong>Catégorie :</strong></label>
                    <select id="category" name="category_id">
                        <option value="0" {{ is_null(old('category_id'))? 'selected' : '' }} >No category</option>
                        @foreach($categories as $id => $name)
                            <option value="{{$id}}">{{$name}}</option>
                        @endforeach
                    </select>
                    </div>
                    <h4>Choisissez un/des tailles</h4>
                    <div class="form-inline">
                        
                    @forelse($sizes as $id => $name)
                        <div class="form-check my-1">
                            <input name="sizes[]" value="{{$id}}" type="checkbox" class=" form-check-input" id="sizes{{$id}}">
                            <label class="form-check-label" for="sizes{{$id}}">{{$name}}</label>
                        </div>
                    @empty
                    @endforelse
                    </div>
            </div><!-- #end col md 6 -->
            <div class="col-md-6">
                <div class="input-radio">
                    <h4>Visibilité :</h4>
                    <input type="radio" name="visibility" value="published" checked> publier<br>
                    <input type="radio" name="visibility" value="unpublished" checked> dépulier<br>
                </div>
                <div class="input-radio">
                    <h4>Statut :</h4>
                    <input type="radio" name="status" value="sale" checked> Sale<br>
                    <input type="radio" name="status" value="standard" checked> Standard<br>
                </div>
            <div class="input-file">
                <label for="file"><strong>File : </strong></label>
                <input class="file" type="file" name="picture" >
            </div>
            <div class="form-group">
                <label for="price"><strong>Prix :</strong></label>
                <input name="price" value="" class="form-control" id="price" type="number" placeholder="0.00 €" step="0.01" required>
            </div>

            <button type="submit" class="btn btn-outline-primary mt-2 shadow">Créer</button>
            </div><!-- #end col md 6 -->
        </div>
    </div>    
</form>
@endsection
