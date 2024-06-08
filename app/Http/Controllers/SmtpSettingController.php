<?php

namespace App\Http\Controllers;

use App\Http\Requests\SmtpConfigRequest;
use App\Models\SmtpSetting;
use Illuminate\Http\Request;

class SmtpSettingController extends Controller
{
    public function showSmtpForm()
    {
        $setting = SmtpSetting::first();
        return view('admin.pages.smtp-setting.create', compact('setting'));
    }

    public function smtpStore(SmtpConfigRequest $request)
    {
        $data = [
            'mail_mailer' => $request->mail_mailer,
            'mail_host' => $request->mail_host,
            'mail_port' => $request->mail_port,
            'mail_username' => $request->mail_username,
            'mail_password' => $request->mail_password,
            'mail_encryption' => $request->mail_encryption ?? null,
            'mail_from_address' => $request->mail_from_address,
            'mail_from_name' => $request->mail_from_name
        ];
        SmtpSetting::updateOrCreate(['id' => 1], $data);

        return redirect()->back()->with('success', 'SMTP config has been updated');
    }
}
