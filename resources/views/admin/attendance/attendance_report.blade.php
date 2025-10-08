@extends('layouts.master-layout')

@section('content')
<div class="p-6 mt-10 bg-white shadow-lg dark:bg-navy-800 rounded-2xl">
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
        <label class="block">
            <span>User</span>
            <select id="userSelect"
                class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                <option value="">Select User</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </label>

        <label class="relative flex">
            <input
                id="dateRange"
                x-init="$el._x_flatpickr = flatpickr($el, {
                    mode: 'range',
                    dateFormat: 'Y-m-d',
                    altInput: true,
                    altFormat: 'M d, Y',
                    allowInput: true
                })"
                class="w-full px-3 py-2 bg-transparent border rounded-lg form-input peer border-slate-300 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                placeholder="Choose date..."
                type="text"
            />
            <span
                class="absolute flex items-center justify-center w-10 h-full pointer-events-none text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="transition-colors duration-200 size-5"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </span>
        </label>
    </div>

    <div id="reportContainer" class="min-w-full mt-4 overflow-x-auto border rounded-lg is-scrollbar-hidden border-slate-200 dark:border-navy-500">
        <table class="hidden w-full text-left" id="reportTable">
            <thead>
                <tr>
                    <th class="px-3 py-3 font-semibold uppercase border border-t-0 border-l-0 whitespace-nowrap border-slate-200 text-slate-800 dark:border-navy-500 dark:text-navy-100 lg:px-5">#</th>
                    <th class="px-3 py-3 font-semibold uppercase border border-t-0 whitespace-nowrap border-slate-200 text-slate-800 dark:border-navy-500 dark:text-navy-100 lg:px-5">Clock In</th>
                    <th class="px-3 py-3 font-semibold uppercase border border-t-0 whitespace-nowrap border-slate-200 text-slate-800 dark:border-navy-500 dark:text-navy-100 lg:px-5">Clock Out</th>
                    <th class="px-3 py-3 font-semibold uppercase border border-t-0 border-r-0 whitespace-nowrap border-slate-200 text-slate-800 dark:border-navy-500 dark:text-navy-100 lg:px-5">Worked Hours</th>
                </tr>
            </thead>
            <tbody id="reportBody"></tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
{{-- <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> --}}
<script src="{{ asset('assets/js/attendance_report.js') }}"></script>
@endpush
