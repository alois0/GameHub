<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameHub</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #383838;
        }

        .navbar {
            background-color: #000000 !important; /* Black background */
        }

        .navbar .navbar-brand {
            color: #ffffff !important; /* White brand text */
        }

        .navbar .nav-link {
            color: #ffffff !important; /* White nav links */
        }

        .navbar .nav-link:hover {
            color: #289EB6 !important; /* Gold color on hover */
        }

        .navbar .nav-item.dropdown .dropdown-menu {
            background-color: #000000; /* Black dropdown menu background */
        }

        .navbar .dropdown-item {
            color: #ffffff; /* White dropdown item text */
        }

        .navbar .dropdown-item:hover {
            background-color: #289EB6; /* Gold background on dropdown item hover */
            color: #000000; /* Black text color on hover */
        }

        .navbar .navbar-toggler {
            background-color: #ffd700; /* Gold color for the toggler button */
        }

        .dropdown-divider {
            background-color: #ffffff; /* White divider */
            height: 1px; /* Ensure it has height */
            margin: 0.5rem 0; /* Margin for spacing */
        }

        .Title {
            max-height: 67px;
            font-size: 40px;
            font-family: Poppins;
            font-weight: 800px;
            margin-left: 16px;
            margin-top: 26px;
            color: white;
        }

        .card {
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('images/LOgo.png') }}" alt="image"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="platformsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Platforms
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="platformsDropdown">
                                @foreach($platforms as $platform)
                                    <li><a class="dropdown-item" href="#">{{ $platform->platform_name }}</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="categoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Categories
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="categoriesDropdown">
                                @foreach($categories as $category)
                                    <li><a class="dropdown-item" href="#">{{ $category->category_name }}</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit" style="border-radius: 20px;background: linear-gradient(90deg, #289EB6 0%, #248E5E 100%);color:white">Search</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <main class="py-4">
        @yield('content')
    </main>

    <footer class="text-center py-4">
        <p>&copy; 2023 GameHub</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>