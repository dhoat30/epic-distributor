const $ = jQuery;

class FacetFilter {
    constructor() {
        // mobile and desktop filter show/hide
        this.closeButton = $('.close-icon');
        // desktop filter show 
        this.filterButton = $('.bottom-nav-bar .Filter');
        // facet label button
        this.labelButton = $('.facet-label-button');
        this.events();
    }

    events() {
        // Set cookie to false every page load to hide the facet container 
        Cookies.set('showingProductFacetContainer', 'false');

        // Show filter container
        this.filterButton.on('click', this.showFilterWrapper.bind(this));

        // Hide filter container
        this.closeButton.on('click', this.hideFilterWrapper.bind(this));
        $('.dark-overlay').on('click', this.hideFilterWrapper.bind(this));

        // Ensure events are bound for the initial load
        this.bindFilterEvents();

        // Rebind after FacetWP updates
        $(document).on('facetwp-loaded', this.bindFilterEvents.bind(this));
    }

    // Show desktop filter container on button click
    showFilterWrapper() {
        $('.dark-overlay').toggle();
        $('.filter-wrapper').toggleClass('show');

        // Add a small delay to ensure elements are interactive
        setTimeout(() => {
            // Rebind events for checkboxes
            this.bindFilterEvents();

            // Re-initialize FacetWP
            FWP.refresh();
        }, 100); // Adjust delay as needed
    }

    hideFilterWrapper() {
        $('.filter-wrapper').removeClass('show');
        $('.dark-overlay').hide();
    }

    bindFilterEvents() {
        // Unbind previous events to avoid duplicate bindings
        $(document).off('click', '.facetwp-checkbox input[type="checkbox"]');

        // Bind click event for checkboxes
        $(document).on('click', '.facetwp-checkbox input[type="checkbox"]', function (event) {
            const checkbox = $(this);
            console.log('Checkbox clicked:', checkbox.val());
            console.log('Checkbox state:', checkbox.prop('checked'));
            // Trigger FacetWP to refresh
            FWP.refresh();
        });
    }
}

export default FacetFilter;