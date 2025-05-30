const leaveRequests = [
    {
        id: 10,
        employee: 'Andrei Santos',
        department: 'Administration',
        leaveType: 'Personal Leave',
        startDate: '2025-01-10',
        endDate: '2025-01-12',
        status: 'Rejected'
    },
    {
        id: 5,
        employee: 'Angelica Cruz',
        department: 'Legislative',
        leaveType: 'Sick Leave',
        startDate: '2025-02-05',
        endDate: '2025-02-07',
        status: 'Approved'
    },
    {
        id: 12,
        employee: 'Patrick Gonzales',
        department: 'Health and Social Services',
        leaveType: 'Sick Leave',
        startDate: '2025-03-01',
        endDate: '2025-03-03',
        status: 'Approved'
    },
    {
        id: 2,
        employee: 'Miguel Reyes',
        department: 'Legislative',
        leaveType: 'Sick Leave',
        startDate: '2025-04-10',
        endDate: '2025-04-12',
        status: 'Approved'
    },
    {
        id: 3,
        employee: 'Camille De Guzman',
        department: 'Sangguniang Kabataan',
        leaveType: 'Personal Leave',
        startDate: '2025-05-15',
        endDate: '2025-05-17',
        status: 'Rejected'
    },
    {
        id: 1,
        employee: 'Trisha Salazar',
        department: 'Administration',
        leaveType: 'Vacation',
        startDate: '2025-06-20',
        endDate: '2025-06-29',
        status: 'Pending'
    },
    {
        id: 11,
        employee: 'Kristine Ramos',
        department: 'Public Safety',
        leaveType: 'Vacation',
        startDate: '2025-07-25',
        endDate: '2025-08-03',
        status: 'Pending'
    },
    {
        id: 7,
        employee: 'Isabella Lopez',
        department: 'Health and Social Services',
        leaveType: 'Special Leave Benefits for Women',
        startDate: '2025-09-01',
        endDate: '2025-09-10',
        status: 'Pending'
    },
    {
        id: 4,
        employee: 'Marco Villanueva',
        department: 'Administration',
        leaveType: 'Vacation',
        startDate: '2025-10-05',
        endDate: '2025-10-09',
        status: 'Pending'
    },
    {
        id: 8,
        employee: 'Jake Garcia',
        department: 'Maintenance / Public works',
        leaveType: 'Unpaid Leave',
        startDate: '2025-11-10',
        endDate: '2025-11-19',
        status: 'Pending'
    },
    {
        id: 6,
        employee: 'Ronald Aquino',
        department: 'Public Safety',
        leaveType: 'Maternity Leave',
        startDate: '2026-08-20',
        endDate: '2026-10-19',
        status: 'Pending'
    },
    {
        id: 14,
        employee: 'Vincent Navarro',
        department: 'Legislative',
        leaveType: 'Special Leave Benefits for Women',
        startDate: '2026-04-25',
        endDate: '2026-05-04',
        status: 'Pending'
    },
    {
        id: 9,
        employee: 'Mia Rodriguez',
        department: 'Sangguniang Kabataan',
        leaveType: 'Vacation Leave',
        startDate: '2026-06-01',
        endDate: '2026-06-10',
        status: 'Pending'
    },
    {
        id: 15,
        employee: 'Sophia Dela Cruz',
        department: 'Sangguniang Kabataan',
        leaveType: 'Vacation Leave',
        startDate: '2026-07-05',
        endDate: '2026-07-14',
        status: 'Pending'
    }
];

// DOM elements
const searchInput = document.getElementById('searchInput');
const departmentFilter = document.getElementById('departmentFilter');
const statusFilter = document.getElementById('statusFilter');
const leaveTypeFilter = document.getElementById('leaveTypeFilter');
const tableBody = document.getElementById('leaveTableBody');
const mobileMenuToggle = document.getElementById('mobileMenuToggle');
const sidebar = document.querySelector('.side-bar');

