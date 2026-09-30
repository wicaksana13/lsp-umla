<?php

namespace App\Http\Controllers\SuperAdmin;


use App\Http\Controllers\Controller;
use App\Models\AssessmentRegistration;
use Illuminate\Http\Request;


class AssessmentController extends Controller
{


public function index()
{


$data = AssessmentRegistration::with([

'participant',

'schedule.scheme',

'schedule.tuk'

])

->latest()

->paginate(15);



return view(
'superadmin.assessment.index',
compact('data')
);


}





public function approve(
AssessmentRegistration $assessment
)
{


$assessment->update([

'status'=>'berlangsung',

'approved_by'=>auth()->id(),

'approved_at'=>now()

]);


return back()

->with(
'success',
'Peserta asesmen disetujui.'
);


}





public function reject(
Request $request,
AssessmentRegistration $assessment
)
{


$assessment->update([

'status'=>'tidak_kompeten',

'note'=>$request->note

]);


return back();

}




public function result(
AssessmentRegistration $assessment
)
{


$assessment->load([

'participant',

'schedule.scheme',

'schedule.tuk',

'units'

]);



return view(
'superadmin.assessment.result',
compact('assessment')
);


}


}