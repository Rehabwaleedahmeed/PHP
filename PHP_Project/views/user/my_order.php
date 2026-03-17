
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Premium Cafeteria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="/css/modern.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--bg-light);
            color: var(--text-dark);
        }

        /* Custom styles for menu page */
        .category-badge {
            display: inline-block;
            padding: 0.5rem 1rem;
            background: var(--bg-light);
            border: 2px solid var(--primary-color);
            border-radius: 50px;
            color: var(--primary-dark);
            font-weight: 600;
            font-size: 0.9rem;
            margin-right: 0.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .category-badge:hover,
        .category-badge.active {
            background: var(--primary-color);
            color: var(--primary-dark);
        }

        .menu-header {
            margin-bottom: 3rem;
        }
            font-size: 1.8rem;
            font-weight: 700;
            background: linear-gradient(135deg, #F0E7D5 0%, #212842 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .navbar-modern .nav-link {
            color: var(--text-secondary) !important;
            font-weight: 500;
            transition: color 0.3s ease;
            margin: 0 0.5rem;
        }

        .navbar-modern .nav-link:hover {
            color: #F0E7D5 !important;
        }

        .theme-toggle {
            background: transparent;
            border: none;
            color: var(--text-secondary);
            font-size: 1.2rem;
            cursor: pointer;
            margin: 0 1rem;
            transition: color 0.3s ease;
        }

        .theme-toggle:hover {
            color: #F0E7D5;
        }

        /* ============ PAGE HEADER ============ */
        .page-header {
            background: linear-gradient(135deg, var(--bg-light) 0%, var(--bg-dark) 100%);
            padding: 3rem 0;
            margin-bottom: 2rem;
            border-bottom: 1px solid var(--border-color);
        }

        .page-header h1 {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--text-primary) 0%, #F0E7D5 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ============ FILTERS SIDEBAR ============ */
        .filters-sidebar {
            background: var(--bg-light);
            border: 1px solid var(--border-color);
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            position: sticky;
            top: 100px;
        }

        .filter-group {
            margin-bottom: 2rem;
        }

        .filter-group:last-child {
            margin-bottom: 0;
        }

        .filter-title {
            font-weight: 700;
            margin-bottom: 1rem;
            color: #F0E7D5;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .filter-option {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.75rem;
        }

        .filter-option input[type="checkbox"],
        .filter-option input[type="radio"] {
            cursor: pointer;
            accent-color: #F0E7D5;
        }

        .filter-option label {
            cursor: pointer;
            margin-bottom: 0;
            flex: 1;
        }

        .price-range {
            margin: 1rem 0;
        }

        .price-input {
            background: rgba(255, 255, 255, 0.08) !important;
            border: 1px solid var(--border-color) !important;
            color: var(--text-primary) !important;
            border-radius: 8px !important;
            padding: 0.5rem !important;
        }

        .reset-filters {
            width: 100%;
            padding: 10px;
            background: transparent;
            color: #F0E7D5;
            border: 2px solid #F0E7D5;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 700;
            transition: all 0.3s ease;
        }

        .reset-filters:hover {
            background: rgba(240, 231, 213, 0.1);
        }

        /* ============ PRODUCTS DISPLAY ============ */
        .products-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .products-count {
            color: var(--text-secondary);
        }

        .sort-control {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .sort-control select {
            background: var(--bg-light);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            border-radius: 8px;
            padding: 0.5rem 1rem;
            cursor: pointer;
        }

        .product-card {
            background: var(--bg-light);
            border: 1px solid var(--border-color);
            border-radius: 15px;
            padding: 1.5rem;
            transition: all 0.3s ease;
            cursor: pointer;
            height: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: hidden;
        }

        .product-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(240, 231, 213, 0.05);
            transition: left 0.3s ease;
            z-index: 0;
        }

        .product-card:hover::before {
            left: 0;
        }

        .product-card:hover {
            border-color: #F0E7D5;
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(240, 231, 213, 0.15);
        }

        .product-content {
            position: relative;
            z-index: 1;
        }

        .product-img {
            width: 100%;
            height: 180px;
            background: linear-gradient(135deg, var(--bg-dark), var(--bg-light));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 60px;
            margin-bottom: 1rem;
        }

        .product-name {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--text-primary);
        }

        .product-category {
            font-size: 0.85rem;
            color: var(--text-secondary);
            margin-bottom: 1rem;
        }

        .product-price {
            font-size: 1.4rem;
            color: #F0E7D5;
            font-weight: 800;
            margin-bottom: 1rem;
        }

        .product-actions {
            display: flex;
            gap: 0.5rem;
            margin-top: auto;
        }

        .btn-add {
            flex: 1;
            padding: 10px;
            background: linear-gradient(135deg, #F0E7D5 0%, #212842 100%);
            color: #1a1a1a;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-add:hover {
            transform: scale(1.05);
        }

        .btn-favorite {
            padding: 10px 15px;
            background: transparent;
            color: var(--text-secondary);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-favorite:hover, .btn-favorite.liked {
            color: #F0E7D5;
            border-color: #F0E7D5;
        }

        /* ============ SKELETON LOADERS ============ */
        .skeleton {
            background: linear-gradient(90deg, var(--bg-light) 0%, rgba(255,255,255,0.1) 50%, var(--bg-light) 100%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 10px;
        }

        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        /* ============ PAGINATION ============ */
        .pagination-control {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin: 3rem 0;
            flex-wrap: wrap;
        }

        .pagination-control button {
            padding: 10px 15px;
            background: var(--bg-light);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .pagination-control button:hover,
        .pagination-control button.active {
            background: #F0E7D5;
            color: #1a1a1a;
            border-color: #F0E7D5;
        }

        /* ============ EMPTY STATE ============ */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: var(--text-secondary);
        }

        .empty-state i {
            font-size: 80px;
            opacity: 0.5;
            margin-bottom: 1rem;
        }

        /* ============ TOAST NOTIFICATIONS ============ */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 2000;
        }

        .toast-message {
            background: var(--bg-light);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 1rem 1.5rem;
            margin-bottom: 0.5rem;
            animation: slideIn 0.3s ease;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        @keyframes slideIn {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .toast-success {
            color: #28a745;
            border-color: #28a745;
        }

        /* ============ FOOTER ============ */
        .footer-modern {
            background: var(--bg-light);
            border-top: 1px solid var(--border-color);
            padding: 3rem 0;
            text-align: center;
            color: var(--text-secondary);
            margin-top: 4rem;
        }

        /* ============ RESPONSIVE ============ */
        @media (max-width: 768px) {
            .page-header h1 {
                font-size: 1.8rem;
            }

            .products-header {
                flex-direction: column;
            }

            .filters-sidebar {
                position: static;
            }

            .sort-control {
                width: 100%;
            }

            .sort-control select {
                flex: 1;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation Component -->
    <?php include(__DIR__ . '/../components/navbar.php'); ?>

    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <h1>☕ Our Menu</h1>
            <p style="color: var(--text-secondary); margin-top: 0.5rem;">Browse our premium selection of coffee and beverages</p>
        </div>
    </div>

    <div class="container mb-5">
        <div class="row">
            <!-- Sidebar Filters -->
            <div class="col-lg-3">
                <div class="filters-sidebar">
                    <div class="filter-group">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span class="filter-title">🔍 Filters</span>
                            <button class="reset-filters" onclick="resetFilters()" style="width: auto; padding: 5px 10px; font-size: 0.85rem;">Reset</button>
                        </div>
                    </div>

                    <!-- Search -->
                    <div class="filter-group">
                        <div class="filter-title">
                            <i class="fas fa-search"></i> Search
                        </div>
                        <input type="text" id="searchInput" class="form-control" placeholder="Search products..." onkeyup="applyFilters()">
                    </div>

                    <!-- Category Filter -->
                    <div class="filter-group">
                        <div class="filter-title">
                            <i class="fas fa-list"></i> Category
                        </div>
                        <div class="filter-option">
                            <input type="checkbox" id="cat-all" checked onchange="applyFilters()">
                            <label for="cat-all">All Categories</label>
                        </div>
                        <div class="filter-option">
                            <input type="checkbox" id="cat-1" onchange="applyFilters()">
                            <label for="cat-1">☕ Coffee</label>
                        </div>
                        <div class="filter-option">
                            <input type="checkbox" id="cat-2" onchange="applyFilters()">
                            <label for="cat-2">🍵 Tea</label>
                        </div>
                        <div class="filter-option">
                            <input type="checkbox" id="cat-3" onchange="applyFilters()">
                            <label for="cat-3">🥐 Snacks</label>
                        </div>
                    </div>

                    <!-- Price Filter -->
                    <div class="filter-group">
                        <div class="filter-title">
                            <i class="fas fa-dollar-sign"></i> Price Range
                        </div>
                        <div class="price-range">
                            <label style="color: var(--text-secondary); font-size: 0.9rem;">Min: <span id="minPriceLabel">0</span> EGP</label>
                            <input type="range" id="minPrice" class="form-range" min="0" max="500" value="0" onchange="applyFilters()">
                        </div>
                        <div class="price-range">
                            <label style="color: var(--text-secondary); font-size: 0.9rem;">Max: <span id="maxPriceLabel">500</span> EGP</label>
                            <input type="range" id="maxPrice" class="form-range" min="0" max="500" value="500" onchange="applyFilters()">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Display -->
            <div class="col-lg-9">
                <!-- Products Header -->
                <div class="products-header">
                    <div class="products-count">
                        Showing <span id="productCount">0</span> products
                    </div>
                    <div class="sort-control">
                        <label style="margin-right: 0.5rem;">Sort by:</label>
                        <select onchange="applySort(this.value)">
                            <option value="newest">Newest</option>
                            <option value="price-asc">Price: Low to High</option>
                            <option value="price-desc">Price: High to Low</option>
                            <option value="name">Name: A to Z</option>
                        </select>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="row g-4" id="productsGrid">
                    <!-- Skeleton loaders -->
                    <div class="col-md-6 col-lg-4">
                        <div class="product-card skeleton" style="height: 320px;"></div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="product-card skeleton" style="height: 320px;"></div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="product-card skeleton" style="height: 320px;"></div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="product-card skeleton" style="height: 320px;"></div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="product-card skeleton" style="height: 320px;"></div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="product-card skeleton" style="height: 320px;"></div>
                    </div>
                </div>

                <!-- Empty State -->
                <div class="empty-state" id="emptyState" style="display: none;">
                    <i class="fas fa-search"></i>
                    <h3>No products found</h3>
                    <p>Try adjusting your filters or search query</p>
                </div>

                <!-- Pagination -->
                <div class="pagination-control" id="pagination"></div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer-modern">
        <div class="container">
            <p class="mb-0">&copy; 2024 Premium Cafeteria. All rights reserved.</p>
        </div>
    </footer>

    <!-- Toast Container -->
    <div class="toast-container" id="toastContainer"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let allProducts = [];
        let filteredProducts = [];
        let currentSort = 'newest';
        const itemsPerPage = 12;
        let currentPage = 1;

        // ============ THEME TOGGLE ============
        function toggleTheme() {
            const html = document.documentElement;
            const currentTheme = html.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            
            html.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            
            const icon = document.querySelector('.theme-toggle i');
            icon.className = newTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
        }

        document.addEventListener('DOMContentLoaded', function() {
            const savedTheme = localStorage.getItem('theme') || 'dark';
            document.documentElement.setAttribute('data-theme', savedTheme);
            const icon = document.querySelector('.theme-toggle i');
            icon.className = savedTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
            
            loadProducts();
        });

        // ============ TOAST NOTIFICATIONS ============
        function showToast(message, type = 'success') {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = `toast-message toast-${type}`;
            toast.innerHTML = `
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
                <span>${message}</span>
            `;
            container.appendChild(toast);
            
            setTimeout(() => {
                toast.style.animation = 'slideOut 0.3s ease';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // ============ LOAD PRODUCTS ============
        async function loadProducts() {
            try {
                const response = await fetch('/api/products?limit=100');
                const data = await response.json();
                
                if (data.success) {
                    allProducts = data.data;
                    applyFilters();
                }
            } catch (error) {
                console.error('Error loading products:', error);
                showToast('Error loading products', 'error');
            }
        }

        // ============ FILTER PRODUCTS ============
        function applyFilters() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const minPrice = parseFloat(document.getElementById('minPrice').value);
            const maxPrice = parseFloat(document.getElementById('maxPrice').value);
            
            const selectedCategories = [];
            if (!document.getElementById('cat-all').checked) {
                [1, 2, 3].forEach(id => {
                    if (document.getElementById(`cat-${id}`).checked) {
                        selectedCategories.push(id);
                    }
                });
            }

            document.getElementById('minPriceLabel').textContent = minPrice;
            document.getElementById('maxPriceLabel').textContent = maxPrice;

            filteredProducts = allProducts.filter(product => {
                const matchesSearch = product.name.toLowerCase().includes(searchTerm);
                const matchesPrice = product.price >= minPrice && product.price <= maxPrice;
                const matchesCategory = selectedCategories.length === 0 || selectedCategories.includes(product.category_id);
                
                return matchesSearch && matchesPrice && matchesCategory;
            });

            currentPage = 1;
            applySorting();
            displayProducts();
        }

        // ============ SORT PRODUCTS ============
        function applySort(sortType) {
            currentSort = sortType;
            applySorting();
            displayProducts();
        }

        function applySorting() {
            switch(currentSort) {
                case 'price-asc':
                    filteredProducts.sort((a, b) => a.price - b.price);
                    break;
                case 'price-desc':
                    filteredProducts.sort((a, b) => b.price - a.price);
                    break;
                case 'name':
                    filteredProducts.sort((a, b) => a.name.localeCompare(b.name));
                    break;
                case 'newest':
                default:
                    filteredProducts.sort((a, b) => b.id - a.id);
            }
        }

        // ============ DISPLAY PRODUCTS ============
        function displayProducts() {
            const grid = document.getElementById('productsGrid');
            const emptyState = document.getElementById('emptyState');
            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const productsToShow = filteredProducts.slice(startIndex, endIndex);

            grid.innerHTML = '';

            if (filteredProducts.length === 0) {
                emptyState.style.display = 'block';
                document.getElementById('pagination').innerHTML = '';
                document.getElementById('productCount').textContent = '0';
                return;
            }

            emptyState.style.display = 'none';
            document.getElementById('productCount').textContent = filteredProducts.length;

            productsToShow.forEach(product => {
                const isFavorited = isFavorite(product.id);
                const col = document.createElement('div');
                col.className = 'col-md-6 col-lg-4';
                col.innerHTML = `
                    <div class="product-card" onclick="goToProduct(${product.id})">
                        <div class="product-content">
                            <div class="product-img">☕</div>
                            <div class="product-name">${product.name}</div>
                            <div class="product-category">Coffee</div>
                            <div class="product-price">EGP ${parseFloat(product.price).toFixed(2)}</div>
                            <div class="product-actions" onclick="event.stopPropagation()">
                                <button class="btn-add" onclick="addToCart(${product.id}, '${product.name}', ${product.price})">
                                    <i class="fas fa-shopping-cart"></i> Add
                                </button>
                                <button class="btn-favorite ${isFavorited ? 'liked' : ''}" onclick="toggleFavorite(${product.id})">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                `;
                grid.appendChild(col);
            });

            displayPagination();
        }

        // ============ PAGINATION ============
        function displayPagination() {
            const pagination = document.getElementById('pagination');
            const totalPages = Math.ceil(filteredProducts.length / itemsPerPage);
            pagination.innerHTML = '';

            if (totalPages <= 1) return;

            // Previous button
            if (currentPage > 1) {
                const prevBtn = document.createElement('button');
                prevBtn.innerHTML = '<i class="fas fa-chevron-left"></i> Previous';
                prevBtn.onclick = () => { currentPage--; displayProducts(); };
                pagination.appendChild(prevBtn);
            }

            // Page buttons
            for (let i = 1; i <= totalPages; i++) {
                const btn = document.createElement('button');
                btn.textContent = i;
                btn.className = i === currentPage ? 'active' : '';
                btn.onclick = () => { currentPage = i; displayProducts(); };
                pagination.appendChild(btn);
            }

            // Next button
            if (currentPage < totalPages) {
                const nextBtn = document.createElement('button');
                nextBtn.innerHTML = 'Next <i class="fas fa-chevron-right"></i>';
                nextBtn.onclick = () => { currentPage++; displayProducts(); };
                pagination.appendChild(nextBtn);
            }
        }

        // ============ PRODUCT INTERACTION ============
        function goToProduct(productId) {
            window.location.href = `/product/${productId}`;
        }

        function addToCart(productId, productName, price) {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            const existingItem = cart.find(item => item.id === productId);
            
            if (existingItem) {
                existingItem.quantity++;
            } else {
                cart.push({ id: productId, name: productName, price: price, quantity: 1 });
            }
            
            localStorage.setItem('cart', JSON.stringify(cart));
            showToast(`${productName} added to cart! 🛒`);
        }

        function toggleFavorite(productId) {
            let favorites = JSON.parse(localStorage.getItem('favorites')) || [];
            const index = favorites.indexOf(productId);
            const btn = event.target.closest('.btn-favorite');
            
            if (index > -1) {
                favorites.splice(index, 1);
                btn.classList.remove('liked');
                showToast('Removed from favorites ❌');
            } else {
                favorites.push(productId);
                btn.classList.add('liked');
                showToast('Added to favorites ❤️');
            }
            
            localStorage.setItem('favorites', JSON.stringify(favorites));
        }

        function isFavorite(productId) {
            const favorites = JSON.parse(localStorage.getItem('favorites')) || [];
            return favorites.includes(productId);
        }

        function resetFilters() {
            document.getElementById('searchInput').value = '';
            document.getElementById('minPrice').value = '0';
            document.getElementById('maxPrice').value = '500';
            document.getElementById('cat-all').checked = true;
            [1, 2, 3].forEach(id => {
                document.getElementById(`cat-${id}`).checked = false;
            });
            applyFilters();
        }
    </script>
</body>
</html>
