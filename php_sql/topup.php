<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>เติมเกม ซื้อคีย์เกม</title>

    <style>
        body{ 
          background: linear-gradient(90deg,rgb(196, 59, 24),rgb(24, 27, 24)); 
          background-size: cover;
          text-align: center;
          padding: 20px;
          align-items: center;
        }
        .navbar{ 
          background: linear-gradient(90deg,rgb(226, 64, 23),rgb(40, 43, 41)); 
        }
        .nav-link{ 
          color: #fff !important; font-weight: bold; 
        }
        .banner img{ 
          width: 100%; 
          border-radius: 10px; 
        }
        .game-card img{ 
          width: 120px;
          height: 120px; 
          object-fit: cover; 
          border-radius: 15px; 
          box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .game-card:hover {
          transform: translateY(-5px);
          cursor: pointer;
        }
        .game-card p {
            margin-top: 5px;
            font-size: 0.9rem;
            font-weight: bold;
            color: white;
        }
        .contact-btn{ 
          position: fixed; 
          bottom: 20px; 
          right: 20px; 
        }
        h3.game-title {
          font-size: 1.5rem;
          font-weight: bold;
          color: white;
          padding: 5px 15px;
          border-radius: 20px;
          display: inline-block; 
          text-transform: uppercase;
          margin: 20px auto 10px auto;
          line-height: 1.5; 
          word-wrap: break-word;
        }
    </style>
</head>

<body>
  <!-- ส่วนของ nav -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Games Store</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="topup.php">Top-up</a>
        </li>

        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="keygame.php">Keys Games</a>
        </li>

        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="coupon.php">Coupon</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Help!!
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">ติดต่อ Admin</a></li>
            <li><a class="dropdown-item" href="#">คำถามที่พบบ่อย</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="admin_list.php">Admin เติมของ</a></li>
          </ul>
        </li>
      </ul>

      <form class="d-flex">
        <a href="user.php" class="btn btn-outline-danger me-2" type="button">Login</a>
        <a href="register.php" class="btn btn-outline-warning me-2" type="button">Register</a>
      </form>

    </div>
  </div>
</nav>

<div class="container mt-4">
    <!-- ภาพสไลด์ -->
    <div id="carouselExample" class="carousel slide banner" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active"><img src="RoV1.jpg" alt="..." /></div>

            <div class="carousel-item"><img src="pubg.jpg" alt="..." /></div>

            <div class="carousel-item"><img src="VALORANT.jpg" alt="..." /></div>

        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>

    </div>

    <!-- Game Top-up -->
    <div class="row text-center mt-4">
      <h3 class="game-title mb-4">GAME TOP-UP</h3>

        <div class="col-3 game-card"><img src="rov2.jpg" alt="ROV">
          <p>ROV</p>
        </div>

        <div class="col-3 game-card"><img src="valor1.jpg" alt="Valorant">
          <p>Valorant</p>
        </div>

        <div class="col-3 game-card"><img src="fifam.jpg" alt="Fifa Mobile">
          <p>Fifa Mobile</p>
        </div>

        <div class="col-3 game-card"><img src="pubgM.jpg" alt="PUBG">
          <p>PUBG</p>
        </div>
    </div>
</div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>