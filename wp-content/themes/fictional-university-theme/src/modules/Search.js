class Search {
  constructor() {
    this.openButton = document.querySelector(".js-search-trigger");
    this.closeButton = document.querySelector(".search-overlay__close");
    this.searchOverlay = document.querySelector(".search-overlay");
    this.searchField = document.querySelector("#search-term");
    this.body = document.body;
    this.isOverlayOpen = false;
    this.isSpinnerVisible = false;
    this.resultsDiv = document.getElementById("search-overlay__results");
    this.previousValue;
    this.typingTimer;
    this.addEventListners();
  }

  addEventListners() {
    this.openButton.addEventListener("click", (e) => {
      // seems to prevent "bubbling" event listners were not previously addig to the page
      e.stopPropagation();
      this.openOverlay();
    });

    this.closeButton.addEventListener("click", (e) => {
      e.stopPropagation();
      this.closeOverlay();
    });

    this.body.addEventListener("keyup", (e) => {
      this.keyPressDispatcher(e);
    });

    this.searchField.addEventListener("keyup", (e) => {
      e.stopPropagation();
      this.typingLogic();
    });
  }

  //  methods

  openOverlay() {
    this.searchOverlay.classList.add("search-overlay--active");
    this.body.classList.add("body-no-scroll");
    this.toggleOverlay();
    console.log("open overlay was called");
  }

  closeOverlay() {
    this.searchOverlay.classList.remove("search-overlay--active");
    this.body.classList.remove("body-no-scroll");
    this.toggleOverlay();

    console.log("close overlay was called");
  }

  keyPressDispatcher(e) {
    if (e.code === "KeyS" && this.isOverlayOpen === false) {
      this.openOverlay();
    } else if (e.code === "Escape" && this.isOverlayOpen === true) {
      this.closeOverlay();
    }
  }

  toggleOverlay() {
    this.isOverlayOpen === true
      ? (this.isOverlayOpen = false)
      : (this.isOverlayOpen = true);
  }

  toggleSpinner() {
    this.isSpinnerVisible === true
      ? (this.isSpinnerVisible = false)
      : (this.isSpinnerVisible = true);
  }

  // search logic below!*************
  typingLogic() {
    if (this.searchField.value !== this.previousValue) {
      //clear timeout
      clearTimeout(this.typingTimer);
      // handle the spinner, and only open if not already spinning
      this.resultsDiv.innerHTML = this.isSpinnerVisible
        ? `<div class="spinner-loader"></div>`
        : this.resultsDiv.innerHTML;
      this.toggleSpinner();
      //display results
      this.typingTimer = setTimeout(() => {
        this.toggleSpinner();
        console.log("get resutls called!");
        console.log("resultsDiv:", this.resultsDiv);
        this.resultsDiv.innerHTML = `working`;
      }, 2000);
    }
    //
    this.previousValue = this.searchField.value;
  }

  // getResults() {
  //   console.log("get resutls called!");
  //   console.log("resultsDiv:", this.resultsDiv);
  //   this.resultsDiv.innerHTML = `working`;
  // }
}

export default Search;
