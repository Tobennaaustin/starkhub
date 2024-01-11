function filterCards() {
    var input, filter, cards, card, txtValue, noResultsMessage;
    input = document.getElementById('searchInput');
    filter = input.value.toLowerCase();
    cards = document.getElementById('cardContainer').getElementsByClassName('card');
    noResultsMessage = document.getElementById('noResultsMessage');

    var found = false;

    for (var i = 0; i < cards.length; i++) {
        card = cards[i];
        txtValue = card.getAttribute('data-search');
        if (txtValue.toLowerCase().indexOf(filter) > -1) {
            card.style.display = '';
            found = true;
        } else {
            card.style.display = 'none';
        }
    }

    // Display a message if no results are found
    if (noResultsMessage) {
        noResultsMessage.style.display = found ? 'none' : '';
    }
}