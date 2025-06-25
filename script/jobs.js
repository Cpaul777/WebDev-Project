document.querySelector('.accept-btn').addEventListener('click', function() {
    updateStatus('accepted');
});
document.querySelector('.reject-btn').addEventListener('click', function() {
    updateStatus('rejected');
});

function updateStatus(status) {
    var appid = document.getElementById('modalAppId').value;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'includes/jobs.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        if (xhr.responseText === 'success') {
            // Optionally update the badge in the table or reload
            alert('Successfully updated status')
            location.reload();
        } else {
            alert('Failed to update status.');
        }
    };
    xhr.send('applicationid=' + encodeURIComponent(appid) + '&status=' + encodeURIComponent(status));
}