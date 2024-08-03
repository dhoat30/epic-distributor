<?php
/**
 * @snippet       Product Images @ Woo Checkout
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 5
 * @community     https://businessbloomer.com/club/
 */
  
add_filter( 'woocommerce_cart_item_name', 'bbloomer_product_image_review_order_checkout', 9999, 3 );
  
function bbloomer_product_image_review_order_checkout( $name, $cart_item, $cart_item_key ) {
    if ( ! is_checkout() ) return $name;
    $product = $cart_item['data'];
    $thumbnail = $product->get_image( array( '80', '80' ), array( 'class' => 'alignleft' ) );
    return $thumbnail . $name;
}

// disable autocomplete on checkout page --------------------------------------------
function disable_autocomplete_checkout_address_fields( $fields ) {
    $fields['billing']['billing_address_1']['autocomplete'] = 'new-password';
    $fields['shipping']['shipping_address_1']['autocomplete'] = 'new-password';
    return $fields;
}
add_filter( 'woocommerce_checkout_fields', 'disable_autocomplete_checkout_address_fields' );

function inject_disable_autocomplete_address_script() {
    if (is_checkout()) {
        ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    function setAddressAutocompleteAttributes() {
        var addressFields = ['billing_address_1', 'shipping_address_1'];
        addressFields.forEach(function(fieldId) {
            var field = document.getElementById(fieldId);
            if (field) {
                field.setAttribute('autocomplete', 'new-password');
                var dummyField = document.createElement('input');
                dummyField.setAttribute('type', 'text');
                dummyField.setAttribute('style', 'display:none;');
                dummyField.setAttribute('autocomplete', 'new-password');
                field.parentNode.insertBefore(dummyField, field.nextSibling);
            }
        });
    }

    // Initial call to set attributes
    setAddressAutocompleteAttributes();

    // Reapply attributes after other scripts may have modified the field
    window.addEventListener('load', setAddressAutocompleteAttributes);
});
</script>
<?php
    }
}
add_action('wp_footer', 'inject_disable_autocomplete_address_script');


// address finder --------------------------------------------------------------------------
function enqueue_google_places_api() {
    if (is_checkout()) {
        ?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGjnGY3z6E7dxxPUBh_7V4PMW6fbbzRF0&libraries=places">
</script>
<?php
    }
}
add_action('wp_head', 'enqueue_google_places_api');

function add_google_places_autocomplete() {
    if (is_checkout()) {
        ?>
<script>
console.log("checkout page")
document.addEventListener('DOMContentLoaded', function() {
    document.addEventListener('DOMContentLoaded', function() {
        function initializeAutocomplete() {
            var addressFields = ['billing_address_1', 'shipping_address_1'];

            addressFields.forEach(function(field) {
                var input = document.getElementById(field);
                console.log(input)
                if (input) {
                    var autocomplete = new google.maps.places.Autocomplete(input, {
                        types: ['address']
                    });
                    autocomplete.setFields(['address_component']);
                    autocomplete.addListener('place_changed', function() {
                        var place = autocomplete.getPlace();
                        var address1 = '';
                        var postcode = '';
                        var city = '';
                        var region = ''; // Updated variable name
                        console.log(place)
                        for (var i = 0; i < place.address_components.length; i++) {
                            var component = place.address_components[i];
                            var addressType = component.types[0];

                            if (addressType == 'street_number') {
                                address1 = component.long_name;
                            }
                            if (addressType == 'route') {
                                address1 += ' ' + component.long_name;
                            }
                            if (addressType == 'postal_code') {
                                postcode = component.long_name;
                            }
                            if (addressType == 'locality') {
                                city = component.long_name;
                            }
                            // Check both administrative_area_level_1 and administrative_area_level_2 for regions
                            if (addressType == 'administrative_area_level_1' ||
                                addressType ==
                                'administrative_area_level_2') {
                                region = component.long_name;
                            }
                        }
                        console.log(region)

                        document.getElementById(field).value = address1;
                        if (document.getElementById(field.replace('address_1',
                                'postcode'))) {
                            document.getElementById(field.replace('address_1',
                                    'postcode')).value =
                                postcode;
                        }
                        if (document.getElementById(field.replace('address_1',
                            'city'))) {
                            document.getElementById(field.replace('address_1', 'city'))
                                .value =
                                city;
                        }
                        // Update the region select field
                        var regionSelect = document.getElementById(field.replace(
                            'address_1',
                            'state'));
                        if (regionSelect) {
                            for (var i = 0; i < regionSelect.options.length; i++) {
                                if (regionSelect.options[i].text.toLowerCase() ===
                                    region
                                    .toLowerCase()) {
                                    regionSelect.selectedIndex = i;
                                    break;
                                }
                            }
                            jQuery(regionSelect).trigger(
                            'change'); // For Select2 support
                        }
                    });
                } else {
                    console.error(field + ' input element not found.');
                }
            });
        }
        initializeAutocomplete();
    });
});
</script>
<?php
    }
}
add_action('wp_footer', 'add_google_places_autocomplete');