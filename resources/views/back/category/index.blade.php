@extends('back.layouts.master')
@section('content')
<div class="d-flex justify-content-end">
    <a type="button" class="btn btn-primary my-3 shadow" href="{{route('category.create')}}">Ajouter une Catégorie</a>
</div>
{{-- On inclut le fichier des messages retournés par les actions du contrôleurs CategoryController--}}
@include('back.partials.flash')
<table class="table table-striped shadow-sm">
    <thead>
        <tr>
            <th>Catégories</th>
            <th>Date de création</th>
            <th>Edition</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
    @forelse($category as $category)
        <tr>
            <td>{{$category->name}}</td>
            <td>{{$category->created_at}}</td>
            <td>
                <a class="text-decoration-none text-primary" href="{{route('category.edit', $category->id)}}"><span class="fa fa-edit" aria-hidden="true"></span> edit</a>
            </td>
            <td>
                <!-- Button trigger modal -->
                <a type="button" class="text-decoration-none text-danger" data-bs-toggle="modal" data-bs-target="#{{$category->id}}"><span class="fa fa-trash" aria-hidden="true"></span> Delete</a>

                <!-- Modal -->
                <div class="modal fade" id="{{$category->id}}" tabindex="-1" aria-labelledby="{{$category->id}}Label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="{{$category->id}}Label">DELETE</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Voulez-vous vraiment supprimer la catégorie : {{$category->name}} ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                        <!-- form destroy -->
                        <form class="delete" method="POST" action="{{route('category.destroy', $category->id)}}">
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
        aucune catégorie ...
    @endforelse
    </tbody>
</table>
@endsection 