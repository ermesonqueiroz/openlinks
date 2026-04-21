<?php

namespace App\Http\Controllers;

use App\Enums\VisitPlatform;
use App\Models\Link;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use function parse_url;

class RedirectController extends Controller
{
    public function __invoke(Link $link, Request $request): RedirectResponse
    {
        $refererUrl = $request->headers->get('referer', 'direct');
        $refererHost = parse_url($refererUrl, PHP_URL_HOST) ?? 'direct';
        $userAgent = $request->headers->get('user-agent');
        $platform = trim($request->headers->get('sec-ch-ua-platform'), '"') ?? VisitPlatform::Unknown;

        $link->visits()->create([
            'referer_host' => $refererHost,
            'referer_url' => $refererUrl,
            'user_agent' => $userAgent,
            'platform' => $platform
        ]);

        return redirect($link->destination_url);
    }
}
