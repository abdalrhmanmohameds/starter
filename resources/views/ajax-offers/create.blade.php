@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="alert alert-success" id="success_msg" style="display: none">
                    تم الحفظ بنجاح
        </div>

        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    {{__('messages.Add Your Offer')}}
                </div>
                @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{Session::get('success')}}
                    </div>
                @endif
                <div class="links">
                    <form method="POST" id="offerForm" action="" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">اختر صورة العرض</label>
                            <input type="file" class="form-control" name="photo">
                            @error('photo')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{__('messages.offer name')}}</label>
                            <input type="text" class="form-control" name="name_ar"
                                   placeholder="{{__('messages.Enter your name arabic')}}">
                            @error('name_ar')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{__('messages.offer price')}}</label>
                            <input type="text" class="form-control" name="name_en"
                                   placeholder="{{__('messages.Enter your name english')}}">
                            @error('name_en')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{__('messages.offer price')}}</label>
                            <input type="text" class="form-control" name="price"
                                   placeholder="{{__('messages.price required')}}">
                            @error('price')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{__('messages.offer details')}}</label>
                            <input type="text" class="form-control" name="details_ar"
                                   placeholder="{{__('messages.Enter your details arabic')}}">
                            @error('details_ar')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{__('messages.offer details')}}</label>
                            <input type="text" class="form-control" name="details_en"
                                   placeholder="{{__('messages.Enter your details english')}}">
                            @error('details_en')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <button id="save_offer" class="btn btn-primary">{{__('messages.save')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop

@section('scripts')
    <script>
        $(document).on('click', '#save_offer ', function (e) {
            e.preventDefault();
            var formData = new FormData($('#offerForm')[0]);
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{route('ajax.offer.store')}}",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                ////////////////// another way/////////////
                {{--data: {
                     '_token': "{{csrf_token()}}",
                     'photo' : $('input[name=photo]').val(),
                     {'name_ar': $("input[name='name_ar']").val(),
                     'name_en': $("input[name='name_en']").val(),
                     'price': $("input[name='price']").val(),
                     'details_ar': $("input[name='details_ar']").val(),
                     'details_en': $("input[name='details_en']").val(),

                },--}}
                success: function (data) {

                     if (data.status === true)
                        $('#success_msg').show();

                }, error: function (reject) {

                }
            });
        });

    </script>
@stop
