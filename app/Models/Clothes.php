<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clothes extends Model
{
    use HasFactory;
    protected $fillable = [ 
       'reference', 'name', 'description', 'price', 'status', 'visibility', 'category_id'
    ];

    // ici le setter va récupérer la valeur à insérer en base de données
    // nous pourrons alors vérifier sa valeur avant que le modèle n'insère la donnée en base de données
    public function setGenreIdAttribute($value){
       
        if($value == 0){
            $this->attributes['category_id'] = null;
        }else{

            $this->attributes['category_id'] = $value;
        }

    }

        public function category(){
            return $this->belongsTo(Category::class);
            }
        public function size(){
            return $this->belongsToMany(Size::class);
            }

        public function picture(){
            return $this->hasOne(Picture::class);
            }

            public function scopePublished($query){
                return $query->where('visibility', 'published');
            }
}
