<?php

namespace App\Http\Controllers\Api\V1\Front;

use Illuminate\Support\Str;
use Carbon\Carbon;  
use App\Models\{
    Avi,
    Votings,
    Settings,
};
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\{
    Request,
    JsonResponse
};

class VotingsController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index(Request $request)
    {
        
    }

    public function show($id)
    {
        
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        /** @var User $user */
        $user = auth()->user();
        $avi_id = $request->get('avi_id');
		
        Votings::create([
            'avi_id' => $avi_id,
            'user_id' => $user->id
        ]);
        return response()->json([
            'status' => 'success',
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function isPossible(Request $request): JsonResponse
    {
        /** @var User $user */
        $user = auth()->user();
		
        $votings = Votings::where('user_id', $user->id)->get();
        if (count($votings) > 0) {
            return response()->json([
                'possible' => false,
            ]);
        }
        return response()->json([
            'possible' => true,
        ]);
    }
}