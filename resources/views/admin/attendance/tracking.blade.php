@extends('layouts.master-layout')

@section('content')
<div class="p-6 mt-10 bg-white shadow-lg dark:bg-navy-800 rounded-2xl">
    <h2 class="mb-4 text-xl font-bold text-gray-800 dark:text-white">Tracking Attendance</h2>

    <!-- Date Picker -->
    <label class="relative flex max-w-xs mb-4">
        <input id="datePicker"
            x-init="$el._x_flatpickr = flatpickr($el, {dateFormat: 'Y-m-d'})"
            class="w-full px-3 py-2 bg-transparent border rounded-lg form-input peer border-slate-300 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
            placeholder="Choose date..."
            type="text"
        />
        <span class="absolute flex items-center justify-center w-10 h-full text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
        </span>
    </label>

    <!-- Table -->
    <table class="w-full mt-5 text-left border-collapse">
        <thead class="bg-gray-100 dark:bg-navy-700">
            <tr>
                <th class="p-3">User</th>
                <th class="p-3">Clock In</th>
                <th class="p-3">Clock Out</th>
                <th class="p-3">Status</th>
                <th class="p-3">AFK Minutes</th>
                <th class="p-3">Total Hours</th>
            </tr>
        </thead>
        <tbody id="trackingBody" class="divide-y divide-gray-200 dark:divide-navy-600">
            <tr>
                <td colspan="5" class="p-3 text-center text-gray-500">Select a date to view records</td>
            </tr>
        </tbody>
    </table>
</div>

<script>
document.getElementById('datePicker').addEventListener('change', function() {
    let date = this.value;

    fetch("{{ route('tracking.fetch') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ date })
    })
    .then(res => res.json())
    .then(data => {
        let tbody = document.getElementById('trackingBody');
        tbody.innerHTML = "";

        if (!data || data.length === 0) {
            tbody.innerHTML = `<tr><td colspan="5" class="p-3 text-center text-gray-500">No records found</td></tr>`;
        } else {
            data.forEach(row => {
                tbody.innerHTML += `
                    <tr>
                        <td class="p-3">${row.name ?? '-'}</td>
                        <td class="p-3">${row.clock_in ? row.clock_in : '-'}</td>
                        <td class="p-3">${row.clock_out ? row.clock_out : '-'}</td>
                        <td class="p-3">${row.status ?? '-'}</td>
                        <td class="p-3">${row.afk_minutes ?? '-'}</td>
                        <td class="p-3">${row.worked_hours ? row.worked_hours : '0h'}</td>
                    </tr>
                `;
            });
        }
    })
    .catch(err => {
        console.error("Error fetching data:", err);
        document.getElementById('trackingBody').innerHTML =
            `<tr><td colspan="5" class="p-3 text-center text-red-500">Error loading data</td></tr>`;
    });
});
</script>
@endsection
