<?php 
include 'db_connect.php';
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}
$sql = "SELECT a.applicationid, a.firstname, a.lastname, a.resume, a.pds, a.tor, a.email, a.jobid, a.date_submitted, a.status FROM applications a";
$result = $conn->query($sql);
$email = '';
?>
<h3>Job Applications</h3>
<div class="applications-table-container">
    
    <table class="applications-table">
        <thead>
            <tr>
                <th>Applicant Name</th>
                <th>Position Applied</th>
                <th>Date Submitted</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): 
                $stmt = $conn->prepare("SELECT role FROM jobs WHERE jobid = ?");
                $stmt->bind_param("i", $row['jobid']);
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($role);
                $stmt->fetch();  
                $email = $row['email'];    
                ?>
                <tr>
                    <td>
                        <strong><?= htmlspecialchars($row['firstname']) .' '. htmlspecialchars($row['lastname']) ?></strong><br>
                        <span style="color: #888; font-size: 0.97rem;"><?= htmlspecialchars($row['email']) ?></span>
                    </td>
                    <td><?= htmlspecialchars($role) ?></td>
                    <td><?= date('F d, Y', strtotime($row['date_submitted'])) ?></td>
                    <td>
                        <?php
                        $status = strtolower($row['status']);
                        $badgeClass = 'status-badge ';
                        if ($status === 'new') $badgeClass .= 'status-new';
                        elseif ($status === 'in review') $badgeClass .= 'status-review';
                        elseif ($status === 'interviewing') $badgeClass .= 'status-interview';
                        elseif ($status === 'rejected') $badgeClass .= 'status-rejected';
                        else $badgeClass .= 'status-new';
                        ?>
                        <span class="<?= $badgeClass ?>"><?= htmlspecialchars($row['status']) ?></span>
                    </td>
                    <td>
                        <button class="view-btn" data-id="<?= $row['jobid'] ?>" data-pds="<?= htmlspecialchars($row['pds']) ?>" data-resume="<?= htmlspecialchars($row['resume']) ?>" data-tor="<?= htmlspecialchars($row['tor']) ?>" data-applicant="<?= htmlspecialchars($row['firstname']) .' '. htmlspecialchars($row['lastname']) ?>">View</button>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="5">No job applications found.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
<div class="modal-bg" id="modalBg">
    <div class="modal" id="modal">
        <button class="modal-close" id="modalClose">&times;</button>
        <h3 id="modalApplicant">Applicant Files</h3>
        <h4 class="email"><strong>Email:</strong> <?= $email?></h4>
        <div class="modal-files" id="modalFiles">

        </div>
    </div>
</div>
</body>