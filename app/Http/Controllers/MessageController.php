<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Message;
use App\Services\DoctorServices;
use App\Services\MessageServices;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    protected $doctorServices;
    protected $messageService;
    public function __construct(DoctorServices $doctorServices, MessageServices $messageService)
    {
        $this->doctorServices = $doctorServices;
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
        
        return view('admin.pages.message.doctor-list');
    }

    public function doctorMessage($id)
    {
        $doctor = Doctor::find($id);
        $sentMessages = $doctor->sentMessages()->with('receiver')->get();
        $receivedMessages = $doctor->receivedMessages()->with('sender')->get();
        return view('admin.pages.message.doctor-message-view', compact('doctor', 'sentMessages', 'receivedMessages'));
    }

    public function doctorMessageStore(Request $request, $id)
    {
        if(!$request->message){
            return redirect()->back()->with('error', 'The message field is required');
        }

        $this->messageService->adminMessageToDoctor($request, $id);
        return redirect()->back()->with('success', 'Message has been sent');
    }
}
