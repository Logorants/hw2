/* FUNZIONE CHE AGGIUNGE UN PRODOTTO AI SEGUITI SUL DB */

function ajax_add_follow_db(itemId, productName, review, price, img, link, csrf_token){

    const form = new FormData;

    form.append('id', itemId);
    form.append('pn', productName);
    form.append('rw', review);
    form.append('p', price);
    form.append('img', img);
    form.append('link', link);

    fetch("/servizi/follows/add", {
        method: 'POST',
        body: form,
        headers: {
            'X-CSRF-TOKEN': csrf_token
        }
    });

}
