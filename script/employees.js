
function employeeWord(){
    const urlParams = new URLSearchParams(location.search);
    const savedTab = urlParams.get('tab');
    const targetTab = document.querySelector(`[role="tab"][data-page="${savedTab}"]`);
    loadContent([savedTab], [targetTab.dataset.tabName]);
    
    };

function employeeListDetect(page = 1) {
    const activeTab = document.querySelector('[role="tab"][aria-selected="true"]');
    
    // const activeTab = document.querySelector('[role="tab"][aria-selected="true"]');
    // const params = new URLSearchParams();

    // // Add filters to URL
    // const search = document.getElementById('searchInput')?.value.trim().toLowerCase() || '';
    // const department = document.getElementById('department-filter')?.value || '';
    // const status = document.getElementById('status-filter')?.value || '';
    // const role = document.getElementById('role-filter')?.value || '';

    // if (search) params.set('search', search);
    // if (department) params.set('department', department);
    // if (status) params.set('status', status);
    // if (role) params.set('role', role);
    // params.set('page', page);
    // console.log(page);
    // console.log(params.toString());
    // loadContent(['includes/employees.php', params.toString()], ['employees']);
    // updateActiveTab(activeTab, page);
    // return false;

    const changePage = document.getElementById('currentPage');
    if(changePage) changePage.textContent = `${page}`;
    loadContent(['includes/employees.php', `${getEmployeeFilters()}&page=${page}`], ['employees']);
    updateActiveTab(activeTab, page);
        return false; //to prevent the default anchor behavior.

}


document.getElementById('searchInput')?.addEventListener('keypress', (event) => {
    if(event.key === "Enter"){
        console.log("Search function");
        const filterParams = getEmployeeFilters();
        const activeTab = document.querySelector('[role="tab"][aria-selected="true"]');
        loadContent(['includes/employees.php'], ['employees'], filterParams);
        updateActiveTab(activeTab);
    }
});

document.getElementById('department-filter')?.addEventListener('change', () => {
  const filterParams = getEmployeeFilters();
  const activeTab = document.querySelector('[role="tab"][aria-selected="true"]');
  console.log(filterParams);
  loadContent(['includes/employees.php'], ['employees'], filterParams);
  updateActiveTab(activeTab);
});

document.getElementById('role-filter')?.addEventListener('change', () => {
  const filterParams = getEmployeeFilters();
  const activeTab = document.querySelector('[role="tab"][aria-selected="true"]');
  loadContent(['includes/employees.php'], ['employees'], filterParams);
  updateActiveTab(activeTab);
});