
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
            const prev = document.querySelector('[role="tab"][aria-selected="true"]');  
            const targetPage = [this.dataset.page];
            const tabName = [this.dataset.tabName];
            if(window.innerWidth <= 992){
              document.getElementById('sidebar').classList.remove('active');
              document.getElementById('overlay').classList.remove('active');
            }

            // Since employees tab has filters
            // Using ternary to set the filterParams to whatever employeefilters return value is
            // or blank
            const filterParams = tabName[0] === 'employees' ? getEmployeeFilters() : '';
            
            
            // Leavemanagement soon

            loadContent([targetPage], [tabName], filterParams);
            updateActiveTab(this);
      });
    });

    // Mobile menu toggle
  document.getElementById('mobileMenuToggle')?.addEventListener('click', toggleMobileMenu);

});

// Load content
async function loadContent(pageUrl, tabName, queryParams = '') {
  try {
      const oldCss = document.querySelector('link[data-tab-css]');
      if(oldCss) oldCss.remove();
      
      const oldScript = document.querySelector('script[data-tab-js]');
      if (oldScript) oldScript.remove();
     
      // Fetch request to server

      // Ternary for if queryParams has value set the value to the first statement or the second otherwise
      
    const fetchUrl = queryParams ? `${pageUrl[0]}?${queryParams}` : pageUrl[0] +'?' + pageUrl[1];
    console.log(fetchUrl);
    const response = await fetch(fetchUrl);
    // Get HTML content from response
    const html = await response.text();
    // Insert HTML into page
    document.getElementById('content-wrapper').innerHTML = html;

    // Load resources
    loadTabResources(tabName);
    if (pageUrl[0] === 'includes/jobs.php') {
       if (typeof initApplicationModal === 'function') {
        initApplicationModal();
      }
    }
  } catch (error) {
    // Error handling type shi
    console.error('Error loading content:', error);
    document.getElementById('content-container').innerHTML = '<p> Failed to load content</p>';
  }
}

// Loading css and JSe
function loadTabResources(tabName){

  // Prevent duplicate loading
  if (document.querySelector(`link[href="styles/${tabName[0]}.css"]`)) {
    console.log("IT RETURNED BECASUE SAME SAME");
    return;
  }
  if (document.querySelector(`script[src="script/${tabName[0]}.js"]`)){ 
    console.log("IT IS JUST RETURNED BECAUSE IT WASN'T REMOVED AND IS THE SAME CSS ANYWAYS");
    return;
  }

  // For that tab's css
  const cssLink = document.createElement('link');
  cssLink.rel = 'stylesheet';
  cssLink.href = `styles/${tabName}.css`;
  cssLink.setAttribute('data-tab-css', 'true');
  document.head.appendChild(cssLink);

  const jsScript = document.createElement('script');
  jsScript.src = `script/${tabName}.js`;
  jsScript.setAttribute('data-tab-js', 'true');
  jsScript.onload = () => {
    console.log(`${tabName} resources loaded`);
  }
  document.body.appendChild(jsScript);

}

// the updateActiveTab function:
function updateActiveTab(activeTab, currentPage = 1){
    // getting other tabs and disable  
    document.querySelectorAll('[role="tab"]').forEach(tab => {
        tab.setAttribute('aria-selected', 'false');
        tab.classList.remove('active')
    });

    // set the active tab active
    activeTab.setAttribute('aria-selected', 'true');
    activeTab.classList.add('active');

    // Updating url without reloading, tnx gpt
    const url = new URLSearchParams();
    url.set('tab', activeTab.dataset.page);
    // const tabName = activeTab.dataset.tabName;
    // Employees specialty back again
    // Leave management soon

    // If employees tab is selected, add possible filters
    if (activeTab.dataset.page === 'includes/employees.php') {
      console.log("ITS AN EMPLYOYEE TAB OH NO");
      const search = document.getElementById('searchInput')?.value.trim().toLowerCase() || '';
      const department = document.getElementById('department-filter')?.value || '';
      const status = document.getElementById('status-filter')?.value || '';
      const role = document.getElementById('role-filter')?.value || '';

      if (search) url.set('search', search);
      if (department) url.set('department', department);
      if (status) url.set('status', status);
      if (role) url.set('role', role);
      if(currentPage) url.set('page', currentPage);
    }

    history.pushState(null, '', `?${url.toString()}`);
}

function toggleMobileMenu() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    
      sidebar.classList.toggle('active');
      overlay.classList.toggle('active');

    if(overlay){
      overlay.addEventListener('click', () => {
        sidebar.classList.remove('active');
        overlay.classList.remove('active');
      })
    }
}

// SIGN OUT FUNCTION TYPE SHI
function profileDropDown(){
  const dropDown = document.getElementById('profile-drop-down');
  if(dropDown.style.display == 'block'){
    document.getElementById('profile-drop-down').style.display = 'none';
  } else{ 
    document.getElementById('profile-drop-down').style.display = 'block';
  }
}

function handleSignOut() {

  window.location.href = 'logout.php';
}

function getEmployeeFilters(){
  // 
  // const page = parseInt(document.getElementById('currentPage').textContent, 10)?.textContent || '0'; 
  const searchInput = document.getElementById('searchInput') 
  const search = searchInput? searchInput.value.trim().toLowerCase() : '';
  const department = document.getElementById('department-filter')?.value || '';
  const status = document.getElementById('status-filter')?.value || '';
  const role = document.getElementById('role-filter')?.value || '';

  const params = new URLSearchParams();
  if (search) params.set('search', search);
  if (department) params.set('department', department);
  if (status) params.set('status', status);
  if (role) params.set('role', role);
  
  // // Page
  // if (page) params.set('page', page)
  return params.toString();
}

function initApplicationModal() {
    document.querySelectorAll('.view-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.getElementById('modalApplicant').textContent = this.dataset.applicant + "'s Files";
            let filesHtml = '';
            if (this.dataset.pds) filesHtml += `<a href="../uploads/${this.dataset.pds}" target="_blank">Personal Data Sheet (PDS)</a>`;
            if (this.dataset.resume) filesHtml += `<a href="../uploads/${this.dataset.resume}" target="_blank">Resume</a>`;
            if (this.dataset.tor) filesHtml += `<a href="../uploads/${this.dataset.tor}" target="_blank">Transcript of Records (TOR)</a>`;
            if (!filesHtml) filesHtml = '<em>No files uploaded.</em>';
            document.getElementById('modalFiles').innerHTML = filesHtml;
            document.getElementById('modalBg').classList.add('active');
        });
    });
    document.getElementById('modalClose').onclick = function() {
        document.getElementById('modalBg').classList.remove('active');
    };
    document.getElementById('modalBg').onclick = function(e) {
        if (e.target === this) this.classList.remove('active');
    };
}