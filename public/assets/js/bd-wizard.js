//Wizard Init

$("#wizard").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "none",
    stepsOrientation: "vertical",
    titleTemplate: '<span class="number">#index#</span>',
    labels: {
        current: "En cours:",
        pagination: "Pagination",
        finish: "Simuler",
        next: "Suivant",
        previous: "Précédent",
        loading: "Chargement ..."
    },
    onFinished: function (event, currentIndex) {
        $("#form").submit();
    }
});

