<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Section extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    
}
