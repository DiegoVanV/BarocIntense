<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'naam',
        'categorie',
        'product_code',
        'prijs',
        'voorraad',
        'installatiekosten',
    ];

    protected $casts = [
        'prijs' => 'decimal:2',
        'installatiekosten' => 'decimal:2',
        'voorraad' => 'integer',
    ];

    /**
     * Get allowed categories
     */
    public static function getCategories()
    {
        return ['Automaten', 'Koffiebonen'];
    }
}

