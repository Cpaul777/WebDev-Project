// Make sure that html is loaded
document.addEventListener('DOMContentLoaded', () => {

    // Load the default content to be shown
    loadContent('includes/dashboard.php');

    // Get all tabs
    const tabs = document.querySelectorAll('[role="tab"]');

    // function for the tabs when clicked
    tabs.forEach(tab => {
        tab.addEventListener('click', function(e){
            e.preventDefault();

            const targetPage = this.dataset.page;

            loadContent(targetPage);

            updateActiveTab(this);
            
        });

    });
});

async function loadContent(pageUrl) {
  try {
    // Fetch request to server
    const response = await fetch(pageUrl);
    
    // Get HTML content from response
    const html = await response.text();
    
    // Insert HTML into page
     document.getElementById('content-wrapper').innerHTML = html;
  } catch (error) {
    // Error handling type shi
    console.error('Error loading content:', error);
    document.getElementById('content-container').innerHTML = '<p> Failed to load content</p>';
  }
}

// the updateActiveTab function:
function updateActiveTab(activeTab){
    // getting other tabs and disable  
    document.querySelectorAll('[role="tab"]').forEach(tab => {
        tab.setAttribute('aria-selected', 'false');
        tab.classList.remove('active')
    });

    // set the active tab active
    activeTab.setAttribute('aria-selected', 'true');
    activeTab.classList.add('active');

    // Updating url without reloading, tnx gpt
    history.pushState(null, '', `?tab=${activeTab.dataset.page}`);
}




// document.querySelectorAll('.tab-btn').forEach(link => {
//     link.addEventListener('click', function(e) {
//         e.preventDefault();
    

//     const page = this.dataset.page;
//     loadContent(page);

//     // Update active tab
//     document.querySelectorAll('.tab-btn').forEach(a => a.classList.remove('active'));
//     this.classList.add('active');
//   });
// });

// loadContent('dashboard.php')