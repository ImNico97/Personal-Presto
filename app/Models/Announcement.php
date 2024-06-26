<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Announcement extends Model
{
    use HasFactory, Searchable;
    protected $fillable = [ 'title', 'description', 'price', 'category_id'];

    public function toSearchableArray(){
        $category = $this->category;
        $array = [
            'id'=>$this->id,
            'title'=>$this->title,
            'description'=>$this->description,
            // 'price'=>$this->price,
            'category'=>$category,
        ];
        return $array;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function toBeRevisionedCount()
    {
    return Announcement::where('is_accepted', null)->count();
    
    }

    public function setAccepted ($value)
    {
        $this->is_accepted=$value;
        $this->save();
        return true;
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }
}
