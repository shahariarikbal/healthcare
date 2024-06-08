<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Doctor;
use App\Models\Message;
use App\Models\Receptionist;
use App\Services\AccountsServices;
use App\Services\DoctorServices;
use App\Services\MessageServices;
use App\Services\ReceptionServices;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    protected $doctorServices;
    protected $receptionServices;
    protected $accountsServices;
    protected $messageService;
    
    public function __construct(
        DoctorServices $doctorServices, 
        MessageServices $messageService, 
        ReceptionServices $receptionServices, 
        AccountsServices $accountsServices)
    {
        $this->doctorServices = $doctorServices;
        $this->receptionServices = $receptionServices;
        $this->accountsServices = $accountsServices;
        $this->messageService = $messageService;
    }

    //********* Doctor message section ***********//
    public function doctorMessagingList()
    {
        if (request()->ajax()) {
            $data = $this->doctorServices->getDoctorDataForDatatable();
            $dataWithActions = $data->map(function ($row) {
                $row->action = $this->doctorServices->generateMessageActionButton($row);
                return $row;
            });
            return datatables()->of($dataWithActions)->make(true);
        }
        
        return view('admin.pages.message.doctors.doctor-list');
    }

    public function showDoctorMessage($id)
    {
        $doctor = Doctor::find($id);
        $sentMessages = $doctor->sentMessages()->with('receiver')->get();
        $receivedMessages = $doctor->receivedMessages()->with('sender')->get();
        return view('admin.pages.message.doctors.doctor-message-view', compact('doctor', 'sentMessages', 'receivedMessages'));
    }

    public function doctorMessageStore(Request $request, $id)
    {
        if(!$request->message){
            return redirect()->back()->with('error', 'The message field is required');
        }

        $this->messageService->adminMessageToDoctor($request, $id);
        return redirect()->back()->with('success', 'Message has been sent');
    }


    //********* Receptionist message section ***********//
    public function receptionMessagingList()
    {
        if (request()->ajax()) {
            $data = $this->receptionServices->getReceptionistDataForDatatable();
            $dataWithActions = $data->map(function ($row) {
                $row->action = $this->receptionServices->generateMessageActionButton($row);
                return $row;
            });
            return datatables()->of($dataWithActions)->make(true);
        }
        
        return view('admin.pages.message.receptionist.list');
    }

    public function receptionMessage($id)
    {
        $reception = Receptionist::findOrFail($id);
        $sentMessages = $reception->sentMessages()->with('receiver')->get();
        $receivedMessages = $reception->receivedMessages()->with('sender')->get();
        return view('admin.pages.message.receptionist.message-view', compact('reception', 'sentMessages', 'receivedMessages'));
    }

    public function receptionMessageStore(Request $request, $id)
    {
        if(!$request->message){
            return redirect()->back()->with('error', 'The message field is required');
        }

        $this->messageService->adminMessageToReceptionist($request, $id);
        return redirect()->back()->with('success', 'Message has been sent');
    }


    //********* Accounts message section ***********//
    public function accountsMessagingList()
    {
        if (request()->ajax()) {
            $data = $this->accountsServices->getAccountsDataForDatatable();
            $dataWithActions = $data->map(function ($row) {
                $row->action = $this->accountsServices->generateMessageActionButton($row);
                return $row;
            });
            return datatables()->of($dataWithActions)->make(true);
        }
        
        return view('admin.pages.message.accounts.list');
    }

    public function accountsMessage($id)
    {
        $account = Account::findOrFail($id);
        $sentMessages = $account->sentMessages()->with('receiver')->get();
        $receivedMessages = $account->receivedMessages()->with('sender')->get();
        return view('admin.pages.message.accounts.message-view', compact('account', 'sentMessages', 'receivedMessages'));
    }

    public function accountsMessageStore(Request $request, $id)
    {
        if(!$request->message){
            return redirect()->back()->with('error', 'The message field is required');
        }

        $this->messageService->adminMessageToAccounts($request, $id);
        return redirect()->back()->with('success', 'Message has been sent');
    }
}
