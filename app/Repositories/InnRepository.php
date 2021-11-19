<?php

namespace App\Repositories;

use App\Models\Inn;
use Carbon\Carbon;

class InnRepository implements  InnRepositoryInterface{

    public function findByInnAndCheckThisInn(string $inn , Carbon $dataNow){
       return Inn::where('inn' , $inn)
            ->where('checkingDate' , $dataNow->format('Y-m-d'))
            ->get()
            ->first();
    }
}

