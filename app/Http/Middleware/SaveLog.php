<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\User;
use App\Events\ServiceRequested;
use App\DTO\Requests\ServiceRequestData;

class SaveLog
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
 
        $data = new ServiceRequestData(
            User::getByToken($request->bearerToken())->id,
            $request->path(),
            $request->getContent(),
            $response->status(),
            json_encode($response->getData()),
            $request->ip(),
        );

        ServiceRequested::dispatch($data);
 
        return $response;
    }
}
