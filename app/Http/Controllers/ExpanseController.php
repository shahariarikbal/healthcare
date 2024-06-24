<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpanseStoreRequest;
use App\Models\Expanse;
use App\Services\ExpanseService;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ExpanseController extends Controller
{
    protected $expanseService;
    public function __construct(ExpanseService $expanseService)
    {
        $this->expanseService = $expanseService;
    }

    public function expanseManage()
    {
        if(request()->ajax()){
            $data = $this->expanseService->getAllDataFromDatabase();
            $dataWithAction = $data->map(function($row){
                $row->action = $this->expanseService->getActionButton($row);
                return $row;
            });

            $totalAmount = $dataWithAction->sum('amount');

            return DataTables()->of($dataWithAction)->with('total_amount', $totalAmount)->make(true);
        }
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

    public function expanseEdit($id)
    {
        $expanse = Expanse::findOrFail($id);
        return view('admin.pages.expanse.edit', compact('expanse'));
    }

    public function expanseUpdate(ExpanseStoreRequest $request, $id)
    {
        try{
            $expanse = Expanse::findOrFail($id);
            $this->expanseService->expanseUpdate($request, $expanse);
            return redirect()->route('expanse.manage')->with('success', 'Expanse has been updated');
        }catch(Exception $exception){
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function expanseDelete($id)
    {
        $expanse = Expanse::findOrFail($id);
        $expanse->delete();
        return redirect()->route('expanse.manage')->with('success', 'Expanse has been deleted');
    }
}
