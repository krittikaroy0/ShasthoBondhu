// navbar scroll background change code start
const navbar = document.querySelector('#navbar');
window.onscroll = () => {
    if (window.scrollY > 100) {
        navbar.classList.add('nav-active');
    } else {
        navbar.classList.remove('nav-active');
    }
};
// navbar scroll background change code end
function updateDateTime() {
    const now = new Date();
    const formatted = now.toLocaleString(); // You can customize format
    document.getElementById('datetime').textContent = formatted;
}

updateDateTime(); // Initial call
setInterval(updateDateTime, 1000); // Update every second

document.getElementById("emailForm").addEventListener("submit", function (e) {
    const emailInput = document.getElementById("inputEmail4").value.trim();
    const errorMsg = document.getElementById("errorMsg");
    const gmailRegex = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;

    if (!gmailRegex.test(emailInput)) {
        e.preventDefault();
        errorMsg.style.display = "block";
    } else {
        errorMsg.style.display = "none";
    }
});
// search code
 const form = document.getElementById('searchForm');
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const query = document.getElementById('searchQuery').value;

        fetch('search.php?q=' + encodeURIComponent(query))
            .then(response => response.text())
            .then(data => {
                document.getElementById('results').innerHTML = data;
            });
    });