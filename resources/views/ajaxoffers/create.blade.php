{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--    <div class="container">--}}
{{--        <div class="row justify-content-center">--}}
{{--            <div class="col-md-8">--}}
{{--                --}}
{{--                <nav class="navbar navbar-expand-lg bg-body-tertiary">--}}
{{--                    <div class="container-fluid">--}}
{{--                        <a class="navbar-brand" href="#">Navbar</a>--}}
{{--                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">--}}
{{--                            <span class="navbar-toggler-icon"></span>--}}
{{--                        </button>--}}
{{--                        <div class="collapse navbar-collapse" id="navbarSupportedContent">--}}
{{--                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">--}}
{{--                                @foreach(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLocales() as $localCode => $properties)--}}
{{--                                    <li class="nav-item">--}}
{{--                                        <a class="nav-link active" aria-current="page" href="{{\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedUrl($localCode , null , [] , true)}}">{{$properties['native']}}</a>--}}
{{--                                    </li>--}}
{{--                                @endforeach--}}

{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </nav>--}}
{{--                --}}
{{--                <div class="card">--}}
{{--                    <div class="card-header">{{ trans('messages.Dash') }}</div>--}}

{{--                    <div class="card-body">--}}
{{--                        @if(Session::has('success'))--}}
{{--                            <div class="alert alert-primary" role="alert">--}}
{{--                                {{ Session::get('success') }}--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                     --}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}


@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">اختر الصوره</label>
                <input type="file" name="photo" class="form-control" id="exampleInputEmail1"
                       aria-describedby="emailHelp">
                @error('photo')
                <small class="from-text text-danger">{{$message}}</small>
                @enderror
            </div>


            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">{{__('messages.Offer Name ar')}}</label>
                <input type="text" name="name_ar" class="form-control" id="exampleInputEmail1"
                       aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                @error('name_ar')
                <small class="from-text text-danger">{{$message}}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">{{__('messages.Offer Name en')}}</label>
                <input type="text" name="name_en" class="form-control" id="exampleInputEmail1"
                       aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                @error('name_en')
                <small class="from-text text-danger">{{$message}}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">{{__('messages.Offer Price')}}</label>
                <input type="text" name="price" class="form-control" id="exampleInputPassword1">
                @error('price')
                <small class="from-text text-danger"> {{$message}} </small>
                @enderror                            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">{{__('messages.Offer details ar')}}</label>
                <input type="text" name="details_ar" class="form-control" id="exampleInputPassword1">
                @error('details_ar')
                <small class="from-text text-danger">{{$message}}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">{{__('messages.Offer details en')}}</label>
                <input type="text" name="details_en" class="form-control" id="exampleInputPassword1">
                @error('details_en')
                <small class="from-text text-danger">{{$message}}</small>
                @enderror
            </div>

            <button id="save_offer" class="btn btn-primary">{{__('messages.Save Offer')}}</button>
        </form>
    </div>
@stop

@section('scripts')

    <script>
        $(document).ready(function () {
            console.log('jQuery is working!');
        });
    </script>

    <script>
        $(document).on('click', '#save_offer', function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: "{{route('ajax.offers.store')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                    'name_ar': $("input[name='name_ar']").val(),
                    'name_en': $("input[name='name_en']").val(),
                    'price': $("input[name='price']").val(),
                    'details_ar': $("input[name='details_ar']").val(),
                    'details_en': $("input[name='details_en']").val(),
                },
                success: function (data) {
                    console.log('Success:', data);
                },
                error: function (xhr, status, error) {
                    console.log('Error:', xhr.responseText);
                },
            });
        });
    </script>
@stop
