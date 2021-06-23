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


/* FUNZIONI API FINNHUB */

function onResponseMarket(resp){
    return resp.json();
}

function onJsonMarket(json){
    for(let i = 0; i < json.length; i++) {
        const block = document.createElement("div");
        const info_block = document.createElement("div");
        info_block.classList.add("finndeets");

        //NOME
        const name = document.createElement("h2");
        name.textContent = json[i]['name'];
        info_block.appendChild(name);

        //LOGO
        const logo = document.createElement("img");
        logo.src = json[i]['logo'];

        //TICKER
        let label = document.createElement("strong");
        label.textContent = 'Ticker:';

        let labelData = document.createElement("strong");
        labelData.textContent = json[i]['ticker'];

        let deetsdiv = document.createElement("div");
        deetsdiv.classList.add("finndata");

        deetsdiv.appendChild(label);
        deetsdiv.appendChild(labelData);
        info_block.appendChild(deetsdiv);

        //NAZIONE
        label = document.createElement("strong");
        label.textContent = 'Nazione:';

        labelData = document.createElement("strong");
        labelData.textContent = json[i]['country'];

        deetsdiv = document.createElement("div");
        deetsdiv.classList.add("finndata");

        deetsdiv.appendChild(label);
        deetsdiv.appendChild(labelData);
        info_block.appendChild(deetsdiv);

        //FINNHUB CAPITAL
        label = document.createElement("strong");
        label.textContent = 'Capitalizzazione:';

        labelData = document.createElement("strong");
        labelData.textContent = json[i]['marketCapitalization'];

        deetsdiv = document.createElement("div");
        deetsdiv.classList.add("finndata");

        deetsdiv.appendChild(label);
        deetsdiv.appendChild(labelData);
        info_block.appendChild(deetsdiv);

        //FINNHUB CURRENCY
        label = document.createElement("strong");
        label.textContent = 'Valuta:';

        labelData = document.createElement("strong");
        labelData.textContent = json[i]['currency'];

        deetsdiv = document.createElement("div");
        deetsdiv.classList.add("finndata");

        deetsdiv.appendChild(label);
        deetsdiv.appendChild(labelData);
        info_block.appendChild(deetsdiv);

        //IPO
        label = document.createElement("strong");
        label.textContent = 'IPO:';

        labelData = document.createElement("strong");
        labelData.textContent = json[i]['ipo'];

        deetsdiv = document.createElement("div");
        deetsdiv.classList.add("finndata");

        deetsdiv.appendChild(label);
        deetsdiv.appendChild(labelData);
        info_block.appendChild(deetsdiv);


        //AGGANCI AL BLOCCO PRINCIPALE
        block.appendChild(logo);
        block.appendChild(info_block);

        document.querySelector("#finance").appendChild(block);
    }
}

fetch("/partner/details").then(onResponseMarket).then(onJsonMarket);
