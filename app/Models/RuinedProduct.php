<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RuinedProduct extends Model
{
    protected $table='ruined_products';
    public function ruinedHeader(){
       return $this->belongsTo(RuinedHeader::class,'ruined_header_id');
    }
    public function product(){
       return $this->belongsTo(Product::class);
    }

}
