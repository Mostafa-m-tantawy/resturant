<?php namespace App;

use Illuminate\Database\Eloquent\Model;


class Uploadedfile extends Model {
	protected $guarded = array();

    public static $rules = array(
        'filable_type' => 'required',
        'filable_id' => 'required',
        'filetype_id' => 'required',
        'link' => 'required'
    );


	public function filable()
	{
		return $this->morphTo();
	}

	public function filetype()
	{
		return $this->belongsTo('BaklySystems\Hydrogen\Models\Filetype');
	}
//
//    public static function addFiles($inst){
//
//        $filetypes=self::filetypes($inst);
//        //dd($phototypes);
//        $files=array();
//        foreach($filetypes as $pt){
//
//            //dd(Input::file()." got in");
//
//
//            if(Input::hasFile($pt->name)){
//
//                $ty=Input::file($pt->name);
//                // dd($ty);
//
//
//
//                if(is_array($ty)){
//                    //     dd($ty);
//                    foreach($ty as $img){
//
//                        $fname=date("dmY-his") . '.' . $img->getClientOriginalExtension();  //getClientOriginalName();
//                        $img->move('files/library/'.strtolower(get_class($inst)).'/'.$pt->name,$fname );
//                        $img_ins=new Uploadedfile();
//                        $img_ins->link=$fname;
//                        $img_ins->filetype_id=$pt->id;
//                        $files[]=$img_ins;
//                        $inst->files()->save($img_ins);
//                    }
//                }else{
//                    // dd($ty);
//                    $img=$ty;
//                    $fname=date("dmY-his") . '.' . $img->getClientOriginalExtension();  //getClientOriginalName();
//                    $img->move('files/library/'.strtolower(get_class($inst)).'/'.$pt->name,$fname );
//                    $img_ins=new Uploadedfile();
//                    $img_ins->link=$fname;
//                    $img_ins->filetype_id=$pt->id;
//                    $files[]=$img_ins;
//                    $inst->files()->save($img_ins);
//                }
//            }
//        }
//        return $files;
//    }

//    public static function manualAddFiles(){
//
//        $files=array();
//
//        if(Input::hasFile('AttendanceFile')){
//
//            $ty=Input::file('AttendanceFile');
//            // dd($ty);
//
//            if(is_array($ty)){
//                //     dd($ty);
//
//
//                foreach($ty as $img){
//
//                    $fname=date("dmY-his") . '.' . $img->getClientOriginalExtension(); //getClientOriginalName();
//                    $img->move('files/library/'.strtolower('Attendance').'/'.'AttendanceFile',$fname );
//                    $img_ins=new Uploadedfile();
//                    $img_ins->link=$fname;
//                    $img_ins->filetype_id=0;
//                    $img_ins->filable_type='attendance';
//                    $img_ins->filable_id=0;
//                    $files[]=$img_ins;
//                    $img_ins->save();
//                }
//            }else{
//                // dd($ty);
//                $img=$ty;
//                $fname=date("dmY-his") . '.' . $img->getClientOriginalExtension();  //getClientOriginalName();
//                $img->move('files/library/'.strtolower('Attendance').'/'.'AttendanceFile',$fname );
//                $img_ins=new Uploadedfile();
//                $img_ins->link=$fname;
//                $img_ins->filetype_id=0;
//                $img_ins->filable_type='attendance';
//                $img_ins->filable_id=0;
//                $files[]=$img_ins;
//                $img_ins->save();
//            }
//        }
//
//        return $files;
//    }
    public static function getFile($filetype_id, $filable_id, $filable_type){
        return Uploadedfile::where('filetype_id' , '=', $filetype_id)->where('filable_id', '=', $filable_id)
            ->where('filable_type', '=', $filable_type)->get()->first();

    }
}
