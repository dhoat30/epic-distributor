// const $ = jQuery
// class Optimization {
//     constructor() {

//         // this.bindEvents();

//     }
//     bindEvents() {
//         this.singleProductPage()
//         // Variable to ensure the function only gets called once when passing 200px
//         let hasScrolledPast200px = false;

//         window.addEventListener('scroll', function () {
//             const scrollPosition = window.pageYOffset || document.documentElement.scrollTop;
//             // Check if scrolled past 200 pixels and function has not yet been called
//             if (scrollPosition > 200 && !hasScrolledPast200px) {
//                 this.singleProductLPageLoop();
//                 hasScrolledPast200px = true;  // Ensure function is not called repeatedly after passing 200px
//             }
//         }.bind(this));

//         // product archive page skelton
//         this.productArchiveSkelton()
//         // product archive page skelton 
//         $(document).on("click", ".webduel-loop-wrapper", this.productArchiveSkelton)

//         $(document).on("keyup", ".facetwp-search", this.productArchiveSkeltonSearch)


//     }
//     singleProductPage() {
//         // check if the device is mobile or desktop 
//         let timeOut
//         if ($(window).width() < 600) {
//             timeOut = 1000
//         } else {
//             timeOut = 1000
//         }
//         setTimeout(() => {
//             $('.single .product-images .skeleton').hide()
//             $('.single .product-images img').show()
//         }, timeOut)
//     }
//     singleProductLPageLoop() {
//         console.log("single product loop")
//         const images = document.querySelectorAll('.single ul.products li.product img');

//         $('.product .skeleton').hide()
//         images.forEach(image => {
//             image.style.display = 'block';
//         });


//     }
//     productArchiveSkelton() {
//         // const images = document.querySelectorAll('.archive ul.products li.product img');
//         setTimeout(() => {
//             $('.product .skeleton').hide()

//         }, 1000)
//     }
//     productArchiveSkeltonSearch() {
//         // const images = document.querySelectorAll('.archive ul.products li.product img');
//         setTimeout(() => {
//             $('.product .skeleton').hide()

//         }, 3000)
//     }
// }
// export default Optimization;


// console.log(images);
// images.forEach((image) => {
//     console.log('Adding skeleton...');
//     const skeleton = document.createElement('div');
//     skeleton.className = 'skeleton';
//     image.parentNode.appendChild(skeleton);
//     image.onload = function () {
//         console.log('Image loaded!');
//         image.classList.add('loaded');
//         const skeleton = image.parentNode.querySelector('.skeleton');
//         if (skeleton) {
//             console.log('Removing skeleton...');
//             skeleton.remove();
//         }
//     };
// });

// const images = document.querySelectorAll('.products .woocommerce-loop-product__link img');

// images.forEach((image) => {
//     const src = image.getAttribute('data-src'); // get the data-src attribute
//     console.log('Adding skeleton...');
//     const skeleton = document.createElement('div');
//     skeleton.className = 'skeleton';
//     image.parentNode.appendChild(skeleton);
//     image.src = src; // replace the src attribute with the data-src value
//     image.onload = function () {
//         console.log('Image loaded!');
//         image.classList.add('loaded');
//         const skeleton = image.parentNode.querySelector('.skeleton');
//         if (skeleton) {
//             console.log('Removing skeleton...');
//             skeleton.remove();
//         }
//     };
// });



window.addEventListener('load', function () {
    // Check if .hero-slider .card-list exists
    if (document.querySelector('.hero-slider .card-list')) {
        // On thumbnail click, change the main image src

        setTimeout(() => {
            document.querySelector('.hero-slider .card-list').style.display = 'block';
        }, 0);
        setTimeout(() => {
            document.querySelector('.hero-slider .skeleton').style.display = 'none';
        }, 3000);
    }
});