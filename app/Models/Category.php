<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded=[];
    protected $fillable = [];  //['name','parent_id','type'];

    public function dishes()
    {
        return $this->hasMany(Dish::class);
    }

    public function parent()
    {
        return $this->where('id', $this->parent_id);
    }

}
