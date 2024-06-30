@extends('back.layouts.master')

@section('content')
    
                
                <form class="mb-4 mt-4" action="{{route('clothes.update', $article->id)}}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                            <h2 class="mt-4">Edit Article :  </h2>
                                <div class="form">
                                    <div class="form-group">
                                        <label for="name"><strong>Titre : </strong></label>
                                            <input type="text" name="name" value="{{$article->name}}" class="form-control" id="name"
                                                placeholder="Titre du livre">
                                            @if($errors->has('name')) <span class="error bg-warning text-warning">{{$errors->first('name')}}</span>@endif
                                    </div>
                                    <div class="form-group">
                                            <label for="price"><strong>Description : </strong></label>
                                            <textarea type="text" name="description"class="form-control">{{$article->description}}</textarea>
                                            @if($errors->has('description')) <span class="error bg-warning text-warning">{{$errors->first('description')}}</span> @endif
                                    </div>
                                </div>
                                <div class="form-inline mt-2">
                                    <label for="category"><strong>Categorie : </strong></label>
                                    <select id="category" name="category_id">
                                            <option value="0" {{is_null($article->category)? 'selected' : '' }} > No category </option>
                                        @foreach($categories as $id => $name)
                                            <option value="{{$id}}" {{ (!is_null($article->category) and $article->category->id == $id)? 'selected' : '' }} >{{$name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="price"><strong>Prix :</strong></label>
                                    <input name="price" value="{{$article->price}}" class="form-control" id="price" type="number" placeholder="0.00 €" step="0.01" required>
                                    @if($errors->has('price')) <span class="error bg-warning text-warning">{{$errors->first('price')}}</span>@endif
                                </div>
                                <h4>Choisissez un/des tailles</h4>
                                <div class="form-inline">
                                @forelse($sizes as $id => $name)
                                    <div class="form-check my-1">
                                        <input class=" form-check-input" name="sizes[]" value="{{$id}}"
                                                @if( is_null($article->size) == false and  in_array($id, $article->size()->pluck('id')->all()))
                                                checked
                                                @endif
                                                type="checkbox" class="form-control"
                                                id="size{{$id}}">
                                        
                                                <label class="form-check-label" for="size{{$id}}">{{$name}}</label>
                                                
                                    </div>
                                @empty
                                @endforelse
                                </div>
                            </div><!-- #end col md 6 -->
                            <div class="col-md-6">
                                <div class="input-radio">
                                    <h4>Visibilité :</h4>
                                    <input type="radio" name="visibility" value="published" @if(old('visibility', $article->visibility) == "published") checked @endif> publier<br>
                                    <input type="radio" name="visibility" value="unpublished" @if(old('visibility', $article->visibility) == "unpublished") checked @endif> dépulier<br>
                                </div>
                                <div class="input-radio">
                                    <h4>Statut :</h4>
                                    <input type="radio" name="status" value="sale" @if(old('status', $article->status) == "sale") checked @endif> Sale<br>
                                    <input type="radio" name="status" value="standard" @if(old('status', $article->status) == "standard") checked @endif> Standard<br>
                                </div>
                                <div class="input-file">
                                    <label for="file"><strong>File : </strong></label>
                                    <input id="file" class="file" type="file" name="picture" >
                                    @if($errors->has('picture')) <span class="error bg-warning text-warning">{{$errors->first('picture')}}</span> @endif
                                </div>

                                <h4><strong>Image</strong></h4>
                                <div class="col-xs-6 col-md-3">
                                @if(!empty($article->picture))
                                <img class="shadow" width="170" src="{{asset('images/'.$article->picture->link)}}" alt="{{$article->picture->title}}">
                                @else
                                    <p class="text-center my-5 text-danger">"Pas d'image"</p>
                                @endif
                                </div>
                                <button type="submit" class="btn btn-outline-primary mt-2">Modifier</button>
                            </div><!-- #end col md 6 -->
                        </div>
                    </div>
                </form>
        
        
@endsection