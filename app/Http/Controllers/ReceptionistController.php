<?php

namespace App\Http\Controllers;

use App\Constants\Statics;
use App\Constants\Status;
use App\Http\Requests\ReceptionistStoreRequest;
use App\Http\Requests\ReceptionistUpdateRequest;
use App\Models\Receptionist;
use App\Services\MessageServices;
use App\Services\ReceptionServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReceptionistController extends Controller
{
    protected $receptionServices;
    
    public function __construct(ReceptionServices $receptionServices)
    {
        $this->receptionServices = $receptionServices;
    }

    public function showLoginForm()
    {
        return view('auth.receptionist.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $receptionist = Receptionist::where('email', $request->email)->first();

        // if the receptionist is null
        if (!$receptionist) {
            return redirect()->back()->with('error', 'Invalid email address');
        }
        
        // if the receptionist is inactive
        if ($receptionist->is_active === Statics::INACTIVE) {
            return redirect()->back()->with('error', 'Unable to login. Please contact the admin');
        }

        // Attempt to login
        if (Auth::guard('receptionist')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/receptionist/dashboard');
        } else {
            return redirect()->back()->with('error', 'Incorrect password');
        }
    }


    public function index()
    {
        return view('receptionist.master');
    }

    public function logout(Request $request)
    {
        Auth::guard('receptionist')->logout();
        return redirect('/receptionist/login');
    }

    // Receiptionist CRUD operation
    public function receptionCreate()
    {
        return view('admin.pages.receptionist.add');
    }

    public function receptionStore(ReceptionistStoreRequest $request)
    {
        $newReception = $this->receptionServices->receptionistStore($request);
        return redirect()->route('reception.manage')->with('success', 'Receptionist has been created');
    }

    public function receptionManage()
    {
        if (request()->ajax()) {
            $data = $this->receptionServices->getReceptionistDataForDatatable();
            $dataWithActions = $data->map(function ($row) {
                $row->action = $this->receptionServices->generateActionButtons($row);
                return $row;
            });
            return datatables()->of($dataWithActions)->make(true);
        }
        return view('admin.pages.receptionist.manage');
    }

    public function receptionEdit($id)
    {
        $receptionist = Receptionist::findOrFail($id);
        return view('admin.pages.receptionist.edit', compact('receptionist'));
    }

    public function receptionView($id)
    {
        $receptionist = Receptionist::findOrFail($id);
        return view('admin.pages.receptionist.view', compact('receptionist'));
    }

    public function receptionUpdate(ReceptionistUpdateRequest $request, $id)
    {
        $receptionist = Receptionist::findOrFail($id);
        $this->receptionServices->receptionistUpdate($request, $receptionist);
        return redirect()->route('reception.manage')->with('success', 'Receptionist has been updated');
    }

    public function receptionActive($id)
    {
        $receptionist = Receptionist::findOrFail($id);
        $receptionist->is_active = Statics::INACTIVE;
        $receptionist->save();
        return redirect()->route('reception.manage')->with('success', 'Receptionist has been inactivated');
    }

    public function receptionInactive($id)
    {
        $receptionist = Receptionist::findOrFail($id);
        $receptionist->is_active = Statics::ACTIVE;
        $receptionist->save();
        return redirect()->route('reception.manage')->with('success', 'Receptionist has been Activated');
    }

    public function receptionDelete($id)
    {
        $receptionist = Receptionist::findOrFail($id);
        $receptionist->delete();
        return redirect()->route('reception.manage')->with('success', 'Receptionist has been deleted');
    }
}
