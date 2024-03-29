<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .table {
            margin: 2em 2em;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <li class="nav-item active">
                    <a class="nav-link"
                       href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">{{ $properties['native'] }}
                        <span class="sr-only">(current)</span></a>
                </li>
            @endforeach

            {{--  /////////////////example localizatioin تعدد اللغات///////////////////--}}
            {{--  /////////////////example localizatioin تعدد اللغات///////////////////--}}
            {{--  /////////////////example localizatioin تعدد اللغات///////////////////--}}

            {{--                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)--}}
            {{--                        <li>--}}
            {{--                            <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">--}}
            {{--                                {{ $properties['native'] }}--}}
            {{--                            </a>--}}
            {{--                        </li>--}}
            {{--                    @endforeach--}}

            {{--  /////////////////example localizatioin تعدد اللغات///////////////////--}}

        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="{{__('messages.Search')}}"
                   aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">{{__('messages.Search')}}</button>
        </form>
    </div>
</nav>
<div>
    @if(Session::has('error'))
        <div class="alert alert-danger">{{__('messages.error')}}</div>
    @endif

    @if(Session::has('successfully'))
        <div class="alert alert-success">{{__('messages.successfully')}}</div>
    @endif
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
            <tr>
                <th scope="row">{{$offer -> id}}</th>
                <td>{{$offer -> name}}</td>
                <td>{{$offer -> price}}</td>
                <td>{{$offer -> details}}</td>
                <td><img style="width: 100px ; height:100px;object-fit:cover" src="{{asset('images/offers/'.$offer->photo)}}" alt="photo not found"></td>

                <td>
                    <a href="{{url('offers/edit/'.$offer -> id)}}" class="btn btn-success">{{__('messages.edit')}}</a>
                    <a href="{{route('offers.delete',$offer -> id)}}"
                       class="btn btn-danger">{{__('messages.delete')}}</a>
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
