<?php

namespace App\Http\Controllers;

use App\Constants\Statics;
use App\Constants\Status;
use App\Http\Requests\AccountsStoreRequest;
use App\Http\Requests\AccountsUpdateRequest;
use App\Models\Account;
use App\Services\AccountsServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    protected $accountServices;

    public function __construct(AccountsServices $accountServices)
    {
        $this->accountServices = $accountServices;
    }


    public function showLoginForm()
    {
        return view('auth.account.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $account = Account::where('email', $request->email)->first();

        // Check if the account is null
        if (!$account) {
            return redirect()->back()->with('error', 'Invalid email address');
        }
        
        // Check if the account is inactive
        if ($account->is_active === Statics::INACTIVE) {
            return redirect()->back()->with('error', 'Unable to login. Please contact the admin');
        }

        // Attempt to login
        if (Auth::guard('account')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/account/dashboard');
        } else {
            return redirect()->back()->with('error', 'Incorrect password');
        }
    }


    public function index()
    {
        return view('account.master');
    }

    public function logout(Request $request)
    {
        Auth::guard('account')->logout();
        return redirect('/account/login');
    }


    // Receiptionist CRUD operation
    public function accountsCreate()
    {
        return view('admin.pages.accounts.add');
    }

    public function accountsStore(AccountsStoreRequest $request)
    {
        $newReception = $this->accountServices->accountsStore($request);
        return redirect()->route('accounts.manage')->with('success', 'Account has been created');
    }

    public function accountsManage()
    {
        if (request()->ajax()) {
            $data = $this->accountServices->getAccountsDataForDatatable();
            $dataWithActions = $data->map(function ($row) {
                $row->action = $this->accountServices->generateActionButtons($row);
                return $row;
            });
            return datatables()->of($dataWithActions)->make(true);
        }
        return view('admin.pages.accounts.manage');
    }

    public function accountsEdit($id)
    {
        $accounts = Account::findOrFail($id);
        return view('admin.pages.accounts.edit', compact('accounts'));
    }

    public function accountsView($id)
    {
        $accounts = Account::findOrFail($id);
        return view('admin.pages.accounts.view', compact('accounts'));
    }

    public function accountsUpdate(AccountsUpdateRequest $request, $id)
    {
        $accounts = Account::findOrFail($id);
        $this->accountServices->accountsUpdate($request, $accounts);
        return redirect()->route('accounts.manage')->with('success', 'Account has been updated');
    }

    public function accountsActive($id)
    {
        $accounts = Account::findOrFail($id);
        $accounts->is_active = Statics::INACTIVE;
        $accounts->save();
        return redirect()->route('accounts.manage')->with('success', 'Accounts has been inactivated');
    }

    public function accountsInactive($id)
    {
        $accounts = Account::findOrFail($id);
        $accounts->is_active = Statics::ACTIVE;
        $accounts->save();
        return redirect()->route('accounts.manage')->with('success', 'Accounts has been Activated');
    }

    public function accountsDelete($id)
    {
        $accounts = Account::findOrFail($id);
        $accounts->delete();
        return redirect()->route('accounts.manage')->with('success', 'Accounts has been deleted');
    }
}
