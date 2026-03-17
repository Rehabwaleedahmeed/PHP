
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="/css/modern.css" rel="stylesheet">
    <style>
        body {
            background: var(--bg-light);
            color: var(--text-dark);
        }

        .orders-card {
            background: var(--bg-white);
            border: 1px solid rgba(33, 40, 66, 0.1);
            border-radius: 12px;
            padding: 2rem;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .orders-card:hover {
            background: var(--bg-white);
            border-color: var(--primary-color);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
        }

        .order-row {
            background: var(--bg-light);
            border-left: 4px solid var(--primary-color);
            padding: 1.5rem;
            margin-bottom: 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .order-row:hover {
            background: var(--bg-white);
            border-left-color: var(--primary-dark);
            transform: translateX(5px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
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
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1.5rem;
            margin-bottom: 1rem;
        }

        .detail-item {
            text-align: center;
        }

        .detail-label {
            color: var(--text-muted);
            font-size: 0.85rem;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
        }

        .detail-value {
            font-size: 1.1rem;
            color: var(--text-dark);
            font-weight: 600;
        }

        .order-items {
            background: var(--bg-white);
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
        }

        .item-list li:last-child {
            border-bottom: none;
        }

        .item-quantity {
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .item-price {
            color: var(--primary-dark);
            font-weight: 600;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .btn-small {
            padding: 0.5rem 1rem;
            font-size: 0.85rem;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-status {
            background: rgba(52, 152, 219, 0.2);
            color: #3498db;
        }

        .btn-status:hover {
            background: rgba(52, 152, 219, 0.4);
        }

        .btn-cancel {
            background: rgba(220, 53, 69, 0.2);
            color: #dc3545;
        }

        .btn-cancel:hover {
            background: rgba(220, 53, 69, 0.4);
        }

        .filter-section {
            background: var(--bg-white);
            border: 1px solid var(--border-color);
            padding: 1.5rem;
            border-radius: 12px;
            margin-bottom: 2rem;
        }

        .filter-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .filter-row:last-child {
            margin-bottom: 0;
        }

        .filter-label {
            color: var(--text-dark);
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: block;
        }

        .filter-input {
            background: var(--bg-white) !important;
            border: 1px solid var(--border-color) !important;
            color: var(--text-dark) !important;
            border-radius: 6px;
            padding: 0.75rem;
        }

        .filter-input::placeholder {
            color: var(--text-muted) !important;
        }

        .filter-input:focus {
            background: var(--bg-white) !important;
            border-color: var(--primary-dark) !important;
            box-shadow: 0 0 0 3px rgba(33, 40, 66, 0.1);
        }

        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
            color: var(--text-muted);
        }

        .empty-state i {
            font-size: 3rem;
            color: var(--primary-dark);
            margin-bottom: 1rem;
            display: block;
        }

        @keyframes fadeOutSlide {
            0% {
                opacity: 1;
                transform: translateX(0);
            }
            100% {
                opacity: 0;
                transform: translateX(-30px);
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
            <h1>📦 Manage Orders</h1>
            <p class="text-muted">Track and manage all customer orders</p>
        </div>
    </div>

    <div class="container-fluid py-5">
        <div class="mb-3">
            <a href="/order/create" class="btn btn-primary-modern">
                <i class="fas fa-plus me-2"></i>Create Order (Assign to User)
            </a>
        </div>

        <!-- Orders Summary -->
        <div id="summarySection" style="display: none;">
            <div class="orders-card" style="background: linear-gradient(135deg, rgba(44, 24, 16, 0.05) 0%, rgba(139, 111, 71, 0.05) 100%); border-left: 4px solid #8B6F47;">
                <h5 style="color: var(--text-dark); margin-bottom: 1.5rem;">
                    <i class="fas fa-chart-line"></i> Orders Summary
                </h5>
                <div class="summary-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem;">
                    <div class="summary-item">
                        <div style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 0.5rem;">
                            <i class="fas fa-check-circle"></i> Total Done Orders
                        </div>
                        <div id="doneCount" style="font-size: 2rem; font-weight: 700; color: #27AE60;">0</div>
                    </div>
                    <div class="summary-item">
                        <div style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 0.5rem;">
                            <i class="fas fa-dollar-sign"></i> Total Revenue
                        </div>
                        <div id="doneTotal" style="font-size: 2rem; font-weight: 700; color: #8B6F47;">EGP 0.00</div>
                    </div>
                    <div class="summary-item">
                        <div style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 0.5rem;">
                            <i class="fas fa-boxes"></i> Total Items (Done)
                        </div>
                        <div id="doneItems" style="font-size: 2rem; font-weight: 700; color: #2196f3;">0</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="filter-section">
            <h5 style="color: var(--text-dark); margin-bottom: 1.5rem;">
                <i class="fas fa-filter"></i> Filter Orders
            </h5>
            <div class="filter-row">
                <div>
                    <label class="filter-label">Date From</label>
                    <input type="date" id="dateFrom" class="form-control filter-input" onchange="filterOrders()">
                </div>
                <div>
                    <label class="filter-label">Date To</label>
                    <input type="date" id="dateTo" class="form-control filter-input" onchange="filterOrders()">
                </div>
                <div>
                    <label class="filter-label">Customer</label>
                    <select id="userFilter" class="form-control filter-input" onchange="filterOrders()">
                        <option value="">All Customers</option>
                    </select>
                </div>
                <div>
                    <label class="filter-label">Status</label>
                    <select id="statusFilter" class="form-control filter-input" onchange="filterOrders()">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="processing">Processing</option>
                        <option value="out-for-delivery">Out for Delivery</option>
                        <option value="done">Done</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
            </div>
            <div class="filter-row">
                <div>
                    <button class="btn btn-secondary" onclick="resetFilters()">
                        <i class="fas fa-sync-alt"></i> Reset Filters
                    </button>
                </div>
            </div>
        </div>

        <!-- Orders List -->
        <div class="orders-card">
            <h5 style="color: var(--text-dark); margin-bottom: 1.5rem;">
                <i class="fas fa-list"></i> Orders
            </h5>
            <div id="ordersContainer">
                <div class="empty-state">
                    <i class="fas fa-inbox"></i>
                    <p>Loading orders...</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Change Modal -->
    <div class="modal fade" id="statusModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content" style="background: var(--bg-white); border: 1px solid var(--border-color);">
                <div class="modal-header" style="border-bottom: 1px solid var(--border-color);">
                    <h5 class="modal-title" style="color: var(--text-dark);">Update Order Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="statusOrderId">
                    <div class="mb-3">
                        <label class="form-label" style="color: var(--text-dark);">New Status</label>
                        <select id="newStatus" class="form-control filter-input">
                            <option value="pending">Pending</option>
                            <option value="processing">Processing</option>
                            <option value="out-for-delivery">Out for Delivery</option>
                            <option value="done">Done</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid var(--border-color);">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn" style="background: linear-gradient(135deg, #F0E7D5 0%, #212842 100%); color: #1a1a1a; border: none;" onclick="updateOrderStatus()">
                        Update
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include(__DIR__ . '/../components/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/app.js"></script>
    <script>
        let allOrders = [];
        let userMap = {};
        let pendingAdminCancelOrderId = null;
        const statusModal = new bootstrap.Modal(document.getElementById('statusModal'));

        async function loadOrders() {
            try {
                const response = await fetch('/api/orders/all');
                const data = await response.json();
                
                if (data.success) {
                    allOrders = data.data;
                    displayOrders(allOrders);
                }
            } catch (error) {
                console.error('Error loading orders:', error);
                document.getElementById('ordersContainer').innerHTML = `
                    <div class="empty-state">
                        <i class="fas fa-exclamation-circle"></i>
                        <p>Error loading orders</p>
                    </div>
                `;
            }
        }

        async function loadUsers() {
            try {
                const response = await fetch('/api/users');
                const data = await response.json();
                
                if (data.success) {
                    const userSelect = document.getElementById('userFilter');
                    data.data.forEach(user => {
                        userMap[user.id] = user.name;
                        const option = document.createElement('option');
                        option.value = user.id;
                        option.textContent = user.name;
                        userSelect.appendChild(option);
                    });
                }
                return true;
            } catch (error) {
                console.error('Error loading users:', error);
                return false;
            }
        }

        function displayOrders(orders) {
            const container = document.getElementById('ordersContainer');
            
            if (orders.length === 0) {
                container.innerHTML = `
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <p>No orders found</p>
                    </div>
                `;
                return;
            }

            container.innerHTML = '';

            orders.forEach(order => {
                const orderDate = new Date(order.created_at).toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });

                const itemCount = order.items ? order.items.length : 0;
                const items = order.items || [];
                const orderTotal = parseFloat(order.total ?? order.total_price ?? 0);
                const itemsHtml = items.map(item => 
                    `<li><span>${item.name} <span class="item-quantity">× ${item.quantity}</span></span> <span class="item-price">EGP ${(item.quantity * item.price).toFixed(2)}</span></li>`
                ).join('');

                const orderElement = document.createElement('div');
                orderElement.className = 'order-row';
                orderElement.setAttribute('data-order-id', order.id);
                orderElement.innerHTML = `
                    <div class="order-header">
                        <div class="order-id">#${order.id}</div>
                        <span class="order-status status-${order.status}">
                            <i class="fas fa-circle"></i> ${order.status.charAt(0).toUpperCase() + order.status.slice(1).replace('-', ' ')}
                        </span>
                    </div>

                    <div class="order-details">
                        <div class="detail-item">
                            <div class="detail-label"><i class="fas fa-user"></i> Customer</div>
                            <div class="detail-value">${userMap[order.user_id] || 'Unknown'}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label"><i class="fas fa-calendar"></i> Date</div>
                            <div class="detail-value">${orderDate}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label"><i class="fas fa-box"></i> Items</div>
                            <div class="detail-value">${itemCount}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label"><i class="fas fa-dollar-sign"></i> Total</div>
                            <div class="detail-value">EGP ${orderTotal.toFixed(2)}</div>
                        </div>
                    </div>

                    <div class="order-items">
                        <strong style="color: var(--text-dark); display: block; margin-bottom: 0.5rem;">
                            <i class="fas fa-shopping-bag"></i> Order Items
                        </strong>
                        <ul class="item-list">
                            ${itemsHtml}
                        </ul>
                    </div>

                    <div class="action-buttons">
                        <button class="btn-small btn-status" onclick="openStatusModal(${order.id}, '${order.status}')">
                            <i class="fas fa-edit"></i> Change Status
                        </button>
                        <button class="btn-small btn-cancel" onclick="cancelAdminOrder(${order.id})">
                            <i class="fas fa-times"></i> Cancel Order
                        </button>
                    </div>
                `;
                container.appendChild(orderElement);
            });

            updateSummary();
        }

        function openStatusModal(orderId, currentStatus) {
            document.getElementById('statusOrderId').value = orderId;
            document.getElementById('newStatus').value = currentStatus;
            statusModal.show();
        }

        async function updateOrderStatus() {
            const orderId = document.getElementById('statusOrderId').value;
            const newStatus = document.getElementById('newStatus').value;

            try {
                const response = await fetch(`/api/orders/${orderId}/status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ status: newStatus })
                });

                const result = await response.json();

                if (result.success) {
                    window.toast?.success('Order status updated successfully', 'Success');
                    statusModal.hide();
                    loadOrders();
                } else {
                    window.toast?.error(result.message || 'Error updating status', 'Error');
                }
            } catch (error) {
                console.error('Error:', error);
                window.toast?.error('Failed to update status', 'Error');
            }
        }

        async function cancelAdminOrder(orderId) {
            // Show confirmation modal instead of basic confirm
            pendingAdminCancelOrderId = orderId;
            
            // Remove any existing modal
            const oldModal = document.getElementById('adminCancelConfirmModal');
            if (oldModal) {
                oldModal.remove();
            }
            
            const modal = document.createElement('div');
            modal.className = 'modal fade';
            modal.id = 'adminCancelConfirmModal';
            modal.tabindex = '-1';
            modal.innerHTML = `
                <div class="modal-dialog">
                    <div class="modal-content" style="background: var(--bg-white); border: 1px solid var(--border-color);">
                        <div class="modal-header" style="border-bottom: 1px solid var(--border-color);">
                            <h5 class="modal-title" style="color: var(--text-dark);">
                                <i class="fas fa-exclamation-triangle" style="color: #f44336;"></i> Confirm Cancellation
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body" style="color: var(--text-dark);">
                            <p>Are you sure you want to cancel order <strong>#${orderId}</strong>?</p>
                            <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 0;">
                                This action will remove the order from the list.
                            </p>
                        </div>
                        <div class="modal-footer" style="border-top: 1px solid var(--border-color);">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, Keep It</button>
                            <button type="button" class="btn btn-danger" id="adminConfirmCancelBtn" style="cursor: pointer;">
                                <i class="fas fa-times"></i> Yes, Cancel Order
                            </button>
                        </div>
                    </div>
                </div>
            `;
            document.body.appendChild(modal);
            
            // Show modal
            const bsModal = new bootstrap.Modal(modal);
            bsModal.show();
            
            // Wait a moment for modal to be rendered, then attach event listener
            setTimeout(() => {
                const confirmBtn = document.getElementById('adminConfirmCancelBtn');
                if (confirmBtn) {
                    confirmBtn.onclick = confirmAdminCancelOrder;
                }
            }, 100);
        }

        async function confirmAdminCancelOrder() {
            if (!pendingAdminCancelOrderId) {
                console.error('No order ID set');
                return;
            }
            
            const orderId = pendingAdminCancelOrderId;
            const orderElement = document.querySelector(`[data-order-id="${orderId}"]`);
            
            try {
                const response = await fetch(`/api/orders/${orderId}/cancel`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    }
                });

                const result = await response.json();

                if (result.success) {
                    // Remove from allOrders array
                    allOrders = allOrders.filter(order => order.id != orderId);
                    
                    // Animate removal
                    if (orderElement) {
                        orderElement.style.animation = 'fadeOutSlide 0.5s ease-out forwards';
                        setTimeout(() => {
                            orderElement.remove();
                            updateSummary();
                        }, 500);
                    }
                    
                    window.toast?.success('Order cancelled and removed', 'Success');
                    
                    // Close the modal
                    const modalElement = document.getElementById('adminCancelConfirmModal');
                    if (modalElement) {
                        const bsModal = bootstrap.Modal.getInstance(modalElement);
                        if (bsModal) {
                            bsModal.hide();
                        }
                        // Remove modal from DOM
                        setTimeout(() => {
                            const modal = document.getElementById('adminCancelConfirmModal');
                            if (modal && modal.parentNode) {
                                modal.remove();
                            }
                            pendingAdminCancelOrderId = null;
                        }, 300);
                    }
                } else {
                    window.toast?.error(result.message || 'Failed to cancel order', 'Error');
                }
            } catch (error) {
                console.error('Error:', error);
                window.toast?.error('Failed to cancel order', 'Error');
            }
        }

        function filterOrders() {
            const dateFrom = document.getElementById('dateFrom').value;
            const dateTo = document.getElementById('dateTo').value;
            const userId = document.getElementById('userFilter').value;
            const status = document.getElementById('statusFilter').value;

            let filtered = allOrders;

            if (dateFrom) {
                filtered = filtered.filter(order => {
                    const orderDate = new Date(order.created_at).toLocaleDateString('en-CA');
                    return orderDate >= dateFrom;
                });
            }

            if (dateTo) {
                filtered = filtered.filter(order => {
                    const orderDate = new Date(order.created_at).toLocaleDateString('en-CA');
                    return orderDate <= dateTo;
                });
            }

            if (userId) {
                filtered = filtered.filter(order => order.user_id == userId);
            }

            if (status) {
                filtered = filtered.filter(order => order.status === status);
            }

            displayOrders(filtered);
        }

        function resetFilters() {
            document.getElementById('dateFrom').value = '';
            document.getElementById('dateTo').value = '';
            document.getElementById('userFilter').value = '';
            document.getElementById('statusFilter').value = '';
            displayOrders(allOrders);
        }

        function updateSummary() {
            // Calculate summary for done orders
            const doneOrders = allOrders.filter(order => order.status === 'done');
            
            if (doneOrders.length === 0) {
                document.getElementById('summarySection').style.display = 'none';
                return;
            }

            document.getElementById('summarySection').style.display = 'block';

            let totalRevenue = 0;
            let totalItems = 0;

            doneOrders.forEach(order => {
                totalRevenue += parseFloat(order.total ?? order.total_price ?? 0);
                totalItems += (order.items?.length ?? 0);
            });

            document.getElementById('doneCount').textContent = doneOrders.length;
            document.getElementById('doneTotal').textContent = `EGP ${totalRevenue.toFixed(2)}`;
            document.getElementById('doneItems').textContent = totalItems;
        }

        // Load data on page load
        document.addEventListener('DOMContentLoaded', async () => {
            await loadUsers();
            loadOrders();
        });
    </script>
</body>
</html>
