import $ from 'jquery';

//event delegation. could have done this $('.menu-item-has-children').on('mouseenter'))
$('.c-navigation').on('mouseenter', '.menu-item-has-children', (e) => {
    //if not in the sub menu i.e. if the top level menu
    if(!$(e.currentTarget).parents('.submenu').length){
        $('.menu > .menu-item.oopen').find('> a > .menu-button').trigger('click')
    }
    $(e.currentTarget).addClass('open');
}).on('mouseleave', '.menu-item-has-children', (e) => {
    $(e.currentTarget).removeClass('open');
})


$('.c-navigation').on('click', '.menu .menu-button', (e) => {
    e.preventDefault();
    e.stopPropagation();

    let menu_button = $(e.currentTarget);
    let menu_link = menu_button.parent();
    let menu_item = menu_link.parent();

    //when clicked
    if(menu_item.hasClass('open')) {
        //close it and all the inside menus that are open
        menu_item.add(menu_item.find('.menu-item.open')).removeClass('open');

        //accessibility stuff
        menu_link.add(menu_item.find('a')).attr('aria-expanded', 'false');
        menu_button.find('.menu-button-show').attr('aria-hidden', 'false');
        menu_button.find('.menu-button-hide').attr('aria-hidden', 'true');
    } else {
        //open the element
        menu_item.addClass('open');


        //accessibility stuff
        //close all other open elements (by clicking their menu button)
        menu_item.siblings('.open').find('>a>.menu-button').trigger('click')
        menu_link.attr('aria-expanded', 'true');
        menu_button.find('.menu-button-show').attr('aria-hidden', 'true');
        menu_button.find('.menu-button-hide').attr('aria-hidden', 'false');
    }
})

$(document).click((e) => {
    if($('.menu-item.open').length) {
        $('.menu > .menu-item.open > a > .menu-button').trigger('click');
    }
})