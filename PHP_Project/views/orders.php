 
<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: /login');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - Premium Cafeteria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="/css/modern.css" rel="stylesheet">
    <style>
        .order-card {
            background: var(--bg-white);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }

        .order-card:hover {
            background: var(--bg-white);
            border-color: var(--primary-dark);
            transform: translateY(-2px);
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .order-id {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary-dark);
        }

        .order-status {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .status-pending {
            background: rgba(255, 193, 7, 0.2);
            color: #ffc107;
        }

        .status-processing {
            background: rgba(33, 150, 243, 0.2);
            color: #2196f3;
        }

        .status-out-for-delivery {
            background: rgba(76, 175, 80, 0.2);
            color: #4caf50;
        }

        .status-done {
            background: rgba(76, 175, 80, 0.2);
            color: #4caf50;
        }

        .status-cancelled {
            background: rgba(244, 67, 54, 0.2);
            color: #f44336;
        }

        .order-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .detail-item {
            text-align: center;
            padding: 0.5rem;
        }

        .detail-label {
            color: var(--text-muted);
            font-size: 0.75rem;
            text-transform: uppercase;
            margin-bottom: 0.3rem;
        }

        .detail-value {
            font-size: 1rem;
            color: var(--text-dark);
            font-weight: 600;
        }

        .order-items {
            background: var(--bg-light);
            padding: 1rem;
            border-radius: 6px;
            margin-bottom: 1rem;
            border: 1px solid var(--border-color);
        }

        .item-list {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .item-list li {
            padding: 0.5rem 0;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .item-list li:last-child {
            border-bottom: none;
        }

        .item-name {
            color: var(--text-dark);
        }

        .item-details {
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .item-price {
            color: var(--primary-dark);
            font-weight: 600;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: var(--text-muted);
        }

        .empty-state i {
            font-size: 4rem;
            color: var(--primary-dark);
            margin-bottom: 1rem;
            display: block;
        }

        .empty-state p {
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
        }

        .btn-primary-modern {
            background: linear-gradient(135deg, #F0E7D5 0%, #212842 100%);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 12px 24px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-primary-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(240, 231, 213, 0.2);
            color: #fff;
            text-decoration: none;
        }
        
        .order-actions {
            display: flex;
            gap: 0.75rem;
            justify-content: flex-end;
            margin-top: 1rem;
            flex-wrap: wrap;
        }
        
        .btn-cancel-order {
            background: rgba(220, 53, 69, 0.1);
            border: 1px solid rgba(220, 53, 69, 0.35);
            color: #dc3545;
            border-radius: 8px;
            padding: 0.5rem 0.9rem;
            font-weight: 600;
            transition: all 0.2s ease;
        }
        
        .btn-cancel-order:hover {
            background: rgba(220, 53, 69, 0.18);
            transform: translateY(-1px);
        }
    </style>
</head>
<body>
    <!-- Navigation Component -->
    <?php include(__DIR__ . '/components/navbar.php'); ?>

    <!-- Page Header -->
    <div class="page-header">
        <div class="container-fluid">
            <h1><i class="fas fa-receipt"></i> My Orders</h1>
            <p class="text-muted">View and track your orders</p>
        </div>
    </div>

    <div class="container-fluid py-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <!-- Pending Cart Section -->
                <div id="pendingCartSection" style="display: none; margin-bottom: 2rem;">
                    <div class="card-modern" style="border-color: var(--primary-accent); background: #fafaf9;">
                        <div class="card-header-modern" style="background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-accent) 100%); color: white;">
                            <h5 style="color: white; margin: 0;">
                                <i class="fas fa-shopping-cart"></i> Your Shopping Cart
                            </h5>
                        </div>
                        <div class="card-body-modern">
                            <div id="pendingCartItems"></div>
                            
                            <div style="background: #f9f6f1; padding: 15px; border-radius: 8px; margin-top: 15px;">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Subtotal:</span>
                                    <strong id="cartSubtotal">EGP 0</strong>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Tax (14%):</span>
                                    <strong id="cartTax">EGP 0</strong>
                                </div>
                                <hr style="border-color: #e8e0d5; margin: 10px 0;">
                                <div class="d-flex justify-content-between">
                                    <span style="font-size: 1.1rem; font-weight: bold;">Total:</span>
                                    <strong style="font-size: 1.2rem; color: var(--primary-accent);" id="cartTotal">EGP 0</strong>
                                </div>
                            </div>
                            
                            <div style="display: flex; gap: 1rem; margin-top: 15px; flex-wrap: wrap;">
                                <button onclick="placePendingOrder()" class="btn btn-primary-modern flex-grow-1" style="min-width: 150px;">
                                    <i class="fas fa-check me-2"></i> Place Order
                                </button>
                                <button onclick="clearPendingCart()" class="btn btn-secondary-modern flex-grow-1" style="min-width: 150px;">
                                    <i class="fas fa-trash me-2"></i> Clear Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div style="margin-bottom: 2rem;">
                    <a href="/products" class="btn btn-primary-modern">
                        <i class="fas fa-shopping-bag"></i> Continue Shopping
                    </a>
                </div>

                <!-- Orders List -->
                <div id="ordersContainer">
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <p>Loading your orders...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include __DIR__ . '/components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Display pending cart
        function displayPendingCart() {
            if (typeof CartManager === 'undefined') {
                console.error('CartManager not loaded');
                return;
            }

            const cart = CartManager.getCart();
            const section = document.getElementById('pendingCartSection');
            
            if (Object.keys(cart).length === 0) {
                section.style.display = 'none';
                return;
            }

            section.style.display = 'block';
            const itemsContainer = document.getElementById('pendingCartItems');
            
            let html = '<ul class="list-unstyled mb-0">';
            Object.values(cart).forEach(item => {
                const subtotal = item.quantity * item.price;
                html += `
                    <li style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #e8e0d5;">
                        <div style="flex: 1;">
                            <div style="font-weight: 600; color: var(--primary-dark);">${item.name}</div>
                            <small style="color: #a89785;">${item.quantity} × EGP ${item.price.toFixed(2)}</small>
                        </div>
                        <div style="margin-right: 12px;">
                            <strong style="color: var(--primary-accent);">EGP ${subtotal.toFixed(2)}</strong>
                        </div>
                        <button onclick="removeFromCart(${item.id})" class="btn btn-sm" style="background: rgba(220,53,69,0.2); color: #dc3545; border: none; padding: 5px 10px; border-radius: 6px; cursor: pointer;">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </li>
                `;
            });
            html += '</ul>';
            itemsContainer.innerHTML = html;

            // Update totals
            const totals = CartManager.calculateTotals();
            document.getElementById('cartSubtotal').textContent = 'EGP ' + totals.subtotal.toFixed(2);
            document.getElementById('cartTax').textContent = 'EGP ' + totals.tax.toFixed(2);
            document.getElementById('cartTotal').textContent = 'EGP ' + totals.total.toFixed(2);
        }

        function removeFromCart(productId) {
            CartManager.removeItem(productId);
            displayPendingCart();
            window.toast.success('Item removed from cart', 'Removed');
        }

        function clearPendingCart() {
            if (confirm('Are you sure you want to clear your entire cart?')) {
                CartManager.clearCart();
                displayPendingCart();
                window.toast.success('Cart cleared', 'Cleared');
            }
        }

        async function placePendingOrder() {
            if (typeof CartManager === 'undefined') {
                window.toast.error('Cart manager not available');
                return;
            }

            const cart = CartManager.getCart();
            if (Object.keys(cart).length === 0) {
                window.toast.warning('Your cart is empty', 'Empty Cart');
                return;
            }

            try {
                window.LoadingSpinner.show('Placing order...');
                
                const totals = CartManager.calculateTotals();
                const items = Object.values(cart).map(item => ({
                    id: item.id,
                    quantity: item.quantity,
                    price: item.price
                }));

                const response = await fetch('/api/orders/create', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        userId: null, // Current user will be set by the API
                        notes: 'Order placed from shopping cart',
                        subtotal: totals.subtotal,
                        tax: totals.tax,
                        total: totals.total,
                        items: items
                    })
                });

                const result = await response.json();
                window.LoadingSpinner.hide();

                if (result.success) {
                    window.toast.success('Order placed successfully!', 'Success');
                    CartManager.clearCart();
                    displayPendingCart();
                    loadOrders();
                } else {
                    window.toast.error(result.message || 'Failed to place order', 'Error');
                }
            } catch (error) {
                window.LoadingSpinner.hide();
                console.error('Error:', error);
                window.toast.error('Error placing order: ' + error.message, 'Error');
            }
        }

        async function loadOrders() {
            try {
                const response = await fetch('/api/orders');
                const data = await response.json();
                
                if (data.success && data.data) {
                    displayOrders(data.data);
                } else {
                    showEmptyState('No orders found');
                }
            } catch (error) {
                console.error('Error loading orders:', error);
                showEmptyState('Error loading orders');
            }
        }

        function displayOrders(orders) {
            if (orders.length === 0) {
                showEmptyState('You haven\'t placed any orders yet');
                return;
            }

            const container = document.getElementById('ordersContainer');
            container.innerHTML = '';

            orders.forEach(order => {
                const orderDate = new Date(order.created_at).toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });

                const items = order.items || [];
                const totalValue = parseFloat(order.total ?? order.total_price ?? 0);
                const canCancel = ['pending', 'processing', 'out-for-delivery'].includes(String(order.status || '').toLowerCase());
                const itemsHtml = items.map(item => `
                    <li>
                        <div>
                            <div class="item-name">${item.name}</div>
                            <div class="item-details">Qty: ${item.quantity}</div>
                        </div>
                        <div class="item-price">EGP ${(item.quantity * item.price).toFixed(2)}</div>
                    </li>
                `).join('');

                const orderElement = document.createElement('div');
                orderElement.className = 'order-card';
                orderElement.setAttribute('data-order-id', order.id);
                orderElement.innerHTML = `
                    <div class="order-header">
                        <div class="order-id">Order #${order.id}</div>
                        <span class="order-status status-${order.status}">
                            <i class="fas fa-circle"></i> ${order.status.charAt(0).toUpperCase() + order.status.slice(1).replace('-', ' ')}
                        </span>
                    </div>

                    <div class="order-details">
                        <div class="detail-item">
                            <div class="detail-label"><i class="fas fa-calendar"></i> Date</div>
                            <div class="detail-value">${orderDate}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label"><i class="fas fa-box"></i> Items</div>
                            <div class="detail-value">${items.length}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label"><i class="fas fa-dollar-sign"></i> Subtotal</div>
                            <div class="detail-value">EGP ${parseFloat(order.subtotal || 0).toFixed(2)}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label"><i class="fas fa-receipt"></i> Total</div>
                            <div class="detail-value">EGP ${totalValue.toFixed(2)}</div>
                        </div>
                    </div>

                    <div class="order-items">
                        <strong style="color: var(--text-dark); display: block; margin-bottom: 0.5rem;">
                            <i class="fas fa-list"></i> Order Items
                        </strong>
                        <ul class="item-list">
                            ${itemsHtml}
                        </ul>
                    </div>
                    
                    <div class="order-actions">
                        ${canCancel ? `<button class="btn-cancel-order" onclick="cancelOrder(${order.id})"><i class="fas fa-times me-1"></i>Cancel Order</button>` : ''}
                    </div>
                `;
                container.appendChild(orderElement);
            });
        }
        
        async function cancelOrder(orderId) {
            // Show custom confirmation dialog
            const orderCard = document.querySelector(`[data-order-id="${orderId}"]`);
            if (!orderCard) return;
            
            // Create confirmation modal
            const confirmModal = document.createElement('div');
            confirmModal.className = 'modal fade';
            confirmModal.id = `confirmCancelModal-${orderId}`;
            confirmModal.tabIndex = '-1';
            confirmModal.innerHTML = `
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content" style="border: 1px solid #e8e0d5;">
                        <div class="modal-header" style="background: #f9f6f1; border-bottom: 1px solid #e8e0d5;">
                            <h5 class="modal-title">
                                <i class="fas fa-trash-alt" style="color: #dc3545;"></i> Cancel Order
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to cancel this order? This action cannot be undone.</p>
                            <p style="color: #666; font-size: 0.9rem; margin-top: 1rem;">Order #${orderId} will be permanently removed from your orders list.</p>
                        </div>
                        <div class="modal-footer" style="border-top: 1px solid #e8e0d5;">
                            <button type="button" class="btn btn-secondary-modern" data-bs-dismiss="modal">
                                <i class="fas fa-times me-2"></i> Keep Order
                            </button>
                            <button type="button" class="btn" style="background: #dc3545; color: white; border: none;" onclick="confirmCancelOrder(${orderId})">
                                <i class="fas fa-trash-alt me-2"></i> Yes, Cancel Order
                            </button>
                        </div>
                    </div>
                </div>
            `;
            
            document.body.appendChild(confirmModal);
            const modal = new bootstrap.Modal(confirmModal);
            modal.show();
            
            // Clean up modal after it's hidden
            confirmModal.addEventListener('hidden.bs.modal', function() {
                confirmModal.remove();
            });
        }

        async function confirmCancelOrder(orderId) {
            try {
                // Show loading state on the order card
                const orderCard = document.querySelector(`[data-order-id="${orderId}"]`);
                if (orderCard) {
                    const originalContent = orderCard.innerHTML;
                    orderCard.style.opacity = '0.6';
                    orderCard.style.pointerEvents = 'none';
                }

                const response = await fetch(`/api/orders/${orderId}`, {
                    method: 'DELETE'
                });
                const result = await response.json();
                
                // Close the confirmation modal
                const confirmModal = document.querySelector(`#confirmCancelModal-${orderId}`);
                if (confirmModal) {
                    const modal = bootstrap.Modal.getInstance(confirmModal);
                    if (modal) modal.hide();
                }
                
                if (result.success) {
                    // Animate removal
                    if (orderCard) {
                        orderCard.style.transition = 'all 0.3s ease';
                        orderCard.style.opacity = '0';
                        orderCard.style.transform = 'translateX(100%)';
                        setTimeout(() => {
                            orderCard.remove();
                            // Check if there are any orders left
                            const container = document.getElementById('ordersContainer');
                            if (container && container.children.length === 0) {
                                showEmptyState('You haven\'t placed any orders yet');
                            }
                        }, 300);
                    }
                    
                    window.toast?.success('Order cancelled and removed successfully', 'Cancelled');
                } else {
                    // Restore state if error
                    if (orderCard) {
                        orderCard.style.opacity = '1';
                        orderCard.style.pointerEvents = 'auto';
                    }
                    window.toast?.error(result.message || 'Failed to cancel order', 'Error');
                }
            } catch (error) {
                // Restore state if error
                const orderCard = document.querySelector(`[data-order-id="${orderId}"]`);
                if (orderCard) {
                    orderCard.style.opacity = '1';
                    orderCard.style.pointerEvents = 'auto';
                }
                window.toast?.error('Failed to cancel order: ' + error.message, 'Error');
            }
        }

        function showEmptyState(message) {
            const container = document.getElementById('ordersContainer');
            container.innerHTML = `
                <div class="empty-state">
                    <i class="fas fa-inbox"></i>
                    <p>${message}</p>
                    <a href="/order/create" class="btn btn-primary-modern">
                        <i class="fas fa-plus"></i> Create Your First Order
                    </a>
                </div>
            `;
        }

        // Load orders on page load
        document.addEventListener('DOMContentLoaded', function() {
            displayPendingCart();
            loadOrders();
        });
    </script>
    <script src="/js/app.js"></script>
</body>
</html>
