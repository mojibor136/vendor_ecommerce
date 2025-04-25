<?php

namespace App\Http\Middleware\Visitor;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Visitor\Visitor;

class VisitorTracking {
    /**
    * Handle an incoming request.
    *
    * @param  \Closure( \Illuminate\Http\Request ): ( \Symfony\Component\HttpFoundation\Response )  $next
    */

    public function handle( Request $request, Closure $next ): Response {
        Visitor::create( [
            'ip_address' => $request->ip(),
            'page_visited' => url()->current(),  // Current page URL
        ] );

        return $next( $request );
    }
}
