## setup

1. unzip fresh wordpress dl into htdocs, 
2. rename to your website name. 
3. start normal mamp
4. add database in http://localhost:8888/phpMyAdmin called the website name
5. go through the wordpress installation in browser at localhost:8888/ursitename, put root as database username&pass. no need to fiddle with wp-config it creates it for you.
6. wp-config set WP_DEBUG to true
7. delete the other themes in themes folder
8. IMPORT _themename & _themename-child into themes folder
9. change screenshot.jpg for theme pic.
10. activate theme in wp
11. install themecheck & themeforest check
    
12. Add dummy data: https://codex.wordpress.org/Theme_Unit_Test 
 1. Go to Tools: Import in the WordPress admin panel.
 2. Install the "WordPress" importer from the list.
 3. Activate & Run Importer.
 4. Upload this file using the form provided on that page.
 5. You will first be asked to map the authors in this export file to users
    on the site. For each author, you may choose to map to an
    existing user on the site or to create a new user
 6. CHECK download & import file attachments
 7. Click submit & ur DONE

### setup npm

13. navigate to _themename folder and run npm install
14. run npm install --global gulp-cli
15. we don't need to find all '_themename' and replace with website name, 'gulp final' task will do that when we run it.
16. run 'npm start' to start the dev environment
  
### setup in wp-admin

17. Assign widgets (sidebar and footer widget columns) Appearance->Widgets
    1.  primary sidebar widget
    2.  footer widgets 
18. Assign Menus: Appearance -> Menus
19. Assign MegaMenus: Appearance -> Menus -> Screen Options, Check Css Classes -> Add 'mega cols-4' to top lvl of megamenu

## notes

- functions that start with GET_permalink.. need to be echoed, THE_permalink doesnt.
- how to console.log:
```php
<pre>
<?php var_dump($wp_query) ?>
</pre>
```
- the loop can be customised to retreive not just the current urls main loop, this is why we call reset on it every time

### template heirarchy
- img1
- img2
  
### functions
- functions are included in wp directly without any includes

## notes
- we can import any js libraries we need in bundle.js just make sure they are not already included in wp core:
  - https://developer.wordpress.org/reference/functions/wp_enqueue_script/
  
### action hooks, filer hooks & child themes

#### CUSTOM ACTION HOOKS
- Action hooks allow us to run a function at a specific point in our code: The function can echo something, modify a global variable or modify something in database.
- We can create action hooks to allow other developers to interact with our theme like this
 > <?php do_action('_themename_after_pagination'); ?>

- and we register a callback function to run at that place (can also set priority for more than one as 3d parameter and Number of arguments as 4th parameter):
```php
  <?php after_pagination(){echo 'sdfsffs'} ?>

  <?php add_action (' _themename_after_pagination', 'after_pagination', 2)>
  <?php add_action (' _themename_after_pagination', 'after_pagination', 1)>
```

#### CORE ACTION HOOKS
https://codex.wordpress.org/Plugin_API/Action_Reference
- E.g. <?php wp_head(); ?> Function just calls the do_action('wp_head') hook in the core.
- Enqueue_scripts is the proper way to add styles & scripts
- NOT LIKE THIS:
```php
  <?php
  function function_to_add() {
  echo '<style>body{background-color:#000}</style>'
  }
  add_action('wp_head','function_to_add')
  ?>
```

- modify the loop before calling get posts
```php
  <?php
  function function_to_add($query) {
    if($query->is_main_query()){
      $query->set('posts_per_page', 2)
    }
  }
  add_action('pre_get_posts','function_to_add')
  ?>
```

- remove_action(hook, function)

#### CORE & CUSTOM FILTER HOOKS

https://codex.wordpress.org/Plugin_API/Filter_Reference
- 
```php
  <?php
  function filter_title($title) {
    return "Filtered' . $title;
  }
  add_filter('the_title','filter_title')
  ?>
```


CHILD THEMES
- any file in child folders completely overrides equivalent parent file


- allow child themes to override parent theme functions by writing them inside this if statement in the parent functions folder
```php
if(!function_exists('_themename_post_meta')){
  ...
}
```


### SANITATION/ESCAPING

- printf is for escaping variables into a string that is translateable and echo (sprintf without echo)
> 'name' => sprintf(esc_html__( 'Footer Widgets Column %s', '_themename' ), $i + 1)

- escape & translate html in language file
> esc_html__( 'Footer widgets', '_themename' )


- escape url and html:
```html
<a href="<?php echo esc_url(home_url('/')) ?>" class="c-header__blogname"><?php esc_html(bloginfo('name')); ?></a>
```

- Esc_attr_x gives context to the translator string.
```html
<input type="search" class="c-search-form__field" name="s" placeholder="<?php echo esc_attr_x('Search', 'placeholder', '_themename' ) ?>
<button type="submit"><span class="u-screen-reader-text"><?php echo esc_html_x( 'Search', 'submit button', '_themename' ); ?></span></button>
```

- escape and echo
```html
<nav class="header-nav" role="navigation" aria-label="<?php esc_html_e( 'Main Navigation', '_themename' ) ?> ">
```

- escape and translate
```php
$wp_customize->add_control('_themename_site_info', array(
  'type' => 'text',
  'label' => esc_html__('Site Info', '_themename') )
))
```

- escaped attribute in skip link for keyboard accessibility of main conent
```html
<a class="u-skip-link" href="#content"><?php esc_attr_e('Skip to content', '_themename'); ?></a>
```

- custom excape function with wp_kses
```html
  <div class="o-row__column o-row__column--span-12 c-site-info__text">
      <?php 
        //allow some html&attributes
        $allowed = array('a' => array(
          'href' => array(), 
          'title' => array()
        ));
        echo wp_kses( $site_info, $allowed );
        
        //echo esc_html( $site_info ); 
      ?>
  </div>
```

## Section 7: Adding Theme Options Using The Customizer API

https://developer.wordpress.org/themes/customize-api/

https://developer.wordpress.org/themes/theme-security/data-sanitization-escaping/


## Section 8: User Roles & capabilities

https://wordpress.org/support/article/roles-and-capabilities/

https://www.bynicolas.com/code/wordpress-nonce/


## Section 9: Metadata , Custom Fields & bundling plugins

Metadata is the extreanous data associated with a post
- such as custom fields

### Plugins

* SETUP

- To initialise plugin put the index.php info file in your plugins folder.
- add the following to restrict access to this file:
  ```php
  if( !defined('WPINC')) {
    die;
  }
  ```
- Move all your code from the functions.php file to the index.php file of the theme (or other file and include it in index)
- Move the package.json and gulp file and remove anything to do with broswerSync
- run npm install
- Change the text-domain of the theme code to the text domain of the plugin
- Create js/scss folder structure and make enqueue-assets.php file which includes those scss js files (from the dist folder)
- (you can prefix your functions with the themename + plugin name if u need, we not doing that here)
- run npm run bundle, get the zip file and put in into your theme inside a folder somewhere, this can then be installed when theme is installed.

- make sure the plugins are installed automatically when installing your theme with TGM Plugin ACtivation
    - [TGM Plugin ACtivation Domnloads](http://tgmpluginactivation.com/download/)
    - Text Domain, Dunction Prefix, Name = _themename
    - Copy the class-tgm-plugin-activation.php into lib folder
    - Update include-plugins.php file


# build the final theme + plugins

> npm run bundle (in plugin folder)
> npm run bundle (in theme folder)
> /final zip file is the finished product




## CREATE NEW PLUGIN

1. duplicate _themename-metaboxes
2. rename _themename-NEWNAME
3. 


