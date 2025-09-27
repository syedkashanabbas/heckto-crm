@extends('layouts.master-layout')

@section('content')
<div class="p-6 space-y-10">

  {{-- Top Row (3 widgets) --}}
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    {{-- Clock --}}
    <div class="bg-white dark:bg-navy-800 p-6 rounded-2xl shadow-lg text-center">
      <h3 class="text-lg font-semibold mb-3 text-slate-800 dark:text-white">Attendance Clock</h3>
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

    {{-- Today Date --}}
    <div class="bg-white dark:bg-navy-800 p-6 rounded-2xl shadow-lg text-center">
      <h3 class="text-lg font-semibold mb-3 text-slate-800 dark:text-white">Today</h3>
      <p id="todayDate" class="text-2xl font-bold text-indigo-600">Thu, Sep 25 2025</p>
    </div>

    {{-- World Clocks --}}
    <div class="bg-white dark:bg-navy-800 p-6 rounded-2xl shadow-lg text-center">
      <h3 class="text-lg font-semibold mb-3 text-slate-800 dark:text-white">World Clocks</h3>
      <p><b>🇵🇰 Pakistan:</b> <span id="pkTime">--:--:--</span></p>
      <p><b>🇬🇧 UK:</b> <span id="ukTime">--:--:--</span></p>
      <p><b>🇺🇸 USA (NY):</b> <span id="usTime">--:--:--</span></p>
    </div>
  </div>

  {{-- Middle Row (2 widgets) --}}
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white dark:bg-navy-800 p-6 rounded-2xl shadow-lg text-center">
      <h3 class="text-lg font-semibold mb-3 text-slate-800 dark:text-white">Total Hours Worked</h3>
      <p id="hoursWorked" class="text-3xl font-bold text-slate-700 dark:text-white">0h 00m</p>
    </div>
    <div class="bg-white dark:bg-navy-800 p-6 rounded-2xl shadow-lg text-center">
      <h3 class="text-lg font-semibold mb-3 text-slate-800 dark:text-white">Tasks Completed</h3>
      <p id="tasksCompleted" class="text-3xl font-bold text-indigo-600">18</p>
    </div>
  </div>

  {{-- Daily Summary --}}
  <div class="bg-white dark:bg-navy-800 p-6 rounded-2xl shadow-lg">
    <h3 class="text-lg font-semibold text-slate-800 dark:text-white mb-4">Daily Summary</h3>
    <input type="text" placeholder="Title"
      class="form-input w-full bg-transparent p-3 mb-4 text-lg font-medium placeholder:text-slate-400/70" />
    <textarea rows="5" placeholder="Write your daily summary..."
      class="form-textarea w-full resize-none bg-transparent p-3 placeholder:text-slate-400/70"></textarea>
    <div class="flex justify-end mt-4">
      <button class="btn rounded-md bg-primary px-4 text-xs-plus font-medium text-white hover:bg-primary-focus">
        Save Post
      </button>
    </div>
  </div>
</div>

{{-- JS for Clocks --}}
<script>
  function updateClocks() {
    const now = new Date();
    document.getElementById("mainClock").innerText = now.toLocaleTimeString();
    document.getElementById("todayDate").innerText = now.toLocaleDateString('en-US', { weekday: 'short', month: 'short', day: 'numeric', year: 'numeric' });
    const opts = { hour: '2-digit', minute: '2-digit', second: '2-digit' };
    document.getElementById("pkTime").innerText = new Date().toLocaleTimeString("en-GB", { ...opts, timeZone: "Asia/Karachi" });
    document.getElementById("ukTime").innerText = new Date().toLocaleTimeString("en-GB", { ...opts, timeZone: "Europe/London" });
    document.getElementById("usTime").innerText = new Date().toLocaleTimeString("en-US", { ...opts, timeZone: "America/New_York" });
  }
  setInterval(updateClocks, 1000);
  updateClocks();

  // Dummy login/logout toggle
  let isLoggedIn = false, loginCount = 0;
  $("#loginBtn").click(function () {
    if (!isLoggedIn) {
      isLoggedIn = true; loginCount++;
      $("#statusText").html('You are currently <span class="font-bold text-green-600">Logged In</span>');
      $("#loginCount").text(loginCount);
      $("#loginBtn").addClass("hidden"); $("#logoutBtn").removeClass("hidden");
    }
  });
  $("#logoutBtn").click(function () {
    if (isLoggedIn) {
      isLoggedIn = false;
      $("#statusText").html('You are currently <span class="font-bold text-red-600">Logged Out</span>');
      $("#logoutBtn").addClass("hidden"); $("#loginBtn").removeClass("hidden");
    }
  });
</script>
@endsection
