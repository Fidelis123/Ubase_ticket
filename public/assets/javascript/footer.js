//C:\xampp\htdocs\Ubase_ticket\public\assets\javascript\footer.js

const footer = document.getElementById('footer');

footer.innerHTML = `
    <div class="footer-container">

        <div class="footer-content-wrapper">

            <div class="footer-left">
                <div class="logo-img ">
                    <img src="./public/assets/image/venue/bmwone.jpg" alt="logo">
                    <span>Ubase Tickets</span>
                </div>

                <div class="footer-newsletter">
                    <p>Join our newsletter to stay up to date on features and release</p>
                        <form class="newsletter-form">
                            <div class="newsletter-input">
                                <input type="email" placeholder="Enter your email" required>
                            <button type="submit" class="search-btn" 
                                id="subscribe">Subscribe</button>
                            </div>      
                        </form>
                    </div>
                </div>    
            
    

            <div class="footer-right">
                <div class="footer-links-wrapper">
                    <div class="footer-column">
                        <ul>
                            <li><a href="./app/pages/company.php">Company</a></li>
                            <li><a href="./app/pages/about.php">About Us</a></li>
                            <li><a href="./app/pages/services.php">Services</a></li>
                        </ul>
                    </div>

                    <div class="footer-column">
                        <ul>
                            <li><a href="./app/pages/Resources.php">Resources</a></li>
                            <li><a href="./app/pages/Events.php">Events</a></li>
                            <li><a href="./app/pages/Newsletter.php">Newsletter</a></li>
                            <li><a href="./app/pages/FAQs.php">FAQs</a></li>
                        </ul>
                    </div>

                    <div class="footer-column">
                        <ul>
                            <li><a href="./app/pages/Support.php">Support</a></li>
                            <li><a href="./app/pages/Help.php">Help Center</a></li>
                            <li><a href="./app/pages/Contact.php">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
        

                <div class="footer-socials">
                    <a href=""><img src="./public/assets/image/icons/twitter (1).png" alt=""></a>
                    <a href=""><img src="./public/assets/image/icons/instagram.png" alt=""></a>
                    <a href=""><img src="./public/assets/image/icons/whatsapp (1).png" alt=""></a>
                    <a href=""><img src="./public/assets/image/icons/facebook.png" alt=""></a>
                </div>
            </div>
        </div>
        <div class="line"></div>

        <section class="footer-legal">
            <div class="legal-left">
                <p>&copy; 2026 Ubase Tickets. All Rights Reserved.</p>
            </div>

            <div class="legal-right">
                    <a href="./app/pages/terms.php">Terms of Service</a>
                    <a href="./app/pages/privacy.php">Privacy Policy</a>
                    <a href="./app/pages/sitemap.php">Sitemap</a>
                </div>
        </section>

    </div>`;

    // --- DYNAMIC ACTIVE CLASS LOGIC ---
    
    // Get the current file name from the URL (e.g., "about.php")

    const currentFile = window.location.pathname.split("/").pop();

    // Select all footer links
    const footerLinks = document.querySelectorAll(".footer-links-wrapper a"); 
    
    footerLinks.forEach(link => {
        //get the filename from the link's href attribute
        const linkHref = link.getAttribute("href").split("/").pop();

        // If the link's href matches the current file, add the active class
        if (linkHref === currentFile && currentFile !== "") {
            link.classList.add("active");
        } else {
            link.classList.remove("active");
        }
    });