<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use App\Http\Requests\OfferRequest;
//use Mcamara\LaravelLocalization\LaravelLocalization;
use LaravelLocalization;

class OfferController extends Controller
{

    use OfferTrait;

    public function create()
    {
        //view form to add this offer
        return view('ajaxoffer.create');
    }

    public function store(OfferRequest $request)
    {
        //save offer into DB using AJAX
        //save photo in folder
        $file_name = $this->saveImage($request->photo, 'images/offers'); //saveImage   تاتي من   trait OfferTrait

        //insert in database ادخال البيانات الئ داتا
        $offer = Offer::create([
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

        if ($offer)
            return response()->json([
                'status' => true,
                'mgs' => 'تم الحفظ',
            ]);
        else return response()->json([
            'status' => false,
            'mgs' => 'فشل الحفظ',
        ]);
    }

    public function all(){
          //عرض البيانات حسب اللغه
          $offers =  Offer::select(
            'id',
            'price',
            'photo',
            'name_' . LaravelLocalization::getcurrentLocale() . ' as name', //نقطه مهمه انتبه للمسافات
            'details_' . LaravelLocalization::getcurrentLocale() . ' as details',
        )->limit(10)->get();
        return view('ajaxoffer.all', compact('offers'));
    }

    public function delete(Request $request){

        $offer = Offer::find($request -> id);
        if (!$offer)
            return redirect()->back()->with(['error' => __('messages.offer not exist')]);
        $offer->delete();

        return response()->json([
            'status' => true,
            'mgs' => 'تم الحفظ بنجاح',
            'id' => $request -> id
        ]);

    }

    public function edit(Request $request)
    {
        //chek if offer exists

        //Offer::findOrFail($offer_id);
        $offer = Offer::find($request -> offer_id);
        if (!$offer)
           // return redirect()->back();
           return response()->json([
            'status' => false,
            'mgs' => 'هذا العرض غير موجود',
            'id' => $request -> id
        ]);

        $offer = Offer::select('id', 'name_ar', 'name_en', 'name_de', 'details_ar', 'details_en', 'details_de', 'price')->find($request -> offer_id);
        return view('ajaxoffer.edit', compact('offer'));
    }

    public function update(OfferRequest $request)
    {
        //chek if offer exists

        $offer = Offer::find($request -> offer_id);//  تم تمريره في فيو edit // <input type="text" style="display: none" class="form-control" name="offer_id" value={{ $offer -> id }}>
        if (!$offer)
        return response()->json([
            'status' => false,
            'mgs' => 'هذا العرض غير موجود',
            'id' => $request -> id
        ]);
        //update date
        $offer->update($request->all());
        return response()->json([
            'status' => true,
            'mgs' => 'تم التعديل بنجاح',
            'id' => $request -> id
        ]);
          // جلب بيانات محدده
        // update([
            // 'name_ar' => $request -> name_ar,
            // 'name_en' => $request -> name_en,
        // ])
    }


}
