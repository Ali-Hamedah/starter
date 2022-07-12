@extends('layouts.app')

@section('content')


    <div class="alert alert-success" id="success_msg" style="display: none;">
        تم الحذف بنجاح
    </div>


    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>



            </tr>
        </thead>
        <tbody>
            @if(isset($services) && $services -> count() > 0);
            @foreach ($services as $service)
                <tr >
                    <th scope="col">{{ $service -> id }}</th>
                    <th scope="col">{{ $service -> name }}</th>

                </tr>
            @endforeach
            @else
            <th>لا يوجد اطباء</th>
            @endif



        </tbody>

    </table>

    <br><br>
                <form method="POST" action="{{route('save.doctors.services')}}">
                    @csrf
                    {{-- <input name="_token" value="{{csrf_token()}}"> --}}


                    <div class="form-group">
                        <label for="exampleInputEmail1">أحتر طبيب</label>
                        <select class="form-control" name="doctor_id" >
                            @foreach($doctors as $doctor)
                                <option value="{{$doctor -> id}}">{{$doctor -> name}}</option>
                            @endforeach
                        </select>

                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">أختر الخدمات </label>

                        <select class="form-control" name="servicesIds[]" multiple>
                            @foreach($allServices as $allService)
                                <option value="{{$allService -> id}}">{{$allService -> name}}</option>
                            @endforeach
                        </select>

                    </div>

                    <button type="submit" class="btn btn-primary">{{__('messages.Save Offer')}}</button>
                </form>


    </div>

@stop

