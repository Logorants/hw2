/* FUNZIONE CHE CONTROLLA I SEGUITI */

function check_follows_db(item_id, event, elem, checkProd, csrf_token) {

    fetch("/servizi/follows/check/" + item_id).then(resp => {

        return resp.json();

    }).then(json => {
        console.log(json);
        if (event.target.dataset.followed === "0" && !json['check']) {

            if (!checkProd) {
                ajax_add_follow_db(elem.dataset.itemId, elem.dataset.productName, elem.dataset.review, elem.dataset.price, elem.dataset.img, elem.dataset.link, csrf_token);
            }

            event.target.dataset.followed = "1";
            const container = document.querySelector("#followed");
            event.target.textContent = "unfollow -";
            container.appendChild(elem);

            container.classList.remove("hidden");
            document.querySelector("#products div").classList.remove("hidden");

        } else if (event.target.dataset.followed === "1") {
            event.target.dataset.followed = "0";
            const container = document.querySelector("#unfollowed");
            event.target.textContent = "follow +";
            container.appendChild(elem);

            delete_follow_db(elem.dataset.itemId, csrf_token);

            if (document.querySelector("#followed").children.length === 0) {
                document.querySelector("#followed").classList.add("hidden");
            }
        }

    })

}
