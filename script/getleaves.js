document.getElementById('searchInput')?.addEventListener('keypress', (event) => {
    if(event.key === "Enter"){
        console.log("Search function");
        const filterParams = getEmployeeFilters();
        const activeTab = document.querySelector('[role="tab"][aria-selected="true"]');
        loadContent(['includes/getleaves.php'], ['getleaves'], filterParams);
        updateActiveTab(activeTab);
    }
});

document.getElementById('department-filter')?.addEventListener('change', () => {
  const filterParams = getEmployeeFilters();
  const activeTab = document.querySelector('[role="tab"][aria-selected="true"]');
  console.log(filterParams);
  loadContent(['includes/getleaves.php'], ['getleaves'], filterParams);
  updateActiveTab(activeTab);
});

document.getElementById('leavetype-filter')?.addEventListener('change', () => {
  const filterParams = getEmployeeFilters();
  const activeTab = document.querySelector('[role="tab"][aria-selected="true"]');
  loadContent(['includes/getleaves.php'], ['getleaves'], filterParams);
  updateActiveTab(activeTab);
});