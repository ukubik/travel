<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserAuthor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      if(Auth::user()->role->name !== "Автор" || Auth::user()->claim->result === "Отклонена") {
        return redirect()->route('index')->with(['errors' => ['Вы не являетесь Автором или Ваша заявка была отклонена']]);
      } elseif (Auth::user()->claim->result === "Рассматривается") {
        return redirect()->route('index')->with(['message' => 'Ваша заявка рассматривается администрацией']);
      }
        return $next($request);
    }
}
