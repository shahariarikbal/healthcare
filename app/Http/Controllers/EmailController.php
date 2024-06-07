<?php

namespace App\Http\Controllers;

use App\Jobs\PatientOfferEmailJob;
use App\Models\Email;
use App\Models\Patient;
use App\Services\EmailServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmailController extends Controller
{
    protected $emailService;

    public function __construct(EmailServices $emailService)
    {
        $this->emailService = $emailService;
    }

    public function emailCreate()
    {
        $emails = Patient::latest()->get(['email']);
        $chunks = $emails->chunk(100);
        return view('admin.pages.email.create', compact('chunks'));
    }

    public function emailSend(Request $request)
    {
        $this->validate($request, [
            'email_to' => 'required|array',
            'email_to.*' => 'required|email',
            'subject' => 'required|string|max:255',
            'body' => 'required',
        ], [
            'email_to.required' => 'At least one email must be selected',
            'email_to.*.required' => 'Email field is required',
            'email_to.*.email' => 'The email field must be a valid email'
        ]);
        
        $emails = $request->email_to;
        $patients = Patient::whereIn('email', $emails)->get();
        
        foreach($patients as $patient){
            $dynamicData = [
                'name' => $patient->name,
                'email_to' => $patient->email,
                'subject' => $request->subject,
                'body' => $request->body,
            ];

            Email::create([
                'email_to' => $patient->email,
                'subject' => $request->subject,
                'body' => $request->body,
            ]);
            dispatch(new PatientOfferEmailJob($patient->email, $dynamicData));
        }

        return redirect()->back()->with('success', 'Email has beeen sent');
    }

    public function sendingEmailShow()
    {
        if(request()->ajax()){
            $data = $this->emailService->getAllSendingEmailFromDatabase();
            $dataWithAction = $data->map(function($row){
                $row->action = $this->emailService->generateActionButtons($row);
                return $row;
            });

            return datatables()->of($dataWithAction)->make(true);
        }
        return view('admin.pages.email.sent-box');
    }

    public function sendingEmailDelete($id)
    {
        $email = Email::findOrFail($id);
        $email->delete();
        return redirect()->back()->with('success', 'Email has beeen deleted');
    }
}
