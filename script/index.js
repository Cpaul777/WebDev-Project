// Make sure that html is loaded
document.addEventListener('DOMContentLoaded', () => {
 
   // Load the default content to be shown
  loadContent(['includes/dashboard.php', 'dashboard']);
    // Get all tabs
    const tabs = document.querySelectorAll('[role="tab"]');

    // function for the tabs when clicked
    tabs.forEach(tab => {
        tab.addEventListener('click', function(e){
            e.preventDefault();

            const targetPage = [this.dataset.page];
            const tabName = [this.dataset.tabName];

            loadContent(targetPage, tabName);
            updateActiveTab(this);
            
        });

    });

    // Mobile menu toggle
  document.getElementById('mobileMenuToggle')?.addEventListener('click', toggleMobileMenu);

});



// Load content
async function loadContent(pageUrl, tabName) {
  try {

    const oldCss = document.querySelector('link[data-tab-css]');
    if(oldCss) oldCss.remove();
    const oldScript = document.querySelector('script[data-tab-js]');
    if (oldScript) oldScript.remove();

    if(tabName) loadTabResources(tabName);

    // Fetch request to server
    const response = await fetch(pageUrl[0]+"?"+pageUrl[1]+"="+pageUrl[2]);
    
    // Get HTML content from response
    const html = await response.text();
    
    // Insert HTML into page
     document.getElementById('content-wrapper').innerHTML = html;

    //  Load tab specfici css/js
    loadTabResources(tabName);

  } catch (error) {
    // Error handling type shi
    console.error('Error loading content:', error);
    document.getElementById('content-container').innerHTML = '<p> Failed to load content</p>';
  }
}

// Loading css and JS
function loadTabResources(tabName){
  // For that tab's css
  const cssLink = document.createElement('link');
  cssLink.rel = 'stylesheet';
  cssLink.href = `styles/${tabName}.css`;
  cssLink.setAttribute('data-tab-css', 'true');
  document.head.appendChild(cssLink);

  //For that tab's JS
  const jsScript = document.createElement('script');
  jsScript.src = `script/${tabName}.js`;
  jsScript.setAttribute('data-tab-js', 'true');
  document.body.appendChild(jsScript);

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

function toggleMobileMenu() {
    const sidebar = document.querySelector('.side-bar');
    sidebar.classList.toggle('active');
    
    // Handle overlay
    let overlay = document.querySelector('.overlay');
    if (!overlay) {
        overlay = document.createElement('div');
        overlay.className = 'overlay';
        document.body.appendChild(overlay);
        overlay.addEventListener('click', () => {
            sidebar.classList.remove('active');
            overlay.remove();
        });
    }
}

// mine