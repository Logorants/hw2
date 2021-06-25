/* FUNZIONI API NEWSAPI */

function onResponseNews(resp){
    return resp.json();
}

function onJsonNews(json) {
    const articles = json['articles'];

    for(let i = 0; i < articles.length; i++){

        const art_title = articles[i]['title'];
        const art_site = articles[i]['source']['name'];
        const art_img = articles[i]['urlToImage'];
        const art_url = articles[i]['url'];

        const article = document.createElement("div");
        article.classList.add("article");
        const img = document.createElement("img");
        img.src = art_img;
        const title = document.createElement("h2");
        title.textContent = art_title
        const author = document.createElement("em");
        author.textContent = "published by " + art_site;
        const url = document.createElement("a");
        url.href = art_url;
        url.textContent = "read the article";
        url.target = "_blank";
        url.classList.add("buttonBlack1");

        article.appendChild(img);
        article.appendChild(title);
        article.appendChild(author);
        article.appendChild(url);

        document.querySelector("#news .articles_shelf").appendChild(article);
    }

}

fetch("/partner/news").then(onResponseNews).then(onJsonNews);
