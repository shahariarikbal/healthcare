<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpanseStoreRequest;
use App\Services\ExpanseService;
use Exception;
use Illuminate\Http\Request;

class ExpanseController extends Controller
{
    protected $expanseService;
    public function __construct(ExpanseService $expanseService)
    {
        $this->expanseService = $expanseService;
    }

    public function expanseManage()
    {
        return view('admin.pages.expanse.expanse');
    }

    public function expanseCreate()
    {
        return view('admin.pages.expanse.add');
    }

    public function expanseStore(ExpanseStoreRequest $request)
    {
        try{
            $this->expanseService->expanseStore($request);
            return redirect()->route('expanse.manage')->with('success', 'Expanse has been created');
        }catch(Exception $exception){
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
