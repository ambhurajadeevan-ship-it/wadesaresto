@extends('layouts.app')

@section('content')

<style>

body {
    font-family: 'Poppins', sans-serif;
}

.section {
    padding: 100px 0;
}

.section-dark {
    background: #0f0f0f;
    color: #fff;
}

.section-light {
    background: #f8f8f8;
}

/* HERO */
.hero-section {
    padding-top: 60px;
    padding-bottom: 80px;
    background: white;
}

#heroCarousel img {
    height: 420px;
    object-fit: cover;
    border-radius: 20px;
    transition: 0.5s ease;
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
    filter: invert(1);
}

.carousel-item {
    transition: transform 0.8s ease-in-out;
}

.hero-img{
    border-radius: 20px;
    box-shadow: 0 30px 60px rgba(0,0,0,0.4);
    transition: 0.4s ease; 
}

.hero-img:hover{
    transform: scale(1.03);
}

.hero-content {
    color: #fff;
    padding-left: 80px;
}

.hero-title {
    font-family: 'Playfair Display', serif;
    font-size: 70px;
    font-weight: 300;
    letter-spacing: 4px;
    color: #0F3B34;
    margin-bottom: 18px;
}

.hero-subtitle {
    letter-spacing: 3px;
    font-size: 16px;
    margin-bottom: 40px;
    opacity: 0.9;
    color: #1F3D36;
}

.hero-btn {
    padding: 16px 45px;
    border-radius: 50px;
    background: linear-gradient(135deg, #d4b16a, #b8954d);
    font-weight: 600;
    display: inline-block;
}

.btn-hero {
    background: #1F3D36;
    border: none;
    padding: 14px 40px;
    border-radius: 50px;
    font-weight: 600;
    color: #fff;
    transition: 0.3s;
}

.btn-hero:hover {
    background: #0F2A24;
    transform: translateY(-3px);
}

.btn-reservasi {
    background: #0F3B34;   /* dark green elegan */
    color: #ffffff;
    border: none;
    border-radius: 40px;
    padding: 14px 40px;
    font-weight: 600;
    text-decoration: none;
    display: inline-block;
    transition: 0.3s ease;
}

.btn-reservasi:hover {
    background: #0c2f2a;
    color: #ffffff;
}

.hero-slider-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 15px;
}

.hero-img {
    height: 400px;
    object-fit: cover;
    border-radius: 20px;
}

.slider-btn {
    background: transparent;
    border: none;
    width: auto;
    height: auto;
    padding: 0;
    color: #1F3D36;
    font-size: 32px;
    transition: 0.3s ease;
}

.slider-btn:hover {
    background: #162C27;
    transform: scale(1.15);
}

/*About*/
/* ===== ABOUT PREMIUM WHITE ===== */

.about-section {
    background: white;
    padding-top: 60px;
    padding-bottom: 80px;
}

.about-small-title {
    letter-spacing: 3px;
    font-size: 13px;
    color: #c8a96a;
}

.about-title {
    font-family: 'Playfair Display', serif;
    font-size: 42px;
    margin: 15px 0 20px 0;
    color: #0F3B34;;
}

.about-divider {
    width: 80px;
    height: 2px;
    background: #c8a96a;
    margin-bottom: 25px;
}

.about-lead {
    font-weight: 500;
    font-size: 18px;
    margin-bottom: 20px;
    color: #0F3B34;
}

.about-text {
    line-height: 1.9;
    color: #555;
}

.about-quote {
    border-left: 3px solid #c8a96a;
    padding-left: 20px;
    margin: 30px 0;
    font-style: italic;
    color: #333;
}

.about-highlights h6 {
    color: #0F3B34;
    font-weight: 600;
}

.about-highlights small {
    color: #666;
}

.about-stats h3 {
    color: #0F3B34;
    font-weight: 700;
}

.about-stats small {
    color: #777;
}

/* IMAGE EFFECT */
.about-img-wrapper {
    position: relative;
}

