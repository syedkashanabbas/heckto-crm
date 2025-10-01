document.addEventListener("DOMContentLoaded", () => {
    function loadAttendance() {
        fetch("/admin/attendance/data")
            .then(res => res.json())
            .then(data => {
                let tbody = document.getElementById("attendanceBody");
                tbody.innerHTML = "";

                if (data.length === 0) {
                    tbody.innerHTML = `<tr><td colspan="5" class="p-3 text-center text-gray-500">No records found</td></tr>`;
                    return;
                }

                data.forEach(row => {
                    let statusColor = row.status === "LOGIN"
                        ? "text-green-600"
                        : row.status === "AFK"
                        ? "text-yellow-600"
                        : "text-red-600";

                    tbody.innerHTML += `
                        <tr>
                            <td class="p-3">${row.user}</td>
                            <td class="p-3">${row.clock_in}</td>
                            <td class="p-3">${row.clock_out}</td>
                            <td class="p-3 font-bold ${statusColor}">${row.status}</td>
                            <td class="p-3">${row.worked}</td>
                        </tr>
                    `;
                });
            })
            .catch(err => console.error("Error:", err));
    }

    loadAttendance();
    setInterval(loadAttendance, 60000); // auto refresh every 1 min
});
