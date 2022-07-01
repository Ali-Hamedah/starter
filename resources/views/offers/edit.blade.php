<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <style>
        html,
        body {
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

        .links>a {
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
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page"
                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                {{ $properties['native'] }}</a>
                        </li>
                    @endforeach
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                {{ __('messages.Update your offer') }}
            </div>
            <form method="POST" action="{{ route('offers.update' , $offer -> id) }}">
                @csrf
                @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif

                <div class="form-group">
                    <label for="exampleInputEmail1">{{ __('messages.Offer Name ar') }}</label>
                    <input type="text" class="form-control" name="name_ar" value={{ $offer -> name_ar }} aria-describedby="emailHelp"
                        placeholder={{ __('messages.Offer Name ar') }}>
                    @error('name_ar')
                        <small class="form-text text-danger"> {{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">{{ __('messages.Offer Name en') }}</label>
                    <input type="text" class="form-control" name="name_en" value={{$offer -> name_en }} aria-describedby="emailHelp"
                        placeholder={{ __('messages.Offer Name en') }}>
                    @error('name_en')
                        <small class="form-text text-danger"> {{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">{{ __('messages.Offer Name de') }}</label>
                    <input type="text" class="form-control" name="name_de" value={{ $offer -> name_de }} aria-describedby="emailHelp"
                        placeholder={{ __('messages.Offer Name de') }}>
                    @error('name_de')
                        <small class="form-text text-danger"> {{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">{{ __('messages.Offer details ar') }}</label>
                    <input type="text" class="form-control" name="details_ar" value={{ $offer -> details_ar }} aria-describedby="emailHelp"
                        placeholder={{ __('messages.Offer Name') }}>
                    @error('details_ar')
                        <small class="form-text text-danger"> {{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">{{ __('messages.Offer details en') }}</label>
                    <input type="text" class="form-control" name="details_en" value={{ $offer -> details_en }}  aria-describedby="emailHelp"
                        placeholder={{ __('messages.Offer Name') }}>
                    @error('details_en')
                        <small class="form-text text-danger"> {{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">{{ __('messages.Offer details de') }}</label>
                    <input type="text" class="form-control" name="details_de" value={{ $offer -> details_de }}  aria-describedby="emailHelp"
                        placeholder={{ __('messages.Offer Name') }}>
                    @error('details_de')
                        <small class="form-text text-danger"> {{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">{{ __('messages.Offer Price') }}</label>
                    <input type="Text" class="form-control" name="price" value={{ $offer -> price }}
                        placeholder={{ __('messages.Offer Price') }}>
                    @error('price')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">{{ __('messages.Save Offer') }}</button>
            </form>


        </div>
    </div>
</body>

</html>
