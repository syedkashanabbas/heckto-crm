@extends('layouts.master-layout')

@section('content')
<div class="max-w-md mx-auto mt-10 dark:bg-navy-800 bg-white p-6 rounded-2xl shadow-lg text-center space-y-6">

    <h2 class="text-2xl font-bold text-gray-800">Attendance System</h2>

    <!-- Status -->
    <div class="text-lg">
        Status:
        <span id="statusText" class="font-semibold dark:text-white text-gray-600">Not Logged In</span>
    </div>

    <!-- Timer -->
    <div id="timerDisplay" class="text-4xl font-mono font-bold dark:text-white text-blue-600">
        00:00:00
    </div>

    <!-- Buttons -->
    <div class="flex justify-center gap-4 mt-6">
        <button id="clockInBtn"
            class="px-4 py-2 bg-green-500 hover:bg-green-600 text-slate-500 rounded-xl shadow-md transition">
            Clock In
        </button>

        <button id="afkBtn"
            class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-slate-500 dark:text-white rounded-xl shadow-md transition hidden">
            AFK
        </button>

        <button id="clockOutBtn"
            class="px-4 py-2 bg-red-500 hover:bg-red-600 text-slate-500 rounded-xl shadow-md dark:text-white transition hidden">
            Clock Out
        </button>
    </div>
</div>
<div class="p-6 space-y-10">



  {{-- Middle Row (2 widgets) --}}
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white dark:bg-navy-800 p-6 rounded-2xl shadow-lg text-center">
      <h3 class="text-lg font-semibold mb-3 text-slate-800 dark:text-white">Tasks Completed</h3>
      <p id="tasksCompleted" class="text-3xl font-bold text-indigo-600">18</p>
    </div>
  </div>

  {{-- Daily Summary --}}
  <div class="bg-white dark:bg-navy-800 p-6 rounded-2xl mt-6 shadow-lg">
    <h3 class="text-lg font-semibold text-slate-800 dark:text-white mb-4">Daily Summary</h3>
    <input type="text" placeholder="Title"
      class="form-input w-full bg-transparent p-3 mb-4 text-lg font-medium placeholder:text-slate-400/70" />
    <textarea rows="5" placeholder="Write your daily summary..."
      class="form-textarea w-full resize-none bg-transparent p-3 placeholder:text-slate-400/70"></textarea>
    <div class="flex justify-end mt-4">
      <button class="btn rounded-md bg-primary px-4 text-xs-plus font-medium text-white hover:bg-primary-focus">
        Save Daily Summary
      </button>
    </div>
  </div>
</div>


@endsection
