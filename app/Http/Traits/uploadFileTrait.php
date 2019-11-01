<?php
namespace App\Http\Traits;

use App\Uploadedfile;
use App\UploadFile;
use Illuminate\Support\Facades\Auth;

trait uploadFileTrait {


    public function upload($files) {

            foreach($files as $file)

            {        $name=$file->getClientOriginalName();

                $filename_images = date("dmY-his") . $name;
                $fulllink_images = '/media/'.($this->getTable()).'/files/';
                $file->move($fulllink_images, $filename_images);

                $upload=new UploadFile();
                $upload->restaurant_id=Auth::user()->restaurant->id;
                $upload->filable_type=get_class($this);
                $upload->filable_id=$this->id;
                $upload->url	=$fulllink_images . '/' . $filename_images;
                $upload->save();

           }


    }


    public function files(){
        return $this->morphMany(UploadFile::class,'filable');
    }
}
