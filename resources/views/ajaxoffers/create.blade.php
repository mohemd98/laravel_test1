@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="alert alert-success" id="success_msg" style="display: none;">
            تم الحفظ بنجاح
        </div>

        <form method="POST" id="offerForm" action="" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">اختر الصوره</label>
                <input type="file" name="photo" class="form-control" id="exampleInputEmail1"
                       aria-describedby="emailHelp">
                <small id="photo_error" class="form-text text-danger"></small>
            </div>


            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">{{__('messages.Offer Name ar')}}</label>
                <input type="text" name="name_ar" class="form-control" id="exampleInputEmail1"
                       aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                <small id="name_ar_error" class="form-text text-danger"></small>
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">{{__('messages.Offer Name en')}}</label>
                <input type="text" name="name_en" class="form-control" id="exampleInputEmail1"
                       aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                <small id="name_en_error" class="form-text text-danger"></small>
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">{{__('messages.Offer Price')}}</label>
                <input type="text" name="price" class="form-control" id="exampleInputPassword1">
                <small id="price_error" class="form-text text-danger"></small>
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">{{__('messages.Offer details ar')}}</label>
                <input type="text" name="details_ar" class="form-control" id="exampleInputPassword1">
                <small id="details_ar_error" class="form-text text-danger"></small>
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">{{__('messages.Offer details en')}}</label>
                <input type="text" name="details_en" class="form-control" id="exampleInputPassword1">
                <small id="details_en_error" class="form-text text-danger"></small>
            </div>

            <button id="save_offer" class="btn btn-primary">{{__('messages.Save Offer')}}</button>
        </form>
    </div>
@stop

@section('scripts')

    <script>
        $(document).on('click', '#save_offer', function (e) {
            e.preventDefault();

            $('#photo_error').text('');
            $('#name_ar_error').text('');
            $('#name_en_error').text('');
            $('#price_error').text('');
            $('#details_ar_error').text('');
            $('#details_en_error').text('');

            var formData = new FormData($('#offerForm')[0]);

            $.ajax({
                type: 'POST',
                url: "{{route('ajax.offers.store')}}",
                {{--data: {--}}
                    {{--    '_token': "{{csrf_token()}}",--}}
                    {{--    'name_ar': $("input[name='name_ar']").val(),--}}
                    {{--    'name_en': $("input[name='name_en']").val(),--}}
                    {{--    'price': $("input[name='price']").val(),--}}
                    {{--    'details_ar': $("input[name='details_ar']").val(),--}}
                    {{--    'details_en': $("input[name='details_en']").val(),--}}
                    {{--},--}}
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    if (data.status == true) {
                        $('#success_msg').show();
                    }
                },
                error: function (reject) {
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function (key, val) {
                        $("#" + key + "_error").text(val[0]);
                    });
                },
            });
        });
    </script>
@stop
