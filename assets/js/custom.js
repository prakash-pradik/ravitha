
$(window).on('load', function(){ 
  // Preloader
  $('.loader').fadeOut();
  $('.loader-mask').delay(350).fadeOut('slow');
});

document.getElementById("contactForm").addEventListener("submit", function(e) {
    e.preventDefault();

    const form = this;
    const button = document.getElementById("sendBtn");
    const msg = document.getElementById("formMsg");

    button.classList.add("loading");
    msg.textContent = "";

    fetch("send-mail.php", {
        method: "POST",
        body: new FormData(form)
    })
    .then(res => res.text())
    .then(response => {
        button.classList.remove("loading");
        msg.textContent = response;
        msg.style.color = "green";
        form.reset();
    })
    .catch(error => {
        button.classList.remove("loading");
        msg.textContent = "Etwas ist schiefgelaufen. Versuchen Sie es erneut!";
        msg.style.color = "red";
    });
});

document.getElementById("newsletterForm").addEventListener("submit", function(e) {
    e.preventDefault();

    const form = this;
    const button = document.getElementById("subscribeBtn");
    const msg = document.getElementById("successMsg");

    button.classList.add("loading");
    msg.textContent = "";

    fetch("subscribe-mail.php", {
        method: "POST",
        body: new FormData(form)
    })
    .then(res => res.text())
    .then(response => {
        button.classList.remove("loading");
        msg.textContent = response;
        msg.style.color = "green";
        form.reset();
    })
    .catch(error => {
        button.classList.remove("loading");
        msg.textContent = "Etwas ist schiefgelaufen. Versuchen Sie es erneut!";
        msg.style.color = "red";
    });
});