.about-img {
    border-radius: 20px;
    box-shadow: 0 25px 60px rgba(0,0,0,0.1);
}

.about-accent {
    position: absolute;
    bottom: -20px;
    left: -20px;
    width: 120px;
    height: 120px;
    background: #c8a96a;
    border-radius: 20px;
    opacity: 0.15;
}

/*menu*/

.menu-section{
    background:white;
    padding-top: 60px;
    padding-bottom: 80px;
}

.menu-title{
    font-family:'Playfair Display',serif;
    text-align:center;
    font-size: 50px;
    margin-bottom:50px;
    letter-spacing:5px;
    color:#0F3B34;
}

.menu-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:25px;
    max-width: 1000px;
    margin: auto;
}

.menu-item{
    position:relative;
    aspect-ratio:3/4;
    overflow:hidden;
    border-radius:0px;
    cursor:pointer;
}

.menu-item img{
    width:100%;
    height:100%;
    object-fit:cover;
    transition:.5s;
    border-radius: 0px:
}

.menu-overlay{
    position:absolute;
    bottom:0;
    left:0;
    right:0;
    padding:20px;
    background:linear-gradient(to top,rgba(0,0,0,0.8),transparent);
    color:white;
    opacity:0;
    transition:.4s;
}

.menu-item:hover img{
    transform:scale(1.1);
}

.menu-item:hover .menu-overlay{
    opacity:1;
}

@media(max-width:768px){
.menu-grid{grid-template-columns:repeat(2,1fr);}
}

@media(max-width:500px){
.menu-grid{grid-template-columns:1fr;}
}


/* GALLERY */

.gallery-section{
    background:#fff;
    padding-top: 60px;
    padding-bottom: 80px;
}

/* TITLE */
.gallery-title{
    font-family:'Playfair Display',serif;
    text-align:center;
    font-size: 50px;
    letter-spacing:5px;
    color:#0F3B34;
}

.gallery-sub{
    color:#777;
    letter-spacing:2px;
    margin-bottom:50px;
    font-size:13px;
}

/* GRID */
.gallery-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:25px;
}

/* IMAGE */
.gallery-item{
    position:relative;
    overflow:hidden;
    height:260px;
    cursor:pointer;
}

.gallery-item img{
    width:100%;
    height:100%;
    object-fit:cover;
    transition:0.5s ease;
}

/* HOVER EFFECT */
.gallery-item::after{
    content:"";
    position:absolute;
    inset:0;
    background:rgba(0,0,0,0.2);
    opacity:0;
    transition:0.4s;
}

.gallery-item:hover img{
    transform:scale(1.1);
}

.gallery-item:hover::after{
    opacity:1;
}

/* RESPONSIVE */
@media(max-width:992px){
    .gallery-grid{
        grid-template-columns:repeat(3,1fr);
    }
}

@media(max-width:768px){
    .gallery-grid{
        grid-template-columns:repeat(2,1fr);
    }
}

@media(max-width:500px){
    .gallery-grid{
        grid-template-columns:1fr;
    }
}

.instagram-cta h5 {
    font-weight: 600;
    color: #333;
}

.btn-instagram {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 22px;
    border-radius: 30px;
    text-decoration: none;
    font-weight: 600;
    color: #fff;
    background: linear-gradient(45deg,#f09433,#e6683c,#dc2743,#cc2366,#bc1888);
    transition: 0.3s ease;
}

.btn-instagram:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    color: #fff;
}


/* LOCATION */
/* ===== LOCATION SECTION FIX ===== */

/* SECTION */
.location-section {
    background: white;
    padding-top: 60px;
    padding-bottom: 80px;
}

/* TITLE */
.section-title h2 {
    font-family: 'Playfair Display', serif;
    font-weight: 700;
    font-size: 50px;
    letter-spacing: 5px;
    color:#0F3B34;
}

.section-title p {
    color: #777;
    font-size: 20px;
}

/* MAP */
.map-box {
    border-radius: 30px;
    overflow: hidden;
    box-shadow: 0 30px 80px rgba(0,0,0,0.08);
}

