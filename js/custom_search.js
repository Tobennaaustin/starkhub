function filterCards() {
    var input, filter, cards, card, txtValue, levelFilter, noResultsMessage;
    input = document.getElementById('searchInput');
    filter = input.value.toLowerCase();
    cards = document.getElementsByClassName('card');
    noResultsMessage = document.getElementById('noResultsMessage');

    var found = false;

    for (var i = 0; i < cards.length; i++) {
        card = cards[i];
        txtValue = card.getAttribute('data-search').toLowerCase();
        levelFilter = card.getAttribute('data-level').toLowerCase();

        if ((txtValue.indexOf(filter) > -1 || filter === '') && (levelFilter === 'all' || levelFilter === getCurrentTab())) {
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

function getCurrentTab() {
    var tabs = document.querySelectorAll('.radio');
    for (var i = 0; i < tabs.length; i++) {
        if (tabs[i].checked) {
            return tabs[i].id.replace('-tab', '');
        }
    }
    return 'all';
}