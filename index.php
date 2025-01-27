<?php
session_start();

// Configurar a conexão com o banco de dados
$host = "localhost"; // Nome do host
$username = "root"; // Nome de usuário do MySQL
$password = ""; // Senha do MySQL
$dbname = "barbearia"; // Nome do banco de dados

// Criar a conexão
$mysqli = new mysqli($host, $username, $password, $dbname);

// Verificar a conexão
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Buscar barbeiros do banco de dados
$query = "SELECT name, photo FROM barbers";
$result = $mysqli->query($query);
$barbers = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $barbers[] = $row;
    }
}

// Fechar a conexão
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="remixicons/fonts/remixicon.css">
  <link rel="stylesheet" href="css/style.css">
  <link href="https://fonts.googleapis.com/css?family=Your+Font" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <title>BARBERSHOP</title>

  <!-- Booksy Styling -->
  <style>
    .booksy-widget-container-dialog,
    .booksy-widget-container-dialog .booksy-business-link {
      background-image: none !important;
    }
  </style>

</head>

<body id="home" data-bs-spy="scroll" data-bs-target=".navbar">

  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <img src="img/logo.png" alt="Logo" class="navbar-logo">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ms-auto">
          <a class="nav-link active" aria-current="page" href="#hero">HOME</a>
          <a class="nav-link" href="#services">SERVICES</a>
          <a class="nav-link" href="#portfolio">OUR WORK</a>
          <a class="nav-link" href="#reviews">REVIEWS</a>
          <?php if (isset($_SESSION['first_name'])): ?>
                        <a class="nav-link" href="#">Olá, <?php echo htmlspecialchars($_SESSION['first_name']); ?></a>
                        <a class="nav-link" href="login/logout.php" style="background-color: #50d9f4e2;">Log out</a>
                    <?php else: ?>
                        <a class="nav-link" href="login/sign-in.html" style="background-color: #50d9f4e2;">Log in</a>
                    <?php endif; ?>
        </div>
      </div>
    </div>
  </nav>

  <!-- HERO -->
  <section id="hero" class="d-flex align-items-center justify-content-center">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center title-space">
          <h1 class="display-3 fs-responsive">
           
            <span class="d-block">Barbershop</span>
          </h1>
          <div class="book-now-container" style="margin-top: 5rem;">

       <!-- Botão para abrir o primeiro modal -->
  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal1">Realizar Marcação</button>

   <!-- Estrutura do Modal 1 -->
   <div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="modal1Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal1Label">Escolha um Barbeiro</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="container">
            <div class="row">
              <?php foreach ($barbers as $barber): ?>
                <div class="col-md-4 text-center">
                  <img src="colaboradores/<?php echo htmlspecialchars($barber['photo']); ?>" alt="<?php echo htmlspecialchars($barber['name']); ?>" class="img-fluid rounded-circle mb-2">
                  <h5><?php echo htmlspecialchars($barber['name']); ?></h5>
                  <button class="btn btn-primary select-barber" data-name="<?php echo htmlspecialchars($barber['name']); ?>" data-photo="colaboradores/<?php echo htmlspecialchars($barber['photo']); ?>">Select</button>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Estrutura do Modal 2 -->
  <div class="modal fade" id="modal2" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal2Label">Modal 2</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="selectedBarber" class="text-center mb-3">
            <!-- A foto e o nome do barbeiro selecionado aparecerão aqui -->
          </div>
          Hide this modal and show the first with the button below.
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" id="backToModal1">Back to first</button>
          <button class="btn btn-primary" id="openModal3">Open third modal</button>
        </div>
      </div>
    </div>
  </div>


  <!-- Estrutura do Modal 3 -->
  <div class="modal fade" id="modal3" tabindex="-1" aria-labelledby="modal3Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal3Label">Modal 3</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          This is the third modal.
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" id="backToModal2">Back to second</button>
        </div>
      </div>
    </div>
  </div>
      
          </div>
          <p class="address">
            <a href="https://www.google.com/maps/place/12554+Centralia+St,+Lakewood,+CA+90715" target="_blank"
              class="map-link">
              <i class="ri-map-pin-2-fill"></i>
              12554 Centralia St
              Lakewood, CA 90715
            </a>
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- SERVICES W/ CARDS -->
  <section id="services">
    <div class="container text-center">
      <div class="row">
        <div class="col-12 intro">
          <h1>Services</h1>
          <h5>Discover your signature style</h5>
          <p>At Top Dog Barbershop, every cut is a blend of precision, style, and personal expression. Select from our
            bespoke services to elevate your grooming experience and distinguish your look.</p>
        </div>
      </div>

      <div class="row justify-content-center align-items-center">
        <div class="col-lg-3 col-md-6 card-spacing">
          <div class="service">
            <div class="card custom-rounded">
              <a href="#hero">
                <img src="./img/service1.jpg" class="card-img1-top" alt="...">
              </a>
              <div class="card-body content">
                <div class="content">
                  <h3 class="h5">Classic<br>Haircut</h3>
                  <p class="card-text txt">Expert cuts that blend timeless elegance with modern precision. Step out
                    in style with a look tailored just for you.</p>
                  <a href="#hero" class="link-more txt">
                    <span>Book Now</span>
                    <i class="ri-arrow-right-line icon"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 card-spacing">
          <div class="service">
            <div class="card custom-rounded">
              <a href="#hero">
                <img src="./img/service2.jpg" class="card-img-top" alt="...">
              </a>
              <div class="card-body content">
                <div class="content">
                  <h3 class="h5 nowrap-text"> Beard/Facial<Br>Hair</h3>
                  <p class="card-text txt">Your standard cut, elevated to a new level of service. Beard, facial hair,
                    and eyebrows are included in this service.</p>
                  <a href="#hero" class="link-more txt">
                    <span>Book Now</span>
                    <i class="ri-arrow-right-line icon"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 card-spacing">
          <div class="service">
            <div class="card custom-rounded">
              <a href="#hero">
                <img src="./img/service3.jpg" class="card-img-top" alt="...">
              </a>
              <div class="card-body content">
                <div class="content">
                  <h3 class="h5 nowrap-text">Full Service +<br>Cut</h3>
                  <p class="card-text txt">Your standard cut, plus a beard and facial hair service, a shampoo and/or
                    conditioning, and a facial to top it off.</p>
                  <a href="#hero" class="link-more txt">
                    <span>Book Now</span>
                    <i class="ri-arrow-right-line icon"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- PORTFOLIO -->
  <section id="portfolio">
    <div class="port">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="section-header text-center">
              <h2>Our Portfolio</h2>
              <p>Check Out Our Latest Work</p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 col-sm-12">
            <div class="gallery-item" data-bs-target="#popup1" data-bs-toggle="modal">
              <img alt="Image 1" src="img/Image1.jpeg">
              <div class="overlay">
                <p>'Mid Drop Fade'</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-sm-12">
            <div class="gallery-item" data-bs-target="#popup2" data-bs-toggle="modal">
              <img alt="Image 2" src="img/Image2.jpeg">
              <div class="overlay">
                <p>'High Drop Fade'</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-sm-12">
            <div class="gallery-item" data-bs-target="#popup3" data-bs-toggle="modal">
              <img alt="Image 3" src="img/Image3.jpeg">
              <div class="overlay">
                <p>'Taper Fade with Mullet'</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Popup modals -->
    <div class="modal fade" id="popup1">
      <div class="modal-dialog">
        <div class="modal-content"><img alt="Image 1" src="img/Image1.jpeg"></div>
      </div>
    </div>
    <div class="modal fade" id="popup2">
      <div class="modal-dialog">
        <div class="modal-content"><img alt="Image 2" src="img/Image2.jpeg"></div>
      </div>
    </div>
    <div class="modal fade" id="popup3">
      <div class="modal-dialog">
        <div class="modal-content"><img alt="Image 3" src="img/Image3.jpeg"></div>
      </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
  </section>

  <!-- REVIEWS -->
  <section id="reviews">
    <div class="container">
      <div class="row">
        <div class="col-12 intro text-center">
          <h1>Reviews</h1>
          <p>
          See for yourself why customers love our barbershop.
          </p>
        </div>
      </div>

      <div class="row gy-4">
      
        <div class="col-lg-4 col-md-6">
          <div class="review">
            <div class="d-flex justify-content-between">             

              <div class="ms-3">
                <h5>Danny G.</h5>
                <small>Nov 3, 2023</small>
              </div>

              <div class="img-wrapper">
                <img src="img/stars.png" alt="5 stars">
              </div>
             
            </div>
            <p class="mt-4">
              "Top dog has some of the best barbers in town."
            </p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6">
          <div class="review">
            <div class="d-flex justify-content-between">             

              <div class="ms-3">
                <h5>Ethan B.</h5>
                <small>Oct 26, 2023</small>
              </div>

              <div class="img-wrapper">
                <img src="img/stars.png" alt="5 stars">
              </div>
             
            </div>
            <p class="mt-4">
              "Reliable spot for a haircut. Johnny never lets me down."
            </p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6">
          <div class="review">
            <div class="d-flex justify-content-between">             

              <div class="ms-3">
                <h5>Mark A.</h5>
                <small>April 9, 2023</small>
              </div>

              <div class="img-wrapper">
                <img src="img/stars.png" alt="5 stars">
              </div>
             
            </div>

            <p class="mt-4">
              "Cuts are always fresh, always take my kids here!
            </p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6">
          <div class="review">
            <div class="d-flex justify-content-between">             

              <div class="ms-3">
                <h5>Jose A.</h5>
                <small>April 9, 2023</small>
              </div>

              <div class="img-wrapper">
                <img src="img/stars.png" alt="5 stars">
              </div>
             
            </div>

            <p class="mt-4">
              "Good place to go, I like how they gave my fade."
            </p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6">
          <div class="review">
            <div class="d-flex justify-content-between">             

              <div class="ms-3">
                <h5>Jason L.</h5>
                <small>April 2, 2023</small>
              </div>

              <div class="img-wrapper">
                <img src="img/stars.png" alt="5 stars">
              </div>
             
            </div>

            <p class="mt-4">
              "Good service. For sure will be going again next time."
            </p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6">
          <div class="review">
            <div class="d-flex justify-content-between">             

              <div class="ms-3">
                <h5>Sheila P.</h5>
                <small>April 9, 2023</small>
              </div>

              <div class="img-wrapper">
                <img src="img/stars.png" alt="5 stars">
              </div>
             
            </div>

            <p class="mt-4">
              "Did my hubby right! Got mid fade w/ texture on the top."
            </p>
          </div>
        </div>
        
      </div>

    </div>
  </section>


  <!-- FOOTER -->
  <footer>
    <div class="footer-top">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <h3 class="mb-3">Policy</h3>
            <p>
              *No call/no shows will be charged full amount of 
              service missed. Please cancel 3 hours before 
              appointment to give your barber enough time 
              to try to fill the appointment*
            </p>
          </div>
          <div class="col-lg-3 offset-lg-1">
            <h4 class="mb-4">Working Hours</h4>
            <div>
              <h6>Tuesday - Friday</h6>
              <p>9AM - 6PM</p>
            </div>
            <div>
              <h6>Saturday </h6>
              <p>9AM - 3PM</p>
            </div>
          </div>
          <div class="col-lg-3">
            <h4>Contact</h4>
            
            <p>
              <i class="ri-map-pin-2-fill"></i>
              <span>12554 Centralia St Lakewood, CA 90715</span>
            </p>
            <p>
              <i class="ri-phone-fill"></i>
              <span>(562) 219-5922</span>
            </p>

          </div>
        </div>
      </div>
    </div>
  </footer>

  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/custom.js"></script>