.map-box iframe {
    width: 100%;
    height: 450px;
    border: none;
}

/* BUTTON */
.location-button-wrapper {
    text-align: center;
    margin-top: 40px; /* kasih jarak dari map */
}

.btn-location {
    display: inline-block;
    padding: 14px 32px;
    border-radius: 40px;
    background: #0f3b34;
    color: white;
    font-weight: 600;
    text-decoration: none;
    transition: 0.3s ease;
}

.btn-location:hover {
    background: #092822;
    transform: translateY(-4px);
}


/* ================= FOOTER PREMIUM ================= */

.premium-footer {
    background: #F3EFE7;
    color: #333;
    padding: 80px 0 30px 0;
}

/* Brand */
.footer-brand {
    font-family: 'Playfair Display', serif;
    font-size: 34px;
    font-weight: 700;
    letter-spacing: 4px;
    color: #0F3B34;
}

.footer-sub {
    font-size: 13px;
    letter-spacing: 2px;
    color: #777;
    margin-bottom: 20px;
}

.footer-desc {
    font-size: 14px;
    color: #555;
    line-height: 1.8;
}

/* Title */
.footer-title {
    font-size: 14px;
    letter-spacing: 2px;
    text-transform: uppercase;
    margin-bottom: 20px;
    color: #0F3B34;
}

/* Links */
.footer-links {
    list-style: none;
    padding: 0;
}

.footer-links li {
    margin-bottom: 10px;
}

.footer-links a {
    color: #555;
    text-decoration: none;
    transition: 0.3s;
}

.footer-links a:hover {
    color: #0F3B34;
}

/* Contact */
.footer-contact {
    font-size: 14px;
    color: #555;
    line-height: 1.8;
}

/* Social */
.footer-social {
    margin-top: 20px;
    display: flex;
    gap: 15px;
}

.footer-social a {
    width: 45px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #0F3B34;
    border-radius: 50%;
    color: #fff;
    transition: 0.3s;
}

.footer-social a:hover {
    background: #c8a96a;
    color: #000;
    transform: translateY(-4px);
}

/* Divider */
.footer-line {
    border-color: #ddd;
    margin: 40px 0 20px 0;
}

.footer-bottom {
    font-size: 13px;
    color: #666;
}

</style>

<!-- HERO -->
<section id="home" class="hero-section">
    <div class="container">
        <div class="row align-items-center">

            <!-- TEXT KIRI -->
            <div class="col-lg-6 ps-lg-5">
                <h1 class="hero-title">
                    WADESA <br> RESTO
                </h1>
                <p class="hero-subtitle">
                    Rasa Nusantara · Dalam Balutan Elegan
                </p>
                <a href="/booking" class="btn btn-gold mt-3">
                    Reservasi Sekarang
                </a>
            </div>

            <!-- FOTO KANAN -->
            <div class="col-lg-6 order-lg-2 order-1">
                <div class="hero-slider-wrapper">

                    <button class="slider-btn"
                        type="button"
                        data-bs-target="#heroCarousel"
                        data-bs-slide="prev">
                        <i class="bi bi-chevron-left"></i>
                    </button>

                    <div id="heroCarousel"
                         class="carousel slide w-100"
                         data-bs-ride="carousel">

                        <div class="carousel-inner rounded-4 shadow">

                            <div class="carousel-item active">
                                <img src="{{ asset('images/hero1.JPG') }}"
                                     class="d-block w-100 hero-img">
                            </div>

                            <div class="carousel-item">
                                <img src="{{ asset('images/hero2.PNG') }}"
                                     class="d-block w-100 hero-img">
                            </div>

                            <div class="carousel-item">
                                <img src="{{ asset('images/hero3.PNG') }}"
                                     class="d-block w-100 hero-img">
                            </div>

                        </div>
                    </div>

                    <button class="slider-btn"
                        type="button"
                        data-bs-target="#heroCarousel"
                        data-bs-slide="next">
                        <i class="bi bi-chevron-right"></i>
                    </button>

                </div>
            </div>

        </div>
    </div>
