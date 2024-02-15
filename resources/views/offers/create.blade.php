<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

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
        <div class="flex-center po  sition-ref full-height">


             <div class="content">
                <div class="title m-b-md">
                    Add Your Offer
                </div>

                <div class="links">
                    <form method="POST"  action="{{route('offers.store')}}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter your name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">price</label>
                            <input type="text" class="form-control" name="price" placeholder="Enter your price">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">details</label>
                            <input type="text" class="form-control" name="details" placeholder="Enter your details">
                        </div>
                        <button type="submit" class="btn btn-primary">save offer</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
