<?php

namespace App\Http\Middleware;

use Closure;


class ParticipantMiddleware
{

public function handle($request, Closure $next)
{

if(
auth()->user()->role !== 'participant'
){

abort(403);

}


return $next($request);


}
public function schedule()
{

$jadwal = CertificationSchedule::where(
'status',
'open'
)
->get();


return view(
'participant.schedule',
compact('jadwal')
);


}
}
