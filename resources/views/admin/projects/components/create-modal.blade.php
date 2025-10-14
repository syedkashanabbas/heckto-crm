<template x-teleport="#x-teleport-target">
    <div
    class="fixed inset-0 z-[100] flex flex-col items-center justify-center overflow-hidden px-4 py-6 sm:px-5"
    x-show="showcreateModal"
    x-cloak
      x-data="{
             
              users: [],
              async loadUsers() {
                try {
                  const res = await fetch('/users/mini');
                  const data = await res.json();
                  if (data.success && Array.isArray(data.data)) {
                    this.users = data.data;
                  }
                } catch (err) {
                  console.error('Failed to load users', err);
                }
              }
            }"
    role="dialog"
    @keydown.window.escape="showcreateModal = false"
    x-effect="if (showcreateModal) loadUsers()"
  >

    <div
      class="absolute inset-0 bg-slate-900/60 transition-opacity duration-300"
      @click="showcreateModal = false"
      x-show="showcreateModal"
      x-transition:enter="ease-out"
      x-transition:enter-start="opacity-0"
      x-transition:enter-end="opacity-100"
      x-transition:leave="ease-in"
      x-transition:leave-start="opacity-100"
      x-transition:leave-end="opacity-0"
    ></div>

    <div
      class="relative w-full max-w-lg origin-top rounded-lg bg-white shadow-xl transition-all duration-300 dark:bg-navy-700"
      x-show="showcreateModal"
      x-transition:enter="ease-out"
      x-transition:enter-start="opacity-0 scale-95"
      x-transition:enter-end="opacity-100 scale-100"
      x-transition:leave="ease-in"
      x-transition:leave-start="opacity-100 scale-100"
      x-transition:leave-end="opacity-0 scale-95"
    >
      <div class="flex justify-between rounded-t-lg bg-slate-200 px-4 py-3 dark:bg-navy-800 sm:px-5">
        <h3 class="text-base font-medium text-slate-700 dark:text-navy-100">Create New Project</h3>
        <button
          @click="showcreateModal = false"
          class="btn -mr-1.5 size-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="size-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
      </div>

      <div class="px-4 py-4 sm:px-5 space-y-4">

        <!-- Thumbnail Upload + Color Picker Row -->
        <div class="flex items-start space-x-4">
          <!-- Thumbnail Upload with Preview -->
          <div x-data="{ preview: null }" class="flex flex-col">
            <span class="font-medium text-slate-700 dark:text-navy-100 mb-1">Thumbnail:</span>
            <label
              class="relative flex h-24 w-24 cursor-pointer items-center justify-center overflow-hidden rounded-lg border border-slate-300 bg-slate-100 hover:bg-slate-200 dark:border-navy-450 dark:bg-navy-600 dark:hover:bg-navy-550"
            >
              <input
                type="file"
                accept="image/*"
                class="absolute inset-0 h-full w-full opacity-0 cursor-pointer"
                @change="preview = URL.createObjectURL($event.target.files[0])"
              />
              <template x-if="!preview">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-6 text-slate-500 dark:text-navy-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                </svg>
              </template>
              <img x-show="preview" :src="preview" class="absolute inset-0 h-full w-full object-cover" />
            </label>
          </div>

          <!-- Color Picker -->
          <div class="flex flex-col">
            <span class="font-medium text-slate-700 dark:text-navy-100 mb-1">Project Color:</span>
            <input
              type="color"
              class="h-12 w-20 rounded-lg border border-slate-300 cursor-pointer hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
            />
          </div>
        </div>

        <!-- Project Name -->
        <label class="block">
          <span>Project Name:</span>
          <input
            class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
            placeholder="Enter project name"
            type="text"
          />
        </label>

        <!-- Description -->
        <label class="block">
          <span>Description:</span>
          <textarea
            rows="3"
            placeholder="Describe the project..."
            class="form-textarea mt-1.5 w-full resize-none rounded-lg border border-slate-300 bg-transparent p-2.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
          ></textarea>
        </label>

      <label class="block">
  <span>Assign Users:</span>
  <select
    x-ref="userSelect"
    x-init="$el._tom = new Tom($el)"
    x-effect="
      if (users.length && $refs.userSelect._tom) {
        // clear previous options
        $refs.userSelect.innerHTML = '';
        // re-render fresh ones
        users.forEach(u => {
          const opt = document.createElement('option');
          opt.value = u.id;
          opt.textContent = u.name;
          $refs.userSelect.appendChild(opt);
        });
        // Tom Select refresh
        $refs.userSelect._tom.sync();
      }
    "
    class="mt-1.5 w-full"
    multiple
    placeholder="Select team members..."
    autocomplete="off"
  ></select>
</label>


        <!-- Dates -->
        <div class="grid grid-cols-2 gap-3">
          <label class="relative flex flex-col">
            <span>Start Date:</span>
            <input
              x-init="$el._x_flatpickr = flatpickr($el)"
              class="form-input mt-1.5 peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
              placeholder="Select start date"
              type="text"
            />
            <span class="pointer-events-none absolute right-3 top-8 text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
              <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
              </svg>
            </span>
          </label>

          <label class="relative flex flex-col">
            <span>End Date:</span>
            <input
              x-init="$el._x_flatpickr = flatpickr($el)"
              class="form-input mt-1.5 peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
              placeholder="Select end date"
              type="text"
            />
            <span class="pointer-events-none absolute right-3 top-8 text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
              <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
              </svg>
            </span>
          </label>
        </div>

        <!-- Status -->
        <label class="block">
          <span>Status:</span>
         <select
        class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent"
      >
        <option value="draft">Draft</option>
        <option value="active">Active</option>
        <option value="on_hold">On Hold</option>
        <option value="completed">Completed</option>
        <option value="archived">Archived</option>
      </select>

        </label>

        <!-- Progress Range -->
        <div x-data="{ range: 50 }">
          <div class="flex justify-between text-xs text-slate-500 dark:text-navy-200">
            <span>0%</span>
            <span>100%</span>
          </div>
          <input
            x-model="range"
            type="range"
            min="0"
            max="100"
            class="form-range mt-2 text-slate-500 dark:text-navy-300 w-full"
          />
          <p class="mt-1 text-sm">Progress: <span class="font-semibold text-primary dark:text-accent" x-text="range"></span>%</p>
        </div>

        <div class="space-x-2 text-right pt-4">
          <button
            @click="showcreateModal = false"
            class="btn min-w-[7rem] rounded-full border border-slate-300 font-medium text-slate-800 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-50 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90"
          >
            Cancel
          </button>
           <button
          id="createProjectBtn"
          class="btn min-w-[7rem] rounded-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
        >
          Create
        </button>


        </div>
      </div>
    </div>
  </div>
</template>
