<?php


namespace App\Approve;


class Chain implements Style
{
    public $type;
    public function __construct(TypeInterface $type){
        $this->type=$type;
    }

    public function checkResponseAvailability($type)
    {
    }


}
