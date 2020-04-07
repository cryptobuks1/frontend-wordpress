(function ($) {
  "use strict";

  /**
   * All of the code for your public-facing JavaScript source
   * should reside in this file.
   *
   * Note: It has been assumed you will write jQuery code here, so the
   * $ function reference has been prepared for usage within the scope
   * of this function.
   *
   * This enables you to define handlers, for when the DOM is ready:
   *
   * $(function() {
   *
   * });
   *
   * When the window is loaded:
   *
   * $( window ).load(function() {
   *
   * });
   *
   * ...and/or other possibilities.
   *
   * Ideally, it is not considered best practise to attach more than a
   * single DOM-ready or window-load handler for a particular page.
   * Although scripts in the WordPress core, Plugins and Themes may be
   * practising this, we should strive to set a better example in our own work.
   */

  $(window).load(function () {
    const apiUrl =
      "https://zq7vthl3ye.execute-api.ca-central-1.amazonaws.com/sta/geo";

    let searchParams = {
      searchTerms: [],
      bbox: null,
    };

    async function addSearchTerm(searchTerm) {
      if (!searchTerm || searchParams.searchTerms.indexOf(searchTerm) !== -1)
        return;
      searchParams.searchTerms.push(searchTerm);
      renderPill(searchTerm);
      updateResults();
    }

    async function renderPill(searchTerm) {
      document
        .getElementById("cgp-shortcodes-simple-search")
        .getElementsByClassName("cgp-shortcodes-search-pills")[0].innerHTML +=
        '<a href="#" class="badge badge-pill badge-primary">' +
        searchTerm +
        "</a>";
      document.getElementById("cgp-filter-search-term").value = "";
    }

    $(".cgp-shortcodes-search-pills").click(function (event) {
      if (event.target.nodeName != "A") return;
      searchParams.searchTerms = searchParams.searchTerms.filter(function (
        value
      ) {
        return value != event.target.innerHTML;
      });
      event.target.remove();
      updateResults();
    });

    $("#cgp-shortcodes-simple-search .search-button").on("click", function () {
      addSearchTerm(document.getElementById("cgp-filter-search-term").value);
    });

    async function updateResults() {
      let url = new URL(apiUrl);

      let params = {
        regex: [],
        select: [
          "properties.title",
          "properties.organisationname",
          "properties.description",
          "properties.topiccategory",
        ],
        tags: [],
      };

      searchParams.searchTerms.forEach((e) => {
        params.regex.push("(?i)\\b(" + e + ")\\b");
      });

      Object.keys(params).forEach((key) =>
        url.searchParams.append(key, JSON.stringify(params[key]))
      );

      fetch(url)
        .then((response) => {
          response.json().then((data) => {
            renderResults(data.Items);
          });
        })
        .catch((error) => console.log(`Failed because of: ${error}`));
    }

    function renderResults(Items) {
      let result = [];
      let i = 1;
      document.getElementById("metadata-search-result").innerHTML = "";
      Items.forEach((e) => {
        i++;
        document.getElementById(
          "metadata-search-result"
        ).innerHTML += resultCard(e);
      });
    }

    function resultCard(data) {
      let htmlString =
        '<div class="card">' +
        '<div class="card-body">' +
        '<h5 class="card-title">' +
        data.properties.title.en +
        "</h5>" +
        '<p class="card-text">' +
        data.properties.description.en +
        "</p>" +
        '<h6>Organisation: </h6><p class="card-text">  ' +
        data.properties.organisationname.en +
        "</p>" +
        '<h6>Theme: </h6><p class="card-text">  ' +
        data.properties.topiccategory +
        "</p>" +
        "</div>";
      return htmlString;
    }
  });
})(jQuery);
