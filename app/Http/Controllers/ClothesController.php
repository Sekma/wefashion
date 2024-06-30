<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Models\Category;
use App\Models\Size;
use App\Models\Clothes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ClothesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Paginator::useBootstrap(); // Pour Bootstrap

        $categories = Category::pluck('name', 'id')->all(); 
        /* return clothes::all(); */ // retourne tous les livres de l'application
        $clothes = Clothes::paginate(15);
        // $clothes = clothes::all(); // pagination 
         return view('back.clothes.index', ['clothes' => $clothes, 'categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // permet de récupérer une collection type array avec en clé id => name
        $sizes = Size::pluck('size', 'id')->all();
        $categories = Category::pluck('name', 'id')->all();

        return view('back.clothes.create', ['sizes' => $sizes, 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    
    // function pour générer la référence 

    function random_reference($chars) {
        $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        return substr(str_shuffle($letters), 0, $chars);
        }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required|string',
            'category_id' => 'integer',
            'sizes.*' => 'integer', // pour vérifier un tableau d'entiers il faut mettre sizes.*
            'visibility' => 'in:published,unpublished',
            'status' => 'in:sale,standard',
            'title_image' => 'string|nullable', // pour le titre de l'image si il existe
            'picture' => 'image|max:3000'
        ]);
        // la référence
        $reference = $this->random_reference(16);
        // ajouter l'atribut reference a notre tableau
        $clothes = Clothes::create(array_merge($request->all(), ['reference' => $reference]));
   
        
    
        // On utilise le modèle clothes et la relation sizes ManyToMany pour attacher des/un nouveaux/nouvel auteur(s)
        // à un livre que l'on vient de créer en base de données.
        // Attention $request->sizes correspond aux donnes du formulaire alors $clothes->sizes() à la relation ManyToMany
        $clothes->size()->attach($request->sizes);

         // image
         $im = $request->file('picture');
        
         // si on associe une image à un clothes 
         if (!empty($im)) {
             if($request->category_id==1){
                $link = $request->file('picture')->store('homme');
             }elseif($request->category_id==2){
                $link = $request->file('picture')->store('femme');
             }else{
                $link = $request->file('picture')->store('images');
             }
             
 
             // mettre à jour la table picture pour le lien vers l'image dans la base de données
             $clothes->picture()->create([
                 'link' => $link
             ]);
         }

        return redirect()->route('clothes.index')->with('message', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $clothes = Clothes::find($id);
        $categories = Category::pluck('name', 'id')->all(); 
        return view('back.clothes.show', ['article' => $clothes, 'categories' => $categories]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $article = Clothes::find($id);

        $sizes = Size::pluck('size', 'id')->all();
        $categories = Category::pluck('name', 'id')->all();
    
        return view('back.clothes.edit', compact('article', 'sizes', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required|string',
            'category_id' => 'integer',
            'sizes.*' => 'integer', // pour vérifier un tableau d'entiers il faut mettre size.*
            'visibility' => 'in:published,unpublished',
            'status' => 'in:sale,standard'
        ]);

        $article = Clothes::find($id); // associé les fillables

        $article->update($request->all());
        
        // on utilisera la méthode sync pour mettre à jour les auteurs dans la table de liaison
        $article->size()->sync($request->sizes);

        // image
        $im = $request->file('picture');
        
        // si on associe une image à un article 
        if (!empty($im)) {

            if($request->category_id==1){
                $link = $request->file('picture')->store('homme');
             }elseif($request->category_id==2){
                $link = $request->file('picture')->store('femme');
             }else{
                $link = $request->file('picture')->store('images');
             }

            // suppression de l'image si elle existe 
            if(!empty($article->picture)){
                Storage::disk('local')->delete($article->picture->link); // supprimer physiquement l'image
                $article->picture()->delete(); // supprimer l'information en base de données
            }

            // mettre à jour la table picture pour le lien vers l'image dans la base de données
            $article->picture()->create([
                'link' => $link
            ]);
            
        }

        $articleCount = DB::table('clothes')->count();
        if($articleCount>$id){
            $result=$id;
        }
        else{
            $result=$articleCount;
        }
        $page= (int) ( ($result - 1) / 15 ) + 1;
        return redirect('admin/clothes?page='.$page)->with('message', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Clothes::find($id);

        $article->delete();

        return redirect()->route('clothes.index')->with('message', 'success delete');
    }
}
