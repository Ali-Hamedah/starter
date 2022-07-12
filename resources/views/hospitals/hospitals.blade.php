@extends('layouts.app')

@section('content')


@if(Session::has('success'))

    <div class="alert alert-success">
           {{Session::get('success')}}
    </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">address</th>
                <th scope="col">الاجراءات</th>

            </tr>
        </thead>
        <tbody>
            @if(isset($hospitals) && $hospitals -> count() > 0);
            @foreach ($hospitals as $hospital)
                <tr>
                <th scope="col">{{ $hospital -> id }}</th>
                <th scope="col">{{ $hospital -> name }}</th>
                <th scope="col">{{ $hospital -> address }}</th>
                <th scope="col">
                    <a href="{{ route('hospital.doctors', $hospital->id) }} " class="btn btn-primary"  role="button" aria-disabled="true">عرض الاطباء </a>
                    <a href="{{ route('hospital.delete', $hospital->id) }} " class="btn btn-danger"  role="button" aria-disabled="true">حذف</a>

                </th>
            </tr>
            @endforeach
            @endif


        </tbody>
    </table>

@stop