// Initialize the page
function initLeaveManagement(){ 
    renderTable(leaveRequests);
    setupEventListeners();
    addInteractiveFeatures();
    // setupMobileMenu();
};


// Setup event listeners for filtering
function setupEventListeners() {
    if (searchInput) searchInput.addEventListener('input', filterTable);
    if (departmentFilter) departmentFilter.addEventListener('change', filterTable);
    if (statusFilter) statusFilter.addEventListener('change', filterTable);
    if (leaveTypeFilter) leaveTypeFilter.addEventListener('change', filterTable);
}

// Setup mobile menu functionality
function setupMobileMenu() {
    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('active');
            
            // Create or toggle overlay
            let overlay = document.querySelector('.overlay');
            if (!overlay) {
                overlay = document.createElement('div');
                overlay.className = 'overlay';
                document.body.appendChild(overlay);
                
                overlay.addEventListener('click', function() {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                });
            }
            
            overlay.classList.toggle('active');
        });
    }
}

// Add interactive features for header and sidebar
function addInteractiveFeatures() {
    // Add click handlers for navigation links
    const navItems = document.querySelectorAll('.nav-item');
    navItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all nav items
            navItems.forEach(nav => nav.classList.remove('active'));
            
            // Add active class to clicked item
            this.classList.add('active');
            
            // Get the page data attribute
            const page = this.getAttribute('data-page');
            
            // Handle different page navigation
            handlePageNavigation(page);
            
            // Close mobile menu if open
            if (window.innerWidth <= 768) {
                sidebar.classList.remove('active');
                const overlay = document.querySelector('.overlay');
                if (overlay) overlay.classList.remove('active');
            }
        });
    });
    
    // Add notification bell functionality
    const notifBell = document.getElementById('notif-bell');
    if (notifBell) {
        notifBell.addEventListener('click', function() {
            // Show notification dropdown or modal
            showNotifications();
        });
    }
    
    // Add profile button functionality
    const profileButton = document.getElementById('profile-button');
    if (profileButton) {
        profileButton.addEventListener('click', function() {
            // Show profile dropdown or modal
            showProfileMenu();
        });
    }
}

// Handle page navigation
function handlePageNavigation(page) {
    const contentContainer = document.querySelector('.content-container');
    switch(page) {
        case 'dashboard':
            contentContainer.innerHTML = `
                <h2 style="color: #111827; margin-bottom: 20px;">Dashboard</h2>
                <div class="dashboard-content">
                    <p>Dashboard content will be loaded here...</p>
                </div>
            `;
            break;
        case 'employee':
            contentContainer.innerHTML = `
                <h2 style="color: #111827; margin-bottom: 20px;">Employee Management</h2>
                <div class="employee-content">
                    <p>Employee management content will be loaded here...</p>
                </div>
            `;
            break;
        case 'payroll':
            contentContainer.innerHTML = `
                <h2 style="color: #111827; margin-bottom: 20px;">Payroll Management</h2>
                <div class="payroll-content">
                    <p>Payroll management content will be loaded here...</p>
                </div>
            `;
            break;
        case 'calendar':
            contentContainer.innerHTML = `
                <h2 style="color: #111827; margin-bottom: 20px;">Calendar</h2>
                <div class="calendar-content">
                    <p>Calendar content will be loaded here...</p>
                </div>
            `;
            break;
        case 'leave':
            // Reload the leave management content
            loadLeaveManagementContent();
            break;
        case 'signout':
            handleSignOut();
            break;
    }
}

