<?php

namespace App\Containers\WrittenSection\Broadcast\Classes;

use Illuminate\Support\Facades\Facade;

/**
 * @method static void routes(array|null $attributes = null)
 * @method static void userRoutes(array|null $attributes = null)
 * @method static void channelRoutes(array|null $attributes = null)
 * @method static string|null socket(\Illuminate\Http\Request|null $request = null)
 * @method static \Illuminate\Broadcasting\PendingBroadcast event(mixed|null $event = null)
 * @method static void queue(mixed $event)
 * @method static mixed connection(string|null $driver = null)
 * @method static mixed driver(string|null $name = null)
 * @method static \Pusher\Pusher pusher(array $config)
 * @method static \Ably\AblyRest ably(array $config)
 * @method static string getDefaultDriver()
 * @method static void setDefaultDriver(string $name)
 * @method static void purge(string|null $name = null)
 * @method static \Illuminate\Broadcasting\BroadcastManager extend(string $driver, \Closure $callback)
 * @method static \Illuminate\Contracts\Foundation\Application getApplication()
 * @method static \Illuminate\Broadcasting\BroadcastManager setApplication(\Illuminate\Contracts\Foundation\Application $app)
 * @method static \Illuminate\Broadcasting\BroadcastManager forgetDrivers()
 * @method static mixed auth(\Illuminate\Http\Request $request)
 * @method static mixed validAuthenticationResponse(\Illuminate\Http\Request $request, mixed $result)
 * @method static void broadcast(array $channels, string $event, array $payload = [])
 * @method static array|null resolveAuthenticatedUser(\Illuminate\Http\Request $request)
 * @method static void resolveAuthenticatedUserUsing(\Closure $callback)
 * @method static \Illuminate\Broadcasting\Broadcasters\Broadcaster channel(\Illuminate\Contracts\Broadcasting\HasBroadcastChannel|string $channel, callable|string $callback, array $options = [])
 *
 * @see \Illuminate\Broadcasting\BroadcastManager
 * @see \Illuminate\Broadcasting\Broadcasters\Broadcaster
 */
class Broadcast extends Facade
{
    public static function getFacadeAccessor()
    {
        return Channel::class;
    }
}