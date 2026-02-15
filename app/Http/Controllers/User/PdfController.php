<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Barryvdh\DomPDF\Facade\Pdf; // ✅ import
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;


class PdfController extends Controller
{
    public function generatePdf(Request $request)
    {
       $shops = Shop::select(
        'shop_name',
        'email',
        'address',
        'image'
    )->get();

    $data = [
        'title' => 'Shop List',
        'date' => now(),
        'items' => $shops
    ];

    return Pdf::loadView('pdf.invoice', $data)
        // ->setPaper('a4', 'portrait')
        ->download('shops.pdf');
    
}


public function mail()
{
   Mail::to('omarfaruck1994@gmail.com')->send(
        new ContactMail(
            'John Doe',
            'john@example.com',
            'This is a test message.'
        )
    );

    return "Mail sent successfully ✅";
}
}
