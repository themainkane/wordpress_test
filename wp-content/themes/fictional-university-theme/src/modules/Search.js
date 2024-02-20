class Search {
  constructor() {
    this.openButton = document.querySelector(".js-search-trigger");
    this.closeButton = document.querySelector(".search-overlay__close");
    this.searchOverlay = document.querySelector(".search-overlay");
    this.addEventListners();
  }

  addEventListners() {
    this.openOverlay();
    this.closeOverlay();
    console.log(this.openButton);
  }

  openOverlay() {
    this.openButton.addEventListener(
      "click",
      function (e) {
        e.stopPropagation();
        this.searchOverlay.classList.add("search-overlay--active");
        console.log("open overlay was called");
      }.bind(this)
    );
  }

  closeOverlay() {
    this.closeButton.addEventListener("click", () => {
      this.searchOverlay.classList.remove("search-overlay--active");
      console.log("close overlay was called");
    });
  }
}

export default Search;
