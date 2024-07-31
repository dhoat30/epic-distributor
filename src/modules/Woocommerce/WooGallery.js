const $ = jQuery
class WooGallery {
    constructor() {
        this.$largeImageContainer = $('.single .product-main-image');
        if (this.$largeImageContainer.length) {
            this.$largeImage = this.$largeImageContainer.find('img');
            this.$largeSource = this.$largeImageContainer.find('source');

            // zoom effect 

            if (this.$largeImage.length && window.matchMedia('(min-width: 1250px)').matches) {
                this.zoomer = this.$largeImageContainer.find('img');
                this.initializeEvents();
            }
        }
    }

    initializeEvents() {
        this.bindGalleryImageClicks();
        this.bindVariationChanges();
        // this.bindLargeImageContainerClick();
        this.$largeImage.on({
            'mousemove touchmove': (e) => this.zoom(e),
            'mouseleave': (e) => this.resetImage(e)
        });
    }

    bindGalleryImageClicks() {
        const $galleryImages = $('.single .gallery li img');
        $galleryImages.on('click', (event) => {


            const largeImageSrc = $(event.currentTarget).data('large_image');
            console.log(largeImageSrc);
            this.replaceImage(largeImageSrc);
        });
    }

    bindVariationChanges() {
        $('.variations_form').on('change', '.variations select', (event) => {
            // Extract the current variations data
            const variationData = $(event.currentTarget).closest('form').data('product_variations');
            if (!Array.isArray(variationData)) {
                // console.log('Variation data is not an array:', variationData);
                return; // Exit the function if not array
            }
            const selectedOptions = {};
            $('.variations select').each(function () {
                selectedOptions[$(this).data('attribute_name')] = $(this).val();
            });
            // Find matching variation
            const matchedVariation = variationData.find(variation => {
                return Object.entries(selectedOptions).every(([key, value]) => variation.attributes[key] === value);
            });
            if (matchedVariation && matchedVariation.image && matchedVariation.image.src) {
                this.replaceImage(matchedVariation.image.src);
            }
        });

    }

    bindLargeImageContainerClick() {
        this.$largeImageContainer.on('click', () => {
            this.$largeImageContainer.fadeOut();
        });
    }


    replaceImage(imageSrc, imageSrcset) {
        this.$largeImageContainer.fadeIn();
        this.$largeImage.attr('src', imageSrc).on('load', () => {
            this.$largeImage.show();
        });
        this.$largeSource.attr('srcset', imageSrc);
    }

    // zoom effect 
    zoom(e) {
        var offsetX, offsetY;
        if (e.offsetX) {
            offsetX = e.offsetX;
            offsetY = e.offsetY;
        } else {
            offsetX = e.touches[0].pageX - this.zoomer.offset().left;
            offsetY = e.touches[0].pageY - this.zoomer.offset().top;
        }
        var x = offsetX / this.zoomer.width() * 100;
        var y = offsetY / this.zoomer.height() * 100;
        this.$largeImage.css({
            transform: `scale(1.3) translate(${-x}px, ${-y}px)`
        });
    }

    resetImage(e) {
        this.zoomer.css('transform', '');
    }
}

export default WooGallery;
