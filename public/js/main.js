$(function () {
    $("#form-total").steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "fade",
        enableAllSteps: true,
        autoFocus: true,
        transitionEffectSpeed: 500,
        titleTemplate: '<div class="title">#title#</div>',
        labels: {
            previous: 'Précédant',
            next: 'Suivant',
            finish: 'Simuler',
            current: ''
        },
        onStepChanging: function (event, currentIndex, newIndex) {
            if (currentIndex === 3) { //if last step
                //remove default #finish button
                $('#form-total').find('a[href$="#finish"]').remove();
                //append a submit type button
                $('#form-total .actions li:last-child').append('<button type="submit" id="submit" class="btn-large"><span class="fa fa-chevron-right"></span>Ok</button>');
            }
            return true;
        },
        onFinished: function (event, currentIndex) {
            $(".form-register").submit();
        }
    });
});
