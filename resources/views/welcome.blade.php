@extends('layouts.app')

@section('content')

<style>
    /* ── Carousel Hero (Mobile-First) ── */
    .hero-carousel .carousel-item {
        height: clamp(300px, 60vh, 92vh);
        min-height: 300px;
        background-size: cover;
        background-position: center;
    }
    @media (min-width: 640px) {
        .hero-carousel .carousel-item {
            height: clamp(350px, 70vh, 92vh);
        }
    }
    .hero-carousel .carousel-item::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(15,23,42,.88) 0%, rgba(15,23,42,.45) 55%, transparent 100%);
    }
    .hero-carousel .carousel-caption {
        z-index: 10;
        bottom: 5%;
        left: 5%;
        right: 5%;
        text-align: center;
    }
    @media (min-width: 768px) {
        .hero-carousel .carousel-caption {
            bottom: 9%;
            left: 10%;
            right: 10%;
        }
    }
    .hero-badge {
        display: inline-block;
        border: 1px solid rgba(99,102,241,.55);
        background: rgba(99,102,241,.2);
        color: #a5b4fc;
        font-size: clamp(0.55rem, 2vw, 0.72rem);
        font-weight: 700;
        letter-spacing: .1em;
        text-transform: uppercase;
        padding: 0.25rem 0.75rem;
        border-radius: 999px;
        margin-bottom: 0.75rem;
        backdrop-filter: blur(8px);
    }
    @media (min-width: 640px) {
        .hero-badge {
            padding: 0.3rem 1rem;
            margin-bottom: 1.1rem;
        }
    }
    .hero-title {
        font-size: clamp(1.5rem, 5vw, 5rem);
        font-weight: 900;
        letter-spacing: -.025em;
        line-height: 1.1;
        color: #fff;
        margin-bottom: 0.5rem;
    }
    @media (min-width: 640px) {
        .hero-title {
            margin-bottom: 0.9rem;
        }
    }
    .hero-sub {
        font-size: clamp(0.85rem, 3vw, 1.1rem);
        color: #cbd5e1;
        max-width: 40rem;
        margin: 0 auto 1rem;
        line-height: 1.6;
        padding: 0 1rem;
    }
    @media (min-width: 640px) {
        .hero-sub {
            margin: 0 auto 2rem;
            line-height: 1.75;
            padding: 0;
        }
    }
    .hero-btn {
        display: inline-block;
        padding: 0.6rem 1.25rem;
        border-radius: 0.5rem;
        font-weight: 700;
        font-size: clamp(0.8rem, 2vw, 0.97rem);
        text-decoration: none;
        transition: background .2s, transform .1s;
    }
    @media (min-width: 640px) {
        .hero-btn {
            padding: 0.9rem 2.25rem;
            border-radius: 0.75rem;
        }
    }
    .hero-btn-primary {
        background: #4f46e5;
        color: #fff !important;
        box-shadow: 0 10px 30px rgba(79,70,229,.4);
    }
    .hero-btn-primary:hover, .hero-btn-primary:active { background: #4338ca; transform: translateY(-2px); }
    .carousel-indicators {
        bottom: 1rem !important;
    }
    .carousel-indicators [data-bs-target] {
        width: clamp(24px, 8vw, 36px);
        height: 3px;
        border-radius: 2px;
        background: rgba(255,255,255,.4);
        border: none;
    }
    .carousel-indicators .active {
        background: #818cf8;
        width: clamp(30px, 10vw, 52px);
    }
    .carousel-control-prev, .carousel-control-next {
        width: clamp(2.5rem, 10vw, 3rem) !important;
    }

    /* ── Quick-Select Dropdown (Mobile-Friendly) ── */
    .btn-quick-select {
        background: rgba(255,255,255,.13) !important;
        backdrop-filter: blur(12px);
        border: 1.5px solid rgba(255,255,255,.3) !important;
        color: #fff !important;
        padding: 0.6rem 1rem !important;
        border-radius: 0.5rem !important;
        font-weight: 700 !important;
        font-size: clamp(0.8rem, 2vw, 0.97rem) !important;
    }
    @media (min-width: 640px) {
        .btn-quick-select {
            padding: 0.9rem 2rem !important;
            border-radius: 0.75rem !important;
        }
    }
    .btn-quick-select:hover, .btn-quick-select:focus { background: rgba(255,255,255,.23) !important; }
    .dropdown-menu-hero {
        background: #1e293b !important;
        border: 1px solid #334155 !important;
        border-radius: 0.85rem !important;
        box-shadow: 0 24px 48px rgba(0,0,0,.4) !important;
        min-width: 200px;
        padding: 0.4rem;
    }
    @media (min-width: 640px) {
        .dropdown-menu-hero {
            min-width: 220px;
        }
    }
    .dropdown-menu-hero .dropdown-item {
        color: #cbd5e1;
        padding: clamp(0.5rem, 2vw, 0.65rem) clamp(0.75rem, 3vw, 1rem);
        font-size: clamp(0.8rem, 2vw, 0.92rem);
        border-radius: 0.55rem;
    }
    .dropdown-menu-hero .dropdown-item:hover { background: #334155; color: #fff; }
    .dropdown-menu-hero .dropdown-item.hl { color: #a5b4fc; font-weight: 700; }
    .dropdown-divider { border-color: #334155 !important; margin: 0.3rem 0.5rem; }

    /* ── Marquee (Scrollable on Mobile) ── */
    .marquee-wrap {
        overflow-x: auto;
        display: flex;
        gap: clamp(0.75rem, 2vw, 1.25rem);
        padding: clamp(0.75rem, 2vw, 1.1rem) clamp(1rem, 3vw, 1.5rem);
        background: #fff;
        border-bottom: 1.5px solid #e2e8f0;
        -webkit-overflow-scrolling: touch;
    }
    @media (min-width: 768px) {
        .marquee-wrap {
            overflow: hidden;
            gap: 1.25rem;
            padding: 1.1rem;
        }
    }
    .marquee-track {
        flex-shrink: 0;
        display: flex;
        gap: clamp(0.75rem, 2vw, 1.25rem);
        min-width: 100%;
    }
    @media (min-width: 768px) {
        .marquee-track {
            animation: mscroll 28s linear infinite;
        }
    }
    .marquee-wrap:hover .marquee-track { animation-play-state: paused; }
    @keyframes mscroll {
        from { transform: translateX(0); }
        to   { transform: translateX(calc(-100% - 1.25rem)); }
    }
    .mpill {
        display: flex;
        align-items: center;
        gap: clamp(0.4rem, 1vw, 0.55rem);
        background: #f1f5f9;
        border: 1.5px solid #e0e7ff;
        padding: clamp(0.4rem, 1.5vw, 0.55rem) clamp(0.9rem, 2.5vw, 1.3rem);
        border-radius: 999px;
        font-weight: 600;
        font-size: clamp(0.75rem, 2vw, 0.88rem);
        color: #4338ca;
        white-space: nowrap;
        text-decoration: none;
        transition: background .2s, border-color .2s, color .2s, transform .15s;
    }
    .mpill:hover, .mpill:active { background: #4f46e5; color: #fff; border-color: #4f46e5; transform: scale(1.06); }
</style>

{{-- ═══ BOOTSTRAP CAROUSEL HERO ═══ --}}
<div id="heroCarousel" class="carousel slide hero-carousel" data-bs-ride="carousel" data-bs-interval="4500">

    <div class="carousel-indicators">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-label="Sarees"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Kurtis"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Western Wear"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3" aria-label="Sale"></button>
    </div>

    <div class="carousel-inner">

        {{-- Slide 1 — Sarees --}}
        <div class="carousel-item active"
             style="background-image:url('https://images.unsplash.com/photo-1583391733956-3750e0ff4e8b?auto=format&fit=crop&w=1950&q=80')">
            <div class="carousel-caption">
                <div class="hero-badge">&#10024; Premium Collection</div>
                <h1 class="hero-title">Timeless <span style="color:#818cf8">Sarees</span></h1>
                <p class="hero-sub">Traditional textures meeting modern drapes. Handpicked for every occasion.</p>
                <div class="d-flex flex-column flex-sm-row justify-content-center align-items-center gap-3 flex-wrap">
                    <a href="/products?category=sarees" class="hero-btn hero-btn-primary">Shop Sarees &rarr;</a>
                    <div class="dropdown">
                        <button class="btn btn-quick-select dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Quick Select</button>
                        <ul class="dropdown-menu dropdown-menu-hero">
                            <li><a class="dropdown-item" href="/products?category=sarees">&#128084;&nbsp; Sarees</a></li>
                            <li><a class="dropdown-item" href="/products?category=kurtis">&#128087;&nbsp; Kurtis</a></li>
                            <li><a class="dropdown-item" href="/products?category=dresses">&#128721;&nbsp; Western Wear</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item hl" href="/products">&#128717;&nbsp; View All Products</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        {{-- Slide 2 — Kurtis --}}
        <div class="carousel-item"
             style="background-image:url('https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?auto=format&fit=crop&w=1950&q=80')">
            <div class="carousel-caption">
                <div class="hero-badge">&#128087; Everyday Elegance</div>
                <h1 class="hero-title">Designer <span style="color:#818cf8">Kurtis</span></h1>
                <p class="hero-sub">Comfort and style woven together for your everyday grace.</p>
                <div class="d-flex flex-column flex-sm-row justify-content-center align-items-center gap-3 flex-wrap">
                    <a href="/products?category=kurtis" class="hero-btn hero-btn-primary">Shop Kurtis &rarr;</a>
                    <div class="dropdown">
                        <button class="btn btn-quick-select dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Quick Select</button>
                        <ul class="dropdown-menu dropdown-menu-hero">
                            <li><a class="dropdown-item" href="/products?category=sarees">&#128084;&nbsp; Sarees</a></li>
                            <li><a class="dropdown-item" href="/products?category=kurtis">&#128087;&nbsp; Kurtis</a></li>
                            <li><a class="dropdown-item" href="/products?category=dresses">&#128721;&nbsp; Western Wear</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item hl" href="/products">&#128717;&nbsp; View All Products</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        {{-- Slide 3 — Western Wear --}}
        <div class="carousel-item"
             style="background-image:url('https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?auto=format&fit=crop&w=1950&q=80')">
            <div class="carousel-caption">
                <div class="hero-badge">Modern Silhouettes</div>
                <h1 class="hero-title">Western <span style="color:#818cf8">Wear</span></h1>
                <p class="hero-sub">Contemporary silhouettes designed for standout moments.</p>
                <div class="d-flex flex-column flex-sm-row justify-content-center align-items-center gap-3 flex-wrap">
                    <a href="/products?category=dresses" class="hero-btn hero-btn-primary">Shop Western &rarr;</a>
                    <div class="dropdown">
                        <button class="btn btn-quick-select dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Quick Select</button>
                        <ul class="dropdown-menu dropdown-menu-hero">
                            <li><a class="dropdown-item" href="/products?category=sarees">&#128084;&nbsp; Sarees</a></li>
                            <li><a class="dropdown-item" href="/products?category=kurtis">&#128087;&nbsp; Kurtis</a></li>
                            <li><a class="dropdown-item" href="/products?category=dresses">&#128721;&nbsp; Western Wear</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item hl" href="/products">&#128717;&nbsp; View All Products</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        {{-- Slide 4 — Sale --}}
        <div class="carousel-item"
             style="background-image:url('https://images.unsplash.com/photo-1441986300917-64674bd600d8?auto=format&fit=crop&w=1950&q=80')">
            <div class="carousel-caption">
                <div class="hero-badge">&#9889; Limited Time</div>
                <h1 class="hero-title">Up to <span style="color:#f59e0b">40% OFF</span></h1>
                <p class="hero-sub">Seasonal sale — exclusive discounts on our newest drops. Don't miss out!</p>
                <div class="d-flex flex-column flex-sm-row justify-content-center align-items-center gap-3 flex-wrap">
                    <a href="/products" class="hero-btn hero-btn-primary">Claim Discount &rarr;</a>
                    <div class="dropdown">
                        <button class="btn btn-quick-select dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Quick Select</button>
                        <ul class="dropdown-menu dropdown-menu-hero">
                            <li><a class="dropdown-item" href="/products?category=sarees">&#128084;&nbsp; Sarees</a></li>
                            <li><a class="dropdown-item" href="/products?category=kurtis">&#128087;&nbsp; Kurtis</a></li>
                            <li><a class="dropdown-item" href="/products?category=dresses">&#128721;&nbsp; Western Wear</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item hl" href="/products">&#128717;&nbsp; View All Products</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>

</div>

{{-- ═══ CLICKABLE INFINITE MARQUEE ═══ --}}
<div class="marquee-wrap">
    <div class="marquee-track">
        <a href="/products?category=sarees"  class="mpill">&#128084; Premium Sarees</a>
        <a href="/products?category=kurtis"  class="mpill">&#128087; Designer Kurtis</a>
        <a href="/products?category=dresses" class="mpill">&#128721; Western Wear</a>
        <a href="/products"                  class="mpill">&#10024; New Arrivals</a>
        <a href="/products"                  class="mpill">&#128717; Seasonal Sale</a>
        <a href="/products"                  class="mpill">&#11088; Exclusive Collection</a>
        <a href="/products"                  class="mpill">&#9889; Limited Offers</a>
    </div>
    <div class="marquee-track" aria-hidden="true">
        <a href="/products?category=sarees"  class="mpill">&#128084; Premium Sarees</a>
        <a href="/products?category=kurtis"  class="mpill">&#128087; Designer Kurtis</a>
        <a href="/products?category=dresses" class="mpill">&#128721; Western Wear</a>
        <a href="/products"                  class="mpill">&#10024; New Arrivals</a>
        <a href="/products"                  class="mpill">&#128717; Seasonal Sale</a>
        <a href="/products"                  class="mpill">&#11088; Exclusive Collection</a>
        <a href="/products"                  class="mpill">&#9889; Limited Offers</a>
    </div>
</div>

{{-- ═══ FEATURED CATEGORIES GRID ═══ --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-20 lg:py-24">
    <div class="text-center mb-8 sm:mb-12 lg:mb-16">
        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold mb-3 sm:mb-4 text-slate-900">Explore Categories</h2>
        <div class="w-16 sm:w-20 h-1 sm:h-1.5 bg-indigo-600 mx-auto rounded-full"></div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">

        <a href="/products?category=sarees" class="text-decoration-none">
            <div class="group relative bg-white shadow-sm border border-slate-100 rounded-2xl sm:rounded-3xl p-4 sm:p-6 lg:p-8 text-center hover:shadow-2xl transition duration-500 overflow-hidden">
                <div class="text-3xl sm:text-4xl lg:text-5xl mb-3 sm:mb-4">&#129403;</div>
                <h3 class="text-lg sm:text-xl lg:text-2xl font-bold mb-2 sm:mb-4 text-slate-900 group-hover:text-indigo-600 transition">Sarees</h3>
                <p class="text-xs sm:text-sm lg:text-base text-slate-500 mb-4 sm:mb-6 leading-relaxed">Traditional textures meet modern drapes. Perfect for every occasion.</p>
                <span class="inline-block border-2 border-indigo-600 text-indigo-600 px-4 sm:px-6 lg:px-8 py-1.5 sm:py-2 lg:py-2.5 rounded-lg sm:rounded-xl font-bold text-xs sm:text-sm lg:text-base group-hover:bg-indigo-600 group-hover:text-white transition duration-300">Browse</span>
            </div>
        </a>

        <a href="/products?category=kurtis" class="text-decoration-none">
            <div class="group relative bg-white shadow-sm border border-slate-100 rounded-2xl sm:rounded-3xl p-4 sm:p-6 lg:p-8 text-center hover:shadow-2xl transition duration-500 overflow-hidden">
                <div class="text-3xl sm:text-4xl lg:text-5xl mb-3 sm:mb-4">&#128087;</div>
                <h3 class="text-lg sm:text-xl lg:text-2xl font-bold mb-2 sm:mb-4 text-slate-900 group-hover:text-indigo-600 transition">Kurtis</h3>
                <p class="text-xs sm:text-sm lg:text-base text-slate-500 mb-4 sm:mb-6 leading-relaxed">Comfort and style woven together for your everyday grace.</p>
                <span class="inline-block border-2 border-indigo-600 text-indigo-600 px-4 sm:px-6 lg:px-8 py-1.5 sm:py-2 lg:py-2.5 rounded-lg sm:rounded-xl font-bold text-xs sm:text-sm lg:text-base group-hover:bg-indigo-600 group-hover:text-white transition duration-300">Browse</span>
            </div>
        </a>

        <a href="/products?category=dresses" class="text-decoration-none">
            <div class="group relative bg-white shadow-sm border border-slate-100 rounded-2xl sm:rounded-3xl p-4 sm:p-6 lg:p-8 text-center hover:shadow-2xl transition duration-500 overflow-hidden">
                <div class="text-3xl sm:text-4xl lg:text-5xl mb-3 sm:mb-4">&#128085;</div>
                <h3 class="text-lg sm:text-xl lg:text-2xl font-bold mb-2 sm:mb-4 text-slate-900 group-hover:text-indigo-600 transition">Western Wear</h3>
                <p class="text-xs sm:text-sm lg:text-base text-slate-500 mb-4 sm:mb-6 leading-relaxed">Contemporary western silhouettes designed for standout moments.</p>
                <span class="inline-block border-2 border-indigo-600 text-indigo-600 px-4 sm:px-6 lg:px-8 py-1.5 sm:py-2 lg:py-2.5 rounded-lg sm:rounded-xl font-bold text-xs sm:text-sm lg:text-base group-hover:bg-indigo-600 group-hover:text-white transition duration-300">Browse</span>
            </div>
        </a>

    </div>
</div>

{{-- ═══ PROMO BANNER ═══ --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12 sm:pb-20 lg:pb-24">
    <div class="bg-indigo-600 rounded-2xl sm:rounded-3xl lg:rounded-[3rem] p-6 sm:p-12 lg:p-20 text-center relative overflow-hidden shadow-2xl">
        <div class="absolute top-0 right-0 w-32 sm:w-48 lg:w-64 h-32 sm:h-48 lg:h-64 bg-white/10 rounded-full -mr-16 sm:-mr-24 lg:-mr-32 -mt-16 sm:-mt-24 lg:-mt-32 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-32 sm:w-48 lg:w-64 h-32 sm:h-48 lg:h-64 bg-indigo-400/20 rounded-full -ml-16 sm:-ml-24 lg:-ml-32 -mb-16 sm:-mb-24 lg:-mb-32 blur-3xl"></div>
        <h2 class="relative text-xl sm:text-3xl lg:text-5xl font-bold text-white mb-4 sm:mb-6 lg:mb-6">Seasonal Celebration &ndash; Up to 40% OFF</h2>
        <p class="relative text-sm sm:text-base lg:text-lg text-indigo-100 mb-6 sm:mb-10 max-w-2xl mx-auto leading-relaxed px-2">
            Limited time offer. Join prem.in today and get exclusive access to our newest drops.
        </p>
        <a href="/products" class="relative inline-block bg-white text-indigo-600 px-6 sm:px-10 lg:px-12 py-2.5 sm:py-3 lg:py-4 rounded-lg sm:rounded-xl lg:rounded-2xl font-bold text-sm sm:text-base lg:text-lg hover:bg-slate-100 transition shadow-xl active:scale-95 touch-action-manipulation">
            Claim Your Discount
        </a>
    </div>
</div>

@endsection
