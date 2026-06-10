<?php

namespace App\Models;



use App\Models\Section;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'quantity',
        'section_id',
        'image',
        'stock',
    ];


    // Relation with Section
    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }

    // JSON に image_url を含める
    protected $appends = ['image_url'];

    // accessor
    public function getImageUrlAttribute()
    {
        return $this->image
            ? Storage::url($this->image)
            : null;
    }
}
