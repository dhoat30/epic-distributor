const $ = jQuery;

class DesktopMenu {
    constructor(menuSelector) {
        this.menu = $(menuSelector);
        if (window.matchMedia('(min-width: 1300px)').matches) {
            this.initEvents();
        }
    }

    initEvents() {
        // Attach mouseenter and mouseleave to first-level menu items to handle first to second level interactions
        this.menu.find('> li.menu-item-has-children').mouseenter(this.handleMouseEnter.bind(this));
        this.menu.find('> li.menu-item-has-children').mouseleave(this.handleMouseLeave.bind(this));

        // Attach mouseenter and mouseleave to second-level menu items to handle second to third level interactions
        this.menu.find('> li.menu-item-has-children > ul > li.menu-item-has-children').mouseenter(this.handleSecondLevelMouseEnter.bind(this));
        this.menu.find('> li.menu-item-has-children > ul > li.menu-item-has-children').mouseleave(this.handleSecondLevelMouseLeave.bind(this));

        // Optionally keep the document click to close all submenus when clicking outside
        // $(document).on('click', this.handleOutsideClick.bind(this));
    }

    handleMouseEnter(e) {
        var $currentTarget = $(e.currentTarget);
        var $submenu = $currentTarget.children('ul.sub-menu');
        // Show submenu
        $submenu.addClass('show-mega-menu');

    }

    handleMouseLeave(e) {
        var $currentTarget = $(e.currentTarget);
        var $submenu = $currentTarget.children('ul.sub-menu');
        // Hide submenu
        $submenu.removeClass('show-mega-menu');
    }

    handleSecondLevelMouseEnter(e) {
        e.stopPropagation(); // Stop the event from bubbling up to parent li
        var $currentTarget = $(e.currentTarget);
        var $submenu = $currentTarget.children('ul.sub-menu');

        // Show submenu
        $submenu.stop(true, true).slideDown();
    }

    handleSecondLevelMouseLeave(e) {
        // e.stopPropagation(); // Stop the event from bubbling up to parent li
        var $currentTarget = $(e.currentTarget);
        var $submenu = $currentTarget.children('ul.sub-menu');


        $submenu.stop(true, true).slideUp('fast');
    }

    handleOutsideClick(e) {
        if (!$(e.target).closest(this.menu).length) {
            // Close all submenus
            this.menu.find('ul.sub-menu').slideUp('fast');
            this.menu.find('li.menu-item-has-children').removeClass('submenu-opened arrow-rotated');
        }
    }
}

export default DesktopMenu;
