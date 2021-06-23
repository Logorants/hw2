/* FUNZIONI GESTIONE RESPONSE */

function onJsonEbayContent(json) {
    let data = json;
    data = data['findItemsByKeywordsResponse'][0]['searchResult'][0]['item'];

    for (let product of data) {
        add_block(product, false);
    }

}

function add_block(product, isFollowed) {
    const flex_container = isFollowed ? document.querySelector("#followed") : document.querySelector("#unfollowed");
    if(isFollowed) flex_container.classList.remove("hidden");

    const flex_item = document.createElement("div");
    const title = document.createElement("h2");
    const image = document.createElement("img");
    const dettagli = document.createElement("div");
    const price = document.createElement("em");
    const percentage = document.createElement("em");
    const button_container = document.createElement("div");
    const more = document.createElement("button");
    const follow = document.createElement("button");
    const link = document.createElement("a");

    title.textContent = isFollowed ? product['nome'] : product['title'][0];

    const keys = Object.keys(product);
    let avatar = "images/dinamic_contents/avatar_standard.png";

    if (isFollowed) image.src = product['img'];
    else {
        for (let key of keys) {

            if (key === "galleryPlusPictureURL") {
                avatar = product['galleryPlusPictureURL'][0];
            }
        }
        image.src = avatar;
    }

    //LINKS
    link.href = isFollowed ? product['link'] : product['viewItemURL'][0];
    link.target = "_blank";

    //DATASET
    flex_item.dataset.itemId = isFollowed ? product['ean13'] : product['itemId'][0];
    flex_item.dataset.productName = isFollowed ? product['nome'] : product['title'][0];
    flex_item.dataset.review = isFollowed ? parseFloat(product['recensione']) / 5 * 100 : parseFloat(product['sellerInfo'][0]['positiveFeedbackPercent'][0]) / 100 * 5;
    flex_item.dataset.price = isFollowed ? product['prezzo'] : product['sellingStatus'][0]['currentPrice'][0]['__value__'];
    flex_item.dataset.img = avatar;
    flex_item.dataset.link = link.href;
    more.dataset.show = '0';
    follow.dataset.followed = isFollowed ? "1" : "0";

    //PERCENTUALE POSITIVA
    percentage.textContent = isFollowed ? (product['recensione'] / 5 * 100) + "% di feedback positivi" : product['sellerInfo'][0]['positiveFeedbackPercent'][0] + "% di feedback positivi";
    const moredeets = document.createElement("div");
    moredeets.appendChild(percentage);

    //PREZZO
    price.textContent = isFollowed ? "€" + product['prezzo'] : "€" + product['sellingStatus'][0]['currentPrice'][0]['__value__'];
    const moredeets1 = document.createElement("div");
    moredeets1.appendChild(price);


    //CLASSI HIDDEN
    dettagli.appendChild(moredeets);
    dettagli.classList.add("hidden");

    //BOTTONI
    more.textContent = "show more";
    follow.textContent = isFollowed ? "unfollow -" : "follow +";

    more.classList.add("product_button", "m_button");
    more.addEventListener('click', onMore);
    follow.classList.add("product_button", "f_button");
    follow.addEventListener('click', onFollow);
    button_container.classList.add("b_container");

    link.appendChild(image);
    flex_item.appendChild(link);
    flex_item.appendChild(title);
    dettagli.appendChild(moredeets);
    dettagli.appendChild(moredeets1);
    flex_item.appendChild(dettagli);
    button_container.appendChild(more);
    button_container.appendChild(follow);
    flex_item.appendChild(button_container);

    flex_container.appendChild(flex_item);
}

/* HANDLERS */

function onMore(event) {
    const elem = event.currentTarget.parentElement.parentElement.children;

    if (event.currentTarget.textContent.toLowerCase() === "show more") {
        event.currentTarget.textContent = "show less";
        elem.item(2).classList.remove("hidden");

    } else {
        event.currentTarget.textContent = "show more";
        elem.item(2).classList.add("hidden");
    }

}

function onFollow(event) {
    const elem = event.target.parentElement.parentElement;
    check_prod_db(elem.dataset.itemId, event, elem, csrf_token);
}

function onResearch(event) {
    event.preventDefault();
    document.querySelector("#unfollowed").innerHTML = "";
    const q = document.forms['search']['query'].value;
    if (q !== "") fetch("/servizi/search/" + q).then(resp => resp.json()).then(onJsonEbayContent);

}

/* ISTRUZIONI: ASSEGNAZIONE EVENTI */

const more_b = document.querySelectorAll(".m_button");
const follow_b = document.querySelectorAll(".f_button");

for (let elem of more_b) {
    elem.addEventListener('click', onMore);
}

for (let elem of follow_b) {
    elem.addEventListener('click', onFollow);
}

document.forms['search'].addEventListener('submit', onResearch);
load_follows_db();
const csrf_token = document.querySelector('#token').getAttribute('content');
