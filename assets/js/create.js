function getCall(val) {
    const control = document.getElementById(val);
    const controls = document.getElementsByClassName("controls");

    if (controls) {
        Array.prototype.forEach.call(controls, (el) => {
            if (el) {
                el.style.display = "none";
            }
        });
        if (control) {
            control.style.display = "block";
        }
    }
}

$("#selectee").change(function() {
    $(".cleardiv").val("");
});
