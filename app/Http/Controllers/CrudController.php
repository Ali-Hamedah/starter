<?php

namespace App\Http\Controllers;




use ar;
use App\Models\Offer;
use App\Models\video;
use LaravelLocalization;
use App\Traits\OfferTrait;
use App\Events\VideoViewer;
use Illuminate\Http\Request;
use App\Http\Requests\OfferRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class CrudController extends Controller
{

    use OfferTrait;

    public function __construct()
    {
        $this -> middleware('auth');
    }


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
        //save photo in folder
        $file_name = $this->saveImage($request->photo, 'images/offers'); //saveImage   تاتي من   trait OfferTrait


        //insert in database ادخال البيانات الئ داتا
        Offer::create([
            'id' => $request->id,
            'photo' => $file_name,
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
    public function getAllOffers()
    {
        //عرض كل البيانات من الداتا
        // $offers =  Offer::select('id', 'price',
        //'name_ar','name_en', 'details_ar', 'details_en',)->get();
        // return view('offers.all', compact('offers'));

        //عرض البيانات حسب اللغه
        $offers =  Offer::select(
            'id',
            'price',
            'photo',
            'name_' . LaravelLocalization::getcurrentLocale() . ' as name', //نقطه مهمه انتبه للمسافات
            'details_' . LaravelLocalization::getcurrentLocale() . ' as details',
        )->get();
        return view('offers.all', compact('offers'));
    }

    public function editOffers($offer_id)
    {
        //chek if offer exists

        //Offer::findOrFail($offer_id);
        $offer = Offer::find($offer_id);
        if (!$offer)
            return redirect()->back();

        $offer = Offer::select('id', 'name_ar', 'name_en', 'name_de', 'details_ar', 'details_en', 'details_de', 'price')->find($offer_id);
        return view('offers.edit', compact('offer'));
    }

    public function delete($offer_id)
    {
        $offer = Offer::find($offer_id);
        if (!$offer)
            return redirect()->back()->with(['error' => __('messages.offer not exist')]);
        $offer->delete();
        return redirect()->route('offers.all', $offer_id)->with(['success' => __('messages.offer deleted successfully')]);
    }

    public function updateOffers(OfferRequest $request, $offer_id)
    {
        //chek if offer exists

        $offer = Offer::find($offer_id);
        if (!$offer)
            return redirect()->back();

        //update date
        $offer->update($request->all());
        return redirect()->back()->with(['success' => 'تم التعديل بنجاح']);
    }

    public function getVideo()
    {
        $video = video::first();
        event(new VideoViewer($video)); //fire event
        return view('video')->with('video', $video);
    }
}
