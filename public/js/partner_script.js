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
