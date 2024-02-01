<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        .active {
            text-decoration: underline;
            text-decoration-color: #A74D4A;
            text-underline-position: under;
        }
    </style>

</head>

<body style="background-color: #DCDCDC">
    <nav class="navbar sticky-top navbar-expand-lg my-4 mx-5">
        <div class="container-fluid">
            <a class="navbar-brand fw-bolder fs-3 order-1 order-lg-0" href="">A m e l i a.</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse order-0 order-lg-1" id="navbarText">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item mx-2">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="#">Album</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link active" href='{{ route('photo.create') }}'>
                            <i class="bi bi-plus-circle h5"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Gallery Lists</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($photos as $photo)
                                <div class="col-md-2">
                                    <div class="card border shadow p-2">
                                        <img src="{{ asset($photo->path) }}" style="height: 70px; width:70px;"
                                            alt="Image">
                                        <br>
                                        <a href="{{ route('photo.destroy', $photo->id) }}">Delete</a>
                                        <form
                                            action="{{ $photo->isFavorited ? route('favorites.destroy', ['favorite' => $photo->favorites->first()]) : route('favorites.store') }}"
                                            method="post">
                                            @csrf
                                            @if ($photo->isFavorited)
                                                @method('DELETE')
                                            @endif
                                            <input type="hidden" name="photoId" value="{{ $photo->id }}">
                                            <button
                                                type="submit">{{ $photo->isFavorited ? 'Favorite' : 'Unfavorite' }}</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>

</body>

</html>
