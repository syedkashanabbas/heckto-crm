@extends('layouts.master-layout')

@section('content')
<div class="max-w-md p-6 mx-auto mt-10 space-y-6 text-center bg-white shadow-lg dark:bg-navy-800 rounded-2xl">

    <h2 class="text-2xl font-bold text-gray-800 dark:text-navy-100">Attendance System</h2>

    <!-- Status -->
    <div class="text-lg">
        Status:
        <span id="statusText" class="font-semibold text-gray-600 dark:text-white">Not Logged In</span>
    </div>

    <!-- Timer -->
    <div id="timerDisplay" class="font-mono text-4xl font-bold text-primary dark:text-accent-light">
        00:00:00
    </div>

    <!-- Buttons -->
    <div class="flex justify-center gap-4 mt-6">
        <button id="clockInBtn"
            class="px-4 py-2 transition border shadow-md rounded-xl bg-success/10 border-success/30 text-success hover:bg-success/20 focus:bg-success/20 active:bg-success/25">
            Clock In
        </button>

        <button id="afkBtn"
            class="hidden px-4 py-2 transition border shadow-md rounded-xl bg-warning/10 border-warning/30 text-warning hover:bg-warning/20 focus:bg-warning/20 active:bg-warning/25">
            AFK
        </button>

        <button id="clockOutBtn"
            class="hidden px-4 py-2 transition border shadow-md rounded-xl bg-error/10 border-error/30 text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25">
            Clock Out
        </button>
    </div>
</div>

<div class="p-6 space-y-10">



  {{-- Middle Row (2 widgets) --}}
  <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
    <div class="p-6 text-center bg-white shadow-lg dark:bg-navy-800 rounded-2xl">
      <h3 class="mb-3 text-lg font-semibold text-slate-800 dark:text-white">Tasks Completed</h3>
      <p id="tasksCompleted" class="text-3xl font-bold text-indigo-600">18</p>
    </div>
  </div>

  {{-- Daily Summary --}}
<div class="p-6 mt-6 bg-white shadow-lg dark:bg-navy-800 rounded-2xl">
  <h3 class="mb-4 text-lg font-semibold text-slate-800 dark:text-white">Daily Summary</h3>

  <!-- Date Picker -->
  <label class="relative flex mb-3">
    <input id="summaryDate"
      x-init="$el._x_flatpickr = flatpickr($el, { dateFormat: 'Y-m-d' })"
      class="w-full px-3 py-2 bg-transparent border rounded-lg form-input peer border-slate-300 pl-9"
      placeholder="Choose date..."
      type="text"
    />
    <span class="absolute flex items-center justify-center w-10 h-full pointer-events-none text-slate-400">
      📅
    </span>
  </label>

  <input type="text" id="summaryTitle"
    class="w-full p-3 mb-4 text-lg font-medium bg-transparent form-input placeholder:text-slate-400/70"
    placeholder="Title" />

  <textarea id="summaryText" rows="5"
    class="w-full p-3 bg-transparent resize-none form-textarea placeholder:text-slate-400/70"
    placeholder="Write your daily summary..."></textarea>

  <div class="flex justify-end mt-4">
    <button id="saveSummaryBtn"
      class="px-4 font-medium text-white rounded-md btn bg-primary text-xs-plus hover:bg-primary-focus">
      Save Daily Summary
    </button>
  </div>
</div>

</div>


@endsection
