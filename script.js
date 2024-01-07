document.getElementById('searchForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const searchQuery = document.getElementById('searchQuery').value;

    fetch(`search.php?search=${searchQuery}`)
    .then(response => response.text())
    .then(data => {
        document.getElementById('searchResults').innerHTML = data;
    });
});
