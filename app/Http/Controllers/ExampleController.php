<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
     /**
     * @OA\Post(
     *     path="/api/things",
     *     operationId="/api/things",
     *     tags={"yourtag"},
     *     security={{"bearer_token":{}}},
     *     @OA\Response(
     *         response="200",
     *         description="Returns some sample category things",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Bad request. When required parameters were not supplied.",
     *     ),
     * )
     */

    public function getThings(Request $request)
    {
        return response()->json("Hello", Response::HTTP_OK);
    }

    //
}
