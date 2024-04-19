$(document).ready(function() {
    function showNavbar(toggleId, navId, bodyId, headerId) {
        const toggle = $('#' + toggleId);
        const nav = $('#' + navId);
        const bodyPd = $('#' + bodyId);
        const headerPd = $('#' + headerId);

        // Validate that all variables exist
        if (toggle.length && nav.length && bodyPd.length && headerPd.length) {
            toggle.click(function() {
                // show navbar
                nav.toggleClass('show');
                // change icon
                toggle.toggleClass('bx-x');
                // add padding to body
                bodyPd.toggleClass('body-pd');
                // add padding to header
                headerPd.toggleClass('body-pd');
            });
        }
    }

    showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header');

    /*===== LINK ACTIVE =====*/
    const linkColor = $('.nav_link');

    function colorLink() {
        if (linkColor.length) {
            linkColor.removeClass('active');
            $(this).addClass('active');
        }
    }

    linkColor.click(colorLink);
});