</section>

<!-- ABOUT PREMIUM WHITE -->
<section id="about" class="about-section">
    <div class="container">

        <div class="row align-items-center">

            <!-- IMAGE SIDE -->
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="about-img-wrapper">
                    <img src="{{ asset('images/about.PNG') }}"
                         class="img-fluid about-img">

                    <div class="about-accent"></div>
                </div>
            </div>

            <!-- CONTENT SIDE -->
            <div class="col-lg-6 ps-lg-5">

                <h2 class="about-title">
                    Tentang Kami
                </h2>

                <div class="about-divider"></div>

                <p class="about-lead">
                    Lebih dari sekadar tempat makan, Wadesa adalah ruang untuk menikmati waktu,
                    rasa, dan suasana dalam harmoni yang hangat.
                </p>

                <p class="about-text">
                    Wadesa Resto merupakan perpaduan harmonis antara cita rasa lokal autentik 
                    dan sentuhan modern yang elegan. Terletak di kawasan sejuk Baturiti, 
                    kami menghadirkan pengalaman kuliner yang tidak hanya memanjakan lidah,
                    tetapi juga memberikan kenyamanan dalam setiap momen.
                </p>

                <blockquote class="about-quote">
                    “Kami percaya bahwa pengalaman kuliner terbaik lahir dari 
                    keseimbangan rasa, suasana, dan pelayanan.”
                </blockquote>

                <!-- HIGHLIGHT GRID -->
                <div class="row mt-4 about-highlights">

                    <div class="col-6 mb-4">
                        <h6>Bahan</h6>
                        <small>Bahan pilihan terbaik setiap hari</small>
                    </div>

                    <div class="col-6 mb-4">
                        <h6>Atmosfer</h6>
                        <small>Suasana hangat & pemandangan alami</small>
                    </div>

                    <div class="col-6">
                        <h6>Pengalaman</h6>
                        <small>Pelayanan ramah & profesional</small>
                    </div>

                    <div class="col-6">
                        <h6>Interior</h6>
                        <small>Desain modern & nyaman</small>
                    </div>

                </div>

                <!-- STATISTICS -->
                <div class="row mt-5 about-stats text-center">

                    <div class="col-4">
                        <h3>5+</h3>
                        <small>Tahun Pengalaman</small>
                    </div>

                    <div class="col-4">
                        <h3>1000+</h3>
                        <small>Pelanggan Bahagia</small>
                    </div>

                    <div class="col-4">
                        <h3>4.4★</h3>
                        <small>Nilai Pelanggan</small>
                    </div>

                </div>

                <!-- CTA -->
                <div class="mt-5">
                    <a href="#menu" class="btn btn-gold px-4 py-2 me-3">
                        Lihat Menu Kita
                    </a>

                    <a href="/booking" class="btn btn-reservasi">
                        Reservasi Sekarang
                    </a>
                </div>

            </div>

        </div>
    </div>
</section>


<!-- MENU -->
<section id="menu" class="menu-section">

    <div class="container">

        <h2 class="menu-title">OUR MENU</h2>

        <div class="menu-grid">

            @foreach(\App\Models\Menu::take(6)->get() as $menu)

            <div class="menu-item">

                <img src="{{ asset('storage/'.$menu->foto) }}">

                <div class="menu-overlay">
                    <span>{{ $menu->kategori }}</span>
                    <h5>{{ $menu->nama_menu }}</h5>
                    <p>
                    Rp {{ number_format($menu->harga,0,',','.') }}
                    </p>
                </div>

            </div>

            @endforeach

        </div>

        <div class="text-center mt-5">
        <a href="{{ route('menu.all') }}" class="btn btn-gold px-4 py-2">
        Lihat Semua Menu
        </a>
        </div>

    </div>

</section>

