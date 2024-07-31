<?php 
// add product resources
add_action('woocommerce_after_single_product', 'webduel_product_resources', 50);
function webduel_product_resources(){ 
    global $product; 
    $brochure = get_field('brochure', $product->get_id()); 
    $informationSheet = get_field('information_sheet', $product->get_id()); 
    $userManual = get_field('user_manual', $product->get_id()); 
    if(!$brochure || !$informationSheet || !$userManual) return;
    ?>
<section class="resources-section row-container">
    <div class="container">
        <h2 class="title h3">Resources</h2>
        <div class="resources-wrapper">
            <?php 
        if($brochure){ 
            pdf_file_html($brochure['url'], $brochure['filesize'], "Brochure"); 
        }
        
        if($informationSheet){ 
            pdf_file_html($informationSheet['url'], $informationSheet['filesize'], "Information Sheet"); 
        }
        if($userManual){ 
            pdf_file_html($userManual['url'], $userManual['filesize'], "User Manual"); 
        }
        ?>
        </div>
    </div>
</section>
<?php 

}
function pdf_file_html($fileUrl, $fileSize, $title){ 
;
    ?>
<div class="resource">
    <div class="h4"><?php echo $title; ?></div>
    <div class="pdf-wrapper">
        <svg height="70px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
            id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;"
            xml:space="preserve">
            <g>
                <g>
                    <path
                        d="M494.479,138.557L364.04,3.018C362.183,1.09,359.621,0,356.945,0h-194.41c-21.757,0-39.458,17.694-39.458,39.442v137.789    H44.29c-16.278,0-29.521,13.239-29.521,29.513v147.744C14.769,370.761,28.012,384,44.29,384h78.787v88.627    c0,21.71,17.701,39.373,39.458,39.373h295.238c21.757,0,39.458-17.653,39.458-39.351V145.385    C497.231,142.839,496.244,140.392,494.479,138.557z M359.385,26.581l107.079,111.265H359.385V26.581z M44.29,364.308    c-5.42,0-9.828-4.405-9.828-9.82V206.744c0-5.415,4.409-9.821,9.828-9.821h265.882c5.42,0,9.828,4.406,9.828,9.821v147.744    c0,5.415-4.409,9.82-9.828,9.82H44.29z M477.538,472.649c0,10.84-8.867,19.659-19.766,19.659H162.535    c-10.899,0-19.766-8.828-19.766-19.68V384h167.403c16.278,0,29.521-13.239,29.521-29.512V206.744    c0-16.274-13.243-29.513-29.521-29.513H142.769V39.442c0-10.891,8.867-19.75,19.766-19.75h177.157v128    c0,5.438,4.409,9.846,9.846,9.846h128V472.649z" />
                </g>
            </g>
            <g>
                <g>
                    <path
                        d="M132.481,249.894c-3.269-4.25-7.327-7.01-12.173-8.279c-3.154-0.846-9.923-1.269-20.308-1.269H72.596v84.577h17.077    v-31.904h11.135c7.731,0,13.635-0.404,17.712-1.212c3-0.654,5.952-1.99,8.856-4.01c2.904-2.019,5.298-4.798,7.183-8.336    c1.885-3.538,2.827-7.904,2.827-13.096C137.385,259.634,135.75,254.144,132.481,249.894z M117.856,273.173    c-1.288,1.885-3.067,3.269-5.337,4.154s-6.769,1.327-13.5,1.327h-9.346v-24h8.25c6.154,0,10.25,0.192,12.288,0.577    c2.769,0.5,5.058,1.75,6.865,3.75c1.808,2,2.712,4.539,2.712,7.615C119.789,269.096,119.144,271.288,117.856,273.173z" />
                </g>
            </g>
            <g>
                <g>
                    <path
                        d="M219.481,263.452c-1.846-5.404-4.539-9.971-8.077-13.702s-7.789-6.327-12.75-7.789c-3.692-1.077-9.058-1.615-16.096-1.615    h-31.212v84.577h32.135c6.308,0,11.346-0.596,15.115-1.789c5.039-1.615,9.039-3.865,12-6.75c3.923-3.808,6.942-8.788,9.058-14.942    c1.731-5.039,2.596-11.039,2.596-18C222.25,275.519,221.327,268.856,219.481,263.452z M202.865,298.183    c-1.154,3.789-2.644,6.51-4.471,8.163c-1.827,1.654-4.125,2.827-6.894,3.519c-2.115,0.539-5.558,0.808-10.327,0.808h-12.75v0    v-56.019h7.673c6.961,0,11.635,0.269,14.019,0.808c3.192,0.692,5.827,2.019,7.904,3.981c2.077,1.962,3.692,4.692,4.846,8.192    c1.154,3.5,1.731,8.519,1.731,15.058C204.596,289.231,204.019,294.394,202.865,298.183z" />
                </g>
            </g>
            <g>
                <g>
                    <polygon
                        points="294.827,254.654 294.827,240.346 236.846,240.346 236.846,324.923 253.923,324.923 253.923,288.981     289.231,288.981 289.231,274.673 253.923,274.673 253.923,254.654   " />
                </g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
            <g>
            </g>
        </svg>
    </div>
    <div class="link-wrapper">
        <a target="_blank" class="link" href="<?php echo $fileUrl;?> ">Download <svg xmlns="http://www.w3.org/2000/svg"
                height="20px" viewBox="0 0 32 32" width="20px">
                <g id="a9148db4-8702-4948-b3d7-c33f0782daf4" data-name="Download">
                    <path fill="var(--light-on-surface)"
                        d="m28 24v-4a1 1 0 0 0 -2 0v4a1 1 0 0 1 -1 1h-18a1 1 0 0 1 -1-1v-4a1 1 0 0 0 -2 0v4a3 3 0 0 0 3 3h18a3 3 0 0 0 3-3zm-6.38-5.22-5 4a1 1 0 0 1 -1.24 0l-5-4a1 1 0 0 1 1.24-1.56l3.38 2.7v-13.92a1 1 0 0 1 2 0v13.92l3.38-2.7a1 1 0 1 1 1.24 1.56z" />
                </g>
            </svg>

        </a>
        <div class="file-size"> <?php echo format_file_size($fileSize); ?> </div>
    </div>

</div>
<?php
}
// pdf file size 
function format_file_size($bytes) {
    if ($bytes >= 1073741824) {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    } elseif ($bytes > 1) {
        $bytes = $bytes . ' bytes';
    } elseif ($bytes == 1) {
        $bytes = $bytes . ' byte';
    } else {
        $bytes = '0 bytes';
    }

    return $bytes;
}