/* DOKUWIKI:include_once jquery.slimbox2.js */
/* DOKUWIKI:include_once jquery.pwi.js */

function on_document_ready(div_id, username, mode, album) {
    jQuery(document).ready(function() {
        jQuery('#' + div_id).pwi({
            username: username,
            mode: mode,
            album: album,
            maxResults: 999, // display all photos (without any paging)
            // photoSize: 0, // middle-clic on thumbnail opens full-size photo
            labels: {
                photo:"photo",
                photos: "photos",
                albums: "Retour aux albums",
                slideshow: "Lancer un diaporama",
                loading: "Chargement...",
                page: "Page",
                prev: "Précédent",
                next: "Suivant",
                devider: "|"
            },
            months: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin",
                     "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"],

            // slimbox documentation: http://code.google.com/p/slimbox/wiki/jQueryManual
            slimbox_config: {
                // disable all animations
                overlayFadeDuration: 0,
                resizeDuration: 0,
                imageFadeDuration: 0,
                captionAnimationDuration: 0,
                counterText: "{x} / {y}",
            },
        });
    });
}
