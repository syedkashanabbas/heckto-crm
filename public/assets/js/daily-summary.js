let dateInput = document.getElementById("summaryDate");
let titleInput = document.getElementById("summaryTitle");
let textInput = document.getElementById("summaryText");

// jab date change ho to fetch karo
dateInput.addEventListener("change", async () => {
    let date = dateInput.value;

    if (!date) return;

    let res = await fetch(`/daily-summary?date=${date}`, {
        headers: { "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content }
    });

    let data = await res.json();

    if (res.ok && data) {
        titleInput.value = data.title || "";
        textInput.value = data.summary || "";
    } else {
        // agar koi summary na ho to empty fields
        titleInput.value = "";
        textInput.value = "";
    }
});

// save button (same as before)
document.getElementById("saveSummaryBtn").addEventListener("click", async () => {
    let date = dateInput.value;
    let title = titleInput.value;
    let text = textInput.value;

    let res = await fetch("/daily-summary", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ title, summary: text, summary_date: date })
    });

    let data = await res.json();
    if (res.ok) {
        alert("Summary saved ✅");
    } else {
        alert(data.error || "Error saving summary ❌");
    }
});
