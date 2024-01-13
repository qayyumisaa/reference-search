document.getElementById('searchForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const searchQuery = document.getElementById('searchQuery').value;

    fetch(`search.php?search=${searchQuery}`)
    .then(response => response.text())
    .then(data => {
        document.getElementById('searchResults').innerHTML = data;
    });
});

function openModal() {
    document.getElementById('searchModal').style.display = 'block';
  }
  
  function closeModal() {
    document.getElementById('searchModal').style.display = 'none';
  }

