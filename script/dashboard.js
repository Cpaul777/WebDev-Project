// Modal functions
function showModal() {
    document.getElementById('modalDetails').style.display = 'flex';
    
}

function closeModal() {
    document.getElementById('modalDetails').style.display = 'none';
}

window.addEventListener('click', function(event) {
    const modal = document.getElementById('modalDetails');
    if (event.target === modal) {
        closeModal();
    }
});

// Close with Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeModal();
    }
});

function employeePage(){
    let url = new URL(window.location.href);
    url.searchParams.set('tab', 'includes/getleaves.php');
    window.location.href = url.href;
}