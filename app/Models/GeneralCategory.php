<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class GeneralCategory extends Model
{
    use HasFactory;
    protected $table; // Deja la propiedad $table sin definir inicialmente

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $alias = "";
        if (Auth::user()->alias) {
            $alias = Auth::user()->alias . '_';
        }

        // Concatena el alias con el nombre de la tabla base
        $this->table = $alias . 'general_categories';
    }
}
