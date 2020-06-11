<!-- form to override the default wordpress form -->
<form role="search" method="get" class="c-search-form" action="<?php echo esc_url( home_url('/') ) ?>">
    <label class="c-search-form__label">
        <!-- this bit is for accessibility -->
        <span class="screen-reader-text">
            <?php echo esc_html_x( 'Search for:', 'accessibility search label', '_themename' ) ?>
        </span>
        <!-- name="s" has to be this. Wordpres now knows that you requested a url with a search parameter and will display the search result page template on submit and filter the posts agaisnt the search query. Esc_attr_x gives context to the translator string. Value puts what you just searched into the input-->

        <input type="search" class="c-search-form__field" name="s" placeholder="<?php echo esc_attr_x('Search', 'placeholder', '_themename' ) ?>" value="<?php echo esc_attr(get_search_query()) ?>" />
    </label>
    <button class="c-search-form__button" type="submit"><span class="u-screen-reader-text"><?php echo esc_html_x( 'Search', 'submit button', '_themename' ); ?></span><i class="fas fa-search" aria-hidden="true"></i></button>
</form> 

<!-- All YOU NEED FOR A BASIC FORM IN WP
<form role="search" method="get" class="c-search-form" action="<?php echo esc_url( home_url('/') ) ?>">
<input type="search" name="s"/>
<button type="submit">search</button>
</form>  -->
