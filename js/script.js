window.addEventListener('DOMContentLoaded', () => {

    jQuery('#img_01').ezPlus({
        zoomWindowFadeIn: 500,
        zoomLensFadeIn: 500,
        gallery: 'gal1',
        imageCrossfade: true,
        zoomWindowWidth: 411,
        zoomWindowHeight: 274,
        zoomWindowOffsetX: 10,
        scrollZoom: true,
        zoomType: 'inner',
        cursor: 'pointer'
    });


    jQuery('#img_01').bind('click', function (e) {
        var ez = jQuery('#img_01').data('ezPlus');
        jQuery.fancyboxPlus(ez.getGalleryList());
        return false;
    });



});
