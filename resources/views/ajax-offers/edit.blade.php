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
<div class="flex-center po  sition-ref full-height">


    <div class="content">
        <div class="title m-b-md">
            {{__('messages.Edit Offer')}}
        </div>
        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{Session::get('success')}}
            </div>
        @endif
        <div class="links">
            <form method="POST" action="{{route('offers.update',$offer -> id)}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">{{__('messages.chonse offer photo')}}</label>
                    <input type="file" class="form-control" name="photo">
                    @error('photo')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">{{__('messages.offer name')}}</label>
                    <input type="text" class="form-control" value="{{$offer->name_ar}}" name="name_ar"
                           placeholder="{{__('messages.Enter your name arabic')}}">
                    @error('name_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">{{__('messages.offer price')}}</label>
                    <input type="text" class="form-control" value="{{$offer->name_en}}" name="name_en"
                           placeholder="{{__('messages.Enter your name english')}}">
                    @error('name_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">{{__('messages.offer price')}}</label>
                    <input type="text" class="form-control" value="{{$offer->price}}" name="price"
                           placeholder="{{__('messages.price required')}}">
                    @error('price')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">{{__('messages.offer details')}}</label>
                    <input type="text" class="form-control" value="{{$offer->details_ar}}" name="details_ar"
                           placeholder="{{__('messages.Enter your details arabic')}}">
                    @error('details_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">{{__('messages.offer details')}}</label>
                    <input type="text" class="form-control" value="{{$offer->details_en}}" name="details_en"
                           placeholder="{{__('messages.Enter your details english')}}">
                    @error('details_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">{{__('messages.save')}}</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