<!-- GALERI -->
<section id="gallery" class="gallery-section">
    <div class="container">

        <div class="text-center">
            <h2 class="gallery-title">GALERI</h2>
            <p class="gallery-sub">Photo Galeri</p>
        </div>

        <div class="gallery-grid mt-5">

            @foreach($galeris as $g)
                <div class="gallery-item">
                    <img src="{{ asset('storage/'.$g->foto) }}">
                </div>
            @endforeach

        </div>

        <div class="text-center mt-5">
            <a href="https://www.instagram.com/wadesarestaurant?igsh=YXB1M2t2ZHo4bzdq"
            target="_blank"
            class="btn-instagram">
                <i class="bi bi-instagram"></i>
                Kunjungi Instagram
            </a>
        </div>

    </div>
</section>

<!-- LOCATION -->
<section id="location" class="location-section">
    <div class="container">

        <div class="section-title text-center mb-5">
            <h2>VISIT US</h2>
            <p>Kunjungi Kami Segera</p>
        </div>

        <div class="location-wrapper">

            <!-- MAP -->
            <div class="map-box">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3947.892248579462!2d115.17944927478511!3d-8.313505691721977!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd1899b5d0f23df%3A0xe6e3f4a05121515c!2sWADESA%20Warung%20Kopi%20%26%20Resto!5e0!3m2!1sid!2sid!4v1770831546743!5m2!1sid!2sid"
                    allowfullscreen=""
                    loading="lazy">
                </iframe>
            </div>

            <div class="location-button-wrapper">
                <a href="https://maps.app.goo.gl/DPXcem85tazSEFQC9"
                target="_blank"
                class="btn-location">
                    <i class="bi bi-geo-alt"></i> Buka di Google Maps
                </a>
            </div>

        </div>

    </div>
</section>

<!-- FOOTER -->
<footer class="premium-footer">
    <div class="container">

        <div class="row footer-main">

            <!-- BRAND -->
            <div class="col-md-4 mb-4">
                <div class="footer-brand">WADESA</div>
                <div class="footer-sub">WARUNG KOPI & RESTO</div>

                <p class="footer-desc">
                    Perpaduan cita rasa lokal dan sentuhan modern.
                    Tempat hangat untuk menikmati momen istimewa.
                </p>

                <a href="/booking" class="btn btn-gold mt-3 px-4">
                    Reservasi
                </a>
            </div>

            <!-- NAVIGATION -->
            <div class="col-md-4 mb-4">
                <h6 class="footer-title">Navigasi</h6>
                <ul class="footer-links">
                    <li><a href="/#home">Beranda</a></li>
                    <li><a href="/#about">Tentang</a></li>
                    <li><a href="/#menu">Menu</a></li>
                    <li><a href="/#gallery">Galeri</a></li>
                    <li><a href="/#location">Lokasi</a></li>
                </ul>
            </div>

            <!-- CONTACT -->
            <div class="col-md-4 mb-4">
                <h6 class="footer-title">About Us</h6>
                <p class="footer-contact">
                    Batunya, Kec. Baturiti<br>
                    Kab. Tabanan, Bali 82191<br><br>
                    <i class="bi bi-telephone"></i> 0823 3922 1193 <br>
                    <i class="bi bi-clock"></i> 07.00 - 20.00
                </p>

                <div class="footer-social">
                    <a href="https://www.instagram.com/wadesarestaurant?igsh=YXB1M2t2ZHo4bzdq"
                    target="_blank">
                        <i class="bi bi-instagram"></i>
                    </a>

                    <a href="https://www.facebook.com/share/19RX61RREn/?mibextid=wwXIfr"
                    target="_blank">
                        <i class="bi bi-facebook"></i>
                    </a>

                    <a href="https://wa.me/6282339221193"
                    target="_blank">
                        <i class="bi bi-whatsapp"></i>
                    </a>
                </div>
            </div>

        </div>

        <hr class="footer-line">

        <div class="footer-bottom text-center">
            © 2026 Wadesa Resto. All rights reserved.
        </div>

    </div>
</footer>



@endsection
