<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT. ATTAQI BERKAH UTAMA — Portal Transaksi Digital</title>
    <meta name="description" content="Kelola transaksi dan pembayaran bisnis Anda dengan cepat, aman, dan tanpa repot bersama PT. ATTAQI BERKAH UTAMA.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --gold:       #C8963E;
            --gold-light: #E8B860;
            --gold-dark:  #9C6E28;
            --gold-pale:  #FDF6E7;
            --white:      #FFFFFF;
            --off-white:  #FAFAF8;
            --gray-50:    #F9F9F7;
            --gray-100:   #F2F0EB;
            --gray-300:   #D1CCC0;
            --gray-500:   #8A8478;
            --gray-700:   #4A4540;
            --gray-900:   #1C1A17;
            --shadow-sm:  0 1px 3px rgba(0,0,0,.07), 0 1px 2px rgba(0,0,0,.05);
            --shadow-md:  0 4px 16px rgba(0,0,0,.08), 0 2px 6px rgba(0,0,0,.05);
            --shadow-lg:  0 12px 40px rgba(0,0,0,.10), 0 4px 12px rgba(0,0,0,.06);
            --shadow-gold:0 8px 32px rgba(200,150,62,.25);
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', system-ui, sans-serif;
            background: var(--off-white);
            color: var(--gray-900);
            overflow-x: hidden;
            line-height: 1.6;
        }

        /* ── NAVBAR ─────────────────────────────────────────── */
        header {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(255,255,255,.92);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--gray-100);
            box-shadow: var(--shadow-sm);
        }

        .nav-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
            height: 68px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .nav-brand img {
            height: 40px;
            width: auto;
            object-fit: contain;
        }

        .nav-brand-text {
            font-size: 15px;
            font-weight: 700;
            color: var(--gray-900);
            line-height: 1.25;
            letter-spacing: -.2px;
        }

        .nav-brand-sub {
            font-size: 10px;
            font-weight: 500;
            color: var(--gold);
            letter-spacing: .5px;
            text-transform: uppercase;
        }

        nav { display: flex; align-items: center; gap: 6px; }

        nav a {
            font-size: 14px;
            font-weight: 500;
            color: var(--gray-700);
            text-decoration: none;
            padding: 8px 14px;
            border-radius: 8px;
            transition: color .2s, background .2s;
        }

        nav a:hover { color: var(--gold-dark); background: var(--gold-pale); }

        .btn-primary {
            background: linear-gradient(135deg, var(--gold), var(--gold-dark));
            color: #fff !important;
            font-weight: 600 !important;
            padding: 9px 20px !important;
            border-radius: 10px !important;
            box-shadow: var(--shadow-gold);
            transition: transform .2s, box-shadow .2s !important;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--gold-light), var(--gold)) !important;
            transform: translateY(-1px);
            box-shadow: 0 12px 36px rgba(200,150,62,.35) !important;
        }

        .btn-outline {
            border: 1.5px solid var(--gold) !important;
            color: var(--gold-dark) !important;
            background: transparent !important;
        }

        .btn-outline:hover { background: var(--gold-pale) !important; }

        /* ── HERO ───────────────────────────────────────────── */
        .hero {
            background: linear-gradient(150deg, #fff 0%, #FDF8EE 50%, #FFF8E8 100%);
            padding: 96px 24px 80px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -120px; left: 50%;
            transform: translateX(-50%);
            width: 700px; height: 700px;
            background: radial-gradient(circle, rgba(200,150,62,.10) 0%, transparent 70%);
            pointer-events: none;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--gold-pale);
            border: 1px solid rgba(200,150,62,.3);
            color: var(--gold-dark);
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .5px;
            text-transform: uppercase;
            padding: 6px 14px;
            border-radius: 999px;
            margin-bottom: 24px;
        }

        .hero h1 {
            font-size: clamp(2rem, 5vw, 3.4rem);
            font-weight: 900;
            letter-spacing: -1.5px;
            line-height: 1.12;
            color: var(--gray-900);
            max-width: 700px;
            margin: 0 auto 20px;
        }

        .hero h1 span {
            background: linear-gradient(135deg, var(--gold), var(--gold-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero p {
            font-size: 17px;
            color: var(--gray-500);
            max-width: 520px;
            margin: 0 auto 40px;
            line-height: 1.7;
        }

        .hero-cta {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .cta-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 13px 28px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            transition: transform .2s, box-shadow .2s;
        }

        .cta-btn-main {
            background: linear-gradient(135deg, var(--gold), var(--gold-dark));
            color: #fff;
            box-shadow: var(--shadow-gold);
        }

        .cta-btn-main:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 40px rgba(200,150,62,.4);
        }

        .cta-btn-ghost {
            background: #fff;
            color: var(--gray-700);
            border: 1.5px solid var(--gray-300);
            box-shadow: var(--shadow-sm);
        }

        .cta-btn-ghost:hover {
            border-color: var(--gold);
            color: var(--gold-dark);
            transform: translateY(-1px);
        }

        /* ── LAYANAN ────────────────────────────────────────── */
        #layanan {
            padding: 80px 24px;
            background: var(--white);
        }

        .section-label {
            text-align: center;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 12px;
        }

        .section-title {
            text-align: center;
            font-size: clamp(1.6rem, 3vw, 2.4rem);
            font-weight: 800;
            letter-spacing: -0.8px;
            color: var(--gray-900);
            margin-bottom: 12px;
        }

        .section-sub {
            text-align: center;
            color: var(--gray-500);
            font-size: 16px;
            max-width: 500px;
            margin: 0 auto 52px;
        }

        .logo-grid {
            max-width: 900px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        @media (max-width: 600px) { .logo-grid { grid-template-columns: repeat(2, 1fr); } }

        .logo-card {
            background: var(--gray-50);
            border: 1px solid var(--gray-100);
            border-radius: 16px;
            padding: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: border-color .2s, box-shadow .2s, transform .2s;
        }

        .logo-card:hover {
            border-color: var(--gold-light);
            box-shadow: 0 8px 24px rgba(200,150,62,.12);
            transform: translateY(-2px);
        }

        .logo-card img {
            height: 72px;
            object-fit: contain;
            filter: grayscale(20%);
            transition: filter .2s;
        }

        .logo-card:hover img { filter: grayscale(0%); }

        /* ── FEATURES ───────────────────────────────────────── */
        .features {
            padding: 80px 24px;
            background: var(--gray-50);
        }

        .features-grid {
            max-width: 960px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 24px;
        }

        .feature-card {
            background: var(--white);
            border: 1px solid var(--gray-100);
            border-radius: 18px;
            padding: 28px 24px;
            box-shadow: var(--shadow-sm);
            transition: box-shadow .2s, transform .2s;
        }

        .feature-card:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-3px);
        }

        .feature-icon {
            width: 48px; height: 48px;
            background: linear-gradient(135deg, var(--gold-pale), #FFF0CC);
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 22px;
            margin-bottom: 16px;
        }

        .feature-card h3 {
            font-size: 16px;
            font-weight: 700;
            color: var(--gray-900);
            margin-bottom: 8px;
        }

        .feature-card p { font-size: 14px; color: var(--gray-500); line-height: 1.6; }

        /* ── KONTAK ─────────────────────────────────────────── */
        #contacts {
            padding: 80px 24px;
            background: var(--white);
        }

        .contact-grid {
            max-width: 960px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }

        @media (max-width: 720px) { .contact-grid { grid-template-columns: 1fr; } }

        .contact-info { display: flex; flex-direction: column; gap: 20px; }

        .contact-item { display: flex; gap: 14px; align-items: flex-start; }

        .contact-item-icon {
            width: 40px; height: 40px; flex-shrink: 0;
            background: var(--gold-pale);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px;
        }

        .contact-item-text h4 { font-size: 13px; font-weight: 600; color: var(--gray-500); margin-bottom: 4px; text-transform: uppercase; letter-spacing: .5px; }
        .contact-item-text a, .contact-item-text p { font-size: 15px; color: var(--gray-900); text-decoration: none; line-height: 1.5; }
        .contact-item-text a:hover { color: var(--gold-dark); }

        .contact-map iframe {
            width: 100%; height: 280px;
            border-radius: 16px;
            border: 1px solid var(--gray-100);
        }

        .contact-map a {
            display: inline-block;
            margin-top: 12px;
            color: var(--gold-dark);
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
        }

        .contact-map a:hover { text-decoration: underline; }

        /* ── FOOTER ─────────────────────────────────────────── */
        footer {
            background: var(--gray-900);
            color: #fff;
            padding: 48px 24px 28px;
        }

        .footer-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 32px;
        }

        .footer-brand { display: flex; align-items: center; gap: 10px; }
        .footer-brand img { height: 36px; width: auto; filter: brightness(0) invert(1); opacity: .9; }
        .footer-brand-name { font-size: 14px; font-weight: 700; color: #fff; line-height: 1.3; }
        .footer-brand-sub { font-size: 11px; color: var(--gold-light); letter-spacing: .5px; }

        .footer-links { display: flex; gap: 40px; flex-wrap: wrap; }
        .footer-col h5 { font-size: 12px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; color: var(--gold-light); margin-bottom: 14px; }
        .footer-col ul { list-style: none; display: flex; flex-direction: column; gap: 8px; }
        .footer-col a { font-size: 14px; color: rgba(255,255,255,.6); text-decoration: none; transition: color .2s; }
        .footer-col a:hover { color: var(--gold-light); }

        .footer-bottom {
            max-width: 1200px;
            margin: 28px auto 0;
            padding-top: 20px;
            border-top: 1px solid rgba(255,255,255,.08);
            text-align: center;
            font-size: 13px;
            color: rgba(255,255,255,.4);
        }

        /* ── MOBILE NAV ─────────────────────────────────────── */
        .hamburger { display: none; cursor: pointer; padding: 8px; border: none; background: none; }
        .hamburger span { display: block; width: 22px; height: 2px; background: var(--gray-700); border-radius: 2px; transition: .2s; margin: 5px 0; }

        @media (max-width: 768px) {
            .hamburger { display: block; }
            nav { display: none; position: absolute; top: 68px; left: 0; right: 0; background: #fff; border-bottom: 1px solid var(--gray-100); flex-direction: column; align-items: stretch; padding: 12px 16px 16px; box-shadow: var(--shadow-md); }
            nav.open { display: flex; }
            nav a { padding: 12px 14px; }
        }
    </style>
</head>

<body>

    <!-- ── HEADER ──────────────────────────────────────────── -->
    <header>
        <div class="nav-inner">
            <a href="/" class="nav-brand">
                <img src="{{ asset('images/logo.png') }}" alt="PT. ATTAQI BERKAH UTAMA Logo">
                <div>
                    <div class="nav-brand-text">PT. ATTAQI BERKAH UTAMA</div>
                    <div class="nav-brand-sub">Portal Transaksi Digital</div>
                </div>
            </a>

            <button class="hamburger" id="nav-mobile-btn" aria-label="Menu">
                <span></span><span></span>
            </button>

            <nav id="nav">
                <a href="#">Beranda</a>
                <a href="#layanan">Layanan</a>
                <a href="#contacts">Kontak</a>
                <a href="/user/login" class="btn-outline cta-btn" style="padding:9px 18px;border-radius:10px;font-size:14px;font-weight:600;text-decoration:none;border:1.5px solid var(--gold);color:var(--gold-dark);">Masuk</a>
                <a href="/user/register" class="btn-primary" style="padding:9px 18px;border-radius:10px;font-size:14px;text-decoration:none;">Daftar</a>
            </nav>
        </div>
    </header>

    <!-- ── HERO ────────────────────────────────────────────── -->
    <section class="hero">
        <div class="hero-badge">✦ Sistem Pembayaran Digital Terpercaya</div>
        <h1>Solusi Transaksi Digital<br>untuk <span>PT. ATTAQI<br>BERKAH UTAMA</span></h1>
        <p>Kelola transaksi, topup saldo, dan pembayaran bisnis Anda dengan cepat, aman, dan tanpa repot — semua dalam satu portal.</p>
        <div class="hero-cta">
            <a href="/user/login" class="cta-btn cta-btn-main">
                <span>⚡</span> Masuk ke Portal
            </a>
            <a href="/user/register" class="cta-btn cta-btn-ghost">
                Daftar Akun Baru →
            </a>
        </div>
    </section>

    <!-- ── KEUNGGULAN ───────────────────────────────────────── -->
    <section class="features">
        <p class="section-label">Mengapa Kami</p>
        <h2 class="section-title">Fitur Unggulan</h2>
        <p class="section-sub">Platform kami dirancang untuk kemudahan transaksi bisnis modern.</p>

        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">💳</div>
                <h3>Topup Saldo Mudah</h3>
                <p>Isi saldo dengan berbagai metode pembayaran populer secara instan dan aman.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📦</div>
                <h3>Katalog Produk Lengkap</h3>
                <p>Beli produk & layanan langsung dari portal dengan potong saldo otomatis.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📊</div>
                <h3>Riwayat Transaksi</h3>
                <p>Pantau seluruh riwayat transaksi Anda secara real-time dan transparan.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🔒</div>
                <h3>Keamanan Terjamin</h3>
                <p>Sistem proteksi berlapis memastikan data dan transaksi Anda selalu aman.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">⚡</div>
                <h3>Proses Cepat</h3>
                <p>Transaksi diproses dalam hitungan detik, tanpa antrian dan tanpa kerumitan.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🤝</div>
                <h3>Layanan Pelanggan</h3>
                <p>Tim kami siap membantu Anda kapan saja melalui WhatsApp dan email.</p>
            </div>
        </div>
    </section>

    <!-- ── LAYANAN ───────────────────────────────────────────── -->
    <section id="layanan" style="padding:80px 24px; background:#fff;">
        <p class="section-label">Jaringan Kami</p>
        <h2 class="section-title">Operator yang Didukung</h2>
        <p class="section-sub">Mendukung berbagai operator dan layanan keuangan terkemuka di Indonesia.</p>

        <div class="logo-grid">
            <div class="logo-card"><img src="{{ asset('images/indosat.jpg') }}" alt="Indosat"></div>
            <div class="logo-card"><img src="{{ asset('images/telkomsel.jpg') }}" alt="Telkomsel"></div>
            <div class="logo-card"><img src="{{ asset('images/xl.jpg') }}" alt="XL Axiata"></div>
            <div class="logo-card"><img src="{{ asset('images/bank.jpg') }}" alt="Bank"></div>
            <div class="logo-card"><img src="{{ asset('images/tri.jpg') }}" alt="Tri"></div>
            <div class="logo-card"><img src="{{ asset('images/smartfren.jpg') }}" alt="Smartfren"></div>
        </div>
    </section>

    <!-- ── KONTAK ───────────────────────────────────────────── -->
    <section id="contacts" style="padding:80px 24px; background:var(--gray-50);">
        <p class="section-label">Hubungi Kami</p>
        <h2 class="section-title">Ada Pertanyaan?</h2>
        <p class="section-sub">Kami siap membantu untuk informasi lebih lanjut, kerja sama, atau bantuan teknis.</p>

        <div class="contact-grid">
            <div class="contact-info">
                <div class="contact-item">
                    <div class="contact-item-icon">📞</div>
                    <div class="contact-item-text">
                        <h4>Telepon / WhatsApp</h4>
                        <a href="https://wa.me/6281210627762">+62 812-1062-7762</a>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-item-icon">✉️</div>
                    <div class="contact-item-text">
                        <h4>Email</h4>
                        <a href="mailto:info@attaqiberkahutama.co.id">info@attaqiberkahutama.co.id</a>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-item-icon">📍</div>
                    <div class="contact-item-text">
                        <h4>Alamat</h4>
                        <p>Jalan Salvia Blok Ub No. 15, RT.1/RW.6, Rw Buntu, Rawabuntu, Serpong, Kota Tangerang Selatan, Banten</p>
                    </div>
                </div>
            </div>

            <div class="contact-map">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.280035801262!2d106.67633857498624!3d-6.303602561710993!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69fbe1265e9c99%3A0x8a06c27f25ccf878!2sJalan%20Salvia%20Blok%20Ub%20No.%2015%2C%20RT.1%2FRW.6%2C%20Rw%20Buntu%2C%20Rawabuntu%2C%20SERPONG%2C%20KOTA%20TANGERANG%20SELATAN%2C%20BANTEN!5e0!3m2!1sen!2sid!4v1717685148907!5m2!1sen!2sid"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
                <a href="https://www.google.com/maps/place/6%C2%B018'13.0%22S+106%C2%B040'44.1%22E" target="_blank">
                    📍 Lihat di Google Maps
                </a>
            </div>
        </div>
    </section>

    <!-- ── FOOTER ───────────────────────────────────────────── -->
    <footer>
        <div class="footer-inner">
            <div class="footer-brand">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
                <div>
                    <div class="footer-brand-name">PT. ATTAQI BERKAH UTAMA</div>
                    <div class="footer-brand-sub">Portal Transaksi Digital</div>
                </div>
            </div>

            <div class="footer-links">
                <div class="footer-col">
                    <h5>Navigasi</h5>
                    <ul>
                        <li><a href="#">Beranda</a></li>
                        <li><a href="#layanan">Layanan</a></li>
                        <li><a href="#contacts">Kontak</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h5>Akun</h5>
                    <ul>
                        <li><a href="/user/login">Login User</a></li>
                        <li><a href="/user/register">Daftar</a></li>
                        <li><a href="/admin/login">Login Admin</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-bottom">© 2025 PT. ATTAQI BERKAH UTAMA — Hak cipta dilindungi.</div>
    </footer>

    <!-- ── MOBILE NAV JS ─────────────────────────────────────── -->
    <script>
        const btn = document.getElementById('nav-mobile-btn');
        const nav = document.getElementById('nav');
        if (btn && nav) {
            btn.addEventListener('click', function () {
                nav.classList.toggle('open');
                const spans = btn.querySelectorAll('span');
                if (nav.classList.contains('open')) {
                    spans[0].style.transform = 'rotate(45deg) translate(5px, 5px)';
                    spans[1].style.transform = 'rotate(-45deg) translate(5px, -5px)';
                } else {
                    spans[0].style.transform = '';
                    spans[1].style.transform = '';
                }
            });
        }
    </script>

</body>
</html>
