<template x-teleport="#x-teleport-target">
  <div
    x-data="{ showSuccessModal: false, message: '' }"
    x-show="showSuccessModal"
    x-cloak
    class="fixed inset-0 z-[200] flex items-center justify-center px-4 py-6 sm:px-5"
    role="dialog"
  >
    <div
      class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity duration-300"
      @click="showSuccessModal = false"
    ></div>
    <div
      class="relative max-w-lg w-full rounded-lg bg-white px-6 py-8 text-center transition-all duration-300 dark:bg-navy-700"
      x-transition:enter="ease-out"
      x-transition:enter-start="opacity-0 scale-95"
      x-transition:enter-end="opacity-100 scale-100"
      x-transition:leave="ease-in"
      x-transition:leave-start="opacity-100 scale-100"
      x-transition:leave-end="opacity-0 scale-95"
    >
      <svg
        xmlns="http://www.w3.org/2000/svg"
        class="inline size-20 text-success"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
        ></path>
      </svg>
      <div class="mt-4">
        <h2 class="text-2xl font-semibold text-slate-700 dark:text-navy-100">
          Success!
        </h2>
        <p class="mt-2 text-slate-600 dark:text-navy-200" x-text="message"></p>
        <button
          @click="showSuccessModal = false"
          class="btn mt-6 bg-success font-medium text-white hover:bg-success-focus focus:bg-success-focus active:bg-success-focus/90"
        >
          Close
        </button>
      </div>
    </div>
  </div>
</template>
