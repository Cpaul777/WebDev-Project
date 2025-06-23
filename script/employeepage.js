document.addEventListener('DOMContentLoaded', function () { 
    function getTab(){
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get('tab');
    }

    function setActiveTab(tab) {
        const url = new URL(window.location.href);
        url.searchParams.set('tab', tab);
        history.pushState({}, '', url);
    }

    function showTab(tabId){
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.remove('active');
        });

        const activeTab = document.getElementById(tabId);
        if (activeTab) {
            activeTab.classList.add('active');
        }
    }

    function tabBtn(tabId){
        document.querySelectorAll('.tab').forEach(tab => {
            tab.classList.remove('active');
        });

        const activeTab = document.querySelector(`[data-tab="${tabId}"]`);
        if (activeTab) {
            activeTab.classList.add('active');
        }
    }

    const currentTab = getTab();
    if(currentTab) {
        showTab(currentTab);
        tabBtn(currentTab);
    };

    document.querySelectorAll('.tab').forEach(link => {
        link.addEventListener('click', function (e) {
        e.preventDefault();
        const tab = this.dataset.tab;
        setActiveTab(tab);
        showTab(tab);
        tabBtn(tab);
        });
    });

    window.addEventListener('popstate', () => {
        const tab = getTabFromURL();
        showTab(tab);
        tabBtn(tab.dataset.tab);
    });

});
