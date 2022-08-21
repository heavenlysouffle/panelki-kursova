<?php

if (!$errors) {
    session_start();
}
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
                                                        <input type="hidden" value="pay" name="pageName">
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
                                                        <input type="hidden" value="pay" name="pageName">
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
                        <input type="hidden" value="pay" name="pageName">
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
    <section class="events">
        <div class="row row-1"></div>
        <div class="row row-2"></div>
        <div class="form_content">
            <div class="form_pay">
                <form action="{{ route('pay.order') }}" method="POST" option="#credit" style="display: flex; justify-content: center; flex-wrap: wrap">
                    @csrf
                    <h2>Сплатити замовлення на суму {{ $_SESSION['cart_cost'] }}₴:</h2>
                    <div class="form_box">
                        <div class="form-element">
                            <input type="text" name="first_name" placeholder="Ім'я..." />
                        </div>
                        <div class="form-element">
                            <input type="text" name="second_name" placeholder="Фамілія..." />
                        </div>
                        <div class="form-element" style="width: 100%">
                            <input type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}" name="phone" placeholder="096-777-77-77" />
                            <span class="validity"></span>
                        </div>
                        <div class="form-element" style="width: 100%; padding-left: 25px;">
                            <img src="/img/card_icon.png" alt="">
                            <input type="number" name="card" placeholder="7777 7777 7777 7777" />
                            <span class="validity"></span>
                        </div>
                        <div class="form-element" style="padding-left: 25px;">
                            <img src="/img/date_icon.png" alt="">
                            <input type="text" pattern="[0-9]{2}/[2-3]{1}[0-9]{1}" name="date" placeholder="06 / 24" />
                            <span class="validity"></span>
                        </div>
                        <div class="form-element" style="padding-left: 25px;">
                            <img src="/img/cvc_icon.png" alt="">
                            <input type="password" pattern="[0-9]{3}" name="cvc" placeholder="CVC" />
                            <span class="validity"></span>
                        </div>
                    </div>
                    <div class="checkbox-requirements">
                        <input class="checkbox_btn" type="checkbox">
                        <h6>Я погоджуюсь з умовами політики конфіденційності і дозволяю обробляти мої персональні дані.</h6>
                    </div>
                    <button class="confirm-button" type="submit">Підтвердити</button>
                    <div class="breakpoint" style="width: 100%; height: 0;"></div>
                    <a href="/issues" class="return-link"><span>Повернутись</span></a>
                </form>
            </div>
        </div>
        <div class="error-message-container">
            <div>
                @if($errors)
                    @foreach($errors as $error)
                        <div class="error-message">
                            (!) {{ $error }}
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="row row-3"></div>
        <div class="row row-4"></div>
    </section>
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
<!-- Footer end -->
</body>
</html>
