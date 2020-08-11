import $, { data } from 'jquery';

export default class AdvancedFilter {
    constructor() {
        this.baseUrl = this.getBaseUrl();

        let params = this.getActiveCheckboxes();
        this.url = this.prepareFilterUrl(params);
        
        this.url += this.addPriceFilterToUrl();
    }

    getBaseUrl() {
        let url = window.location.href;
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

    addPriceFilterToUrl() {
        let filter = $(".faceted-slider")[0];
        let min = $("#price-min").val();
        let max = $("#price-max").val();

        if(min || max) {
            let label = $(filter).data("slider-label");
            let unit = $(filter).data("slider-unit");
             min = min? min : $(filter).data("slider-min");
             max = max? max : $(filter).data("slider-max");

             if(parseInt(min) && parseInt(max)) {
                if(parseInt(min) > parseInt(max))
                    [min, max] = [max, min];

                let url = ""
                if(this.url[this.url.length - 1] != "=") 
                    url += "/";

                url += `${label}-${unit}-${min}-${max}`;
                return url;
             }

        }
        return "";
    }

    filter() {
        event.preventDefault();
        prestashop.emit('updateFacets', `${this.baseUrl}&${this.url}`);
    }
}