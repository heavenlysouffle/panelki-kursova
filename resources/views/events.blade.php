<?php

session_start();
$cartClass = $_GET['cartClass'] ?? 'cart'

?>

    <!DOCTYPE html>
<html lang="ua">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Події</title>
    <link rel="icon" type="image/png" href="{{ asset('/img/svg/favicon.png') }}">
    <script src="/js/main.js" defer></script>
    <link rel="stylesheet" href="/css/events.css">
</head>
<body style="position: relative">

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
                                                        <input type="hidden" value="events" name="pageName">
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
                                                        <input type="hidden" value="events" name="pageName">
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
                        <input type="hidden" value="events" name="pageName">
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

<main>
    @if(!$events->isEmpty())
        <div class="section-events-wrapper">
            <section class="events large">
                <div class="row row-1">
                    <div class="events-wrapper">
                        <div class="column" style="margin-right: 2px;"></div>
                        <div class="column">
                            <div class="window">
                                <h1 class="events-city">
                                    {{$events[0]->city}}
                                    <br><?php echo str_replace('2022-', '', $events[0]->date)?>
                                </h1>
                            </div>
                        </div>
                        <div class="column"></div>
                        <div class="column"></div>
                        <div class="column" style="width: 300px;"></div>
                    </div>
                </div>
                <div class="row row-2">
                    <div class="events-wrapper">
                        <div class="column"></div>
                        <div class="column"></div>
                        <div class="column"></div>
                        <div class="column"></div>
                        <div class="column">
                            <div class="window">
                                <h1 class="events-city">
                                    {{$events[1]->city}}
                                    <br><?php echo str_replace('2022-', '', $events[1]->date)?>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-3">
                    <div class="events-wrapper">
                        <div class="column">
                            <div class="window">
                                <h1 class="events-city">
                                    {{$events[2]->city}}
                                    <br><?php echo str_replace('2022-', '', $events[2]->date)?>
                                </h1>
                            </div>
                        </div>
                        <div class="column"></div>
                        <div class="column">
                            <div class="window">
                                <h1 class="events-city">
                                    {{$events[3]->city}}
                                    <br><?php echo str_replace('2022-', '', $events[3]->date)?>
                                </h1>
                            </div>
                        </div>
                        <div class="column"></div>
                        <div class="column" style="width: 299px;"></div>
                    </div>
                </div>
                <div class="row row-4"></div>
            </section>
            <section class="events middle">
                <div class="row row-1">
                    <div class="events-wrapper">
                        <div class="column" style="margin-right: 2px;"></div>
                        <div class="column">
                            <div class="window">
                                <h1 class="events-city">
                                    {{$events[0]->city}}
                                    <br><?php echo str_replace('2022-', '', $events[0]->date)?>
                                </h1>
                            </div>
                        </div>
                        <div class="column"></div>
                        <div class="column"></div>
                        <div class="column" style="width: 300px;"></div>
                    </div>
                </div>
                <div class="row row-2">
                    <div class="events-wrapper">
                        <div class="column"></div>
                        <div class="column"></div>
                        <div class="column"></div>
                        <div class="column">
                            <div class="window">
                                <h1 class="events-city">
                                    {{$events[1]->city}}
                                    <br><?php echo str_replace('2022-', '', $events[1]->date)?>
                                </h1>
                            </div>
                        </div>
                        <div class="column"></div>
                    </div>
                </div>
                <div class="row row-3">
                    <div class="events-wrapper">
                        <div class="column" style="margin-left: 3px;">
                            <div class="window">
                                <h1 class="events-city">
                                    {{$events[2]->city}}
                                    <br><?php echo str_replace('2022-', '', $events[2]->date)?>
                                </h1>
                            </div>
                        </div>
                        <div class="column"></div>
                        <div class="column">
                            <div class="window">
                                <h1 class="events-city">
                                    {{$events[3]->city}}
                                    <br><?php echo str_replace('2022-', '', $events[3]->date)?>
                                </h1>
                            </div>
                        </div>
                        <div class="column"></div>
                        <div class="column" style="width: 299px;"></div>
                    </div>
                </div>
                <div class="row row-4"></div>
            </section>
            <section class="events middle-2">
                <div class="row row-1">
                    <div class="events-wrapper">
                        <div class="column" style="margin-right: 2px;"></div>
                        <div class="column">
                            <div class="window">
                                <h1 class="events-city">
                                    {{$events[0]->city}}
                                    <br><?php echo str_replace('2022-', '', $events[0]->date)?>
                                </h1>
                            </div>
                        </div>
                        <div class="column"></div>
                        <div class="column"></div>
                        <div class="column" style="width: 300px;"></div>
                    </div>
                </div>
                <div class="row row-2">
                    <div class="events-wrapper">
                        <div class="column">
                            <div class="window">
                                <h1 class="events-city">
                                    {{$events[1]->city}}
                                    <br><?php echo str_replace('2022-', '', $events[1]->date)?>
                                </h1>
                            </div>
                        </div>
                        <div class="column"></div>
                        <div class="column"></div>
                        <div class="column"></div>
                        <div class="column"></div>
                    </div>
                </div>
                <div class="row row-3">
                    <div class="events-wrapper">
                        <div class="column">
                            <div class="window">
                                <h1 class="events-city">
                                    {{$events[3]->city}}
                                    <br><?php echo str_replace('2022-', '', $events[3]->date)?>
                                </h1>
                            </div>
                        </div>
                        <div class="column" style="margin-left: 3px;">
                            <div class="window">
                                <h1 class="events-city">
                                    {{$events[2]->city}}
                                    <br><?php echo str_replace('2022-', '', $events[2]->date)?>
                                </h1>
                            </div>
                        </div>
                        <div class="column"></div>
                        <div class="column"></div>
                        <div class="column" style="width: 299px;"></div>
                    </div>
                </div>
                <div class="row row-4"></div>
            </section>
            <section class="events small">
                <div class="row row-1">
                    <div class="events-wrapper">
                        <div class="column">
                            <div class="window">
                                <h1 class="events-city">
                                    {{$events[0]->city}}
                                    <br><?php echo str_replace('2022-', '', $events[0]->date)?>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-2">
                    <div class="events-wrapper">
                        <div class="column">
                            <div class="window">
                                <h1 class="events-city">
                                    {{$events[1]->city}}
                                    <br><?php echo str_replace('2022-', '', $events[1]->date)?>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-3">
                    <div class="events-wrapper">
                        <div class="column">
                            <div class="window">
                                <h1 class="events-city">
                                    {{$events[3]->city}}
                                    <br><?php echo str_replace('2022-', '', $events[3]->date)?>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-4">
                    <div class="column">
                        <div class="window">
                            <h1 class="events-city">
                                {{$events[2]->city}}
                                <br><?php echo str_replace('2022-', '', $events[2]->date)?>
                            </h1>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    @endif
</main>

<!-- Footer start -->
<footer class="footer" style="position: absolute; bottom: 0;">
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

<footer class="footer small">
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
