<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public const PAGINATION_COUNT = 5;

    public static $createRules = [
        'name' => 'required|alpha_num',
        'image' => 'required|image|max:2048',
        'description' => 'required',
        'price' => 'numeric|min:1',
        'discount' => 'numeric|min:0.1|max:100',
    ];

    public static $editRules = [
        'name' => 'required|alpha_num',
        'description' => 'required',
        'price' => 'numeric|min:1',
        'discount' => 'numeric|min:0.1|max:100',
    ];

    public $timestamps = false;
    protected $guarded = ['id', 'rating', 'rating_count'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function getPriceAfterDiscount() {
        return $this->price - ($this->price * $this->discount);
    }
}
