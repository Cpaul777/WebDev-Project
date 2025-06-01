// Make sure that html is loaded
document.addEventListener('DOMContentLoaded', () => {

  // Get all tabs
  const tabs = document.querySelectorAll('[role="tab"]');

   // Check for saved tab state
  const urlParams = new URLSearchParams(location.search);
  const savedTab = urlParams.get('tab');
  
  if (savedTab) {
    const targetTab = document.querySelector(`[role="tab"][data-page="${savedTab}"]`);
    if (targetTab) {
      // Activate saved tab
      console.log(targetTab);
      loadContent([savedTab], [targetTab.dataset.tabName]);
      updateActiveTab(targetTab);
    }
  } else {
    loadContent(['includes/dashboard.php'], ['dashboard']);
  }

  // function for the tabs when clicked
    tabs.forEach(tab => {
        tab.addEventListener('click', function(e){
            e.preventDefault();

            const targetPage = [this.dataset.page];
            const tabName = [this.dataset.tabName];
            
            loadContent([targetPage], [tabName]);
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

    // Fetch request to server
    const response = await fetch(pageUrl[0]+"?"+pageUrl[1]+"="+pageUrl[2]);
    console.log(response);
    // Get HTML content from response
    const html = await response.text();
    
    // Insert HTML into page
    document.getElementById('content-wrapper').innerHTML = html;

    // Load resources
    loadTabResources(tabName);
  } catch (error) {
    // Error handling type shi
    console.error('Error loading content:', error);
    document.getElementById('content-container').innerHTML = '<p> Failed to load content</p>';
  }
}

// Loading css and JSe
function loadTabResources(tabName){
  // Prevent duplicate loading

  console.log(tabName);
  if (document.querySelector(`link[href="styles/${tabName}.css"]`)) return;
  if (document.querySelector(`script[src="script/${tabName}.js"]`)) return;

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
    const tabName = activeTab.dataset.tabName;
    console.log(tabName);
    history.pushState(null, '', `?tab=${activeTab.dataset.page}&tabName=${tabName}`);
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

// SIGN OUT FUNCTION TYPE SHI
function profileDropDown(){
  console.log("It entered here");
  const dropDown = document.getElementById('profile-drop-down');
  if(dropDown.style.display == 'block'){
    console.log("IT entered the firt if")
    document.getElementById('profile-drop-down').style.display = 'none';
  } else{ 
    document.getElementById('profile-drop-down').style.display = 'block';
  }
}

function handleSignOut() {
  window.location.href = 'includes/login.php';
}



