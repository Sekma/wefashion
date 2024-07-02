<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Clothes;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all();
        
        return view('back.category.index', ['category' => $category]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('back.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Category::create($request->all());

        return redirect()->route('category.index')->with('message', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        
        return view('back.category.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $category = Category::find($id);

        $category->update($request->all());

        return redirect('admin/category')->with('message', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);

        $clothes = Clothes::all()->where('category_id', $id); // les article de la catégorie à supprimer
        
        foreach($clothes as $article){
            // suppression de l'image si elle existe 
            if(!empty($article->picture)){
                Storage::disk('local')->delete($article->picture->link); // supprimer physiquement l'image
                $article->picture()->delete(); // supprimer l'information en base de données
            }
        }
        

        $category->delete();

        return redirect()->route('category.index')->with('message', 'success delete');
    }
}
