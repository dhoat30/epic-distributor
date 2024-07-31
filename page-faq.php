<?php
get_header();
?>
<?php 
get_template_part('inc/templates/hero');  

$faqData = get_field('faq_group', 'option');
?>
<div class="faq-section row-container">
    <ul class="faq-nav">
        <?php
        foreach ($faqData as $index => $group) {
            $isActive = $index == 0 ? 'active' : '';
            echo '<li class="nav-item body1 ' . $isActive . '" data-target="tab-' . $index . '">' . esc_html($group['group_name']) . '</li>';
        }
        ?>
    </ul>
    <div class="faq-content">
        <?php foreach ($faqData as $index => $group) { ?>
        <div class="content-pane <?php echo $index == 0 ? 'show active' : ''; ?>" id="tab-<?php echo $index; ?>">
            <?php foreach ($group['questions_and_answers'] as $qa) { ?>
            <div class="question-item">
                <h3 class="question body1">
                    <?php echo esc_html($qa['question']); ?>
                    <span class="arrow-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" enable-background="new 0 0 128 128"
                            height="18px" viewBox="0 0 128 128" width="18px">
                            <path fill="var(--light-on-surface)" id="Down_Arrow_3_"
                                d="m64 88c-1.023 0-2.047-.391-2.828-1.172l-40-40c-1.563-1.563-1.563-4.094 0-5.656s4.094-1.563 5.656 0l37.172 37.172 37.172-37.172c1.563-1.563 4.094-1.563 5.656 0s1.563 4.094 0 5.656l-40 40c-.781.781-1.805 1.172-2.828 1.172z" />
                        </svg>
                    </span> <!-- This is a downward arrow -->
                </h3>
                <div class="answer" style="display: none;">
                    <?php echo wpautop($qa['answer']); ?>
                </div>
            </div>
            <?php } ?>
        </div>
        <?php } ?>
    </div>

</div>



<?php
get_footer();
?>