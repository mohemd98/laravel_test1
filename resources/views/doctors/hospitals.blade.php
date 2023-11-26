

@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="alert alert-success" id="success_msg" style="display: none;">
           المستشفيات

        </div>

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


            @if(isset($hospitals) && $hospitals -> count() > 0 )
                @foreach($hospitals as $hospital)
                    <tr>
                        <th scope="row">{{$hospital -> id}}</th>
                        <td>{{$hospital -> name}}</td>
                        <td>{!!  $hospital -> address !!}</td>
                        <td>
                            <a href="{{route('hospital.doctors',$hospital -> id)}}" class="btn btn-success"> عرض الاطباء</a>
                            <a href="{{route('hospital.delete',$hospital -> id)}}" class="btn btn-danger">حذف</a>
                        </td>
                    </tr>
                @endforeach
            @endif

            </tbody>
        </table>

    </div>
@stop

