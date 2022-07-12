<?php

namespace App\Http\Controllers\Relation;

use App\Models\Doctor;
use App\Models\Hospital;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Request;


//json_encode(  , JSON_UNESCAPED_UNICODE) // عرض النصوص العربيه

class DoctorsController extends Controller
{


    public function create(){
        $hospital = Hospital::all();
        $doctors = Doctor::all();
        return view('doctors.createdoctors', compact('hospital','doctors'));
    }

    public function store(Request $request){

//insert in database ادخال البيانات الئ داتا
Doctor::create([
    'id' => $request->id,
    'name' => $request->name,
    'title' => $request->title,
    'hospital_id' => $request->hospital_id,
    'gender' => $request->gender,


]);
//return 'Done yes';
return redirect()->back()->with(['success' => 'تم اضافة العرض بنجاح']);
    }


}
