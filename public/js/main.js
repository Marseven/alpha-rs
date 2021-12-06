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

            return true;
        },
        onFinished: function (event, currentIndex) {
            $(".form-register").submit();
        }
    });
});
