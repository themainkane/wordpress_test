import Result from "./Result";

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
      e.preventDefault();
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
  }

  closeOverlay() {
    this.searchOverlay.classList.remove("search-overlay--active");
    this.body.classList.remove("body-no-scroll");
    this.toggleOverlay();
  }

  keyPressDispatcher(e) {
    // note the difference in the use of && operator for double keystrokes.
    if (
      e.code === "KeyS" &&
      "AltLeft" &&
      !this.isOverlayOpen &&
      !this.isInputFocused()
    ) {
      this.openOverlay();
    } else if (e.code === "Escape" && this.isOverlayOpen === true) {
      this.closeOverlay();
    }
  }

  // logic to check if input field is currently the focus of the document
  isInputFocused() {
    const focusedElement = document.activeElement;
    return (
      focusedElement &&
      (focusedElement.tagName === "INPUT" ||
        focusedElement.tagName === "TEXTAREA")
    );
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
    // if the search field changes (not on arrow keys etc)
    if (this.searchField.value !== this.previousValue) {
      //clear timeout
      clearTimeout(this.typingTimer);
      //will not run if you just emptied the searchfield (if this.searchField is flasy)
      if (this.searchField.value) {
        if (!this.isSpinnerVisible) {
          this.resultsDiv.innerHTML = `<div class="spinner-loader"></div>`;
          this.toggleSpinner();
        }
        //display results
        this.typingTimer = setTimeout(() => {
          this.loadSearchResults();
          this.toggleSpinner();
        }, 2000);
      } else {
        this.resultsDiv.innerHTML = ``;
        this.isSpinnerVisible = false;
      }
      // handle the spinner, and only open if not already spinning
      //
      this.previousValue = this.searchField.value;
    }
  }
  // getResults() {
  //   console.log("get resutls called!");
  //   console.log("resultsDiv:", this.resultsDiv);
  //   this.resultsDiv.innerHTML = `working`;
  // }

  loadSearchResults = async () => {
    const response = await fetch(
      `/wp-json/wp/v2/posts?search=${this.searchField.value}`
    );
    const data = await response.json();
    console.log("data", data);
    this.resultsDiv.innerHTML = `<h2>Search Results</h2>
      <hr class="section-break"></hr>`;
    data.length
      ? data.forEach((e) => {
          const result = new Result(e.title, e.link, e.excerpt);
          console.log("result:", result);
        })
      : (this.resultsDiv.innerHTML += `
      <p>No results matches that criteria</p>
      `);
  };
}

export default Search;
