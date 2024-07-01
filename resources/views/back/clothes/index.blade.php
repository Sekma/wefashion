@extends('back.layouts.master')

@section('content')
<div class="container">

    <div class="d-flex justify-content-end">
        <a type="button" class="btn btn-primary shadow my-3" href="{{route('clothes.create')}}">Ajouter un produit</a>
    </div>

{{-- On inclut le fichier des messages retournés par les actions du contrôleurs ClothesController--}}
@include('back.partials.flash')
<table class="table table-striped shadow-sm">
    <thead>
        <tr class="text-center">
            <th>Produit</th>
            <th>Tailles</th>
	        <th>Catégorie</th>
            <th>Date de création</th>
            <th>Visibilité</th>
            <th>Status</th>
            <th>Edition</th>
            <th>Show</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
    @forelse($clothes as $article)
        <tr class="text-center">
            <td>{{$article->name}}</td>
            <td>
                @forelse($article->size as $size)
                    - {{$size->size}}
                @empty
                Stock épuisé
                @endforelse
            </td>
	        <td>{{$article->category->name?? 'aucun category' }}</td>
            <td>{{$article->created_at}}</td>
            <td><a @if(($article->visibility) == "published") class="btn btn-success bg-success text-white" @elseif(($article->visibility) == "unpublished") class="btn btn-warning bg-warning text-white" @endif>{{$article->visibility}}</a></td>
            <td><a @if(($article->status) == "sale") class="btn btn-outline-danger" @elseif(($article->status) == "standard") class="btn btn-outline-primary" @endif>{{$article->status}}</a></td>
            <td>
                <a class="text-primary" href="{{route('clothes.edit', $article->id)}}"><i class="fa fa-edit" aria-hidden="true"></i></a>
            </td>
            <td>
                <a class="text-success" href="{{route('clothes.show', $article->id)}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
            </td>
            <td>
                <!-- Button trigger modal -->
                <a class="text-danger" type="button" data-bs-toggle="modal" data-bs-target="#{{$article->id}}"><i class="fa fa-trash" aria-hidden="true"></i></a>

                <!-- Modal -->
                <div class="modal fade" id="{{$article->id}}" tabindex="-1" aria-labelledby="{{$article->id}}Label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="{{$article->id}}Label">DELETE</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Voulez-vous vraiment supprimer le produit: {{$article->name}} ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                        <!-- form destroy -->
                        <form class="delete" method="POST" action="{{route('clothes.destroy', $article->id)}}">
                            @method('DELETE')
                            @csrf
                            <input class="btn btn-danger" type="submit" value="Delete" >
                        </form>
                    </div>
                    </div>
                </div>
                </div>
            </td>
        </tr>
    @empty
        aucun article ...
    @endforelse
    </tbody>
</table>
    <div class="d-flex justify-content-end mb-5">
        {{$clothes->links()}}
    </div>
</div>
@endsection 