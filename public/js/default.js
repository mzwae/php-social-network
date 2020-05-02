// tooltip activation
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});
window.addEventListener("load", function() {
    var status = document.getElementById("status");
    var log = document.getElementById("log");

    //Anonymous function to make alert info display temporary
    (function() {
        if ($("div").hasClass("alert-info")) {
            //Fade out in 10 seconds
            $(".alert-info").animate({ opacity: 0 }, 10000);
        }
    })();

    //Online state detector
    function updateOnlineStatus(event) {
        var condition = navigator.onLine
            ? "alert alert-success sticky-top"
            : "alert alert-danger sticky-top";
        var alert = navigator.onLine ? "Back Online" : "Offline";

        if (navigator.onLine) {
            // Wait for 10 seconds
            // Fade out
            $("#status").animate({ opacity: 0 }, 10000);
        } else {
            // Wait for 4 seconds
            //Fade in
            $("#status").animate({ opacity: 100 }, 4000);
        }

        status.className = condition;
        status.innerHTML = alert;

        // log.insertAdjacentHTML("beforeend", "Event: " + event.type + "; Status: " + condition);
    }

    window.addEventListener("online", updateOnlineStatus);
    window.addEventListener("offline", updateOnlineStatus);
});
