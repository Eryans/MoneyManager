// ARTICLE GENERATOR 
class Article{
    constructor(id,title,content){
        this.id = id;
        this.title = title;
        this.content = content;
    }
    instantiate(node){
        console.log("Creating Article");
        let card = document.createElement("article");
        let title = document.createElement("h2");
        let id = document.createElement("p");
        let content = document.createElement("p");
        id.innerText = this.id;
        content.innerText = this.content;
        title.innerText = this.title;
        card.appendChild(title);
        card.appendChild(id);
        card.appendChild(content);
        node.appendChild(card);
        console.log("Article Created");
    }
}

const ARTICLES = [];
const url = "https://oc-jswebsrv.herokuapp.com/api/articles";
fetch(url).then(function(response){
    return response.json();
}).then(function(response){
    response.forEach(function(x,i){
        ARTICLES.push(new Article(x.id,x.titre,x.contenu));
    });
    ARTICLES.forEach(x => x.instantiate(document.querySelector("main")));
});



