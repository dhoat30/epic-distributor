<!-- layouts -->
<?php 
// Check value exists.
if( have_rows('sections') ){ 
     // Loop through rows.
     while ( have_rows('sections') ){ 
        the_row(); 
   
        // row layout 
        if(get_row_layout() === 'row'){            
            get_template_part('inc/templates/row-layout/layouts/row');

        }
           // title layout 
           else if(get_row_layout() === 'list_of_products'){
            get_template_part('inc/templates/row-layout/layouts/list-of-products');
      }
        // title layout 
        else if(get_row_layout() === 'list_of_categories'){
            get_template_part('inc/templates/row-layout/layouts/list-of-categories');  
      }
       // promo cards layout 
       else if(get_row_layout() === 'promo_cards'){        
        get_template_part('inc/templates/row-layout/layouts/promo-cards');  

        }
          // promo cards layout 
       else if(get_row_layout() === '4_cards_row'){        
        get_template_part('inc/templates/row-layout/layouts/4-cards-row');  

        }
      
     }
}
?>