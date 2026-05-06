<?php

namespace App\Http\Controllers;

use App\Services\SchoolResourceService;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(private readonly SchoolResourceService $resourceService)
    {
    }

    public function index(): View
    {
        $resources = [];

        foreach ($this->resourceService->resources() as $resource => $config) {
            $resources[$resource] = [
                'label' => $config['label'],
                'description' => $config['description'],
                'count' => count($this->resourceService->all($resource)),
                'route' => route($resource . '.index'),
            ];
        }

        return view('dashboard', [
            'resources' => $resources,
            'user' => session('client_user'),
        ]);
    }
}
