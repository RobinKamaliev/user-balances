<?php

declare(strict_types=1);

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use App\Http\Requests\View\HistoryViewRequest;
use App\Http\Resources\Api\User\DashboardResource;
use App\User\Exceptions\UserNotFoundException;
use App\User\Services\DashboardService;
use App\User\Services\HistoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class ViewController extends Controller
{
    /**
     * Получения данных для dashboard.
     *
     * @throws UserNotFoundException
     */
    public function dashboard(DashboardService $service): JsonResponse
    {
        $dashboardUserServiceDto = $service->run();

        return response()->json(DashboardResource::make($dashboardUserServiceDto->toArray()));
    }

    /**
     * Получения данных для dashboard.
     *
     * @throws UserNotFoundException
     */
    public function history(HistoryViewRequest $request, HistoryService $service): View
    {
        $operations = $service
            ->run($request->input('description'))
            ->getOperations();

        return view('history', compact('operations'));
    }
}
