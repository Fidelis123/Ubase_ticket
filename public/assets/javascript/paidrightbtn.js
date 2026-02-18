function scrollRight() {
    const container = document.getElementById('paidcontent');
    // scroll amount: Card width (150px) + margin (60px total) = 210px
    container.scrollBy({
        left: 250,
        behavior: 'smooth'
    });
}