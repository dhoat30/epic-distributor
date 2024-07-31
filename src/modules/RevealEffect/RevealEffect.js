const $ = jQuery

class RevealEffect {
    constructor() {
        this.initEvents()
    }
    initEvents() {
        $('.term-description').each(function () {
            var description = $(this);
            var seeMoreButton = $('<a href="#" class="see-more">See more</a>');
            description.after(seeMoreButton);
            seeMoreButton.on('click', function () {
                description.toggleClass('expanded');
                if (description.hasClass('expanded')) {
                    seeMoreButton.text('See less');
                } else {
                    seeMoreButton.text('See more');
                }
            });
        });
    }
}

export default RevealEffect