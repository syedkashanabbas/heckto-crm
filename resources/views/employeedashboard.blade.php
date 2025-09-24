@extends('layouts.master-layout')

@section('content')
<div class="w-full p-6  dark:bg-navy-900 min-h-screen">

  {{-- Top Widgets Row --}}
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
    {{-- Clock Widget --}}
    <div class="bg-white dark:bg-navy-800 p-6 rounded-2xl shadow-lg text-center">
      <h3 class="text-lg font-semibold text-slate-800 dark:text-white mb-3">Attendance Clock</h3>
      <p id="mainClock" class="text-4xl font-bold text-emerald-600">00:00:00</p>
      <p class="text-sm text-slate-500">Your Local Time</p>
      <div class="mt-4 flex justify-center space-x-3">
        <button id="loginBtn" class="px-4 py-2 rounded-lg bg-emerald-600 text-white text-sm font-medium hover:bg-emerald-700">
          Login
        </button>
        <button id="logoutBtn" class="px-4 py-2 rounded-lg bg-red-600 text-white text-sm font-medium hover:bg-red-700 hidden">
          Logout
        </button>
      </div>
      <p id="statusText" class="mt-3 text-slate-600 dark:text-slate-200 text-sm">
        You are currently <span class="font-bold text-red-600">Logged Out</span>
      </p>
      <p class="mt-1 text-xs text-slate-400">Total logins today: <span id="loginCount">0</span></p>
    </div>

    {{-- Date Widget --}}
    <div class="bg-white dark:bg-navy-800 p-6 rounded-2xl shadow-lg text-center">
      <h3 class="text-lg font-semibold text-slate-800 dark:text-white mb-3">Today</h3>
      <p id="todayDate" class="text-2xl font-bold text-indigo-600">Thu, Sep 25 2025</p>
    </div>

    {{-- World Clocks Widget --}}
    <div class="bg-white dark:bg-navy-800 p-6 rounded-2xl shadow-lg">
      <h3 class="text-lg font-semibold text-slate-800 dark:text-white mb-3 text-center">World Clocks</h3>
      <div class="space-y-2 text-sm">
        <p><span class="font-bold">🇵🇰 Pakistan:</span> <span id="pkTime">--:--:--</span></p>
        <p><span class="font-bold">🇬🇧 UK:</span> <span id="ukTime">--:--:--</span></p>
        <p><span class="font-bold">🇺🇸 USA (New York):</span> <span id="usTime">--:--:--</span></p>
      </div>
    </div>
  </div>

  {{-- Daily Summary Section --}}
  <div class="bg-white dark:bg-navy-800 rounded-2xl shadow p-6">
    <h3 class="text-xl font-bold mb-4 text-slate-800 dark:text-white">Daily Summary</h3>

    <div class="flex justify-between">
      <label class="block w-full">
        <input
          type="text"
          class="form-input w-full bg-transparent p-3 text-lg font-medium placeholder:text-slate-400/70"
          placeholder="Title"
        />
      </label>
      <div class="p-2">
        <button class="btn size-8 rounded-full p-0 hover:bg-slate-200 dark:hover:bg-navy-600">
          <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
          </svg>
        </button>
      </div>
    </div>

    <label>
      <textarea rows="5" placeholder="Write your daily summary..."
        class="form-textarea w-full resize-none bg-transparent p-3 placeholder:text-slate-400/70"></textarea>
    </label>

    <div class="flex justify-between p-2.5">
      <div class="flex items-end space-x-1">
        <button class="btn size-8 rounded-full p-0 hover:bg-slate-200 dark:hover:bg-navy-600">
          <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
          </svg>
        </button>
      </div>
      <button
        class="btn rounded-md bg-primary px-4 text-sm font-medium text-white hover:bg-primary-focus">
        Save Post
      </button>
    </div>
  </div>
</div>

{{-- jQuery & Clock Script --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  function updateClocks() {
    let now = new Date();
    $('#mainClock').text(now.toLocaleTimeString());
    $('#todayDate').text(now.toDateString());

    $('#pkTime').text(new Date().toLocaleTimeString("en-GB", { timeZone: "Asia/Karachi" }));
    $('#ukTime').text(new Date().toLocaleTimeString("en-GB", { timeZone: "Europe/London" }));
    $('#usTime').text(new Date().toLocaleTimeString("en-US", { timeZone: "America/New_York" }));
  }
  setInterval(updateClocks, 1000);
  updateClocks();

  let loginCount = 0;
  $('#loginBtn').on('click', function () {
    $('#statusText').html('You are currently <span class="font-bold text-emerald-600">Logged In</span>');
    $('#loginBtn').addClass('hidden');
    $('#logoutBtn').removeClass('hidden');
    loginCount++;
    $('#loginCount').text(loginCount);
  });

  $('#logoutBtn').on('click', function () {
    $('#statusText').html('You are currently <span class="font-bold text-red-600">Logged Out</span>');
    $('#logoutBtn').addClass('hidden');
    $('#loginBtn').removeClass('hidden');
  });
</script>
@endsection
