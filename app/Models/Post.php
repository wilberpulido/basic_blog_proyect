<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Sluggable;
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'iframe',
        'images',
        'user_id',
    ];

    /**
     *Return the sluggable configuration array for this model.
     *@return array
     */
    public function sluggable(): array
    {
        //Cuando se guarde un post el title se convierta un slug
        //Cuando se actualiza tambien se transforma en un slug.
        //Un slug es transformar una url de form amigable
        //Acá transformamos un title: esto es un titulo,
        //A esto-es-un-titulo,luego lo usaremos para nuestras rutas.
        // Usar slug mejora el rendimiento y la visualizacion de google
        return[
            'slug' => [
                'source' => 'title',
                'onUpdate' => true
            ]
        ];
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getGetExcerptAttribute()
    {
        return substr($this->body,0,140);     
    }
    public function getGetImageAttribute()
    {
        if ($this->images) {
            return url("storage/$this->images");
        }
    }
}
