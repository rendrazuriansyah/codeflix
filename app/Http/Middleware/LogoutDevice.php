<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\DeviceLimitService;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class LogoutDevice
 *
 * Middleware for logging out a device. If the request is a logout request,
 * it will log out the device id stored in the session.
 *
 * @package App\Http\Middleware
 */
class LogoutDevice
{
    /**
     * @var \App\Services\DeviceLimitService
     */
    protected $deviceService;

    /**
     * LogoutDevice constructor.
     *
     * @param \App\Services\DeviceLimitService $deviceService
     */
    public function __construct(DeviceLimitService $deviceService)
    {
        $this->deviceService = $deviceService;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // If the request is a logout request, log out the device
        if ($this->isLogoutRequest($request)) {
            // Get the device id from the session
            $deviceId = Session::get('device_id');

            // If there is a device id, log out the device
            if ($deviceId) {
                $this->deviceService->logoutDevice($deviceId);
            }
        }

        // Continue with the request
        return $next($request);
    }

    /**
     * Check if the request is a logout request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return bool
     */
    private function isLogoutRequest(Request $request): bool
    {
        // Check if the request is a logout request
        return $request->is('logout') || Route::currentRouteName() === 'logout';
    }
}