// Load leave management content
function loadLeaveManagementContent() {
    const contentContainer = document.querySelector('.content-container');
    contentContainer.innerHTML = `
        <h2 style="color: #111827; margin-bottom: 20px;">Leave Management</h2>
        
        <!-- Summary Cards -->
        <div class="summary-cards">
            <div class="summary-card">
                <h3>Pending Leaves</h3>
                <p class="count pending-count">5</p>
            </div>
            <div class="summary-card">
                <h3>Approved Leaves</h3>
                <p class="count approved-count">3</p>
            </div>
            <div class="summary-card">
                <h3>Rejected Leaves</h3>
                <p class="count rejected-count">2</p>
            </div>
        </div>

        <!-- Leaves for Approval Section -->
        <div class="approval-section">
            <div class="section-header">
                <h3>Leaves for Approval</h3>
                
                <!-- Filters -->
                <div class="filters">
                    <div class="search-container">
                        <svg class="search-icon" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #9ca3af;">
                            <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                        </svg>
                        <input 
                            type="text" 
                            id="searchInput" 
                            placeholder="Search by employee name or department"
                            class="search-input"
                        >
                    </div>
                    
                    <div class="filter-controls">
                        <select id="departmentFilter" class="filter-select">
                            <option value="">All Departments</option>
                            <option value="Administration">Administration</option>
                            <option value="Legislative">Legislative</option>
                            <option value="Safeguarding Children">Safeguarding Children</option>
                        </select>
                        
                        <select id="statusFilter" class="filter-select">
                            <option value="">All Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Approved">Approved</option>
                            <option value="Rejected">Rejected</option>
                        </select>
                        
                        <select id="leaveTypeFilter" class="filter-select">
                            <option value="">All Leave Types</option>
                            <option value="Vacation">Vacation</option>
                            <option value="Sick Leave">Sick Leave</option>
                            <option value="Personal Leave">Personal Leave</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="table-container">
                <table class="leave-table">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Department</th>
                            <th>Leave Type</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="leaveTableBody">
                        <!-- Table rows will be populated by JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    `;
    
    // Re-initialize the leave management functionality
    setTimeout(() => {
        renderTable(leaveRequests);
        setupEventListeners();
        updateSummaryCards();
    }, 100);
}

// Show notifications
function showNotifications() {
    // Create a simple notification dropdown
    const existingDropdown = document.querySelector('.notification-dropdown');
    if (existingDropdown) {
        existingDropdown.remove();
        return;
    }
    
    const dropdown = document.createElement('div');
    dropdown.className = 'notification-dropdown';
    dropdown.style.cssText = `
        position: absolute;
        top: 60px;
        right: 80px;
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        width: 300px;
        z-index: 1000;
        padding: 16px;
    `;
    
    dropdown.innerHTML = `
        <h4 style="margin-bottom: 12px; color: #111827;">Notifications</h4>
        <div style="border-bottom: 1px solid #e5e7eb; padding: 8px 0; margin-bottom: 8px;">
            <p style="font-size: 14px; margin-bottom: 4px;">New leave request from Sophia Clark</p>
            <span style="font-size: 12px; color: #6b7280;">2 minutes ago</span>
        </div>
        <div style="border-bottom: 1px solid #e5e7eb; padding: 8px 0; margin-bottom: 8px;">
            <p style="font-size: 14px; margin-bottom: 4px;">Leave approved for Marcus Johnson</p>
            <span style="font-size: 12px; color: #6b7280;">1 hour ago</span>
        </div>
        <div style="padding: 8px 0;">
            <p style="font-size: 14px; margin-bottom: 4px;">System maintenance scheduled</p>
            <span style="font-size: 12px; color: #6b7280;">3 hours ago</span>
        </div>
    `;
    
    document.body.appendChild(dropdown);
    
    // Close dropdown when clicking outside
    setTimeout(() => {
        document.addEventListener('click', function closeDropdown(e) {
            if (!dropdown.contains(e.target) && !document.getElementById('notif-bell').contains(e.target)) {
                dropdown.remove();
                document.removeEventListener('click', closeDropdown);
            }
        });
    }, 100);
}

