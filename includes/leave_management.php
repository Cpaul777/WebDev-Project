<div class="tab-content leave_management-tab" id="leave_management-panel" role="panel">
    <div class="content-container" >
        <h2 class="section-title">Leave Management</h2>

        <div class="summary-cards">
            <div class="summary-card">
            <h3>Pending Leaves</h3>
            <p class="count pending-count">9</p>
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

        <div class="approval-section">
            <div class="section-header">
            <h3>Leaves for Approval</h3>

            <div class="filters">
                <div class="search-container">
                <i class="bi bi-search"></i>
                <input
                    type="text"
                    id="searchInput"
                    placeholder="Search by employee name or department"
                    class="search-input">
                </div>

                <div class="filter-controls">
                <select id="departmentFilter" class="filter-select">
                    <option value="">All Departments</option>
                    <option value="Administration">Administration</option>
                    <option value="Legislative">Legislative</option>
                    <option value="Sangguniang Kabataan">Sangguniang Kabataan</option>
                    <option value="Public Safety">Public Safety</option>
                    <option value="Health and Social Services">Health and Social Services</option>
                    <option value="Maintenance / Public works">Maintenance / Public works</option>
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
                    <option value="Maternity Leave">Maternity Leave</option>
                    <option value="Paternity Leave">Paternity Leave</option>
                    <option value="Special Leave benefits for women">Special Leave benefits for women</option>
                    <option value="Unpaid Leave">Unpaid Leave</option>
                </select>
                </div>
            </div>
            </div>

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
                </tbody>
            </table>
            </div>
        </div>
        </div>
</div>