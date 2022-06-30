<?php

namespace App\Http\Controllers;




use ar;
use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Requests\OfferRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use LaravelLocalization;


class CrudController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getOffers()
    {
        return Offer::get();
    }

   // public function storek()
    //{
       // Offer::create([
           // 'name' => 'ahmed',
           // 'price' => '5000',
           // 'details' => 'details offer3',
       // ]);
   // }


    public function create()
    {
        return view('offers.create');
    }

    public function store(OfferRequest $request)
    {
        //تم استبدالها بملف OfferRequest
  //validate data before insert to database
 // $rules = $this->getRules();
  //$messages = $this->getMessages();

  //$validator = Validator::make(
     // $request->all(),
      //$rules,
      //$messages
  //);
  //if ($validator->fails()) {
      // return $validator -> errors();
      //return json_encode($validator->errors(), JSON_UNESCAPED_UNICODE); // عشان الغه العربيه تضهر
    //  return redirect()->back()->withErrors($validator)->withInputs($request->all()); // ترجع رساله الخطا في نفس الصفحه
  //}


        //insert in database ادخال البيانات الئ داتا
        Offer::create([
            'id' => $request->id,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'name_de' => $request->name_de,
            'details_ar' => $request->details_ar,
            'details_en' => $request->details_en,
            'details_de' => $request->details_de,
            'price' => $request->price,

        ]);
        //return 'Done yes';
        return redirect()->back()->with(['success' => 'تم اضافة العرض بنجاح']);
    }

    //  عرض البيانات في الفيو
    public function getAllOffers(){
        //عرض كل البيانات من الداتا
     // $offers =  Offer::select('id', 'price',
       //'name_ar','name_en', 'details_ar', 'details_en',)->get();
     // return view('offers.all', compact('offers'));

      //عرض البيانات حسب اللغه
      $offers =  Offer::select(
        'id',
        'price',
        'name_'.LaravelLocalization::getcurrentLocale() .' as name', //نقطه مهمه انتبه للمسافات
        'details_'.LaravelLocalization::getcurrentLocale().' as details',)->get();
     return view('offers.all', compact('offers'));
    }




}
