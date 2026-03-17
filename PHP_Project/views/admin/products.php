<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products - Premium Cafeteria Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="/css/modern.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--bg-light);
            color: var(--text-dark);
        }

        /* Page Header */
        .page-header {
            background: linear-gradient(135deg, var(--bg-white) 0%, var(--bg-light) 100%);
            padding: 2rem 0;
            margin-bottom: 3rem;
            border-bottom: 2px solid var(--primary-color);
        }

        .page-header h1 {
            font-size: 2rem;
            font-weight: 800;
            color: var(--primary-dark);
        }

        /* Card Styling */
        .product-form-card, .products-list-card {
            background: var(--bg-white);
            border: 1px solid rgba(33, 40, 66, 0.1);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background: var(--bg-light) !important;
            border-bottom: 1px solid rgba(240, 231, 213, 0.2) !important;
            padding: 1rem;
        }

        .card-header h5 {
            color: var(--primary-dark);
            font-weight: 700;
            margin: 0;
        }

        .card-body {
            padding: 2rem;
        }

        /* Form Styling */
        .form-label {
            color: var(--text-dark);
            font-weight: 600;
            margin-bottom: 0.7rem;
        }

        .form-control, .form-select {
            background: var(--bg-white) !important;
            border: 1px solid var(--border-color) !important;
            color: var(--text-dark) !important;
            border-radius: 8px !important;
        }

        .form-control::placeholder {
            color: var(--text-muted) !important;
        }

        .form-control:focus, .form-select:focus {
            background: var(--bg-white) !important;
            border-color: var(--primary-dark) !important;
            color: var(--text-dark) !important;
            box-shadow: 0 0 0 3px rgba(33, 40, 66, 0.1);
        }

        .form-select option {
            background: var(--bg-white);
            color: var(--text-dark);
        }

        /* Button Styling */
        .btn-add-product {
            background: var(--primary-dark);
            color: #FFFFFF;
            border: none;
            border-radius: 8px;
            padding: 12px 24px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-add-product:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(33, 40, 66, 0.2);
            color: #FFFFFF;
        }

        /* Table Styling */
        .table {
            color: rgba(255, 255, 255, 0.85);
            border-color: rgba(240, 231, 213, 0.2);
        }

        .table thead {
            background: rgba(240, 231, 213, 0.1);
            color: #F0E7D5;
        }

        .table th {
            border-color: rgba(240, 231, 213, 0.2);
            font-weight: 700;
        }

        .table td {
            border-color: rgba(240, 231, 213, 0.2);
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background: rgba(240, 231, 213, 0.08);
        }

        .btn-edit, .btn-delete {
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 0.85rem;
            cursor: pointer;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-edit {
            background: rgba(52, 152, 219, 0.2);
            color: #3498db;
        }

        .btn-edit:hover {
            background: rgba(52, 152, 219, 0.4);
        }

        .btn-delete {
            background: rgba(220, 53, 69, 0.2);
            color: #dc3545;
        }

        .btn-delete:hover {
            background: rgba(220, 53, 69, 0.4);
        }

        /* Footer */
        .footer-modern {
            background: rgba(0, 0, 0, 0.5);
            border-top: 1px solid rgba(240, 231, 213, 0.2);
            padding: 2rem 0;
            color: rgba(255, 255, 255, 0.7);
            text-align: center;
            margin-top: 3rem;
        }

        /* Product Image Styles */
        .product-image-cell {
            text-align: center;
        }

        .product-image-thumb {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid rgba(240, 231, 213, 0.3);
        }

        .product-image-placeholder {
            width: 50px;
            height: 50px;
            background: rgba(240, 231, 213, 0.1);
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(240, 231, 213, 0.5);
            font-size: 1.5rem;
        }

        @media (max-width: 768px) {
            .page-header h1 {
                font-size: 1.5rem;
            }

            .card-body {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation Component -->
    <?php include(__DIR__ . '/../components/navbar.php'); ?>

    <!-- Page Header -->
    <div class="page-header">
        <div class="container-fluid">
            <h1>📦 Manage Products</h1>
        </div>
    </div>

    <div class="container-fluid mb-5">
        <div class="row g-4">
            <!-- Add Product Form -->
            <div class="col-lg-5">
                <div class="product-form-card">
                    <div class="card-header">
                        <h5>➕ Add New Product</h5>
                    </div>
                    <div class="card-body">
                        <form action="/admin/products" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="e.g., Espresso" required>
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label">Price (EGP)</label>
                                <input type="number" class="form-control" id="price" name="price" step="0.01" placeholder="50.00" required>
                            </div>

                            <div class="mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select class="form-select" id="category_id" name="category_id" required>
                                    <option value="">Select Category</option>
                                    <option value="1">☕ Coffee</option>
                                    <option value="2">🍵 Tea</option>
                                    <option value="3">🥐 Snacks</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter product description..."></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Product Image</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            </div>

                            <button type="submit" class="btn-add-product">
                                <i class="fas fa-plus"></i> Add Product
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Products Table -->
            <div class="col-lg-7">
                <div class="products-list-card">
                    <div class="card-header">
                        <h5>📋 Products List</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0" id="products-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Category</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Products will be loaded here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <?php include(__DIR__ . '/../components/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const categoryMap = { 1: 'Coffee', 2: 'Tea', 3: 'Snacks' };
        let editingId = null;

        async function loadProducts() {
            try {
                const response = await fetch('/api/products');
                const data = await response.json();
                
                if (data.success) {
                    displayProducts(data.data);
                }
            } catch (error) {
                console.error('Error loading products:', error);
            }
        }

        function displayProducts(products) {
            const tbody = document.querySelector('#products-table tbody');
            tbody.innerHTML = '';

            products.forEach(product => {
                const categoryName = categoryMap[product.category_id] || 'Unknown';
                const row = document.createElement('tr');
                
                // Build image HTML
                let imageHtml = '';
                if (product.image) {
                    imageHtml = `<img src="/uploads/products/${product.image}" alt="${product.name}" class="product-image-thumb">`;
                } else {
                    imageHtml = `<div class="product-image-placeholder"><i class="fas fa-image"></i></div>`;
                }
                
                row.innerHTML = `
                    <td><strong>#${product.id}</strong></td>
                    <td class="product-image-cell">${imageHtml}</td>
                    <td>${product.name}</td>
                    <td><strong>EGP ${parseFloat(product.price).toFixed(2)}</strong></td>
                    <td><span style="background: rgba(240, 231, 213, 0.2); padding: 4px 12px; border-radius: 20px;">${categoryName}</span></td>
                    <td>
                        <button class="btn-edit" onclick="editProduct(${product.id}, '${product.name}', ${product.price}, ${product.category_id}, '${(product.description || '').replace(/'/g, "\\'")}')">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="btn-delete" onclick="deleteProduct(${product.id})">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        function editProduct(id, name, price, categoryId, description) {
            editingId = id;
            document.getElementById('name').value = name;
            document.getElementById('price').value = price;
            document.getElementById('category_id').value = categoryId;
            document.getElementById('description').value = description;
            document.querySelector('button[type="submit"]').innerHTML = '<i class="fas fa-save"></i> Update Product';
            document.querySelector('.card-header h5').textContent = '✏️ Edit Product #' + id;
            window.scrollTo(0, 0);
        }

        function resetForm() {
            editingId = null;
            document.querySelector('form').reset();
            document.querySelector('button[type="submit"]').innerHTML = '<i class="fas fa-plus"></i> Add Product';
            document.querySelector('.card-header h5').textContent = '➕ Add New Product';
        }

        // Override form submission to handle both add and edit
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                const formData = new FormData(form);
                let url = '/admin/products';
                let method = 'POST';
                
                if (editingId) {
                    url = `/admin/products/${editingId}`;
                    method = 'POST';
                }
                
                try {
                    const response = await fetch(url, {
                        method: method,
                        body: formData
                    });
                    const data = await response.json();
                    
                    if (data.success) {
                        alert(editingId ? '✓ Product updated!' : '✓ Product created!');
                        resetForm();
                        loadProducts();
                    } else {
                        alert('❌ Error: ' + data.message);
                    }
                } catch (error) {
                    alert('❌ Error: ' + error.message);
                }
            });
            
            loadProducts();
        });

        async function deleteProduct(id) {
            if (!confirm('Are you sure you want to delete this product?')) return;

            try {
                const response = await fetch(`/admin/products/${id}`, {
                    method: 'DELETE'
                });
                const data = await response.json();
                
                if (data.success) {
                    alert('✓ Product deleted successfully!');
                    loadProducts();
                } else {
                    alert('❌ Error: ' + data.message);
                }
            } catch (error) {
                console.error('Error deleting product:', error);
            }
        }

        // Load products on page load
        window.addEventListener('load', loadProducts);
    </script>
    <script src="/js/app.js"></script>
</body>
</html>
