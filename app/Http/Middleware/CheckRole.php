<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $email = $request->emailLogin;

        $isPemilik = \App\Models\UserEmailModel::where('email', $email)->exists();
        $isPengambil = \App\Models\UserPengambilModel::where('email', $email)->exists();
        $isBank = \App\Models\UserBankSampahModel::where('email', $email)->exists();

        if ($isPemilik && ($isPengambil || $isBank)) {
            return redirect('/pilih-akun');
        }

        return $next($request);
    }
}
