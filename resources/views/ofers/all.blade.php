@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                {{--                --}}
                <nav class="navbar navbar-expand-lg bg-body-tertiary">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">Navbar</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                @foreach(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLocales() as $localCode => $properties)
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="{{\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedUrl($localCode , null , [] , true)}}">{{$properties['native']}}</a>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </nav>
                {{--                --}}

                <table class="table">

                    <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">{{__('messages.Offer Name')}}</th>
                        <th scope="col">{{__('messages.Offer Price')}}</th>
                        <th scope="col">{{__('messages.Offer details')}}</th>
                        <th scope="col">{{__('messages.operation')}}</th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach($offers as $offer)

                        <tr>
                            <th scope="row">{{$offer->id}}</th>
                            <td>{{$offer->name}}</td>
                            <td>{{$offer->price}}</td>
                            <td>{{$offer->details}}</td>
                            <td>
                                <a href="{{url('offers/edit/'.$offer -> id)}}" class="btn btn-success"> {{__('messages.update')}}</a>
{{--                                <a href="{{route('offers.delete',$offer -> id)}}" class="btn btn-danger"> {{__('messages.delete')}}</a>--}}
                            </td>
                        </tr>
                    @endforeach

                    </tbody>

                </table>

            </div>
        </div>
    </div>
@endsection
