<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Size;
use App\Models\Clothes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // création de l'admin
        $this->call(UserTableSeeder::class);
        // on prendra garde de bien supprimer toutes les images avant de commencer les seeders
      //  Storage::disk('local')->delete(Storage::allFiles());

       // création des catégories
       Category::create([
        'name' => 'homme'
       ]);
       Category::create([
        'name' => 'femme'
       ]);

       // création des tailles
       Size::create([
        'size' => 'XS'
       ]);
       Size::create([
        'size' => 'S'
       ]);
       Size::create([
        'size' => 'M'
       ]);
       Size::create([
        'size' => 'L'
       ]);
       Size::create([
        'size' => 'XL'
       ]);


    $index=0;

    // images homme
    $imagesManPath = public_path('images/homme');
    $imagesMan = File::files($imagesManPath);
    //images femme
    $imagesWomenPath = public_path('images/femme');
    $imagesWomen = File::files($imagesWomenPath);

 /*    if (empty($images)) {
        $this->command->info('No images found in the public/images directory.');
        return;
    } */

       Clothes::factory()->count(80)->create()->each(function($article)  use (&$index, $imagesMan, $imagesWomen){
      
        //  Attribuer la catégorie en fonction de l'index
        $category = Category::find($index < 40 ? 1 : 2);

        $article->category()->associate($category);
        $article->save();
        $index++;
        
        // récupération des id des tailles à partir de la méthode pluck d'Eloquent
        $sizes = Size::pluck('id')->shuffle()->slice(0, rand(1, 5))->all();
    
        // Il faut se mettre maintenant en relation avec les tailles (relation ManyToMany) et attacher les id des articles
        // dans la table de liaison.
        $article->size()->attach($sizes);

        // ajout des images
        // les 40 premières images (homme), et les 40 suivantes (femme)
        $index <= 40 ? $randomImage = $imagesMan[array_rand($imagesMan)] : $randomImage = $imagesWomen[array_rand($imagesWomen)];
        // stoquer les noms des fichiers dans notre base de données.
        $index <= 40 ? $article->picture()->create([
                'link' => 'homme/'.$randomImage->getFilename()
            ]) : $article->picture()->create([
                'link' => 'femme/'.$randomImage->getFilename()
            ]);
    });
    }

}
