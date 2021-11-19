<?php

namespace App\Repositories;

use App\Models\Inn;
use Carbon\Carbon;

interface InnRepositoryInterface
{
    public function findByInnAndCheckThisInn(string $inn, Carbon $date);

}
