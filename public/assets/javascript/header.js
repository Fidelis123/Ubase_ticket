// C:\xampp\htdocs\Ubase_ticket\public\assets\javascript\header.js
const header = document.getElementById('header');

header.innerHTML = `
    <div class="logo-img flex">
        <a href="index.html"><img src="./public/assets/image/venue/bmwone.jpg" alt="logo">
            <h1>Ubase Tickets</h1></a>
    </div>

        <nav class="header-nav">
            <ul>
                <li><a href="postarms.html" class="active">Postarms</a></li>
                <li><a href="categories.html">Categories</a></li>
                <li><a href="revisites.html">Revisites</a></li>
            </ul>
        </nav>

        <div class="search" id="search">
           <button type="submit" class="btn"><a href="./app/pages/getstarted.php">Get started</a></button>
        </div>
`;

// select all nav links 
const navLinks = document. querySelectorAll ("nav ul li a");

//Get current page filenames (e.g., "about.html")
const currentPage = window.location.pathname.split ("/").pop();

// loop through each link
navLinks.forEach(link => {
    //we use .includes() because sometimes URLS  have extra paths or parameters

    if (link.getAttribute("href")=== currentPage ||(currentPage === "" && link.getAttribute("href") === "index.html")) {
        link.classList.add("active");
    } else {
        link.classList.remove("active");
    }
});

