$(document).ready(function () {
    let timerInterval;
    let startTime;

    function startTimer(start) {
        startTime = start ? new Date(start) : new Date();
        stopTimer();
        timerInterval = setInterval(function () {
            let now = new Date();
            let diff = Math.floor((now - startTime) / 1000);

            let hours = String(Math.floor(diff / 3600)).padStart(2, '0');
            let minutes = String(Math.floor((diff % 3600) / 60)).padStart(2, '0');
            let seconds = String(diff % 60).padStart(2, '0');

            $("#timerDisplay").text(`${hours}:${minutes}:${seconds}`);
        }, 1000);
    }

    function stopTimer() {
        clearInterval(timerInterval);
    }
    

    // CSRF
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    // ---- INITIAL LOAD ----
    $.get("/attendance/status", function (res) {
        if (res.status === "LOGIN") {
            $("#statusText").text("LOGIN").removeClass().addClass("font-semibold text-green-600");
            $("#clockInBtn").hide();
            $("#afkBtn").show();
            $("#clockOutBtn").show();
            startTimer(res.clock_in_time); // resume from saved clock_in_time
        } else if (res.status === "AFK") {
            $("#statusText").text("AFK").removeClass().addClass("font-semibold text-yellow-600");
            $("#clockInBtn").hide();
            $("#afkBtn").show();
            $("#clockOutBtn").show();
            // timer paused
        } else if (res.status === "LOGOUT") {
            $("#statusText").text("LOGOUT").removeClass().addClass("font-semibold text-red-600");
            $("#clockInBtn").show();
            $("#afkBtn").hide();
            $("#clockOutBtn").hide();
        } else {
            // NONE
            $("#statusText").text("Not Logged In").removeClass().addClass("font-semibold text-gray-600");
            $("#clockInBtn").show();
            $("#afkBtn").hide();
            $("#clockOutBtn").hide();
        }
    });

    // Clock In
    $("#clockInBtn").click(function () {
        $.post("/attendance/clock-in", {}, function (res) {
            $("#statusText").text("LOGIN").removeClass().addClass("font-semibold text-green-600");
            $("#clockInBtn").hide();
            $("#afkBtn").show();
            $("#clockOutBtn").show();
            startTimer(res.attendance.clock_in_time);
        }).fail(function (err) {
            alert(err.responseJSON.message);
        });
    });

    // AFK Toggle
    $("#afkBtn").click(function () {
        $.post("/attendance/afk", {}, function (res) {
            if (res.attendance.status === "AFK") {
                $("#statusText").text("AFK").removeClass().addClass("font-semibold text-yellow-600");
                stopTimer();
            } else {
                $("#statusText").text("LOGIN").removeClass().addClass("font-semibold text-green-600");
                startTimer(res.attendance.afk_end_time || new Date());
            }
        }).fail(function (err) {
            alert(err.responseJSON.message);
        });
    });

    // Clock Out
    $("#clockOutBtn").click(function () {
        $.post("/attendance/clock-out", {}, function (res) {
            $("#statusText").text("LOGOUT").removeClass().addClass("font-semibold text-red-600");
            stopTimer();
            $("#timerDisplay").text("00:00:00");
            $("#clockInBtn").show();
            $("#afkBtn").hide();
            $("#clockOutBtn").hide();
        }).fail(function (err) {
            alert(err.responseJSON.message);
        });
    });
});
