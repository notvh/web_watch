<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PREDATORWATCH - Luxury Timepieces</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
 
</head>


    <header class="header">
        <div class="header-top">
            <div class="header-top-content">
                <span>✉ contact@predatorwatch.com</span>
                <span>⚡ MIỄN PHÍ VẬN CHUYỂN CHO ĐƠN HÀNG TRÊN 10 TRIỆU</span>
                <span>📞 1900 888 999</span>
            </div>
        </div>
        <div class="header-main">
            <div class="logo"><a href="/">PREDATORWATCH</a></div>

            <nav>
                <ul class="nav-menu" id="navMenu">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            SẢN PHẨM
                            <span class="dropdown-arrow">▼</span>
                        </a>
                        <div class="mega-menu">
                            <div class="mega-menu-grid">
                                <div class="mega-menu-column">
                                    <h4>Theo Thương Hiệu</h4>
                                    <a href="#" class="mega-menu-item">Rolex</a>
                                    <a href="#" class="mega-menu-item">Omega</a>
                                    <a href="#" class="mega-menu-item">Patek Philippe</a>
                                    <a href="#" class="mega-menu-item">Audemars Piguet</a>
                                </div>
                                <div class="mega-menu-column">
                                    <h4>Theo Phong Cách</h4>
                                    <a href="#" class="mega-menu-item">Đồng Hồ Lặn</a>
                                    <a href="#" class="mega-menu-item">Đồng Hồ Pilot</a>
                                    <a href="#" class="mega-menu-item">Dress Watch</a>
                                    <a href="#" class="mega-menu-item">Chronograph</a>
                                </div>
                                <div class="mega-menu-column">
                                    <h4>Bộ Sưu Tập Đặc Biệt</h4>
                                    <a href="#" class="mega-menu-item">Limited Edition</a>
                                    <a href="#" class="mega-menu-item">Vintage Collection</a>
                                    <a href="#" class="mega-menu-item">Anniversary Edition</a>
                                    <a href="#" class="mega-menu-item">Collaboration Series</a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            Nam
                            <span class="dropdown-arrow">▼</span>
                        </a>
                        <ul class="dropdown">
                            <li><a href="#" class="dropdown-item">
                                    Automatic
                                    <span class="item-price">từ 15tr</span>
                                </a></li>
                            <li><a href="#" class="dropdown-item">
                                    Chronograph
                                    <span class="item-price">từ 25tr</span>
                                </a></li>
                            <li><a href="#" class="dropdown-item">
                                    Tourbillon
                                    <span class="item-price">từ 100tr</span>
                                </a></li>
                            <li><a href="#" class="dropdown-item">
                                    Moon Phase
                                    <span class="item-price">từ 50tr</span>
                                </a></li>
                            <li><a href="#" class="dropdown-item">
                                    Skeleton
                                    <span class="item-price">từ 35tr</span>
                                </a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            Nữ
                            <span class="dropdown-arrow">▼</span>
                        </a>
                        <ul class="dropdown">
                            <li><a href="#" class="dropdown-item">
                                    Cocktail Watch
                                    <span class="item-price">từ 20tr</span>
                                </a></li>
                            <li><a href="#" class="dropdown-item">
                                    Diamond Collection
                                    <span class="item-price">từ 80tr</span>
                                </a></li>
                            <li><a href="#" class="dropdown-item">
                                    Ceramic Series
                                    <span class="item-price">từ 30tr</span>
                                </a></li>
                            <li><a href="#" class="dropdown-item">
                                    Mother of Pearl
                                    <span class="item-price">từ 45tr</span>
                                </a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            Limited Edition
                            <span class="dropdown-arrow">▼</span>
                        </a>
                        <ul class="dropdown">
                            <li><a href="#" class="dropdown-item">
                                    50th Anniversary
                                    <span class="item-price">Liên hệ</span>
                                </a></li>
                            <li><a href="#" class="dropdown-item">
                                    Collaboration Series
                                    <span class="item-price">từ 200tr</span>
                                </a></li>
                            <li><a href="#" class="dropdown-item">
                                    Heritage Collection
                                    <span class="item-price">từ 150tr</span>
                                </a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">Dịch Vụ
                            <span class="dropdown-arrow">▼</span>
                        </a>
                        <ul class="dropdown">
                            <li><a href="#" class="dropdown-item">
                                    Liên hệ
                                    <span class="item-price"></span>
                                </a></li>
                           
                        </ul>
                    </a>
                    </li>

                   
                </ul>
            </nav>

            <div class="header-actions">
                <div class="search-box" id="searchBox">
                    <input type="text" class="search-input" placeholder="Tìm kiếm...">
                    <button class="action-btn" onclick="toggleSearch()"><i class="fa-solid fa-cart-shopping"></i></button>
                </div>

                <button class="action-btn">

                    <i class="fa-solid fa-heart"></i>
                </button>
                <li class="nav-item" id="logout">
                    @guest

                    <a href="{{ route('login') }}" class="nav-link">Login</a>
                    @endguest
                    @auth

                    <a href="#" class="action-btn">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span class="dropdown-arrow">▼</span>

                    </a>
                    <ul class="dropdown">
                        @if(Auth::user()->role === 'admin')

                        <li><a href="{{ route('admin.dasboard') }}" class="dropdown-item">
                                Quản trị admin
                            @endif

                            </a></li>
                        <li><a href="#" class="dropdown-item">
                                Hồ sơ

                            </a></li>

                        <li style="color: red;"><a href="{{ route('dangxuat') }}" class="dropdown-item">
                                Đăng xuất

                            </a></li>
                    </ul>
                    @endauth
                </li>
                </button>
                <button class="mobile-toggle" onclick="toggleMenu()">☰</button>
            </div>
        </div>
    </header>