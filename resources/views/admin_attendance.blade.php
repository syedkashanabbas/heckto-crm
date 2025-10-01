@extends('layouts.master-layout')

@section('content')
    <div class="p-6 mt-10 bg-white shadow-lg dark:bg-navy-800 rounded-2xl">
        <h2 class="mb-4 text-xl font-bold text-gray-800 dark:text-white">Shift Attendance</h2>

        <div class="overflow-x-auto border border-gray-200 rounded-lg dark:border-navy-600">
            <table id="attendanceTable" class="w-full text-sm text-left border-collapse">
                <thead class="text-gray-700 bg-gray-100 dark:bg-navy-700 dark:text-gray-200">
                    <tr>
                        <th class="p-3">User</th>
                        <th class="p-3">Clock In</th>
                        <th class="p-3">Clock Out</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">Total Hours</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-navy-600" id="attendanceBody">
                    <tr>
                        <td colspan="5" class="p-3 text-center text-gray-500">Loading...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <style>
        /* Mobile look */
        @media (max-width: 768px) {
            #attendanceTable thead {
                display: none;
            }
          #attendanceTable tbody tr {
    display: block;
    margin-bottom: 1rem;
    border: 1px solid #e5e7eb;
    border-radius: 0.5rem;
    padding: 0.75rem;
    background: #fff;
}

.dark #attendanceTable tbody tr {
    background-color: rgb(30 41 59 / var(--tw-bg-opacity, 1)); /* dark:bg-navy-700 */
    border-color: rgb(51 65 85 / var(--tw-border-opacity, 1)); /* dark:border-navy-600 */
}

            #attendanceTable tbody tr td {
                display: flex;
                justify-content: space-between;
                padding: 0.5rem;
                border: none;
            }
            #attendanceTable tbody tr td::before {
                content: attr(data-label);
                font-weight: 600;
                color: #6b7280;
            }
        }

        /* Status badges */
        .status-badge {
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-block;
        }
        .status-login { background: #dcfce7; color: #166534; }
        .status-afk { background: #fef9c3; color: #854d0e; }
        .status-logout { background: #fee2e2; color: #991b1b; }
    </style>
@endsection
