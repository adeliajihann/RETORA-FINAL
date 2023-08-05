<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class EmailController extends Controller
{
    public function kirim()
    {
        $email = 'retora.lesprivat@gmail.com';
        $data = [
            'title' => 'Hai, Tutor!',
            // 'url' => 'https://aantamim.id',
        ];
        Mail::to($email)->send(new SendMail($data));
        return 'Berhasil mengirim email!';
    }
}
