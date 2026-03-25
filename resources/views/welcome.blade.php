@extends('layouts.app')

@section('content')

<style>
    /* ── Carousel Hero ── */
    .hero-carousel .carousel-item {
        height: 92vh;
        min-height: 520px;
        background-size: cover;
        background-position: center;
    }
    .hero-carousel .carousel-item::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(15,23,42,.88) 0%, rgba(15,23,42,.45) 55%, transparent 100%);
    }
    .hero-carousel .carousel-caption {
        z-index: 10;
        bottom: 9%;
        left: 10%; right: 10%;
        text-align: center;
    }
    .hero-badge {
        display: inline-block;
        border: 1px solid rgba(99,102,241,.55);
        background: rgba(99,102,241,.2);
        color: #a5b4fc;
        font-size: .72rem;
        font-weight: 700;
        letter-spacing: .14em;
        text-transform: uppercase;
        padding: .3rem 1rem;
        border-radius: 999px;
        margin-bottom: 1.1rem;
        backdrop-filter: blur(8px);
    }
    .hero-title {
        font-size: clamp(2.4rem, 6vw, 5rem);
        font-weight: 900;
        letter-spacing: -.025em;
        line-height: 1.1;
        color: #fff;
        margin-bottom: .9rem;
    }
    .hero-sub {
        font-size: 1.1rem;
        color: #cbd5e1;
        max-width: 40rem;
        margin: 0 auto 2rem;
        line-height: 1.75;
    }
    .hero-btn {
        display: inline-block;
        padding: .9rem 2.25rem;
        border-radius: .75rem;
        font-weight: 700;
        font-size: .97rem;
        text-decoration: none;
        transition: background .2s, transform .1s;
    }
    .hero-btn-primary {
        background: #4f46e5;
        color: #fff !important;
        box-shadow: 0 10px 30px rgba(79,70,229,.4);
    }
    .hero-btn-primary:hover { background: #4338ca; transform: translateY(-2px); }
    .carousel-indicators [data-bs-target] {
        width: 36px; height: 4px; border-radius: 2px;
        background: rgba(255,255,255,.4); border: none;
    }
    .carousel-indicators .active { background: #818cf8; width: 52px; }

    /* ── Quick-Select Dropdown ── */
    .btn-quick-select {
        background: rgba(255,255,255,.13) !important;
        backdrop-filter: blur(12px);
        border: 1.5px solid rgba(255,255,255,.3) !important;
        color: #fff !important;
        padding: .9rem 2rem !important;
        border-radius: .75rem !important;
        font-weight: 700 !important;
        font-size: .97rem !important;
    }
    .btn-quick-select:hover, .btn-quick-select:focus { background: rgba(255,255,255,.23) !important; }
    .dropdown-menu-hero {
        background: #1e293b !important;
        border: 1px solid #334155 !important;
        border-radius: .85rem !important;
        box-shadow: 0 24px 48px rgba(0,0,0,.4) !important;
        min-width: 220px;
        padding: .4rem;
    }
    .dropdown-menu-hero .dropdown-item {
        color: #cbd5e1; padding: .65rem 1rem;
        font-size: .92rem; border-radius: .55rem;
    }
    .dropdown-menu-hero .dropdown-item:hover { background: #334155; color: #fff; }
    .dropdown-menu-hero .dropdown-item.hl { color: #a5b4fc; font-weight: 700; }
    .dropdown-divider { border-color: #334155 !important; margin: .3rem .5rem; }

    /* ── Marquee ── */
    .marquee-wrap {
        overflow: hidden;
        display: flex;
        gap: 1.25rem;
        padding: 1.1rem 0;
        background: #fff;
        border-bottom: 1.5px solid #e2e8f0;
    }
    .marquee-track {
        flex-shrink: 0;
        display: flex;
        gap: 1.25rem;
        min-width: 100%;
        animation: mscroll 28s linear infinite;
    }
    .marquee-wrap:hover .marquee-track { animation-play-state: paused; }
    @keyframes mscroll {
        from { transform: translateX(0); }
        to   { transform: translateX(calc(-100% - 1.25rem)); }
    }
    .mpill {
        display: flex; align-items: center; gap: .55rem;
        background: #f1f5f9; border: 1.5px solid #e0e7ff;
        padding: .55rem 1.3rem; border-radius: 999px;
        font-weight: 600; font-size: .88rem; color: #4338ca;
        white-space: nowrap; text-decoration: none;
        transition: background .2s, border-color .2s, color .2s, transform .15s;
    }
    .mpill:hover { background: #4f46e5; color: #fff; border-color: #4f46e5; transform: scale(1.06); }
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
<div class="max-w-7xl mx-auto px-6 py-24">
    <div class="text-center mb-16">
        <h2 class="text-4xl font-bold mb-4 text-slate-900">Explore Categories</h2>
        <div class="w-20 h-1.5 bg-indigo-600 mx-auto rounded-full"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

        <a href="/products?category=sarees" class="text-decoration-none">
            <div class="group relative bg-white shadow-sm border border-slate-100 rounded-3xl p-8 text-center hover:shadow-2xl transition duration-500 overflow-hidden">
                <div class="text-5xl mb-4">&#129403;</div>
                <h3 class="text-2xl font-bold mb-4 text-slate-900 group-hover:text-indigo-600 transition">Sarees</h3>
                <p class="text-slate-500 mb-6 leading-relaxed">Traditional textures meet modern drapes. Perfect for every occasion.</p>
                <span class="inline-block border-2 border-indigo-600 text-indigo-600 px-8 py-2.5 rounded-xl font-bold group-hover:bg-indigo-600 group-hover:text-white transition duration-300">Browse</span>
            </div>
        </a>

        <a href="/products?category=kurtis" class="text-decoration-none">
            <div class="group relative bg-white shadow-sm border border-slate-100 rounded-3xl p-8 text-center hover:shadow-2xl transition duration-500 overflow-hidden">
                <div class="text-5xl mb-4">&#128087;</div>
                <h3 class="text-2xl font-bold mb-4 text-slate-900 group-hover:text-indigo-600 transition">Kurtis</h3>
                <p class="text-slate-500 mb-6 leading-relaxed">Comfort and style woven together for your everyday grace.</p>
                <span class="inline-block border-2 border-indigo-600 text-indigo-600 px-8 py-2.5 rounded-xl font-bold group-hover:bg-indigo-600 group-hover:text-white transition duration-300">Browse</span>
            </div>
        </a>

        <a href="/products?category=dresses" class="text-decoration-none">
            <div class="group relative bg-white shadow-sm border border-slate-100 rounded-3xl p-8 text-center hover:shadow-2xl transition duration-500 overflow-hidden">
                <div class="text-5xl mb-4">&#128085;</div>
                <h3 class="text-2xl font-bold mb-4 text-slate-900 group-hover:text-indigo-600 transition">Western Wear</h3>
                <p class="text-slate-500 mb-6 leading-relaxed">Contemporary western silhouettes designed for standout moments.</p>
                <span class="inline-block border-2 border-indigo-600 text-indigo-600 px-8 py-2.5 rounded-xl font-bold group-hover:bg-indigo-600 group-hover:text-white transition duration-300">Browse</span>
            </div>
        </a>

    </div>
</div>

{{-- ═══ PROMO BANNER ═══ --}}
<div class="max-w-7xl mx-auto px-6 pb-24">
    <div class="bg-indigo-600 rounded-[3rem] p-12 md:p-20 text-center relative overflow-hidden shadow-2xl">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-indigo-400/20 rounded-full -ml-32 -mb-32 blur-3xl"></div>
        <h2 class="relative text-3xl md:text-5xl font-bold text-white mb-6">Seasonal Celebration &ndash; Up to 40% OFF</h2>
        <p class="relative text-indigo-100 text-lg mb-10 max-w-xl mx-auto">
            Limited time offer. Join bhovi.in today and get exclusive access to our newest drops.
        </p>
        <a href="/products" class="relative inline-block bg-white text-indigo-600 px-12 py-4 rounded-2xl font-bold hover:bg-slate-100 transition shadow-xl active:scale-95">
            Claim Your Discount
        </a>
    </div>
</div>

@endsection
