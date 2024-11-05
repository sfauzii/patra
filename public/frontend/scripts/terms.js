document.querySelectorAll('#terms-btn').forEach(function (button) {
    button.addEventListener('click', function (event) {
        event.preventDefault()
        document.getElementById('terms-popup').style.display = 'flex'
    })
})

// Hide the popup if clicked outside of the card
window.addEventListener('click', function (event) {
    const popup = document.getElementById('terms-popup')
    if (event.target === popup) {
        popup.style.display = 'none'
    }
})
