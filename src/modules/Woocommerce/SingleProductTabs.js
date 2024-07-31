const $ = jQuery

class SingleProductTabs {
    constructor() {


        this.accordionEvents()

    }
    tabEvents(e) {

        $('.tab-links a').on('click', function (e) {
            e.preventDefault();

            var currentAttrValue = $(this).attr('href');

            // Show/Hide Tabs
            $('.tab').removeClass('active');
            $('.tab-links .tab-link-wrapper').removeClass('active');
            $(this).parent('.tab-link-wrapper').addClass('active');
            $(currentAttrValue).addClass('active');
        });
    }
    accordionEvents() {
        $('.product-accordion .tab-link-wrapper a').on('click', function (e) {
            e.preventDefault(); // Prevent the default anchor behavior
            const targetContent = $(e.target).parent('.tab-link-wrapper').siblings('.tab-content');
            // console.log(targetContent)
            // toggle class on $target content 
            $(targetContent).toggleClass('active');

            const $parentLink = $(e.target).parent('.tab-link-wrapper');

            // Toggle active class on tab link wrappers
            $parentLink.toggleClass('active')


        });
    }
}
export default SingleProductTabs;