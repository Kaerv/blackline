function getResources(start) {
    console.log(start, allResourcesCount);
    getResourcesCount();
    $.ajax({
        method: "GET",
        url: `../php/scripts/get${type}.php`,
        data: {
            token: token,
            start: start
        },
        success: (msg) => {
            $("#loadMoreMessage").parent().remove();
            $("#resources-loading-message").parent().remove();
            generateResourcesDOM(msg);
            addEventsToResources();
            addLoadMoreButton();
        },
        async: true
    });
}

function getResourcesCount() {
    $.ajax({
        method: "GET",
        url: `../php/scripts/get${type}sCount.php`,
        data: {
            token: token
        },
        success: (msg) => {
            result = msg.split(";");
            if(result[0] == 0) {
                allResourcesCount = parseInt(result[1]);
            }
            else {
                console.log(result[1]);
            }
        },
        async: false
    });
}

function generateResourcesDOM(msg) {
    let bigData = msg.split("*");
    let resources = convertRawToObjects(bigData);
    addResourcesToPanel(resources);
}

function convertRawToObjects(row) {
    let resources = [];
    for(let i = 0; i < row.length - 1; i++) {
        let resource = row[i].split("|");
        resource[0] = parseInt(resource[0]);
                
        if(type == "Quote") {
            let isRepeat = false;
            for(let j = 0; j < resources.length; j++) {
                if(resources[j].id == resource[0]) {
                    resources[j].categories.push(resource[4]);
                    isRepeat = true;
                    continue;
                }
            }
        }
        resources.push(createNewResourceObject(resource));
    }
    return resources;
}

function createNewResourceObject(data) {
    let resource = {
        id: data[0],
        author: data[1],
        dateAdded: data[2],
        visitDaily: data[3],
        visitMonthly: data[4],
        visitYearly: data[5]
    }

    if(type == "Article") {
        resource.title = data[6];
        resource.datePublication = data[7];
    }
    else if(type == "Quote") {
        resource.content = data[6];
        resource.translation = data[7];
        resource.categories = [data[8]];
    }
    return resource;
}

function addResourcesToPanel(resources) {
    
    for(let i = 0; i < resources.length; i++) {
        let actualAuthor = resources[i].author;
        resources[i].author = actualAuthor == "" ? "Autor nieznany" : actualAuthor;
        let categories = "";
        if(type == "Quote") {
            for(let j = 0; j < resources[i].categories.length; j++) {
                categories += resources[i].categories[j].toLowerCase();
                categories += ";"
            }
        }
        $("#all-quotes").find("tbody").append(generateResourceRow(resources[i]));
    }
}

function resetResourcesPanel() {
    displayedResources = 25;
    $("#all-quotes").find("tbody").html(emptyTable);
}

function addEventsToResources() {
    $(".remove").each(function() {
        let selfId = $(this).parent().attr("class").split("-")[1]
        $(this).click(function() {
            removeResource(selfId, true);
        });
    });
    $(".edit-button").each(function() {
        let selfId = $(this).parent().attr("class").split("-")[1]
        $(this).click(function() {
            editResource(selfId);
        });
    });
}

function addLoadMoreButton() {
    if(displayedResources < allResourcesCount + 1) {
        $("#all-quotes").find("tbody").append(`
        <tr>
            <td colspan=9><input type="button" id="load-more-button" value="Wczytaj więcej"></td>`
        );

        $("#load-more-button").on("click", function() {
            $("#load-more-button").parent().html("<div id='loadMoreMessage'>Wczytywanie...</div>");
            getResources(displayedResources);
            displayedResources += 25;
        });
    }
}

