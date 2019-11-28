<?php

namespace App;

use App\Http\Traits\baseTrait;
use App\Http\Traits\restaurantScopeTrait;
use App\Scopes\restaurantScope;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Util\TestDox\HtmlResultPrinter;

class HrAttendance extends Model
{
    use baseTrait, restaurantScopeTrait;


    public function employee()
    {
        return $this->belongsTo(HrEmployee::class, 'hr_employee_id');
    }


    public function getLateAttribute()
    {

        $shift = HrShift::whereHas('hours', function ($q) {
            $q->where('id', $this->hr_shift_hour_id);
        })->first();
        $shiftHour = HrShiftHour::find($this->hr_shift_hour_id);

        if ($shift->type == 'fixed') {

           return $this->fixed($shift,$shiftHour);

        } elseif ($shift->type == 'flexible') {

            return $this->flexible($shift,$shiftHour);

        }
    }

    public function fixed($shift,$shiftHour)
    {
        $threshold_time=date("H:i:s",strtotime($shift->threshold.'minutes', strtotime( $shiftHour->start_time)));
        $late='00:00:00';
        $overtime='00:00:00';
        $early='00:00:00';


         if($shift->threshold){
            if($this->check_in < $shiftHour->start_time){
                $overtime = date('H:i:s',
                    strtotime($shiftHour->start_time) - strtotime($this->check_in));
            }else if($this->check_in > $threshold_time){
                $late = date('H:i:s',
                    strtotime($this->check_in) - strtotime($threshold_time));
            }
        }
         else{
            if($this->check_in < $shiftHour->start_time){
                $overtime = date('H:i:s',
                    strtotime($shiftHour->start_time) - strtotime($this->check_in));
            }else if($this->check_in > $shiftHour->start_time){
                $late = date('H:i:s',
                    strtotime($this->check_in) - strtotime($shiftHour->shift_start));
            }
        }

        if($this->check_out < $shiftHour->end_time){
            $early = date('H:i:s',
                strtotime($shiftHour->end_time) - strtotime($this->check_out));
        }else if($this->check_out > $shiftHour->end_time){
            $overtime= date('H:i:s', strtotime($overtime) +
                strtotime($this->check_out) - strtotime($shiftHour->end_time));
        }
        return ['overtime'=>$overtime,'late'=>$late,'early'=>$early];
    }

    public function flexible($shift,$shiftHour)
    {
        $threshold_time=date("H:i:s",strtotime($shift->threshold.'minutes',
            strtotime( $shiftHour->start_time)));
        $late='00:00:00';
        $overtime='00:00:00';
        $early='00:00:00';
        $shift_time= date('H:i:s',
            strtotime($shiftHour->end_time) - strtotime($shiftHour->start_time));
        $actual_time= date('H:i:s',
            strtotime($this->check_out ) - strtotime($this->check_in ));

        if($shift_time>$actual_time) {
            $late=   date('H:i:s',
                strtotime($shift_time) - strtotime($actual_time));
        }else{
        $overtime=date('H:i:s',
            strtotime($actual_time) - strtotime($shift_time));
    }

        return ['overtime'=>$overtime,'late'=>$late,'early'=>$early];

}
}
