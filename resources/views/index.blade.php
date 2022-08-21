<?php

$message = $_COOKIE['message'] ?? null;
session_start();
$cartClass = $_GET['cartClass'] ?? 'cart'

?>

    <!DOCTYPE html>
<html lang="ua">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel`ki</title>
    <link rel="icon" type="image/png" href="{{ asset('/img/svg/favicon.png') }}">
    <script src="/js/main.js" defer></script>
    <script src="https://kit.fontawesome.com/b0f29e9bfe.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/index.css">
</head>
<body style="position: relative;">
<!-- Cart start -->
<div class={{ $cartClass}} id="cart">
    <button onclick="myFunction()" class="cart-btn"></button>
    <div class="cart_bg">
        <div class="cart-title"><h3 >Кошик</h3></div>
        <ul>
            @foreach($panels as $panelItem)
                @if(isset($_SESSION['order_array']) && $_SESSION['order_array'])
                    @foreach($_SESSION['order_array'] as $item)
                        @if($panelItem->name == $item['name'])
                            <li>
                                <div class="magazine">
                                    <div class="cover">
                                        <img class="cover-img" src="/img/issues_issue_{{ $item['name'] }}.jpg" alt="">
                                    </div>
                                    <div class="cart-counter-price">
                                        <div class="cart-counter">
                                            <ul>
                                                <li>
                                                    <form action="{{ route('cart.add') }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" value="{{ $panelItem->name }}" name="name">
                                                        <input type="hidden" value="{{ $panelItem->price }}" name="price">
                                                        <input type="hidden" value="index" name="pageName">
                                                        <button>+ </button>
                                                    </form>
                                                </li>
                                                <li>
                                                    &nbsp;&nbsp;{{ $item['quantity'] }}
                                                </li>
                                                <li>
                                                    <form action="{{ route('cart.remove') }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" value="{{ $panelItem->name }}" name="name">
                                                        <input type="hidden" value="{{ $panelItem->price }}" name="price">
                                                        <input type="hidden" value="index" name="pageName">
                                                        <button>-</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="price">— {{$panelItem->price}} ₴</div>
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </ul>
        @if(isset($_SESSION['cart_cost']))
            <div class="clear-cart-container">
                <a href="">
                    <form action="{{ route('cart.delete') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="index" name="pageName">
                        <button class="clear-cart">Очистити кошик</button>
                    </form>
                </a>
            </div>
        @else
            <div class="fill-cart">
                <p>Упс! Тут поки нічого :(</p>
                <a href="/issues"><button class="clear-cart">Заповнити кошик</button></a>
            </div>
        @endif
        <div class="proceed">
            <div class="proceed_wrapper">
                <div class="proceed-text-price">
                    <div class="proceed-text">Разом:</div>
                    @if (isset($_SESSION['cart_cost']))
                        <div class="final-price">— {{ $_SESSION['cart_cost'] }} ₴</div>
                    @else
                        <div class="final-price">— 0 ₴</div>
                    @endif
                </div>
                @if (isset($_SESSION['order_array']) && $_SESSION['order_array'])
                    <a href="/pay">
                        <button class="proceed-button">Продовжити</button>
                    </a>
                @else
                    <button class="proceed-button" style="cursor: not-allowed;">Продовжити</button>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Cart end -->

<!-- Header start -->
<header class="header">
    <div class="wrapper">
        <div class="header-wrapper">
            <div class="header-logo">
                <a href="/" class="header-logo-link">
                    <img src="/img/svg/header_logo.svg" alt="Панель за панеллю" class="header-logo-pic">
                </a>
            </div>

            <nav class="header-nav-bar">
                <ul class="header-list">
                    <li class="header-item">
                        <a href="/issues" class="header-link">Видання</a>
                    </li>
                    <li class="header-item">
                        <a href="/events" class="header-link">Події</a>
                    </li>
                    <li class="header-item">
                        <a href="/about" class="header-link">Про нас</a>
                    </li>
                    <li class="header-language-change">
                        <a href="#!" class="header-language-link">EN</a>
                    </li>
                </ul>
                <div class="header-nav-close">
                    <span class="header-nav-close-line"></span>
                    <span class="header-nav-close-line"></span>
                </div>
            </nav>
            <div class="header-burger burger">
                <span class="burger-line burger-line_1"></span>
                <span class="burger-line burger-line_2"></span>
                <span class="burger-line burger-line_3"></span>
            </div>
        </div>
    </div>
</header>
<!-- Header end -->

<main class="main">
    <!-- Attention block start -->
    <section class="attention">
        <div class="error-message-container">
            <div>
                @if($message)
                    <div class="error-message">{{$message}}</div>
                    <?php unset($_COOKIE['message']); setcookie('message', null, -1, '/'); ?>
                @endif
            </div>
        </div>
        <div class="attention-wrapper">
            <div class="attention-text-box">
                <h1 class="attention-heading">Про близьке, трохи журливе та з дитинства.</h1>
                <img src="/img/svg/attention_text-box_logo.svg" class="attention-text_box-logo" alt="">
                <p class="attention-text">— креативний проєкт, присвячений модерністській та постмодерністській архітектурі.</p>
            </div>
        </div>
        <div id="attention-slider">
            <input type="radio" name="attention-slider" id="slide-1" checked>
            <input type="radio" name="attention-slider" id="slide-2">
            <input type="radio" name="attention-slider" id="slide-3">
            <input type="radio" name="attention-slider" id="slide-4">
            <div id="slides">
                <div id="overflow">
                    <div class="inner">
                        <div class="slide slide-1">
                            <div class="slide-content"></div>
                        </div>
                        <div class="slide slide-2">
                            <div class="slide-content"></div>
                        </div>
                        <div class="slide slide-3">
                            <div class="slide-content"></div>
                        </div>
                        <div class="slide slide-4">
                            <div class="slide-content"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="controls">
                <label for="slide-1"></label>
                <label for="slide-2"></label>
                <label for="slide-3"></label>
                <label for="slide-4"></label>
            </div>
            <div id="bullets">
                <label for="slide-1"></label>
                <label for="slide-2"></label>
                <label for="slide-3"></label>
                <label for="slide-4"></label>
            </div>
        </div>
    </section>
    <!-- Attention block end -->

    <!-- Interesting block start -->
    <section class="interesting">
        <div class="interesting-wrapper">
            <div class="interesting-content">
                <div class="interesting-block-house"></div>
                <div class="interesting-text-box">
                    <p>“Зате тепер зовсім інша річ. Людина потрапляє до незнайомого міста, але почувається у ньому, як удома.” — "Іронія долі, або З легкою парою!", 1976 р.</p>
                    <p>Архітектура модернізму та постмодернізму зовсім не одноманітна, як вважають деякі: у “черговій” панельці обов'язково приховується душа, яка із радістю відкриється небайдужому у плитці, плануванні та акцентах. Наш проєкт існує саме для того, щоб розповісти про це людям у зручній для кожного формі.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Interesting block end -->

    <!-- Desire block start -->
    <section class="desire">
        <div class="wrapper">
            <div class="desire-content">
                <h1 class="desire-heading">Панель за панеллю,</h1>
                <p class="desire-text">
                    сторінка за сторінкою, прогуляйтеся знайомо незнайомими вулицями разом із випусками нашого журналу від столиць до забутих людьми куточків.
                </p>
                <div class="book_wrapper">
                    <button id="previous-button"></button>
                    <div id="book" class="book">
                        <div id="p1" class="paper">
                            <div class="back">
                                <div id="b1" class="back-content">
                                    <img src="/img/desire_page_1.jpg" alt="">
                                </div>
                            </div>
                        </div>
                        <div id="p2" class="paper">
                            <div class="front">
                                <div id="f2" class="front-content">
                                    <img src="/img/desire_page_2.jpg" alt="">
                                </div>
                            </div>
                            <div class="back">
                                <div id="b2" class="back-content">
                                    <img src="/img/desire_page_3.jpg" alt="">
                                </div>
                            </div>
                        </div>
                        <div id="p3" class="paper">
                            <div class="front">
                                <div id="f3" class="front-content">
                                    <img src="/img/desire_page_4.jpg" alt="">
                                </div>
                            </div>
                            <div class="back">
                                <div id="b3" class="back-content">
                                    <img src="/img/desire_page_5.jpg" alt="">
                                </div>
                            </div>
                        </div>
                        <div id="p4" class="paper">
                            <div class="front">
                                <div id="f4" class="front-content">
                                    <img src="/img/desire_page_6.jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button id="next-button"></button>
                </div>
                <div class="mobile-book">
                    <img src="/img/desire_page_1-mobile.jpg" alt="">
                    <img src="/img/desire_page_2.jpg" alt="">
                </div>
            </div>
        </div>
    </section>
    <!-- Desire block end -->

    <!-- Action block start -->
    <section class="action">
        <div class="wrapper">
            <div class="paper_sheet">
                <div class="action-text-box">
                    <p class="action-text">
                        Скоріше приєднуйся до нашої спільноти захисників культурної архітектурної спадщини, онуче!
                    </p>
                    <a href="/issues" class="action-button-link"><button id="action-button">
                            <p class="action-button-text">ГО!</p>
                        </button></a>
                </div>
                <img src="/img/action_paper-picture.png" alt="">
            </div>
        </div>
    </section>
    <!-- Action block end -->
</main>

<!-- Footer start -->
<footer class="footer">
    <div class="wrapper">
        <div class="footer-item">
            <nav class="footer-nav">
                <ul class="footer-menu">
                    <h3 class="footer-menu-title">Links</h3>
                    <li class="footer-menu-item">
                        <a href="#!" class="footer-menu-link">Privacy Policy</a>
                    </li>
                    <li class="footer-menu-item">
                        <a href="#!" class="footer-menu-link">Copyright & Terms</a>
                    </li>
                </ul>
                <ul class="footer-menu">
                    <h3 class="footer-menu-title">Contact us :)</h3>
                    <li class="footer-menu-item">+380678474089</li>
                    <li class="footer-menu-item">polina.bykova.pb@gmail.com</li>
                </ul>
            </nav>
            <div class="footer-break"></div>
            <div class="copyright">
                <img src="/img/svg/footer_logo.svg" alt="" class="footer-logo-pic">
                © 2022 Panel`ki. All rights reserved.
            </div>
            <div class="social-media">
                <a href="#!" class="footer-social-media-link">
                    <img src="/img/svg/telegram-logo.svg" alt="Наш Телеграм" class="social-media-logo">
                </a>
                <a href="#!" class="footer-social-media-link">
                    <img src="/img/svg/instagram-logo.svg" alt="Наш Інстаграм" class="social-media-logo">
                </a>
                <a href="#!" class="footer-social-media-link">
                    <img src="/img/svg/twitter-logo.svg" alt="Наш Твіттер" class="social-media-logo">
                </a>
            </div>
        </div>
    </div>
</footer>
<!-- Footer end -->
</body>
</html>
