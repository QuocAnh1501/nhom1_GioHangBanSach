<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {
        if (!Auth::check()) {
            return redirect()
                ->route('login')
                ->with('error', 'Vui lòng đăng nhập.');
        }

        if (Auth::user()->role !== 'admin') {
            abort(403, 'Bạn không có quyền truy cập trang quản trị.');
        }

        return $next($request);
    }
}