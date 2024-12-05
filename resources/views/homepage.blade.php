<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GameHub</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    body{
      background-color: #383838;
    }

    .navbar {
    background-color: #000000 !important; /* Black background */}

    .navbar .navbar-brand {
        color: #ffffff !important; /* White brand text */}

    .navbar .nav-link {
        color: #ffffff !important; /* White nav links */}

    .navbar .nav-link:hover {
        color: #289EB6 !important; /* Gold color on hover */}

    .navbar .nav-item.dropdown .dropdown-menu {
        background-color: #000000; /* Black dropdown menu background */}

    .navbar .dropdown-item {
        color: #ffffff; /* White dropdown item text */}

    .navbar .dropdown-item:hover {
        background-color: #289EB6; /* Gold background on dropdown item hover */
        color: #000000; /* Black text color on hover */}

    .navbar .navbar-toggler {
        background-color: #ffd700; /* Gold color for the toggler button */}

    .dropdown-divider {
        background-color: #ffffff; /* White divider */
        height: 1px; /* Ensure it has height */
        margin: 0.5rem 0; /* Margin for spacing */}

    .Title{
      max-height: 67px;
      font-size: 40px;
      font-family: Poppins;
      font-weight: 800px;
      margin-left: 16px;
      margin-top: 26px;
      color: white;
}
  </style>
</head>
<body>
<div class="Homepage">
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="https://localhost/GameHub/public/photos/LOgo.png" alt="image"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Plateforms
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Playstation</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">PC</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Xbox</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Nintendo</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Categories
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Aventure</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Sports</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Combat</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Arcade</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Stratégie</a></li>
          </ul>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit" style="border-radius: 20px;background: linear-gradient(90deg, #289EB6 0%, #248E5E 100%);color:white" >Search</button>
      </form>
    </div>
  </div>
</nav>

  <div class="hpslider">
  <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="5000">
      <img src="https://localhost/GameHub/public/photos/Headslide1.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item" data-bs-interval="5000">
      <img src="https://localhost/GameHub/public/photos/Headslide2.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://localhost/GameHub/public/photos/Headslide3.png" class="d-block w-100" alt="...">
    </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden"></span>
    </button>
    </div>
  </div>
  <div class="Title"><h1>Tendences</h1></div>
  <div class="container overflow-hidden text-center">
      <div class="row gx-5">
        <div class="col">
         <div class="p-3"><img class="Frame"  src="https://localhost/GameHub/public/photos/FC25.png" /></div>
        </div>
        <div class="col">
          <div class="p-3"><img class="Frame"  src="https://localhost/GameHub/public/photos/Wukong.png" /></div>
        </div>
        <div class="col">
        <div class="p-3"><img class="Frame"  src="https://localhost/GameHub/public/photos/Cyberpunk.png" /></div>
       </div>
       <div class="col">
       <div class="p-3"><img class="Frame"  src="https://localhost/GameHub/public/photos/COD.png" /></div>
      </div>
      <div class="col">
      <div class="p-3"><img class="Frame"  src="https://via.placeholder.com/487x301" /></div>
     </div>
      </div>
    </div>
  </div>

  
  <div class="Title"><h1>Catégories</h1></div>
  <div class="container overflow-hidden text-center">
    <div class="row gy-5">
    <div class="col-6">
      <div class="p-3">  <img class="Grid" src="https://localhost/GameHub/public/photos/Action.png" /></div>
    </div>
    <div class="col-6">
    <div class="p-3">  <img class="Grid" src="https://localhost/GameHub/public/photos/Aventure.png" /></div>
    </div>
    <div class="col-6">
    <div class="p-3">  <img class="Grid" src="https://localhost/GameHub/public/photos/Racing.png" /></div>
    </div>
    <div class="col-6">
    <div class="p-3">  <img class="Grid" src="https://localhost/GameHub/public/photos/Combat.png" /></div>
    </div>
      </div>  
  </div>


  <div class="Title" ><h1>Meilleures ventes</h1></div>
  <div class="container overflow-hidden text-center">
      <div class="row gx-5">
        <div class="col">
         <div class="p-3"><img class="Frame"  src="https://via.placeholder.com/487x301" /></div>
        </div>
        <div class="col">
          <div class="p-3"><img class="Frame"  src="https://via.placeholder.com/487x301" /></div>
        </div>
        <div class="col">
        <div class="p-3"><img class="Frame"  src="https://via.placeholder.com/487x301" /></div>
       </div>
       <div class="col">
       <div class="p-3"><img class="Frame"  src="https://via.placeholder.com/487x301" /></div>
      </div>
      <div class="col">
      <div class="p-3"><img class="Frame"  src="https://via.placeholder.com/487x301" /></div>
     </div>
      </div>
    </div>
  </div>

  <div class="products">
        @if($latestProducts->count() > 0)
            @foreach($latestProducts as $product)
                <div class="product">
                    <h3>{{ $product->product_name }}</h3>
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->product_name }}" style="width:150px; height:150px;">
                    <p>{{ $product->description }}</p>
                    <p>Price: ${{ $product->price }}</p>
                    <p>Released: {{ \Carbon\Carbon::parse($product->release_date)->format('M d, Y') }}</p>
                </div>
            @endforeach
        @else
            <p>No products found.</p>
        @endif
    </div>
    
    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>   

</body>
</html>
