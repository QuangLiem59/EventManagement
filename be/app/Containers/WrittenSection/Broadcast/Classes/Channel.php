<?php

namespace App\Containers\WrittenSection\Broadcast\Classes;

use Illuminate\Broadcasting\Broadcasters\Broadcaster;

class Channel extends Broadcaster
{
    public function auth($request)
    {
        $channel = $request->get('channel');

        foreach ($this->channels as $pattern => $callback) {
            if (!$this->channelNameMatchesPattern($channel, $pattern)) {
                continue;
            }

            $parameters = $this->extractAuthParameters($pattern, $channel, $callback);

            $handler = $this->normalizeChannelHandlerToCallable($callback);

            $user = $this->retrieveUser($request, $channel);

            $result = $handler($user, ...$parameters);

            return $this->validAuthenticationResponse($request, $result);
        }

        return true;
    }

    public function validAuthenticationResponse($request, $result)
    {
        return $result;
    }

    public function broadcast(array $channels, $event, array $payload = [])
    {

    }
}
