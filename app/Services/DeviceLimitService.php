<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserDevice;
use Illuminate\Support\Str;
use Jenssegers\Agent\Facades\Agent;

/**
 * Service class to manage user devices.
 */
class DeviceLimitService
{
    /**
     * Registers a new device for a user.
     *
     * @param  \App\Models\User  $user
     * @return \App\Models\UserDevice|false
     */
    public function registerDevice(User $user)
    {
        $deviceInfo = $this->getDeviceInfo();

        $existingDevice = $this->findExistingDevice($user, $deviceInfo);
    
        if ($existingDevice) {
            $existingDevice->update(['last_active' => now()]);
            session(['device_id' => $existingDevice->device_id]);
            return $existingDevice;
        }

        if ($this->hasReachedDeviceLimit($user)) {
            return false; // Device limit reached
        }

        $device = $this->createNewDevice($user, $deviceInfo);
        
        session(['device_id' => $device->id]);

        return $device;
    }

    /**
     * Gets the device information from the request.
     *
     * @return array
     */
    private function getDeviceInfo()
    {
        return [
            'device_name' => $this->generateDeviceName(),
            'device_type' => Agent::isDesktop() ? 'desktop' : (Agent::isPhone() ? 'phone' : 'tablet'),
            'platform' => Agent::platform(),
            'platform_version' => Agent::version(Agent::platform()),
            'browser' => Agent::browser(),
            'browser_version' => Agent::version(Agent::browser()),
        ];
    }

    /**
     * Generates a device name based on the platform and browser.
     *
     * @return string
     */
    private function generateDeviceName()
    {
        return ucfirst(Agent::platform()) . ' ' . ucfirst(Agent::browser());
    }

    /**
     * Finds an existing device for the user that matches the given device info.
     *
     * @param  \App\Models\User  $user
     * @param  array  $deviceInfo
     * @return \App\Models\UserDevice|null
     */
    private function findExistingDevice(User $user, array $deviceInfo)
    {
        return UserDevice::where('user_id', $user->id)
            ->where('device_type', $deviceInfo['device_type'])
            ->where('platform', $deviceInfo['platform'])
            ->where('browser', $deviceInfo['browser'])
            ->first();
    }

    /**
     * Checks if the user has reached the maximum device limit.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    private function hasReachedDeviceLimit(User $user)
    {
        $maxDevices = $user->getCurrentPlan()->max_devices ?? 1;
        return UserDevice::where('user_id', $user->id)->count() >= $maxDevices;
    }

    /**
     * Creates a new device for the user.
     *
     * @param  \App\Models\User  $user
     * @param  array  $deviceInfo
     * @return \App\Models\UserDevice
     */
    private function createNewDevice(User $user, array $deviceInfo)
    {
        return UserDevice::create([
            'user_id' => $user->id,
            'device_name' => $deviceInfo['device_name'],
            'device_id' => $this->generateDeviceId(),
            'device_type' => $deviceInfo['device_type'],
            'platform' => $deviceInfo['platform'],
            'platform_version' => $deviceInfo['platform_version'],
            'browser' => $deviceInfo['browser'],
            'browser_version' => $deviceInfo['browser_version'],
            'last_active' => now(),
        ]);
    }

    /**
     * Generates a random device ID.
     *
     * @return string
     */
    private function generateDeviceId()
    {
        return Str::random(32);
    }
}

