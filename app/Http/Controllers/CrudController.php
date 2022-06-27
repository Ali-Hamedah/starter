<?php

namespace App\Http\Controllers;




use ar;
use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

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

    public function storek()
    {
        Offer::create([
            'name' => 'ahmed',
            'price' => '5000',
            'details' => 'details offer3',
        ]);
    }


    public function create()
    {
        return view('offers.create');
    }

    public function store(Request $request)
    {
        //validate data before insert to database
        $rules = $this->getRules();
        $messages = $this->getMessages();

        $validator = Validator::make(
            $request->all(),
            $rules,
            $messages
        );
        if ($validator->fails()) {
            // return $validator -> errors();
            //return json_encode($validator->errors(), JSON_UNESCAPED_UNICODE); // عشان الغه العربيه تضهر
            return redirect()->back()->withErrors($validator)->withInputs($request->all()); // ترجع رساله الخطا في نفس الصفحه
        }


        //insert in database ادخال البيانات الئ داتا
        Offer::create([
            'name' => $request->name,
            'price' => $request->price,
            'details' => $request->details,
        ]);
        //return 'Done yes';
        return redirect()->back()->with(['success' => 'تم اضافة العرض بنجاح']);
    }

    protected function getRules()
    {
        return  $rules = [
            'name' => 'required|max:100|unique:offers,name',
            'price' => 'required|numeric',
            'details' => 'required'
        ];
    }

    protected function getMessages()
    {
        return  $messages = [
            'name.required' =>__('messages.offer name required'),
            'name.unique'  =>__('messages.offer name must be unique'),
            'price.numeric' => 'سعر العرض يجب ان يكون ارقام',
            'price.required' =>  __('messages.Offer Price'),
            'details.required' => __('messages.Offer details'),
        ];
    }
}
