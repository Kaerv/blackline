import $, { data } from 'jquery';

function log(msg) {
    window.console.log(msg);
}

//index.php?id_category=2&controller=category&q=Rozmiar-S-M/Kolor-Bia%C5%82y

export default class AdvancedFilter {
    constructor() {
        this.baseUrl = this.getBaseUrl();

        let params = this.getActiveCheckboxes();
        this.url = this.prepareFilterUrl(params);
    }

    getBaseUrl() {
        let firstFacet = $(".facet-label")[0];
        let url = $(firstFacet).find("a")[0].href;
        if(url.includes("q=")) {
            url = url.substring(0, url.indexOf("q=") - 1);
        }
        return url;
    }

    getActiveCheckboxes() {
        let selectedFacets = [];
        $(".facet").each(function() {
            let title = $(this).find(".facet-title").text();

            let activeValues = [];
            $(this).find(".facet-label").each(function() {
                let checked = $(this).find("input").prop("checked");
                if(checked) {
                    
                    let valueName = $(this).find("a").clone().children().remove().end().text();
                    valueName = valueName.replace(/\r?\n|\r/g, "");
                    valueName = valueName.trim();
                    activeValues.push(valueName);
                }
            });

            if(activeValues.length > 0) {
                selectedFacets.push({
                    title: title,
                    values: activeValues
                });
            }
        });
        return selectedFacets;
    }

    prepareFilterUrl(params) {
        let url = "q=";
        params.forEach(function(obj, index) {
            if(index != 0)
                url += "/";
            url += obj.title;
            obj.values.forEach(function(value, i) {
                url += `-${value}`;
            });
        });
        return url;
    }

    filter() {
        event.preventDefault();
        prestashop.emit('updateFacets', `${this.baseUrl}&${this.url}`);
    }
}