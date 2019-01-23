<?php

namespace App\Http\Controllers\Api;

use App\Services\GravatarService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    private $gravatarService;

    public function __construct(GravatarService $gravatarService)
    {
        $this->gravatarService = $gravatarService;
    }

    public function getAvatarUri(Request $request)
    {
        try {
            return "<img src='" . $this->gravatarService->getAvatar(md5(time())) . "'>";
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }
    }
}