// Show profile menu
function showProfileMenu() {
    const existingMenu = document.querySelector('.profile-menu');
    if (existingMenu) {
        existingMenu.remove();
        return;
    }
    
    const menu = document.createElement('div');
    menu.className = 'profile-menu';
    menu.style.cssText = `
        position: absolute;
        top: 60px;
        right: 20px;
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        width: 200px;
        z-index: 1000;
        padding: 8px 0;
    `;
    
    menu.innerHTML = `
        <div style="padding: 12px 16px; border-bottom: 1px solid #e5e7eb;">
            <p style="font-weight: 500; color: #111827;">John Doe</p>
            <p style="font-size: 12px; color: #6b7280;">Administrator</p>
        </div>
        <a href="#" style="display: block; padding: 12px 16px; text-decoration: none; color: #374151; font-size: 14px; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#f9fafb'" onmouseout="this.style.backgroundColor='transparent'">Profile Settings</a>
        <a href="#" style="display: block; padding: 12px 16px; text-decoration: none; color: #374151; font-size: 14px; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#f9fafb'" onmouseout="this.style.backgroundColor='transparent'">Account Settings</a>
        <a href="#" style="display: block; padding: 12px 16px; text-decoration: none; color: #374151; font-size: 14px; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#f9fafb'" onmouseout="this.style.backgroundColor='transparent'">Help & Support</a>
        <hr style="margin: 8px 0; border: none; border-top: 1px solid #e5e7eb;">
        <a href="#" style="display: block; padding: 12px 16px; text-decoration: none; color: #dc2626; font-size: 14px; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#f9fafb'" onmouseout="this.style.backgroundColor='transparent'" onclick="handleSignOut()">Sign Out</a>
    `;
    
    document.body.appendChild(menu);
    
    // Close menu when clicking outside
    setTimeout(() => {
        document.addEventListener('click', function closeMenu(e) {
            if (!menu.contains(e.target) && !document.getElementById('profile-button').contains(e.target)) {
                menu.remove();
                document.removeEventListener('click', closeMenu);
            }
        });
    }, 100);
}

// Handle sign out
function handleSignOut() {
    if (confirm('Are you sure you want to sign out?')) {
        // In a real application, you would handle the logout process here
        alert('Signing out...');
        // window.location.href = '/login';
    }
}

// Filter table based on search and filter inputs
function filterTable() {
    const searchTerm = searchInput ? searchInput.value.toLowerCase() : '';
    const departmentValue = departmentFilter ? departmentFilter.value : '';
    const statusValue = statusFilter ? statusFilter.value : '';
    const leaveTypeValue = leaveTypeFilter ? leaveTypeFilter.value : '';
    
    const filteredRequests = leaveRequests.filter(request => {
        const matchesSearch = request.employee.toLowerCase().includes(searchTerm) || 
                            request.department.toLowerCase().includes(searchTerm);
        const matchesDepartment = !departmentValue || request.department === departmentValue;
        const matchesStatus = !statusValue || request.status === statusValue;
        const matchesLeaveType = !leaveTypeValue || request.leaveType === leaveTypeValue;
        
        return matchesSearch && matchesDepartment && matchesStatus && matchesLeaveType;
    });
    
    renderTable(filteredRequests);
}

// Render table with leave requests
function renderTable(requests) {
    if (!tableBody) return;
    
    if (requests.length === 0) {
        tableBody.innerHTML = `
            <tr>
                <td colspan="7" style="text-align: center; padding: 40px; color: #6b7280;">
                    No leave requests found matching your criteria.
                </td>
            </tr>
        `;
        return;
    }
    
    tableBody.innerHTML = requests.map(request => `
        <tr>
            <td>
                <div class="employee-name">${request.employee}</div>
            </td>
            <td>${request.department}</td>
            <td>${request.leaveType}</td>
            <td>${formatDate(request.startDate)}</td>
            <td>${formatDate(request.endDate)}</td>
            <td>
                <span class="status-badge status-${request.status.toLowerCase()}">
                    ${request.status}
                </span>
            </td>
            <td>
                <div class="action-buttons">
                    ${request.status === 'Pending' ? `
                        <a href="#" class="action-btn" onclick="approveLeave(${request.id})">Approve</a>
                        <span class="action-separator">|</span>
                        <a href="#" class="action-btn reject" onclick="rejectLeave(${request.id})">Reject</a>
                    ` : `
                        <a href="#" class="action-btn" onclick="viewDetails(${request.id})">View Details</a>
                    `}
                </div>
            </td>
        </tr>
    `).join('');
}

