<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Models\Clothes;
use App\Models\Category;
use App\Models\Size;

class FrontController extends Controller
{

    public function __construct(){

        // méthode pour injecter des données à une vue partielle 
        view()->composer('partials.menu', function($view){
            $categories = Category::pluck('name', 'id')->all(); // on récupère un tableau associatif ['id' => 1]
            $view->with('categories', $categories ); // on passe les données à la vue
        });
    } 

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Paginator::useBootstrap(); // Pour Bootstrap
        $clothesAll = Clothes::published(); // Tous les articles
        $clothes = Clothes::published()->orderBy('id', 'desc')->paginate(6); // pagination 

        return view('front.index', ['clothes' => $clothes, 'articles' => $clothesAll]);
       // return Clothes::all();
    }

    public function showClothesByCategory(int $id){
        Paginator::useBootstrap(); // Pour Bootstrap

        // on récupère le modèle category.id 
        $category = Category::find($id);
        $clothes = $category->clothes()->published()->orderBy('id', 'desc')->paginate(6); // pagination
        $clothesByCategory = $category->clothes()->published(); // Tous les articles de la categorie

        return view('front.category', ['clothes' => $clothes, 'articles' => $clothesByCategory, 'category' => $category]);
    }

    public function showClothesByStatus(){
        Paginator::useBootstrap(); // Pour Bootstrap

        $clothesOnSale = Clothes::where('status', 'sale')->published(); // Tous les articles en promotion
        $clothes = Clothes::where('status', 'sale')->published()->orderBy('id', 'desc')->paginate(6); // pagination 

        return view('front.sale', ['clothes' => $clothes, 'articles' => $clothesOnSale]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // vous ne récupérez qu'un seul produit 
        $article = Clothes::find($id);
        
        // que vous passez à la vue
        return view('front.show', ['article' => $article]);
    }
}
