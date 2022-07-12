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
                <th scope="col">title</th>
                <th scope="col">الاجراءات</th>


            </tr>
        </thead>
        <tbody>
            @if(isset($doctors) && $doctors -> count() > 0);
            @foreach ($doctors as $doctor)
                <tr >
                    <th scope="col">{{ $doctor -> id }}</th>
                    <th scope="col">{{ $doctor -> name }}</th>
                    <th scope="col">{{ $doctor -> title }}</th>
                    <th scope="col">

                        <a href="{{ route('doctors.services', $doctor->id) }} " class="btn btn-primary"  role="button" aria-disabled="true">عرض الخدمات</a>

                    </th>

                </tr>
            @endforeach
            @else
            <th>لا يوجد اطباء</th>
            @endif



        </tbody>
    </table>

@stop

