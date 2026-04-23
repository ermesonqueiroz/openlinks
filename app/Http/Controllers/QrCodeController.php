<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Services\QrCode;

class QrCodeController extends Controller
{
    public function __invoke(Link $link)
    {
        $qrCode = (new QrCode())->generate(
            route('redirect', [
                'link' => $link->alias,
                'r' => 'qr'
            ])
        );

        return response($qrCode->toHtml(), 200, [
            'Content-Type' => 'image/png',
        ]);
    }
}
