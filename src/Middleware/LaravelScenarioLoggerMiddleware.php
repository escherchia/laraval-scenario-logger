<?php

namespace Escherchia\LaravelScenarioLogger\Middleware;

use Closure;
use Escherchia\LaravelScenarioLogger\Logger\ScenarioLogger;
use Illuminate\Support\Facades\Auth;

class LaravelScenarioLoggerMiddleware
{
    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        lsl_service_is_active('log-request') ? ScenarioLogger::logForService('log-request', $request): null;
        Auth::check() ? ScenarioLogger::setUser(Auth::user()) : null;
        throw new \Exception('asdasd');
        $response = $next($request);

        lsl_service_is_active('log-response') ? ScenarioLogger::logForService('log-response', $response): null;
        ScenarioLogger::finish();

        return $response;
    }
}
