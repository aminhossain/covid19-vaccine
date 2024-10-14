<?php

namespace App\Http\Controllers;

use App\Services\SearchService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SearchController extends Controller
{
    protected $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    /**
     * Search vaccination status by NID.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function searchByNID(Request $request): JsonResponse
    {
        $nid = $request->query('nid');

        if (!$nid) {
            return response()->json(['error' => 'NID is required'], 400);
        }

        $result = $this->searchService->findStatusByNID($nid);

        return response()->json($result);
    }
}