</body>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
     document.querySelectorAll('.select-barber').forEach(button => {
      button.addEventListener('click', function () {
        const name = this.getAttribute('data-name');
        const photo = this.getAttribute('data-photo');

        const selectedBarberDiv = document.getElementById('selectedBarber');
        selectedBarberDiv.innerHTML = `
          <img src="${photo}" alt="${name}" class="img-fluid rounded-circle mb-2">
          <h5>${name}</h5>
        `;
        const modal1 = bootstrap.Modal.getInstance(document.getElementById('modal1'));
        modal1.hide();
        const modal2 = new bootstrap.Modal(document.getElementById('modal2'));
        modal2.show();
    });
    });
  document.getElementById('openModal2').addEventListener('click', function () {
    var modal1 = bootstrap.Modal.getInstance(document.getElementById('modal1'));
    modal1.hide();
    var modal2 = new bootstrap.Modal(document.getElementById('modal2'));
    modal2.show();
  });

  document.getElementById('backToModal1').addEventListener('click', function () {
    var modal2 = bootstrap.Modal.getInstance(document.getElementById('modal2'));
    modal2.hide();
    var modal1 = new bootstrap.Modal(document.getElementById('modal1'));
    modal1.show();
  });

  document.getElementById('openModal3').addEventListener('click', function () {
    var modal2 = bootstrap.Modal.getInstance(document.getElementById('modal2'));
    modal2.hide();
    var modal3 = new bootstrap.Modal(document.getElementById('modal3'));
    modal3.show();
  });

  document.getElementById('backToModal2').addEventListener('click', function () {
    var modal3 = bootstrap.Modal.getInstance(document.getElementById('modal3'));
    modal3.hide();
    var modal2 = new bootstrap.Modal(document.getElementById('modal2'));
    modal2.show();
  });
</script>
</html>
