let $ = jQuery;

class Search {
    // describe and create/initiate our object
    constructor() {
        this.url = `${webduelData.root_url}/wp-json/webduel/v1/search?term=`;
        this.loading = $('.search-bar .loading-icon');
        this.searchIcon = $('.search-code .desktop-search');
        this.resultDiv = $('.search-code .result-div');
        this.searchField = $('#search-term');
        this.typingTimer;
        this.searchBar = $('.search-bar');
        this.events();
        this.isSpinnerVisible = false;
        this.previousValue;
    }

    // events 
    events() {
        this.searchField.on("input", this.typingLogic.bind(this)); // Use input event to handle typing and pasting
        this.searchField.on("click", this.searchFieldClickHandler.bind(this));
        // add on enter event 
        this.searchField.on("keypress", this.sendToShopPage.bind(this));
        $(document).on("click", this.documentClickHandler.bind(this));
        // redirect to result page when clicked on search icon  
        this.searchIcon.on('click', this.takeToQueryPage.bind(this));
    }

    // document click handler
    documentClickHandler(e) {
        if (!this.searchBar.is(e.target) && this.searchBar.has(e.target).length === 0) {
            this.resultDiv.hide();
        }
    }

    // search field click
    searchFieldClickHandler() {
        this.resultDiv.show();
    }

    // methods
    typingLogic() {
        if (this.searchField.val() != this.previousValue) {
            clearTimeout(this.typingTimer);
            // check if the value is not empty
            if (this.searchField.val()) {
                if (!this.isSpinnerVisible) {
                    // show loading spinner
                    this.loading.show();
                    this.isSpinnerVisible = true;
                }
                this.typingTimer = setTimeout(this.getResults.bind(this), 500); // Adjusted to 500ms for quicker response
            } else {
                // hide loading
                this.loading.hide();
                this.isSpinnerVisible = false;
                this.resultDiv.hide();
            }
        }
        this.previousValue = this.searchField.val();
    }

    // get result method
    getResults() {
        const queryURL = `${this.url}${this.searchField.val()}`;
        var requestOptions = {
            method: 'GET',
            redirect: 'follow'
        };

        fetch(queryURL, requestOptions)
            .then(response => response.json())
            .then(data => {
                this.resultDiv.show();
                if (data.length) {
                    this.resultDiv.html(`<ul class="search-list">
                    ${data.map(item => {
                        return `<li>
                        <a href="${item.link}"> 
                        <img src="${item.image}" alt="${item.title}"/>
                        <span>${item.title}</span>
                        </a>
                        </li>`;
                    }).join('')}
                    </ul>`);
                } else {
                    this.resultDiv.html(`<p class="center-align medium">Nothing found</p>`);
                }
                // hide loading spinner 
                if (this.isSpinnerVisible) {
                    this.loading.hide();
                    this.isSpinnerVisible = false;
                }
            })
            .catch(error => {
                console.log('error', error);
                this.resultDiv.html(`<p class="center-align medium">An error occurred. Please try again.</p>`);
                // hide loading spinner on error
                if (this.isSpinnerVisible) {
                    this.loading.hide();
                    this.isSpinnerVisible = false;
                }
            });
    }

    // query page redirect 
    takeToQueryPage(e) {
        if (this.searchField.val().length >= 1) {
            window.location.href = `${webduelData.root_url}/shop/?_search=${this.searchField.val()}`;
        }
    }

    sendToShopPage(event) {
        if (event.which === 13) { // jQuery normalizes the keyCode value in 'which'
            event.preventDefault(); // Prevent the form submission

            var searchTerm = $(event.target).val();
            const url = `${location.protocol}//${location.host}/shop?_search=${encodeURIComponent(searchTerm)}`;
            // Redirect to the URL with the search term included as a query parameter
            window.location.href = url;
        }
    }
}

export default Search;
