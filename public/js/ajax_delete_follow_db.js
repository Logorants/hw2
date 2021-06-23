/* FUNZIONE CHE CANCELLA UN PRODOTTO SEGUITO */

function delete_follow_db(itemid, csrf_token){

    const form = new FormData();
    form.append("itemid",itemid);

    fetch("/servizi/follows/delete", {
        method: "POST",
        body: form,
        headers: {
            'X-CSRF-TOKEN': csrf_token
        }
    });
}
