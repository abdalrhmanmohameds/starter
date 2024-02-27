@extends('layouts.app')

@section('content')
    <div class="alert alert-success" id="success_msg" style="display: none">
        تم الحذف بنجاح
    </div>

    <table class="table text-lg-center">
        <thead>
        <tr>
            <th scope="col">{{__('messages.id')}}</th>
            <th scope="col">{{__('messages.offer name')}}</th>
            <th scope="col">{{__('messages.offer price')}}</th>
            <th scope="col">{{__('messages.offer details')}}</th>
            <th scope="col">{{__('messages.photo offer')}}</th>
            <th scope="col">{{__('messages.operation')}}</th>

        </tr>
        </thead>
        <tbody>
        @foreach($offers as $offer)
            <tr class="offerRow{{$offer -> id}}">
                <th scope="row">{{$offer -> id}}</th>
                <td>{{$offer -> name}}</td>
                <td>{{$offer -> price}}</td>
                <td>{{$offer -> details}}</td>
                <td><img style="width: 100px ; height:100px;object-fit:cover"
                         src="{{asset('images/offers/'.$offer -> photo)}}" alt="photo not found"></td>

                <td>
                    <a href="{{url('offers/edit/'.$offer -> id)}}" class="btn btn-success">{{__('messages.edit')}}</a>
                    <a href="{{route('offers.delete',$offer -> id)}}"
                       class="btn btn-danger">{{__('messages.delete')}}</a>

                    <a href="" offer_id="{{$offer -> id}}" class="delete_btn btn btn-danger">حذف اجاكس</a>
                    <a href="{{route('ajax.offer.edit',$offer -> id)}}" class="btn btn-success">تعديل اجاكس</a>
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
@stop

@section('scripts')
    <script>
        $(document).on('click', '.delete_btn ', function (e) {
            e.preventDefault();

            var offer_id = $(this).attr('offer_id');

            $.ajax({
                type: 'post',
                url: "{{route('ajax.offer.delete')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                    'id': offer_id
                },
                // processData: false,
                // contentType: false,
                // cache: false,
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

                    if (data.status === true) {
                        $('#success_msg').show();
                    }
                    $('.offerRow'+data.id).remove();
                }, error: function (reject) {

                }
            });
        });

    </script>
@stop
