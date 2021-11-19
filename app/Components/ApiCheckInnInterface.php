<?php

namespace App\Components;

use Carbon\Carbon;

interface ApiCheckInnInterface
{

    /**
     * @param string $inn
     * @param Carbon $date
     * @return bool
     * @throws ApiCheckInnException
     */
    public function checkInnFromApi(string $inn, Carbon $date): bool;
}
