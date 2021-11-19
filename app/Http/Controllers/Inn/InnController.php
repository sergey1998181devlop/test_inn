<?php

namespace App\Http\Controllers\Inn;

use App\Components\ApiCheckInnException;
use App\Rules\CheckInn;
use Illuminate\Routing\Controller as BaseController;

use App\Services\InnService;
use Carbon\Carbon;
use App\Models\Inn;
use Illuminate\Http\Request;

class InnController extends BaseController
{
    private $service;

    public function __construct(InnService $service)
    {
        $this->service = $service;
    }

    /**
     * @throws ApiCheckInnException
     */
    public function checkInn(Request $request)
    {

        $validatedInn = $request->validate([
            'inn' => ['required', new CheckInn],
        ]);

        return view('pages.inn', [
            'viewModel' => $this->service->checkAndGetInn($request->get('inn'), Carbon::now())->getViewModel()
        ]);
    }

    public function allInn()
    {
        dd(
            Inn::all()->map(function(Inn $inn) {
                return $inn->getAttributes();
            })
        );
    }
}
