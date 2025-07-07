export default class LeiaMaisNoticia {
    constructor() {
        if(jQuery('.content-post > *').length > 10) {
            jQuery('.content-post > *:nth-child(6) ~ *').hide();
            jQuery('.content-post').addClass('showHide');

            jQuery('.content-post').click(function () {
                jQuery('.content-post > *:nth-child(6) ~ *').show();
                jQuery('.content-post').removeClass('showHide');
            });
        }
    }
}