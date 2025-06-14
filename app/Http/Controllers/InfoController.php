<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InfoController extends Controller
{
    /**
     * Display PHP information.
     *
     * @return void
     */
    public function showPhpInfo()
    {
        phpinfo();
    }

    /**
     * Handle a GET request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function handleGetRequest()
    {
        return response()->json(['message' => 'This is a GET request.']);
    }

    /**
     * Handle a POST request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handlePostRequest(Request $request)
    {
        return response()->json([
            'message' => 'This is a POST request.',
            'data_received' => $request->all()
        ]);
    }
}
