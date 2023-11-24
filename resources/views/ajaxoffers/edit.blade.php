

@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="alert alert-success" id="success_msg" style="display: none;">
            تم التحديث بنجاح
        </div>

        <form method="POST" id="offerFormUpdate" action="" enctype="multipart/form-data">
            @csrf
            <input type="text" style="display: none;" class="form-control" value="{{$offer -> id}}" name="offer_id">

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
                <input type="text" name="name_ar" value="{{$offer -> name_ar}}" class="form-control" id="exampleInputEmail1"
                       aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                @error('name_ar')
                <small class="from-text text-danger">{{$message}}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">{{__('messages.Offer Name en')}}</label>
                <input type="text" name="name_en" value="{{$offer -> name_en}}" class="form-control" id="exampleInputEmail1"
                       aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                @error('name_en')
                <small class="from-text text-danger">{{$message}}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">{{__('messages.Offer Price')}}</label>
                <input type="text" name="price" value="{{$offer -> price}}" class="form-control" id="exampleInputPassword1">
                @error('price')
                <small class="from-text text-danger"> {{$message}} </small>
                @enderror                            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">{{__('messages.Offer details ar')}}</label>
                <input type="text" name="details_ar" value="{{$offer -> details_ar}}" class="form-control" id="exampleInputPassword1">
                @error('details_ar')
                <small class="from-text text-danger">{{$message}}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">{{__('messages.Offer details en')}}</label>
                <input type="text" name="details_en" value="{{$offer -> details_en}}" class="form-control" id="exampleInputPassword1">
                @error('details_en')
                <small class="from-text text-danger">{{$message}}</small>
                @enderror
            </div>

            <button id="update_offer" class="btn btn-primary">{{__('messages.Save Offer')}}</button>
        </form>
    </div>
@stop

@section('scripts')

    <script>

        $(document).on('click', '#update_offer', function (e) {
            e.preventDefault();

            var formData = new FormData($('#offerFormUpdate')[0]);

            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{route('ajax.offers.update')}}",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    if(data.status == true){
                        $('#success_msg').show();
                    }
                }, error: function (reject) {
                }
            });
        });


    </script>
@stop
