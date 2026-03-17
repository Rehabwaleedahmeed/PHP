<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details - Premium Cafeteria Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="/css/modern.css" rel="stylesheet">
</head>
<body>
    <?php include 'views/components/navbar.php'; ?>

    <!-- Product Detail Container -->
    <div class="container mt-5 mb-5">
        <div id="productDetail" class="row">
            <div class="col-12 text-center py-5">
                <div class="spinner-border text-primary"></div>
                <p class="mt-3">Loading product details...</p>
            </div>
        </div>
    </div>

    <!-- Related Products Section -->
    <section class="py-5" style="background: var(--bg-light);">
        <div class="container">
            <h2 class="mb-4">Related Products</h2>
            <div id="relatedProducts" class="row">
                <!-- Related products will be loaded here -->
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer-modern">
        <div class="container py-4">
            <p>&copy; 2026 Premium Cafeteria Manager. All rights reserved.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/app.js"></script>

    <script>
        const productId = window.location.pathname.split('/').pop();

        document.addEventListener('DOMContentLoaded', async function() {
            await loadProductDetails();
        });

        async function loadProductDetails() {
            const container = document.getElementById('productDetail');

            try {
                const response = await Utils.apiRequest(`/api/products/${productId}`);

                if (response.success) {
                    const product = response.data.data;
                    displayProductDetails(product);
                    await loadRelatedProducts(product.category_id);
                } else {
                    container.innerHTML = `
                        <div class="col-12">
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                Product not found
                            </div>
                            <a href="/products" class="btn btn-primary-modern">Back to Products</a>
                        </div>
                    `;
                }
            } catch (error) {
                console.error('Error loading product:', error);
                container.innerHTML = `
                    <div class="col-12">
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            Error loading product details
                        </div>
                        <a href="/products" class="btn btn-primary-modern">Back to Products</a>
                    </div>
                `;
            }
        }

        function displayProductDetails(product) {
            const container = document.getElementById('productDetail');
            const imageUrl = product.image
                ? (String(product.image).startsWith('/') ? product.image : `/uploads/products/${product.image}`)
                : null;

            const html = `
                <div class="col-md-6 mb-4">
                    <div class="card-modern" style="padding: 2rem; text-align: center;">
                        <div style="font-size: 8rem; margin-bottom: 2rem; color: var(--primary-dark);">
                            ${imageUrl
                                ? `<img src="${imageUrl}" alt="${product.name}" style="max-height:320px;max-width:100%;object-fit:contain;border-radius:12px;">`
                                : `<i class="fas fa-coffee"></i>`}
                        </div>
                        <div class="mt-3">
                            <p class="text-muted small">Product Image</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card-modern" style="padding: 2rem;">
                        <!-- Breadcrumb -->
                        <nav class="mb-3">
                            <a href="/products" class="text-decoration-none">
                                <i class="fas fa-arrow-left me-1"></i> Back to Products
                            </a>
                        </nav>

                        <h1 style="color: var(--text-dark); margin-bottom: 1rem; font-weight: 800;">
                            ${product.name}
                        </h1>

                        <!-- Rating & Reviews -->
                        <div class="mb-3">
                            <div class="stars mb-2">
                                <i class="fas fa-star" style="color: #ffc107;"></i>
                                <i class="fas fa-star" style="color: #ffc107;"></i>
                                <i class="fas fa-star" style="color: #ffc107;"></i>
                                <i class="fas fa-star" style="color: #ffc107;"></i>
                                <i class="fas fa-star-half-alt" style="color: #ffc107;"></i>
                                <span class="text-muted small ms-2">(125 reviews)</span>
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="mb-4">
                            <span style="font-size: 2.5rem; color: var(--primary-dark); font-weight: 800;">
                                $${parseFloat(product.price).toFixed(2)}
                            </span>
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <h5 style="color: var(--text-dark); margin-bottom: 1rem;">Description</h5>
                            <p style="color: var(--text-muted); line-height: 1.6;">
                                ${product.description || 'This is a premium product from our carefully curated collection. We ensure the highest quality ingredients and preparation methods to provide you with an exceptional experience.'}
                            </p>
                        </div>

                        <!-- Product Details -->
                        <div class="mb-4">
                            <h5 style="color: var(--text-dark); margin-bottom: 1rem;">Details</h5>
                            <ul style="list-style: none; padding: 0;">
                                <li class="py-2 border-bottom" style="color: var(--text-muted);">
                                    <i class="fas fa-tag me-2" style="color: var(--primary-dark);"></i>
                                    <strong>Category:</strong> Category #${product.category_id}
                                </li>
                                <li class="py-2" style="color: var(--text-muted);">
                                    <i class="fas fa-check me-2" style="color: var(--primary-dark);"></i>
                                    <strong>In Stock:</strong> Yes
                                </li>
                            </ul>
                        </div>

                        <!-- Quantity Selector -->
                        <div class="mb-4">
                            <label class="form-label-modern">Quantity</label>
                            <div class="input-group" style="max-width: 200px;">
                                <button class="btn btn-outline-secondary" type="button" onclick="decreaseQty()">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number" id="quantity" class="form-control text-center" value="1" min="1" max="100">
                                <button class="btn btn-outline-secondary" type="button" onclick="increaseQty()">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary-modern btn-lg" onclick="addProductToCart(${product.id})">
                                <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                            </button>
                            <button class="btn btn-secondary-modern btn-lg" id="wishlistBtn" onclick="toggleProductWishlist(${product.id})">
                                <i class="far fa-heart me-2"></i> Add to Wishlist
                            </button>
                        </div>

                        <!-- Shipping Info -->
                        <div class="mt-4 p-3" style="background: var(--bg-light); border-radius: 8px; border-left: 4px solid var(--primary-dark);">
                            <p class="mb-2">
                                <i class="fas fa-shipping-fast me-2" style="color: var(--primary-dark);"></i>
                                <strong>Free Shipping</strong> on orders over $50
                            </p>
                            <p class="mb-0">
                                <i class="fas fa-undo me-2" style="color: var(--primary-dark);"></i>
                                <strong>30-day Returns</strong> if not satisfied
                            </p>
                        </div>
                    </div>
                </div>
            `;

            container.innerHTML = html;
        }

        async function loadRelatedProducts(categoryId) {
            const container = document.getElementById('relatedProducts');

            try {
                const response = await Utils.apiRequest('/api/products');

                if (response.success) {
                    const allProducts = response.data.data || [];
                    const relatedProducts = allProducts
                        .filter(p => p.category_id == categoryId && p.id != productId)
                        .slice(0, 4);

                    if (relatedProducts.length === 0) {
                        container.innerHTML = '<div class="col-12 text-center text-muted py-5">No related products found</div>';
                        return;
                    }

                    let html = '';
                    relatedProducts.forEach(product => {
                        const relatedImageUrl = product.image
                            ? (String(product.image).startsWith('/') ? product.image : `/uploads/products/${product.image}`)
                            : null;
                        html += `
                            <div class="col-md-6 col-lg-3 mb-4">
                                <div class="card-modern product-card-featured hover-lift h-100 d-flex flex-column">
                                    <div class="card-body-modern d-flex flex-column">
                                        <div class="text-center mb-3" style="font-size: 3rem; min-height: 80px; display: flex; align-items: center; justify-content: center; flex-grow: 1;">
                                            ${relatedImageUrl
                                                ? `<img src="${relatedImageUrl}" alt="${product.name}" style="max-height:80px;max-width:100%;object-fit:contain;border-radius:8px;">`
                                                : `<i class="fas fa-coffee" style="color: var(--primary-dark);"></i>`}
                                        </div>
                                        <h6 style="color: var(--text-dark); margin-bottom: 0.5rem;">${product.name}</h6>
                                        <p style="color: var(--primary-dark); font-weight: 700; font-size: 1.1rem; margin-bottom: 1rem;">
                                            $${parseFloat(product.price).toFixed(2)}
                                        </p>
                                        <div class="d-grid gap-2 mt-auto">
                                            <button class="btn btn-primary-modern btn-sm" onclick="addProductToCart(${product.id})">
                                                <i class="fas fa-plus me-1"></i> Add
                                            </button>
                                            <a href="/product/${product.id}" class="btn btn-secondary-modern btn-sm">
                                                View
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                    });

                    container.innerHTML = html;
                }
            } catch (error) {
                console.error('Error loading related products:', error);
            }
        }

        function increaseQty() {
            const input = document.getElementById('quantity');
            input.value = parseInt(input.value) + 1;
        }

        function decreaseQty() {
            const input = document.getElementById('quantity');
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        }

        async function addProductToCart(id) {
            const quantity = parseInt(document.getElementById('quantity').value) || 1;
            await addToCart(id, quantity);
        }

        async function toggleProductWishlist(id) {
            const btn = document.getElementById('wishlistBtn');
            btn.classList.toggle('active');
            const isActive = btn.classList.contains('active');
            btn.innerHTML = isActive ? 
                '<i class="fas fa-heart me-2"></i> Remove from Wishlist' :
                '<i class="far fa-heart me-2"></i> Add to Wishlist';
            toast.success(isActive ? 'Added to wishlist' : 'Removed from wishlist');
        }
    </script>

    <style>
        .stars {
            font-size: 1.2rem;
        }

        .input-group {
            display: flex;
            gap: 0.5rem;
        }

        .input-group input {
            border: 1px solid var(--border-color);
            padding: 0.5rem;
            text-align: center;
            font-weight: 600;
        }

        .input-group button {
            border: 1px solid var(--border-color);
            background: var(--bg-white);
            color: var(--text-dark);
            padding: 0.5rem 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .input-group button:hover {
            background: var(--primary-color);
            border-color: var(--primary-dark);
        }
    </style>
</body>
</html>
