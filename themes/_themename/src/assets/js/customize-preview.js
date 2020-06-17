import $ from 'jquery'
import strip_tags from './helpers/strip-tags';

// console.log(wp)
//console.log(_themename)

//live update blog title
wp.customize( 'blogname', (value) => {
  value.bind( (to) => {
      $('.c-header__blogname').html(to);
  } )
})

//run this js for this customizer 'setting', bind 'to' to the input and do stuff depending on its state
wp.customize( '_themename_display_author_info', (value) => {
  value.bind( (to) => {
      if(to) {
          $('.c-post-author').show();
      } else {
          $('.c-post-author').hide();
      }
  } )
})

wp.customize( '_themename_accent_colour', (value) => {
  value.bind( (to) => {
    // $('#_themename-stylesheet-inline-css').html(
    //   `
    //     a {
    //       color: ${to}
    //     }
    //     :focus{
    //       outline-color: ${to}
    //     }
    //     .c-post.sticky{
    //       border-left-color: ${to}
    //     }
    //     'button, input[type=submit], .header-nav .menu > .menu-item:not(.mega) .sub-menu .menu-item:hover > a {
    //       background-color: ${to}
    //     }
    //   `
    // )

    let inline_css = ``;
    let inline_css_obj = _themename['inline-css'];
    for(let selector in inline_css_obj) {
        inline_css += `${selector} {`;
            for(let prop in inline_css_obj[selector]) {
                let name = inline_css_obj[selector][prop];
                // get any setting value by its name from wp database
                inline_css += `${prop}: ${wp.customize(name).get()}`;
            } 
        inline_css += `}`;
    }
    $('#_themename-stylesheet-inline-css').html(inline_css);
  } )
})

wp.customize( '_themename_site_info', (value)=> {
  //bind means we are now listening to the change events to the input for site_info setting
  value.bind((to) => {
    //to is now the input, updated every time something is typed
    //console.log(to);
    $('.c-site-info__text').html(strip_tags(to, '<a>'));
  })
})