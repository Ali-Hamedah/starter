<?php

namespace App\Http\Controllers\Relation;

use services;
use App\Models\Doctor;
use App\Models\Hospital;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Support\Facades\Redirect;

//json_encode(  , JSON_UNESCAPED_UNICODE) // عرض النصوص العربيه

class RelationsController extends Controller
{
    public function getHospitalDoctors()
    {
        $hospital = Hospital::find(1); // 2- Hospital::where('id',1)->first(); //3- Hospital::first();

        // return $hospital->doctors;

        $hospital = Hospital::with('doctors')->find(1);
        //json_encode(  $hospital, JSON_UNESCAPED_UNICODE);

        $doctors = $hospital->doctors;
        foreach ($doctors as $doctor) {
            echo  $doctor->name, '<br>';
        }
    }

    public function hospitals()
    {
        $hospitals = Hospital::select('id', 'name', 'address')->get();
        return view('hospitals.hospitals', compact('hospitals'));
    }

    public function doctors($hospital_id)
    {
        $hospital = Hospital::find($hospital_id);
        $doctors = $hospital->doctors;

        return view('doctors.doctors', compact('doctors'));
    }
    // get all hospital which must has doctors
    public function hospitalsHasDoctors()
    {

        $hospital = Hospital::whereHas('doctors')->get();
        return json_encode($hospital, JSON_UNESCAPED_UNICODE);
    }

     //get hospital in male
    public function hospitalshasdoctorsmale()
    {
         $hospitalhasmale = Hospital::whereHas('doctors', function ($q) {
            $q->where('gender', 2);
        })->get();
        return json_encode($hospitalhasmale, JSON_UNESCAPED_UNICODE);
    }

     // get hospital not doctors
    public function hospitalsNotHasDoctors(){
        $hospitalnot = Hospital::whereDoesntHave('doctors')->get();
        return json_encode($hospitalnot, JSON_UNESCAPED_UNICODE);
    }

    public function hospitalsDelete($hospital_id){
       $hospital = Hospital::find($hospital_id);
       if(!$hospital)
       return abort('404');

       $hospital -> doctors()-> delete();
       $hospital -> delete();

       return redirect()->back()->with(['success' => 'تم الحذف']);

    }


    public function create(){
        return view('hospitals.create');
    }

    public function store(Request $request){

//insert in database ادخال البيانات الئ داتا
Hospital::create([
    'id' => $request->id,
    'name' => $request->name,
    'address' => $request->address,


]);
//return 'Done yes';
return redirect()->back()->with(['success' => 'تم اضافة العرض بنجاح']);
    }

    // many to many
    public function getDoctorServices(){
        $doctor = Doctor::with('services')->find(9);
        // $doctor->services;
       return json_encode(  $doctor, JSON_UNESCAPED_UNICODE);

    }
    //many to many
    public function getServicesDoctorsssssss(){
        $doctor = Service::with(['doctors' => function($q){
           $q -> select('doctors.id', 'name');
        }])->find(1);
        // $doctor->services;
       return json_encode(  $doctor, JSON_UNESCAPED_UNICODE);

    }

    public function getServicesDoctors($doctor_id){
        $doctor = Doctor::find($doctor_id);
       $services = $doctor->services;

       $doctors = Doctor::select('id','name')->get();
       $allServices = Service::select('id','name')->get();


       return view('doctors.services', compact('services','doctors', 'allServices'));

    }

    //many to many insert to database
    public function saveServicesToDoctors(Request $request){

        $doctor = Doctor::find($request -> doctor_id);

       // $doctor-> services()-> attach($request -> servicesIds); // add with repetition اضافه مع التكرار

      // $doctor-> services()-> sync($request -> servicesIds);// update database تحديث البيانات وحذف القديم

       $doctor-> services()-> syncWithoutDetaching($request -> servicesIds); // add in database اضافه بدون تكرار

        return 'success';


    }






}
