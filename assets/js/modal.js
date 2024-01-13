function show_modal(iteration) {
    var modal = document.getElementById("myModal" + iteration);
    // var btn = documen.getElementById("myBtn");
    var span = document.getElementById("close" + iteration);

    // btn.onclick = function () {
        modal.style.display = "block";
    // }

    span.onclick = function () {
        modal.style.display = "none";
    }

    window.onclick = function (event) {
        if(event.target == modal) {
            modal.style.display = "none";
        }
    }
}