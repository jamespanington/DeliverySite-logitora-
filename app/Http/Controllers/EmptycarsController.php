<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Emptycar;

class EmptycarsController extends Controller
{
    public function __construct()
    {
       
        $this->middleware('auth');
    }
    public function index()
    {
    	return view('pages.emptyTruck_search');
    }
    public function create()
    {
        // echo "dsfadsa"; exit();
        return view('pages.emptyTruck_store');
    }
    public function store(Request $request)
    {
        // echo json_encode($request->get('urgent_matter')); exit();
    	$emptycar = new Emptycar([
            'emptycar_id' => $request->get('emptycar_id'),
    		'urgent_matter' => $request->get('emergency_case'),
    		'emptycar_date' => $request->get('loading_date'),
    		'emptycar_time' => $request->get('loading_time'),
    		'emptycar_space' => $request->get('emptyplaceSpec'),
    		'emptycar_city' => $request->get('city'),
    		'land_pos_loading' => $request->get('beginplace'),
    		'drop_date' => $request->get('drop_date'),
    		'drop_time' => $request->get('drop_time'),
    		// 'drop_city' => $request->get('drop_city'),
    		'land_pos_drop' => $request->get('endplace'),
    		'vehicle_inf' => $request->get('vehicle'),
    		'vehicle_type1' => $request->get('type1'),
    		'vehicle_type1_content' => $request->get('type_Other'),
    		'vehicle_type2' => $request->get('type2'),
    		'vehicle_type3' => $request->get('type3'),
    		'bigo' => $request->get('bigo'),
    		'phone_number' => $request->get('phone'),
    		'person_charge' => $request->get('person_charge')
    	]);
    	$emptycar->save();
    	return redirect('/emptyTruck_info');
    }
    public function show()
    {
        return view('pages.emptyTruck_info');
    }
    public function edit($id)
    {
    	return view('empty_Truck_edit');
    }
    public function update(Request $request, $id)
    {
    	$emptycar = Emptycar::find($id);
    	$emptycar->urgent_matter = $request->get('urgent_matter');
    	$emptycar->emptycar_date = $request->get('emptycar_date');
		$emptycar->emptycar_time = $request->get('emptycar_time');
    	$emptycar->emptycar_space = $request->get('emptycar_space');
    	$emptycar->emptycar_city = $request->get('emptycar_city');
    	$emptycar->land_pos_loading = $request->get('land_pos_loading');
    	$emptycar->drop_date = $request->get('drop_date');
    	$emptycar->drop_time = $request->get('drop_time');
    	// $emptycar->drop_city = $request->get('drop_city');
    	$emptycar->land_pos_drop = $request->get('land_pos_drop');
    	$emptycar->vehicle_inf = $request->get('vehicle_inf');
    	$emptycar->vehicle_type1 = $request->get('vehicle_type1');
    	$emptycar->vehicle_type1_content = $request->get('vehicle_type1_content');
    	$emptycar->vehicle_type2 = $request->get('vehicle_type2');
    	$emptycar->vehicle_type3 = $request->get('vehicle_type3');
    	$emptycar->bigo = $request->get('bigo');
    	$emptycar->phone_number = $request->get('phone_number');
    	$emptycar->person_charge = $request->get('person_charge');
    	$emptycar->save();
        return redirect('/emptyTruck_info');
    }
    public function destroy($id)
    {
    	$emptycar = Emptycar::find($id);
    	$emptycar = Emptycar::delete();
    	return response()->json('Successfully Deleted');
    }
    public function destroy_all()
    {
        Emptycar::delete();
        return redirect('pages.home');
    }
    public function search(Request $request){
        var_dump($request); exit();
        $emptycar = Emptycar::query();
        if(!empty($request->get('start_date') && $request->get('end_date'))){
            $emptycar->whereBetween('emptycar_date', [$request->get('start_date'), $request->get('end_date')]);
        }
        if(!empty($request->get('urgent_matter'))){
            $emptycar->where('urgent_matter', 'LIKE', $request->get('urgent_matter'));
        }
        if(!empty($request->get('emptycar_time'))){
            $emptycar->where('emptycar_time', '>=', $request->get('emptycar_time'));
        }
        if(!empty($request->get('emptycar_space'))){
            $emptycar->where('emptycar_space', 'LIKE', $request->get('emptycar_space'));
        }
        // $emptycar = Emptycar::query()
        //     ->where('emptycar_date', '>=', $request->get('emptycar_date'))
        //     ->where('urgent_matter', 'LIKE', $request->get('urgent_matter'))
        //     ->where('emptycar_time', '>=', $request->get('emptycar_time'))
        //     ->where('emptycar_space', 'LIKE', $request->get('emptycar_space'))
        //     ->get();
        echo json_encode($emptycar->get()); exit();
        return response()->json('Successfully Deleted');
        // $Student_record_search -> join('qualifications', 'qualifications.id', '=', 'student_registrations.course_applied_for');
        // $Student_record_search -> select(['student_registrations.id','student_registrations.reference_number','student_registrations.family_name', 'student_registrations.other_name', 'student_registrations.dob', 'student_registrations.gender', 'student_registrations.nationality',  'qualifications.qualification']);
        // if(!empty($_GET['reference_number'])){
        //     $Student_record_search -> where('student_registrations.reference_number', '=', $_GET['reference_number']);
        // }
        // if(!empty($_GET['family_name'])){
        //     $Student_record_search ->  where('student_registrations.family_name', '=', $_GET['family_name']);
        // }
        // if(!empty($_GET['other_name'])){
        //     $Student_record_search ->  where('student_registrations.other_name', '=', $_GET['other_name']);
        // }
        // if(!empty($_GET['dob'])){
        //     $Student_record_search ->  where('student_registrations.dob', '=', $_GET['dob']);
        // }
        // if(!empty($_GET['gender'])){
        //     $Student_record_search ->   where('student_registrations.gender', '=', $_GET['gender']);
        // }
        // if(!empty($_GET['nationality'])){
        //     $Student_record_search ->  where('student_registrations.nationality', '=', $_GET['nationality']);
        // }
        // if(!empty($_GET['qualification'])){
        //     $Student_record_search ->   where('qualifications.qualification', '=', $_GET['qualification']);
        // }
        // return Datatables::of($Student_record_search)->make(true);        
    }
}

