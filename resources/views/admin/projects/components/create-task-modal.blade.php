<template x-teleport="#x-teleport-target">
  <div
    class="fixed inset-0 z-[100] flex flex-col items-center justify-center overflow-hidden px-4 py-6 sm:px-5"
    x-show="showtaskModal"
    x-data="taskModal({ projectId: {{ $project->id }} })"
    @keydown.window.escape="showtaskModal = false"
  >
    <div class="absolute inset-0 bg-slate-900/60" @click="showtaskModal = false"></div>

    <div
      class="relative w-full max-w-lg origin-top rounded-2xl shadow-2xl bg-white dark:bg-navy-700 transition-all duration-300"
      x-show="showtaskModal"
      x-transition
    >
      <div class="flex justify-between items-center bg-gradient-to-r from-primary/80 to-primary px-4 py-3 rounded-t-2xl">
        <h3 class="text-lg font-medium text-slate-700 line-clamp-1 dark:text-navy-50">Create New Task</h3>
        <button @click="showtaskModal = false" class="text-white hover:opacity-80">
          <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>

      <div class="px-6 py-5 space-y-4">
        <div>
          <label class="block">
            <span class="font-medium text-slate-700 dark:text-navy-100">Title</span>
            <input
              x-model="form.title"
              type="text"
              placeholder="Enter task title"
              class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 hover:border-slate-400 focus:border-primary"
              :class="errors.title ? 'border-red-500 focus:border-red-500' : ''"
            />
          </label>
          <template x-if="errors.title">
            <p class="text-red-500 text-xs mt-1" x-text="errors.title"></p>
          </template>
        </div>

        <div>
          <label class="block">
            <span class="font-medium text-slate-700 dark:text-navy-100">Description</span>
            <textarea
              x-model="form.description"
              rows="3"
              placeholder="Enter task details..."
              class="form-textarea mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent p-2.5 hover:border-slate-400 focus:border-primary"
              :class="errors.description ? 'border-red-500 focus:border-red-500' : ''"
            ></textarea>
          </label>
          <template x-if="errors.description">
            <p class="text-red-500 text-xs mt-1" x-text="errors.description"></p>
          </template>
        </div>

        <div>
          <label class="block">
            <span class="font-medium text-slate-700 dark:text-navy-100">Status</span>
           <select
        x-model="form.status"
        class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:bg-navy-700"
        :class="errors.status ? 'border-red-500 focus:border-red-500' : ''"
      >
        <option value="">Select status</option>
        <option value="pending">Pending</option>
        <option value="in_progress">In Progress</option>
        <option value="in_review">In Review</option>
        <option value="success">Success</option>
      </select>

          </label>
          <template x-if="errors.status">
            <p class="text-red-500 text-xs mt-1" x-text="errors.status"></p>
          </template>
        </div>

        <div>
          <label class="block">
            <span class="font-medium text-slate-700 dark:text-navy-100">Assign To</span>
            <select
              x-model="form.assigned_to"
              class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:bg-navy-700"
            >
              <option value="">Unassigned</option>
              <template x-for="user in users" :key="user.id">
                <option :value="user.id" x-text="user.name + ' (' + user.employee_code + ')'"></option>
              </template>
            </select>
          </label>
        </div>

        <div class="flex justify-end space-x-3 pt-3">
          <button
            @click="showtaskModal = false"
             class="btn border border-slate-300 font-medium text-slate-800 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-50 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90"
  >
            Cancel
          </button>
          <button
            @click="submitTask"
            class="btn bg-primary text-white hover:bg-primary-focus rounded-full px-5 py-2 font-medium"
            x-text="loading ? 'Saving...' : 'Create Task'"
            :disabled="loading"
          ></button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
function taskModal({ projectId }) {
  return {
    users: [],
    loading: false,
    errors: {},
    form: {
      title: '',
      description: '',
      status: '',
      assigned_to: '',
    },

    async init() {
      try {
        const res = await fetch('/users/mini');
        const data = await res.json();
        if (data.success) this.users = data.data;
      } catch (err) {
        console.error('Failed to load users', err);
      }
    },

    validate() {
      this.errors = {};
      if (!this.form.title.trim()) this.errors.title = 'Title is required.';
      if (!this.form.status.trim()) this.errors.status = 'Please select a status.';
      return Object.keys(this.errors).length === 0;
    },

    async submitTask() {
      if (!this.validate()) return;
      this.loading = true;

      try {
        const res = await fetch(`/projects/${projectId}/tasks`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
          },
          body: JSON.stringify(this.form)
        });

        const data = await res.json();

        if (data.success) {
          this.showtaskModal = false;
          this.$dispatch('task-added', data.task);
          this.form = { title: '', description: '', status: '', assigned_to: '' };
        } else {
          alert('Something went wrong while saving.');
        }
      } catch (err) {
        console.error(err);
        alert('Failed to connect to server.');
      } finally {
        this.loading = false;
      }
    }
  }
}
</script>
