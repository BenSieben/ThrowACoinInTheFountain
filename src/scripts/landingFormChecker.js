/**
 * Returns document.getElementByID on given id
 * @param id the id to get element from
 * @returns {Element} document.getElementByID(id)
 */
function elt(id)
{
    return document.getElementById(id);
}

// Modifying what happens when purchase button is clicked
//   (by submitting info to Stripe for validation)
elt('purchase').onclick =
    function(event) {
        var purchase_form = elt('purchase-stuff-form');
        elt('purchase').disabled = true; // prevent additional clicks
        Stripe.card.createToken(purchase_form, tokenResponseHandler);
        event.preventDefault(); //prevent form submitting till get all clear
    };

/**
 * Response handler for receiving a token back
 * from Stripe. Displays an error message if
 * Stripe indicated there was an error
 * @param status (unused in this method) form with relevant information
 * @param response response from Stripe
 */
function tokenResponseHandler(status, response)
{
    var purchase_form = elt('purchase-stuff-form');
    if (response.error) {
        document.getElementById('clientErrorMessage').innerHTML =
            '<p>'+ response.error.message +'</p>';
        setTimeout(function(){
            document.getElementById('clientErrorMessage').innerHTML = '';
        }, 5000);
        elt('purchase').disabled = false;
    } else {
        elt('credit-token').value = response.id;
        purchase_form.submit();
    }
}
