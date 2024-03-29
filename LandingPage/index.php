<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    // Redirect user to login page if not logged in
    header("Location: /WildTaste/login.html");
    exit;
}

// Validasi dan bersihkan input pengguna
function sanitizeInput($input)
{
    return filter_var($input, FILTER_SANITIZE_STRING);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = sanitizeInput($_POST['name']);
    $testimony = sanitizeInput($_POST['testimony']);

    // Simpan testimoni ke database (gunakan prepared statements)
    require 'koneksi.php';
    $sql = "INSERT INTO testimonials (name, description, date) VALUES (:name, :testimony, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':testimony', $testimony, PDO::PARAM_STR);
    $stmt->execute();
    $conn = null;
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="/WildTaste/LandingPage/style.css" />
  </head>
  <body>
    <header id="nav-menu" aria-label="navigation bar">
      <div class="containerNav">
        <div class="nav-start animatable bounceInLeft">
          <a class="logo" href="#home">
            <img src="img/logo.png" class="logobro img-fluid" alt="Logo" />
          </a>
        </div>
        <nav class="menu">
          <ul class="menu-bar">
            <li class="animatable fadeInUp">
              <button
                class="nav-link dropdown-btn"
                data-dropdown="dropdown1"
                aria-haspopup="true"
                aria-expanded="false"
                aria-label="browse"
              >
                Home
              </button>
            </li>
            <li class="animatable fadeInUp animate-in animationDelay">
              <button
                class="nav-link dropdown-btn"
                data-dropdown="dropdown2"
                aria-haspopup="true"
                aria-expanded="false"
                aria-label="discover"
              >
                Discover
                <i class="bx bx-chevron-down" aria-hidden="true"></i>
              </button>
              <div id="dropdown2" class="dropdown">
                <ul role="menu">
                  <li role="menuitem">
                    <a class="dropdown-link" href="discover/dog.html">Dog</a>
                  </li>
                  <li role="menuitem">
                    <a class="dropdown-link" href="discover/cat.html">Cat</a>
                  </li>
                  <li role="menuitem">
                    <a class="dropdown-link" href="discover/fish.html">Fish</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="animatable fadeInUp animate-in animationDelayMed">
              <a class="nav-link" href="#Trending">Trending</a>
            </li>
            <li class="animatable fadeInUp animate-in animationDelayLong">
              <a class="nav-link" href="#Testi">Testimonial</a>
            </li>
            <li class="animatable fadeInUp animate-in animationDelayLongLong">
              <a class="nav-link" href="#footer">About</a>
            </li>
            <li class="logoutList animatable fadeInUp animate-in animationDelayLongLong">
              <a href="/WildTaste/logout.php">
                <button id="logoutButton" class="btn logout list">
                  <i class="bx bx-log-out" style="font-size: 1.2rem"></i>Logout
                </button>
              </a>
            </li>
          </ul>
        </nav>
        <div class="nav-end animatable bounceInRight">
          <a href="" class="cart" id="cartLink"
            ><i class="bx bx-cart" id="cartIcon" style="font-size: 1.8rem"></i
          ></a>
          <button
            class="hamburger animetable fadeIn"
            id="hamburger"
            onclick="this.classList.toggle('opened');this.setAttribute('aria-expanded', this.classList.contains('opened'))"
            aria-label="Main Menu"
          >
            <svg width="45" height="45" viewBox="0 0 100 100">
              <path
                class="line line1"
                d="M 20,29.000046 H 80.000231 C 80.000231,29.000046 94.498839,28.817352 94.532987,66.711331 94.543142,77.980673 90.966081,81.670246 85.259173,81.668997 79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L 25.000021,25.000058"
              />
              <path class="line line2" d="M 20,50 H 80" />
              <path
                class="line line3"
                d="M 20,70.999954 H 80.000231 C 80.000231,70.999954 94.498839,71.182648 94.532987,33.288669 94.543142,22.019327 90.966081,18.329754 85.259173,18.331003 79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L 25.000021,74.999942"
              />
            </svg>
          </button>
          <div class="right-container">
            <a href="/WildTaste/logout.php">
              <button id="logoutButton" class="btn logout">
                <i class="bx bx-log-out" style="font-size: 1.2rem"></i>Logout
              </button>
            </a>
          </div>
        </div>
      </div>
    </header>

    <section id="cartSection">
      <div class="bg-image"></div>
      <div id="popupContainer" class="popupContainer">
        <h1>Shopping Cart</h1>

        <div class="shopping-cart">
          <div class="productEntries">
            <div class="product">
              <div class="product-image">
                <img src="https://s.cdpn.io/3/dingo-dog-bones.jpg" />
              </div>
              <div class="isiProduct">
                <div class="product-details">
                  <div class="product-title">Dingo Dog Bones</div>
                </div>
                <div class="product-price">Rp. 20.000</div>
                <div class="product-quantity">
                  <input type="number" value="2" min="1" />
                </div>
                <div class="product-removal">
                  <button class="remove-product">Remove</button>
                </div>
                <div class="product-line-price">Rp. 40.000</div>
              </div>
            </div>

            <div class="product">
              <div class="product-image">
                <img
                  src="https://s.cdpn.io/3/large-NutroNaturalChoiceAdultLambMealandRiceDryDogFood.png"
                />
              </div>
              <div class="isiProduct">
                <div class="product-details">
                  <div class="product-title">Nutr Adult Lamb and Rice Dog</div>
                </div>
                <div class="product-price">Rp. 100.000</div>
                <div class="product-quantity">
                  <input type="number" value="1" min="1" />
                </div>
                <div class="product-removal">
                  <button class="remove-product">Remove</button>
                </div>
                <div class="product-line-price">Rp. 100.000</div>
              </div>
            </div>
          </div>

          <div class="totals">
            <div class="totals-item">
              <p>Subtotal</p>
              <div class="totals-value" id="cart-subtotal">Rp. 140.000</div>
            </div>
            <div class="totals-item">
              <p>Tax (5%)</p>
              <div class="totals-value" id="cart-tax">Rp. 7.000</div>
            </div>
            <div class="totals-item">
              <p>Shipping</p>
              <div class="totals-value" id="cart-shipping">Rp. 10.000</div>
            </div>
            <div class="totals-item totals-item-total">
              <p>Grand Total</p>
              <div class="totals-value" id="cart-total">Rp. 157.000</div>
            </div>
          </div>
        </div>
        <button class="btn closePopup" id="closePopup">Close</button>
      </div>
    </section>

    <section id="home">
      <div class="containerHome" style="overflow-x: hidden">
        <div class="containerIsi">
          <div class="containerIsiText animatable bounceInLeft animationDelay">
            <h1>Wild Taste</h1>
            <h2>Pet Food</h2>
          </div>
          <p class="pIsiText animatable bounceInLeft animationDelayMed">
            Nourishing Pets with Nature's Bounty, Fostering Wellness and
            Happiness Beyond Compare!
          </p>
          <div
            class="containerIsiButton animatable bounceInLeft animationDelayLong"
          >
            <a href="#discover"
              ><button
                class="btn"
                style="font-size: 1.2rem; padding: 12px 16px"
              >
                Shop Now
              </button></a
            >
          </div>
          <div
            class="containerIsiData animatable bounceInLeft animationDelayLongLong"
          >
            <div class="data">
              <h1>48K+</h1>
              <p>Dog Food</p>
            </div>
            <div class="data">
              <h1>48K+</h1>
              <p>Cat Food</p>
            </div>
            <div class="data">
              <h1>48K+</h1>
              <p>Fish Food</p>
            </div>
          </div>
        </div>
        <div class="containerFotoHome">
          <img
            src="img/Home.png"
            alt=""
            class="imgHome animatable bounceInRight animationDelayLong"
          />
        </div>
      </div>
    </section>

    <section id="discover">
      <div class="containerDiscover">
        <div class="containerDiscoverText">
          <h1>Discover</h1>
          <p>
            Embark on a culinary by choosing from our premium pet food
            selection.
          </p>
        </div>
        <div class="containerDiscoverContent">
          <a href="discover/dog.html">
            <div class="content">
              <h2>Dog</h2>
              <p>Premium canine cuisine for indulgence.</p>
            </div>
          </a>
          <a href="discover/cat.html">
            <div class="content">
              <h2>Cat</h2>
              <p>Premium Nutrition for Feline Wellness.</p>
            </div>
          </a>
          <a href="discover/fish.html">
            <div class="content">
              <h2>Fish</h2>
              <p>Premium Fish Food for Thriving.</p>
            </div>
          </a>
        </div>
      </div>
    </section>

    <section id="Trending">
      <div class="containerTrending">
        <div class="containerTrendingText">
          <h1>Our Trending Product</h1>
          <p>
            Explore Our Trending Pet Food Collection Unleash Tasty Delights.
          </p>
        </div>
        <div class="baris">
          <div class="kartu">
            <div class="cover item tr-1">
              <img src="/WildTaste/img/2.png" alt="" />
              <h1>Royal<br />Canin</h1>
              <p class="price">Rp. 70.000</p>
              <div class="card-back">
                <a class="card-backBtn" href="#">Add to cart</a>
                <a class="card-backBtn" href="#">View detail</a>
              </div>
            </div>
          </div>
          <div class="kartu">
            <div class="cover item tr-2">
              <img src="/WildTaste/img/3.png" alt="" />
              <h1>Pro<br />Plan</h1>
              <p class="price">Rp. 85.000</p>
              <div class="card-back">
                <a class="card-backBtn" href="#">Add to cart</a>
                <a class="card-backBtn" href="#">View detail</a>
              </div>
            </div>
          </div>
          <div class="kartu">
            <div class="cover item tr-3">
              <img src="/WildTaste/img/13.png" alt="" />
              <h1>Whiskas</h1>
              <p class="price">Rp. 40.000</p>
              <div class="card-back">
                <a class="card-backBtn" href="#">Add to cart</a>
                <a class="card-backBtn" href="#">View detail</a>
              </div>
            </div>
          </div>
          <div class="kartu">
            <div class="cover item tr-4">
              <img src="/WildTaste/img/14.png" alt="" />
              <h1>Cat<br />Choize</h1>
              <p class="price">Rp. 25.000</p>
              <div class="card-back">
                <a class="card-backBtn" href="#">Add to cart</a>
                <a class="card-backBtn" href="#">View detail</a>
              </div>
            </div>
          </div>
          <div class="kartu">
            <div class="cover item tr-5">
              <img src="/WildTaste/img/17.png" alt="" />
              <h1>Me-o</h1>
              <p class="price">Rp. 15.000</p>
              <div class="card-back">
                <a class="card-backBtn" href="#">Add to cart</a>
                <a class="card-backBtn" href="#">View detail</a>
              </div>
            </div>
          </div>
          <div class="kartu">
            <div class="cover item tr-6">
              <img src="/WildTaste/img/25.png" alt="" />
              <h1>Takari</h1>
              <p class="price">Rp. 10.000</p>
              <div class="card-back">
                <a class="card-backBtn" href="#">Add to cart</a>
                <a class="card-backBtn" href="#">View detail</a>
              </div>
            </div>
          </div>
          <div class="kartu">
            <div class="cover item tr-7">
              <img src="/WildTaste/img/26.png" alt="" />
              <h1>Sakura</h1>
              <p class="price">Rp. 30.000</p>
              <div class="card-back">
                <a class="card-backBtn" href="#">Add to cart</a>
                <a class="card-backBtn" href="#">View detail</a>
              </div>
            </div>
          </div>
          <div class="kartu">
            <div class="cover item tr-8">
              <img src="/WildTaste/img/27.png" alt="" />
              <h1>Vibra<br />Bites</h1>
              <p class="price">Rp. 20.000</p>
              <div class="card-back">
                <a class="card-backBtn" href="#">Add to cart</a>
                <a class="card-backBtn" href="#">View detail</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="Testi">
      <div class="containerTestimonial" id="containerTestimonial">
        <div class="containerTestimonialText">
          <h1>Give Your Testimony!</h1>
          <p>
            Share your experience and provide feedback to help improve our
            services.
          </p>
        </div>
        <div class="containerTestimonialIsi">
          <form id="testimonialForm" action="save_testimonial.php" method="post">
            <input
              name="name"
              type="text"
              class="feedback-input animatable fadeIn"
              placeholder="Name"
              maxlength="9"
            />
            <textarea
              name="testimony"
              rows="30"
              class="feedback-input animatable fadeIn animationDelay"
              placeholder="Write Your Testimony"
              maxlength="135"
            ></textarea>
            <div class="containerResponse animatable fadeIn">
              <div class="slide-track">
                <!-- SliderAsli -->
                <div class="slide">
                  <div class="containerKartuTesti">
                    <div class="cards">
                      <div class="kartuTesti">
                        <h2 class="card-title">Pele</h2>
                        <p class="date">19:25, 25 Desember 2023</p>
                        <p class="description">Saikk keren abis</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="slide">
                  <div class="containerKartuTesti">
                    <div class="cards">
                      <div class="kartuTesti">
                        <h2 class="card-title">Fadhil</h2>
                        <p class="date">19:43, 25 Desember 2023</p>
                        <p class="description">Kelas Cuii Keren Abis</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="slide">
                  <div class="containerKartuTesti">
                    <div class="cards">
                      <div class="kartuTesti">
                        <h2 class="card-title">Tabina</h2>
                        <p class="date">21:14, 25 Desember 2023</p>
                        <p class="description">Mana Ada Jeleknya Please A :D</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="slide">
                  <div class="containerKartuTesti">
                    <div class="cards">
                      <div class="kartuTesti">
                        <h2 class="card-title">Jabar</h2>
                        <p class="date">22:25, 25 Desember 2023</p>
                        <p class="description">Emangnya Boleh Sekeren ini?</p>
                      </div>
                    </div>
                  </div>
                </div>
                <?php
                require 'koneksi.php';

                // Ambil data testimoni dari database
                $sql = "SELECT * FROM testimonials";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $testimonials = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Tutup koneksi database
                $conn = null;
                ?>
                <!-- Bagian HTML untuk menampilkan testimoni -->
                <?php foreach ($testimonials as $testimonial) : ?>
                <div class="slide">
                 <div class="containerKartuTesti">
                  <div class="cards">
                   <div class="kartuTesti">
                    <h2 class="card-title"><?= $testimonial['name']; ?></h2>
                    <p class="date"><?= $testimonial['date']; ?></p>
                    <p class="description"><?= $testimonial['description']; ?></p>
                   </div>
                  </div>
                 </div>
                </div>
                <?php endforeach; ?>

                <!-- Slider Asli -->
                <!-- Slide Biar Smooth -->
                <div class="slide">
                  <div class="containerKartuTesti">
                    <div class="cards">
                      <div class="kartuTesti">
                        <h2 class="card-title">Pele</h2>
                        <p class="date">19:25, 25 Desember 2023</p>
                        <p class="description">Saikk keren abis</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="slide">
                  <div class="containerKartuTesti">
                    <div class="cards">
                      <div class="kartuTesti">
                        <h2 class="card-title">Fadhil</h2>
                        <p class="date">19:43, 25 Desember 2023</p>
                        <p class="description">Kelas Cuii Keren Abis</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="slide">
                  <div class="containerKartuTesti">
                    <div class="cards">
                      <div class="kartuTesti">
                        <h2 class="card-title">Tabina</h2>
                        <p class="date">21:14, 25 Desember 2023</p>
                        <p class="description">Mana Ada Jeleknya Please A :D</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="slide">
                  <div class="containerKartuTesti">
                    <div class="cards">
                      <div class="kartuTesti">
                        <h2 class="card-title">Jabar</h2>
                        <p class="date">22:25, 25 Desember 2023</p>
                        <p class="description">Emangnya Boleh Sekeren ini?</p>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Bagian HTML untuk menampilkan testimoni -->
                <?php foreach ($testimonials as $testimonial) : ?>
                <div class="slide">
                        <div class="containerKartuTesti">
                            <div class="cards">
                                <div class="kartuTesti">
                                    <h2 class="card-title"><?= $testimonial['name']; ?></h2>
                                    <p class="date"><?= $testimonial['date']; ?></p>
                                    <p class="description"><?= $testimonial['description']; ?></p>
                                </div>
                            </div>
                        </div>
                      </div>
                      <?php endforeach; ?>
                <!-- END DARI SLIDE SMOOTH -->
              </div>
            </div>
            <div class="containerTestiBtn">
              <div
                class="containerSubmitBtn animatable fadeIn animationDelayLong"
                id="containerSubmit"
              >
                <a
                  ><input
                    type="submit"
                    class="btn"
                    value="Submit"
                    id="submitBtn"
                /></a>
              </div>
              <div
                class="containerShowBtn animatable fadeIn animationDelayLong"
                id="containerShow"
              >
                <a href="#containerTestimonial" class="btn" id="showBtn"
                  >Show Responses</a
                >
              </div>
              <div
                class="containerCloseBtn animatable fadeIn"
                id="containerClose"
              >
                <a href="#containerTestimonial" class="btn" id="closeBtn"
                  >Close</a
                >
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>

    <!-- Site footer -->
    <footer class="site-footer" id="footer">
      <div class="containerFooter">
        <div class="row">
          <div class="col-sm-12 col-md-6">
            <h6>About</h6>
            <p class="text-justify">
              WildTaste adalah sebuah situs web yang didedikasikan untuk
              menghadirkan pengalaman kuliner unik seputar makanan binatang.
              Dengan fokus pada keanekaragaman rasa dan budaya, WildTaste
              mengajak pengunjungnya untuk menjelajahi dunia kuliner yang tak
              terduga dan menggugah selera. WildTaste bertujuan untuk menjadi
              sumber inspirasi bagi para pecinta makanan yang ingin merasakan
              sensasi kuliner yang liar dan autentik. Selamat menikmati
              petualangan kuliner di WildTaste!
            </p>
          </div>

          <div class="col-xs-6 col-md-3">
            <h6>Categories</h6>
            <ul class="footer-links">
              <li><a href="">UI Design</a></li>
              <li><a href="">PHP</a></li>
              <li><a href="">Java</a></li>
              <li><a href="">Android</a></li>
              <li><a href="">Templates</a></li>
            </ul>
          </div>

          <div class="col-xs-6 col-md-3">
            <h6>Quick Links</h6>
            <ul class="footer-links">
              <li><a href="">About Us</a></li>
              <li><a href="">Contact Us</a></li>
              <li><a href="">Contribute</a></li>
              <li><a href="">Privacy Policy</a></li>
              <li><a href="">Sitemap</a></li>
            </ul>
          </div>
        </div>
        <hr />
      </div>
      <div class="container">
        <div class="row">
          <div
            class="col-md-8 col-sm-6 col-xs-12"
            style="display: flex; align-items: center"
          >
            <p class="copyright-text">
              Copyright &copy; 2023 All Rights Reserved by
              <a href="#">WildTaste</a>.
            </p>
          </div>

          <div class="col-md-4 col-sm-6 col-xs-12 icon-bawah">
            <ul class="social-icons">
              <li>
                <a class="facebook" href="#"><i class="bx bxl-facebook"></i></a>
              </li>
              <li>
                <a class="twitter" href="#"><i class="bx bxl-twitter"></i></a>
              </li>
              <li>
                <a class="linkedin" href="#"><i class="bx bxl-linkedin"></i></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>

    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
      integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
      crossorigin="anonymous"
    ></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="/WildTaste/LandingPage/app.js"></script>
  </body>
</html>
