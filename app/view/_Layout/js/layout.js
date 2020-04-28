const __ToastSwal = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});

/**
 * Method toast
 * Show toast swall in right top
 * @param {string} type default info. info | warning | success | error | question 
 * @param {string} message 
 * @param {string} toast_ default swal. swal | default
 */
function toast(type = 'info', message = '', toast_ = 'swal') {
    if(toast_ == 'swal') {
        __ToastSwal.fire({
            type: type,
            title: message
        });
    }
    else {
        switch (type.toLowerCase()) {
            case 'info':
                toastr.info(message);
                break;

            case 'success':
                toastr.success(message);
                break;

            case 'error':
                toastr.error(message);
                break;

            case 'warning':
                toastr.warning(message);
                break;
        
            default:
                toastr.info(message);
                break;
        }
    }
}

function loading() {

}

/**
 * Method loadingButton
 * Make button disable and show loading animation
 * @param {object} buttonSelector
 * @param {boolean} isLoading default is true
 */
function loadingButton(buttonSelector, isLoading = true) {
    if(isLoading) {
        const node = document.createElement("SPAN");
        const role = document.createAttribute("role");
        const ariaHidden = document.createAttribute("aria-hidden");

        role.value = "status";
        ariaHidden.value = "true";
        
        node.className = 'spinner-grow spinner-grow-sm';
        node.setAttributeNode(role);
        node.setAttributeNode(ariaHidden);

        buttonSelector.disabled = true;
        buttonSelector.appendChild(node);    

        return;
    }
    
    buttonSelector.disabled = false;
    buttonSelector.removeChild(buttonSelector.children[0]);
}

/**
 * Method setSidebar
 */
function setSidebar() {
    if(!SIDEBAR_LIST || SIDEBAR_LIST.length < 1) {
        return;
    }

    const _siteUrl = SITE_URL.substring(0, (SITE_URL.length-1));
    const sidebar = document.querySelector('#__sidebar');
    SIDEBAR_LIST.forEach(item => {
        const isActive = window.location.href == (_siteUrl+item.router) ? true : false;
        const liClassName = isActive ? 'nav-item menu-open' : 'nav-item';
        const aClassName = isActive ? 'nav-link active' : 'nav-link';
        const icon = (!item.icon || item.icon.trim() == '') ? 'far fa-circle' : item.icon;
        let li = document.createElement('li');
        li.className = liClassName;
        let liValue =   `<a href="${_siteUrl}${item.router}" class="${aClassName}">` +
                                `<i class="nav-icon ${icon}"></i>` +
                                `<p>${item.title}</p></a>`;
        li.innerHTML = liValue;
        sidebar.appendChild(li);
    });
}

/**
 * 
 */
function getActiveSidebar() {

}

/**
 * Method goBack
 * Go to previous page
 */
function goBack() {
    window.history.go(-1);
}

export {goBack, toast, loading, loadingButton, setSidebar};