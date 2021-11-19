<?php

namespace App\Services;

use App\Components\ApiCheckInnInterface;
use App\Models\Inn;
use App\Repositories\InnRepository;
use App\Repositories\InnRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class InnService
{
    private $api;
    private $repositoryInn;

    public function __construct(ApiCheckInnInterface $api, InnRepository $repositoryInn) {
        $this->api = $api;
        $this->repositoryInn = $repositoryInn;
    }

    /**
     * @throws \App\Components\ApiCheckInnException
     */
    public function checkAndGetInn(string $inn , Carbon $dataNow): Inn
    {

        $modelInn  = $this->repositoryInn->findByInnAndCheckThisInn($inn , $dataNow);
        if (!$modelInn instanceof Inn) {
            $checkedData  = $this->api->checkInnFromApi($inn , $dataNow);
            $modelInn = new Inn();
            $modelInn->inn = $inn;
            $modelInn->checkingDate = $dataNow->format('Y-m-d');
            $modelInn->isSelfEmployed = $checkedData;
            if (!$modelInn->save()) {
                throw new \RuntimeException('Inn saving error');
            }
        }
        return $modelInn;
    }
}
