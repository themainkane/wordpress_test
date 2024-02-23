export default class Result {
  constructor(title, href, excerpt) {
    this.title = title;
    this.href = href;
    this.excerpt = excerpt;
    this.resultsDiv = document.getElementById("search-overlay__results");
    this.refreshElement();
  }
  refreshElement() {
    this.resultsDiv.innerHTML += `
      <a href="${this.href}">
      <h3>${this.title.rendered}</h3>
      </a>
      ${this.excerpt.rendered}
    `;
  }
}
