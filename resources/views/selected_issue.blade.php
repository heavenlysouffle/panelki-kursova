<?php

session_start();
$cartClass = $_GET['cartClass'] ?? 'cart'

?>

    <!DOCTYPE html>
<html lang="ua">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Видання Panelki</title>
    <link rel="icon" type="image/png" href="{{ asset('/img/svg/favicon.png') }}">
    <script src="/js/main.js" defer></script>
    <link rel="stylesheet" href="/css/selected_issue.css">
</head>
<body>

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
                                                        <input type="hidden" value="selected_issues/{{$panel->name}}" name="pageName">
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
                                                        <input type="hidden" value="selected_issues/{{$panel->name}}" name="pageName">
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
                        <input type="hidden" value="selected_issues/{{$panel->name}}" name="pageName">
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
    <section class="selected-issue">
        <div class="selected-issue-content">
            <div class="issue-pic-background">
                <div class="issue-pic">
                    <img src="/img/selected_{{$panel->name}}.jpeg" alt="" class="issue-main-picture">
                    <div class="selected-issue-wrapper">
                        <div class="issue-details-text">
                            Тверда палітурка | 20 ілюстрацій
                            <br>44 сторінки | 164 висувні картонні панелі
                            <br>Розмір: 24 х 1,6 х 30 см
                        </div>
                        <div class="fixed-details">
                            <p class="fixed-price">{{$panel->price}}</p>
                            <a class="action-button-link">
                                <form action="{{ route('cart.add') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" value="{{ $panel->name }}" name="name">
                                    <input type="hidden" value="{{ $panel->price }}" name="price">
                                    <input type="hidden" value="selected_issues/{{$panel->name}}" name="pageName">
                                    <button class="purchase-issue-button">Придбати</button>
                                </form>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wrapper">
                <div class="selected-issue-details-mobile">
                    <div class="issue-details-text">
                        Тверда палітурка | 20 ілюстрацій
                        <br>44 сторінки | 164 висувні картонні панелі
                        <br>Розмір: 24 х 1,6 х 30 см
                    </div>
                    <div class="fixed-details">
                        <p class="fixed-price">{{$panel->price}}</p>
                        <a href="/" class="action-button-link">
                            <button class="purchase-issue-button">Придбати</button>
                        </a>
                    </div>
                </div>
                <h1 class="issue-title">Panelki</h1>
                <p class="issue-text">
                    Panelki дозволяє читачам зібрати панельний дім-блок й одночасно дізнатися про збірні будівельні системи та їх історію, які сьогодні ми називаємо “панельками”.

                    <br>Першу частину книги відкриває вступ до масового житла в колишньому Радянському Союзі та його мешканців, ілюстрований фотографіями та пропагандистськими плакатами.
                    Друга частина містить 164 картонні панелі для видавлювання та створення 3D-блоку висотою 27 см із простими інструкціями. На панелях представлені детальні ілюстрації,
                    що відтворюють фасади післявоєнних модерністських житлових будинків, у яких донині живуть мільйони міських жителів, демонструючи деякі елементи, додані орендарями
                    пізніше, зокрема супутникові антени чи графіті.
                </p>
                <img src="/img/selected-issue_1.jpg" alt="" class="issue-details-pic">
                <img src="/img/selected-issue_2.jpg" alt="" class="issue-details-pic">
                <img src="/img/selected-issue_3.jpg" alt="" class="issue-details-pic">
                <img src="/img/selected-issue_4.jpg" alt="" class="issue-details-pic">
                <img src="/img/selected-issue_5.jpg" alt="" class="issue-details-pic">
                <img src="/img/selected-issue_6.jpg" alt="" class="issue-details-pic">
                <img src="/img/selected-issue_7.jpg" alt="" class="issue-details-pic" style="margin-bottom: 0;">
            </div>
        </div>
    </section>
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
