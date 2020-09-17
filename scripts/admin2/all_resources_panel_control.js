let displayedResources = 25;
let allResourcesCount;

$(document).ready(() => {
    let start = Date.now();
    resetResourcesPanel();
    getResources(0);
    $("#check-all").change(function() {
        let checked = $(this).prop("checked");
        $(".check-delete").prop("checked", checked);
    });

    $("#delete-checked").click(() => {removeSelectedResources()});

    let left = Date.now() - start;
    console.log(`%c${left}ms`, "color: #0A0");
});