// Format date for display
function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric'
    });
}

// Update summary cards
function updateSummaryCards() {
    const pendingCount = leaveRequests.filter(r => r.status === 'Pending').length;
    const approvedCount = leaveRequests.filter(r => r.status === 'Approved').length;
    const rejectedCount = leaveRequests.filter(r => r.status === 'Rejected').length;
    
    const pendingElement = document.querySelector('.pending-count');
    const approvedElement = document.querySelector('.approved-count');
    const rejectedElement = document.querySelector('.rejected-count');
    
    if (pendingElement) pendingElement.textContent = pendingCount;
    if (approvedElement) approvedElement.textContent = approvedCount;
    if (rejectedElement) rejectedElement.textContent = rejectedCount;
}

// Action functions for leave management
function approveLeave(id) {
    const request = leaveRequests.find(r => r.id === id);
    if (request && confirm(`Approve leave request for ${request.employee}?`)) {
        request.status = 'Approved';
        renderTable(leaveRequests);
        updateSummaryCards();
        showToast('Leave request approved successfully!', 'success');
    }
}

function rejectLeave(id) {
    const request = leaveRequests.find(r => r.id === id);
    if (request && confirm(`Reject leave request for ${request.employee}?`)) {
        request.status = 'Rejected';
        renderTable(leaveRequests);
        updateSummaryCards();
        showToast('Leave request rejected.', 'error');
    }
}

function viewDetails(id) {
    const request = leaveRequests.find(r => r.id === id);
    if (request) {
        alert(`Leave Details:\n\nEmployee: ${request.employee}\nDepartment: ${request.department}\nLeave Type: ${request.leaveType}\nStart Date: ${formatDate(request.startDate)}\nEnd Date: ${formatDate(request.endDate)}\nStatus: ${request.status}`);
    }
}

// Show toast notification
function showToast(message, type = 'info') {
    const toast = document.createElement('div');
    toast.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: ${type === 'success' ? '#10b981' : type === 'error' ? '#ef4444' : '#3b82f6'};
        color: white;
        padding: 12px 20px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        z-index: 1000;
        font-size: 14px;
        font-weight: 500;
        transform: translateX(100%);
        transition: transform 0.3s ease;
    `;
    toast.textContent = message;
    
    document.body.appendChild(toast);
    
    // Animate in
    setTimeout(() => {
        toast.style.transform = 'translateX(0)';
    }, 100);
    
    // Remove after 3 seconds
    setTimeout(() => {
        toast.style.transform = 'translateX(100%)';
        setTimeout(() => {
            if (toast.parentNode) {
                toast.parentNode.removeChild(toast);
            }
        }, 300);
    }, 3000);
}

// Handle window resize for responsive behavior
window.addEventListener('resize', function() {
    if (window.innerWidth > 768) {
        sidebar.classList.remove('active');
        const overlay = document.querySelector('.overlay');
        if (overlay) overlay.classList.remove('active');
    }
});

// Add additional CSS for status badges
const additionalStyles = `
    .status-pending {
        background-color: #fef3c7;
        color: #92400e;
    }
    
    .status-approved {
        background-color: #d1fae5;
        color: #065f46;
    }
    
    .status-rejected {
        background-color: #fee2e2;
        color: #991b1b;
    }
`;

// Inject additional styles
const styleSheet = document.createElement('style');
styleSheet.textContent = additionalStyles;
document.head.appendChild(styleSheet);