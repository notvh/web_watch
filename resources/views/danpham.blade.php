<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chrono Lux | Đồng hồ sang trọng</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        dark: '#0a0a0a',
                        charcoal: '#1a1a1a',
                        platinum: '#e5e5e5',
                        gold: '#d4af37'
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        serif: ['Playfair Display', 'serif']
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap');
        
        body {
            background-color: #0a0a0a;
            color: #e5e5e5;
            overflow-x: hidden;
        }
        
        .watch-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: linear-gradient(145deg, #1a1a1a, #0f0f0f);
        }
        
        .watch-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(212, 175, 55, 0.15);
        }
        
        .watch-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #d4af37, #a78a3a, #d4af37);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .watch-card:hover::before {
            opacity: 1;
        }
        
        .brand-filter li {
            transition: color 0.3s ease;
            position: relative;
        }
        
        .brand-filter li::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 1px;
            background: #d4af37;
            transition: width 0.3s ease;
        }
        
        .brand-filter li:hover {
            color: #d4af37;
        }
        
        .brand-filter li:hover::after {
            width: 100%;
        }
        
        .price-slider {
            -webkit-appearance: none;
            width: 100%;
            height: 4px;
            border-radius: 5px;
            background: #333;
            outline: none;
        }
        
        .price-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: #d4af37;
            cursor: pointer;
            transition: transform 0.2s ease;
        }
        
        .price-slider::-webkit-slider-thumb:hover {
            transform: scale(1.2);
        }
        
        .search-box {
            transition: all 0.3s ease;
            border: 1px solid #333;
        }
        
        .search-box:focus-within {
            border-color: #d4af37;
            box-shadow: 0 0 0 2px rgba(212, 175, 55, 0.2);
        }
        
        .watch-image {
            transition: transform 0.8s cubic-bezier(0.2, 0.8, 0.2, 1);
        }
        
        .watch-card:hover .watch-image {
            transform: rotate(-5deg);
        }
        
        @media (max-width: 768px) {
            .mobile-menu {
                background: rgba(10, 10, 10, 0.95);
                backdrop-filter: blur(10px);
            }
            
            .filter-sidebar {
                transform: translateX(-100%);
                transition: transform 0.4s cubic-bezier(0.2, 0.8, 0.2, 1);
            }
            
            .filter-sidebar.active {
                transform: translateX(0);
            }
        }
        
        .modal-overlay {
            background: rgba(0, 0, 0, 0.85);
        }
        
        .modal-content {
            background: linear-gradient(145deg, #1a1a1a, #0f0f0f);
            border: 1px solid rgba(212, 175, 55, 0.3);
            box-shadow: 0 25px 50px -12px rgba(212, 175, 55, 0.25);
        }
        
        .pulse-gold {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(212, 175, 55, 0.4); }
            70% { box-shadow: 0 0 0 10px rgba(212, 175, 55, 0); }
            100% { box-shadow: 0 0 0 0 rgba(212, 175, 55, 0); }
        }
        
        .text-gold-gradient {
            background: linear-gradient(to right, #d4af37, #f9f095);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
        }
    </style>
</head>
<body class="font-sans">
    <!-- Header -->
    <header class="border-b border-gray-800 sticky top-0 z-50 bg-dark">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center">
                <a href="#" class="text-2xl font-bold tracking-wider">
                    <span class="text-gold-gradient">CHRONO</span><span class="text-platinum">LUX</span>
                </a>
            </div>
            
            <nav class="hidden md:flex space-x-8">
                <a href="#" class="hover:text-gold transition">Bộ sưu tập</a>
                <a href="#" class="hover:text-gold transition">Thương hiệu</a>
                <a href="#" class="hover:text-gold transition">Giới thiệu</a>
                <a href="#" class="hover:text-gold transition">Liên hệ</a>
            </nav>
            
            <div class="flex items-center space-x-5">
                <div class="relative">
                    <div class="search-box flex items-center bg-charcoal rounded-full px-4 py-2">
                        <i class="fas fa-search text-gray-500"></i>
                        <input type="text" placeholder="Tìm kiếm..." class="bg-transparent border-none focus:outline-none ml-2 text-platinum w-32 md:w-44">
                    </div>
                </div>
                <button class="md:hidden text-xl">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8 flex">
        <!-- Filter Sidebar -->
        <aside class="filter-sidebar hidden md:block w-1/4 lg:w-1/5 pr-6">
            <div class="bg-charcoal rounded-xl p-6 mb-6">
                <h3 class="text-xl font-semibold mb-4 border-b border-gray-800 pb-3 flex items-center">
                    <i class="fas fa-filter mr-2 text-gold"></i> Bộ lọc
                </h3>
                
                <div class="mb-6">
                    <h4 class="font-medium mb-3 text-gold">Thương hiệu</h4>
                    <ul class="brand-filter space-y-2">
                        <li class="cursor-pointer">Rolex</li>
                        <li class="cursor-pointer">Patek Philippe</li>
                        <li class="cursor-pointer">Audemars Piguet</li>
                        <li class="cursor-pointer">Omega</li>
                        <li class="cursor-pointer">Cartier</li>
                        <li class="cursor-pointer">IWC</li>
                        <li class="cursor-pointer">Jaeger-LeCoultre</li>
                        <li class="cursor-pointer">Vacheron Constantin</li>
                    </ul>
                </div>
                
                <div class="mb-6">
                    <h4 class="font-medium mb-3 text-gold">Khoảng giá</h4>
                    <input type="range" min="0" max="100000" value="50000" class="price-slider mb-3">
                    <div class="flex justify-between text-sm text-gray-500">
                        <span>50 triệu</span>
                        <span>500 triệu</span>
                        <span>5 tỷ</span>
                    </div>
                </div>
                
                <div class="mb-6">
                    <h4 class="font-medium mb-3 text-gold">Loại</h4>
                    <div class="space-y-2">
                        <div class="flex items-center">
                            <input type="checkbox" id="automatic" class="form-checkbox h-4 w-4 text-gold border-gray-600 rounded bg-charcoal">
                            <label for="automatic" class="ml-2">Tự động</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="quartz" class="form-checkbox h-4 w-4 text-gold border-gray-600 rounded bg-charcoal">
                            <label for="quartz" class="ml-2">Quartz</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="chronograph" class="form-checkbox h-4 w-4 text-gold border-gray-600 rounded bg-charcoal">
                            <label for="chronograph" class="ml-2">Chronograph</label>
                        </div>
                    </div>
                </div>
                
                <button class="w-full bg-gradient-to-r from-gold to-yellow-700 text-dark py-2.5 rounded-lg font-medium mt-4 hover:opacity-90 transition">
                    Áp dụng bộ lọc
                </button>
            </div>
            
            <div class="bg-charcoal rounded-xl p-6">
                <h3 class="text-xl font-semibold mb-4 border-b border-gray-800 pb-3 flex items-center">
                    <i class="fas fa-crown mr-2 text-gold"></i> Bộ sưu tập
                </h3>
                <ul class="space-y-3">
                    <li class="cursor-pointer flex items-center">
                        <span class="bg-gray-700 rounded-full w-3 h-3 mr-2"></span>
                        Dòng cổ điển
                    </li>
                    <li class="cursor-pointer flex items-center">
                        <span class="bg-gray-700 rounded-full w-3 h-3 mr-2"></span>
                        Dòng thể thao
                    </li>
                    <li class="cursor-pointer flex items-center">
                        <span class="bg-gray-700 rounded-full w-3 h-3 mr-2"></span>
                        Dòng phi công
                    </li>
                    <li class="cursor-pointer flex items-center text-gold">
                        <span class="bg-gold rounded-full w-3 h-3 mr-2"></span>
                        Giới hạn đặc biệt
                    </li>
                </ul>
            </div>
        </aside>
        
        <!-- Mobile Filter Button -->
        <div class="fixed bottom-5 right-5 z-30 md:hidden">
            <button class="p-3 bg-gold text-dark rounded-full pulse-gold">
                <i class="fas fa-filter"></i>
            </button>
        </div>
        
        <!-- Product Grid -->
        <section class="w-full md:w-3/4 lg:w-4/5">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-serif font-bold">Bộ sưu tập đồng hồ</h1>
                <div class="hidden md:block">
                    <select class="bg-charcoal border border-gray-800 text-platinum px-4 py-2 rounded-lg focus:outline-none focus:ring-1 focus:ring-gold">
                        <option>Sắp xếp theo: Mới nhất</option>
                        <option>Sắp xếp theo: Giá thấp đến cao</option>
                        <option>Sắp xếp theo: Giá cao đến thấp</option>
                    </select>
                </div>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <!-- Product Card 1 -->
                <div class="watch-card rounded-xl overflow-hidden relative">
                    <div class="p-4">
                        <div class="h-64 flex items-center justify-center">
                            <img src="https://images.unsplash.com/photo-1522312346375-d1a52e2b99b3?auto=format&fit=crop&w=500&q=80" alt="Luxury Watch" class="watch-image max-h-52">
                        </div>
                        <div class="mt-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-semibold">Rolex Submariner</h3>
                                    <p class="text-sm text-gray-500 mt-1">Automatic</p>
                                </div>
                                <span class="text-gold font-bold">950.000.000₫</span>
                            </div>
                            <button class="w-full mt-4 bg-charcoal border border-gray-700 text-sm py-2.5 rounded-lg hover:border-gold hover:text-gold transition">
                                Xem chi tiết
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Product Card 2 -->
                <div class="watch-card rounded-xl overflow-hidden relative">
                    <div class="p-4">
                        <div class="h-64 flex items-center justify-center">
                            <img src="https://images.unsplash.com/photo-1539874754764-e5ef0b4e0f0e?auto=format&fit=crop&w=500&q=80" alt="Luxury Watch" class="watch-image max-h-52">
                        </div>
                        <div class="mt-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-semibold">Patek Philippe Nautilus</h3>
                                    <p class="text-sm text-gray-500 mt-1">Automatic</p>
                                </div>
                                <span class="text-gold font-bold">1.250.000.000₫</span>
                            </div>
                            <button class="w-full mt-4 bg-charcoal border border-gray-700 text-sm py-2.5 rounded-lg hover:border-gold hover:text-gold transition">
                                Xem chi tiết
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Product Card 3 -->
                <div class="watch-card rounded-xl overflow-hidden relative">
                    <div class="p-4">
                        <div class="h-64 flex items-center justify-center">
                            <img src="https://images.unsplash.com/photo-1542496658-e33a6d0d50a6?auto=format&fit=crop&w=500&q=80" alt="Luxury Watch" class="watch-image max-h-52">
                        </div>
                        <div class="mt-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-semibold">Audemars Piguet Royal Oak</h3>
                                    <p class="text-sm text-gray-500 mt-1">Automatic</p>
                                </div>
                                <span class="text-gold font-bold">1.850.000.000₫</span>
                            </div>
                            <button class="w-full mt-4 bg-charcoal border border-gray-700 text-sm py-2.5 rounded-lg hover:border-gold hover:text-gold transition">
                                Xem chi tiết
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Product Card 4 -->
                <div class="watch-card rounded-xl overflow-hidden relative">
                    <div class="p-4">
                        <div class="h-64 flex items-center justify-center">
                            <img src="https://images.unsplash.com/photo-1619785292559-a15caa28e1f0?auto=format&fit=crop&w=500&q=80" alt="Luxury Watch" class="watch-image max-h-52">
                        </div>
                        <div class="mt-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-semibold">Cartier Santos</h3>
                                    <p class="text-sm text-gray-500 mt-1">Quartz</p>
                                </div>
                                <span class="text-gold font-bold">450.000.000₫</span>
                            </div>
                            <button class="w-full mt-4 bg-charcoal border border-gray-700 text-sm py-2.5 rounded-lg hover:border-gold hover:text-gold transition">
                                Xem chi tiết
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Product Card 5 -->
                <div class="watch-card rounded-xl overflow-hidden relative">
                    <div class="p-4">
                        <div class="h-64 flex items-center justify-center">
                            <img src="https://images.unsplash.com/photo-1617196034796-73df70d8b2cf?auto=format&fit=crop&w=500&q=80" alt="Luxury Watch" class="watch-image max-h-52">
                        </div>
                        <div class="mt-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-semibold">Omega Seamaster</h3>
                                    <p class="text-sm text-gray-500 mt-1">Automatic</p>
                                </div>
                                <span class="text-gold font-bold">380.000.000₫</span>
                            </div>
                            <button class="w-full mt-4 bg-charcoal border border-gray-700 text-sm py-2.5 rounded-lg hover:border-gold hover:text-gold transition">
                                Xem chi tiết
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Product Card 6 -->
                <div class="watch-card rounded-xl overflow-hidden relative">
                    <div class="p-4">
                        <div class="h-64 flex items-center justify-center">
                            <img src="https://images.unsplash.com/photo-1616499370260-485b7ea8d5d6?auto=format&fit=crop&w=500&q=80" alt="Luxury Watch" class="watch-image max-h-52">
                        </div>
                        <div class="mt-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-semibold">Vacheron Constantin</h3>
                                    <p class="text-sm text-gray-500 mt-1">Manual</p>
                                </div>
                                <span class="text-gold font-bold">2.150.000.000₫</span>
                            </div>
                            <button class="w-full mt-4 bg-charcoal border border-gray-700 text-sm py-2.5 rounded-lg hover:border-gold hover:text-gold transition">
                                Xem chi tiết
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Product Card 7 -->
                <div class="watch-card rounded-xl overflow-hidden relative">
                    <div class="p-4">
                        <div class="h-64 flex items-center justify-center">
                            <img src="https://images.unsplash.com/photo-1617043786390-3d8e1e4e4d7c?auto=format&fit=crop&w=500&q=80" alt="Luxury Watch" class="watch-image max-h-52">
                        </div>
                        <div class="mt-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-semibold">IWC Portugieser</h3>
                                    <p class="text-sm text-gray-500 mt-1">Automatic</p>
                                </div>
                                <span class="text-gold font-bold">680.000.000₫</span>
                            </div>
                            <button class="w-full mt-4 bg-charcoal border border-gray-700 text-sm py-2.5 rounded-lg hover:border-gold hover:text-gold transition">
                                Xem chi tiết
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Product Card 8 -->
                <div class="watch-card rounded-xl overflow-hidden relative">
                    <div class="p-4">
                        <div class="h-64 flex items-center justify-center">
                            <img src="https://images.unsplash.com/photo-1585123334904-845d60e97b29?auto=format&fit=crop&w=500&q=80" alt="Luxury Watch" class="watch-image max-h-52">
                        </div>
                        <div class="mt-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-semibold">Jaeger-LeCoultre Reverso</h3>
                                    <p class="text-sm text-gray-500 mt-1">Manual</p>
                                </div>
                                <span class="text-gold font-bold">750.000.000₫</span>
                            </div>
                            <button class="w-full mt-4 bg-charcoal border border-gray-700 text-sm py-2.5 rounded-lg hover:border-gold hover:text-gold transition">
                                Xem chi tiết
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Pagination -->
            <div class="flex justify-center mt-12">
                <nav class="flex items-center">
                    <button class="h-10 w-10 flex items-center justify-center rounded-full bg-charcoal mr-2">
                        <i class="fas fa-chevron-left text-gray-500"></i>
                    </button>
                    <button class="h-10 w-10 flex items-center justify-center rounded-full bg-charcoal mx-1 text-gold">1</button>
                    <button class="h-10 w-10 flex items-center justify-center rounded-full bg-charcoal mx-1">2</button>
                    <button class="h-10 w-10 flex items-center justify-center rounded-full bg-charcoal mx-1">3</button>
                    <button class="h-10 w-10 flex items-center justify-center rounded-full bg-charcoal mx-1">...</button>
                    <button class="h-10 w-10 flex items-center justify-center rounded-full bg-charcoal mx-1">8</button>
                    <button class="h-10 w-10 flex items-center justify-center rounded-full bg-charcoal ml-2">
                        <i class="fas fa-chevron-right text-gray-500"></i>
                    </button>
                </nav>
            </div>
        </section>
    </main>
    
    <!-- Mobile Filter Sidebar -->
    <div class="filter-sidebar fixed inset-y-0 left-0 w-80 bg-dark z-40 p-6 overflow-y-auto md:hidden">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-semibold">Bộ lọc</h3>
            <button class="text-xl">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="mb-6">
            <h4 class="font-medium mb-3 text-gold">Thương hiệu</h4>
            <ul class="space-y-2">
                <li class="cursor-pointer py-1.5">Rolex</li>
                <li class="cursor-pointer py-1.5">Patek Philippe</li>
                <li class="cursor-pointer py-1.5">Audemars Piguet</li>
                <li class="cursor-pointer py-1.5">Omega</li>
                <li class="cursor-pointer py-1.5">Cartier</li>
                <li class="cursor-pointer py-1.5">IWC</li>
                <li class="cursor-pointer py-1.5">Jaeger-LeCoultre</li>
                <li class="cursor-pointer py-1.5">Vacheron Constantin</li>
            </ul>
        </div>
        
        <div class="mb-6">
            <h4 class="font-medium mb-3 text-gold">Khoảng giá</h4>
            <input type="range" min="0" max="100000" value="50000" class="price-slider mb-3">
            <div class="flex justify-between text-sm text-gray-500">
                <span>50 triệu</span>
                <span>500 triệu</span>
                <span>5 tỷ</span>
            </div>
        </div>
        
        <div class="mb-8">
            <h4 class="font-medium mb-3 text-gold">Loại</h4>
            <div class="space-y-2">
                <div class="flex items-center">
                    <input type="checkbox" id="m-automatic" class="form-checkbox h-4 w-4 text-gold border-gray-600 rounded bg-charcoal">
                    <label for="m-automatic" class="ml-2">Tự động</label>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" id="m-quartz" class="form-checkbox h-4 w-4 text-gold border-gray-600 rounded bg-charcoal">
                    <label for="m-quartz" class="ml-2">Quartz</label>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" id="m-chronograph" class="form-checkbox h-4 w-4 text-gold border-gray-600 rounded bg-charcoal">
                    <label for="m-chronograph" class="ml-2">Chronograph</label>
                </div>
            </div>
        </div>
        
        <button class="w-full bg-gradient-to-r from-gold to-yellow-700 text-dark py-3 rounded-lg font-medium">
            Áp dụng bộ lọc
        </button>
    </div>
    
    <!-- Footer -->
    <footer class="border-t border-gray-800 mt-16 py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h4 class="text-lg font-semibold mb-4 text-gold-gradient">CHRONO LUX</h4>
                    <p class="text-gray-500">Chuyên cung cấp các dòng đồng hồ cao cấp với chất lượng và thiết kế đẳng cấp hàng đầu.</p>
                </div>
                
                <div>
                    <h4 class="text-lg font-medium mb-4">Liên kết</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-500 hover:text-gold transition">Giới thiệu</a></li>
                        <li><a href="#" class="text-gray-500 hover:text-gold transition">Sản phẩm</a></li>
                        <li><a href="#" class="text-gray-500 hover:text-gold transition">Chính sách bảo hành</a></li>
                        <li><a href="#" class="text-gray-500 hover:text-gold transition">Liên hệ</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-medium mb-4">Hỗ trợ</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-500 hover:text-gold transition">Hỏi đáp</a></li>
                        <li><a href="#" class="text-gray-500 hover:text-gold transition">Chính sách đổi trả</a></li>
                        <li><a href="#" class="text-gray-500 hover:text-gold transition">Hướng dẫn mua hàng</a></li>
                        <li><a href="#" class="text-gray-500 hover:text-gold transition">Bảo mật thông tin</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-medium mb-4">Liên hệ</h4>
                    <ul class="space-y-2">
                        <li class="flex items-center text-gray-500">
                            <i class="fas fa-map-marker-alt mr-3 text-gold"></i>
                            <span>217 Nguyễn Thị Minh Khai, Quận 1, TP.HCM</span>
                        </li>
                        <li class="flex items-center text-gray-500">
                            <i class="fas fa-phone mr-3 text-gold"></i>
                            <span>+84 28 3827 1000</span>
                        </li>
                        <li class="flex items-center text-gray-500">
                            <i class="fas fa-envelope mr-3 text-gold"></i>
                            <span>contact@chronolux.vn</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-600">
                <p>&copy; 2023 Chrono Lux. Tất cả quyền được bảo lưu.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile filter toggle
        const filterButton = document.querySelector('.pulse-gold');
        const mobileFilter = document.querySelector('.filter-sidebar');
        const closeFilter = document.querySelector('.filter-sidebar .fa-times');
        
        filterButton.addEventListener('click', () => {
            mobileFilter.classList.add('active');
        });
        
        closeFilter.addEventListener('click', () => {
            mobileFilter.classList.remove('active');
        });
        
        // Brand filter hover effect
        const brandItems = document.querySelectorAll('.brand-filter li');
        brandItems.forEach(item => {
            item.addEventListener('mouseenter', function() {
                this.style.color = '#d4af37';
            });
            
            item.addEventListener('mouseleave', function() {
                this.style.color = '';
            });
        });
        
        // Watch card animation
        const watchCards = document.querySelectorAll('.watch-card');
        watchCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
                this.style.boxShadow = '0 10px 25px rgba(212, 175, 55, 0.15)';
                this.querySelector('.watch-image').style.transform = 'rotate(-5deg)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = '';
                this.style.boxShadow = '';
                this.querySelector('.watch-image').style.transform = '';
            });
        });
    </script>
</body>
</html>