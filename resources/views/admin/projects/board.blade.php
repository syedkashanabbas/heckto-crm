@extends('layouts.master-layout')


@section('content')





<div class="flex items-center justify-between space-x-2 px-[var(--margin-x)] py-5 transition-all duration-[.25s]">
        
          <div class="flex items-center space-x-1">
           <h3 class="text-lg font-medium text-slate-700 line-clamp-1 dark:text-navy-50">
        {{ $project->name }} Board
      </h3>

         
          </div>
          
     <div class="flex space-x-1">
      <div class="flex -space-x-2">
        @foreach($activeUsers->take(3) as $user)
          @if(!empty($user->profile_image))
            <div 
              class="avatar size-6 hover:z-10 sm:h-8 sm:w-8"
              x-tooltip.duration.1000="'{{ $user->name }}'"
            >
              <img
                class="rounded-full border-2 border-slate-50 dark:border-navy-900"
                src="{{ asset('storage/'.$user->profile_image) }}"
                alt="{{ $user->name }}"
              />
            </div>
          @else
            @php
              $initials = collect(explode(' ', $user->name))
                          ->map(fn($n) => strtoupper(substr($n, 0, 1)))
                          ->join('');
            @endphp
            <div 
              class="avatar size-6 hover:z-10 sm:h-8 sm:w-8"
              x-tooltip.duration.1000="'{{ $user->name }}'"
            >
              <div class="is-initial rounded-full border-2 border-slate-50 bg-info text-xs uppercase text-white dark:border-navy-900 flex items-center justify-center">
                {{ $initials }}
              </div>
            </div>
          @endif
        @endforeach

        @if($activeUsers->count() > 3)
          <div 
            class="avatar size-6 sm:h-8 sm:w-8"
            x-tooltip.duration.1000="'{{ $activeUsers->count() - 3 }} more users'"
          >
            <div class="is-initial rounded-full border-2 border-slate-50 bg-info text-xs uppercase text-white dark:border-navy-900 flex items-center justify-center">
              +{{ $activeUsers->count() - 3 }}
            </div>
          </div>
        @endif
      </div>


  <button
    class="btn size-6 rounded-full p-0 font-medium text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25 sm:h-8 sm:w-8"
    title="Add new member"
  >
    <svg
      xmlns="http://www.w3.org/2000/svg"
      class="size-4 sm:h-5 sm:w-5"
      viewBox="0 0 20 20"
      fill="currentColor"
    >
      <path
        d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"
      />
    </svg>
  </button>
</div>
</div>
<div 
  x-data="taskBoard({{ $project->id }})"
  x-init="loadTasks()"
  class="flex h-[calc(100vh-8.5rem)] grow flex-col"
>
  <div
    x-init="
      Sortable.create($el, {
        animation: 200,
        easing: 'cubic-bezier(0, 0, 0.2, 1)',
        delay: 150,
        delayOnTouchOnly: true,
        draggable: '.board-draggable',
        handle: '.board-draggable-handler'
      })
    "
    class="kanban-scrollbar grow flex w-full items-start space-x-4 overflow-x-auto overflow-y-hidden px-[var(--margin-x)] transition-all duration-300"
  >
    <!-- STATUS COLUMN -->
    <template x-for="status in ['pending','in_progress','in_review','success']" :key="status">
      <div class="board-draggable relative flex max-h-full w-72 shrink-0 flex-col" :data-status="status">
        
        <!-- COLUMN HEADER -->
        <div class="board-draggable-handler flex items-center justify-between px-0.5 pb-3">
          <div class="flex items-center space-x-2">
            <template x-if="status==='pending'">
              <div class='flex size-8 items-center justify-center rounded-lg bg-warning/10 text-warning'>
                <i class='fa fa-clock text-base'></i>
              </div>
            </template>
            <template x-if="status==='in_progress'">
              <div class='flex size-8 items-center justify-center rounded-lg bg-info/10 text-info'>
                <i class='fa fa-spinner text-base'></i>
              </div>
            </template>
            <template x-if="status==='in_review'">
              <div class='flex size-8 items-center justify-center rounded-lg bg-secondary/10 text-secondary'>
                <i class='fa fa-search text-base'></i>
              </div>
            </template>
            <template x-if="status==='success'">
              <div class='flex size-8 items-center justify-center rounded-lg bg-success/10 text-success'>
                <i class='fa fa-check text-base'></i>
              </div>
            </template>

            <h3 class="text-base font-semibold text-slate-700 capitalize dark:text-navy-100" x-text="status.replace('_',' ')"></h3>
          </div>
        </div>

        <!-- TASK CARDS -->
        <div
          class="is-scrollbar-hidden relative space-y-2.5 overflow-y-auto p-0.5"
          x-init="initSortable($el, status)"
          :data-status="status"
        >
          <template x-for="task in tasks[status]" :key="task.id">
            <div
              class="card cursor-pointer shadow-xs hover:shadow-md transition-all"
              :data-id="task.id"
            >
              <div class="space-y-3 px-2.5 pb-2 pt-1.5">
                <div>
                  <p class="font-medium tracking-wide text-slate-600 dark:text-navy-100" x-text="task.title"></p>
                  <p class="mt-px text-xs text-slate-400 dark:text-navy-300 line-clamp-2" x-text="task.description || 'No description'"></p>
                </div>
                <div class="flex items-center space-x-2" x-show="task.assigned_user">
                  <img class="size-6 rounded-full" :src="task.assigned_user?.profile_image || '{{ asset('assets/images/illustrations/creativedesign-char.svg') }}'">
                  <p class="text-sm text-slate-500" x-text="task.assigned_user?.name || 'Unassigned'"></p>
                </div>
              </div>
            </div>
          </template>
        </div>

        <!-- ADD TASK BUTTON -->
        <div class="flex justify-center py-2">
          <button
            @click="showtaskModal = true"
            class="flex items-center justify-center space-x-2 font-medium text-slate-600 hover:text-primary focus:text-primary dark:text-navy-100 dark:hover:text-accent-light dark:focus:text-accent-light"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            <span>New Task</span>
          </button>
        </div>
      </div>
    </template>

    @include('admin.projects.components.create-task-modal')
  </div>





{{-- Scripts for The Alpine --}}
<script>
function taskBoard(projectId) {
  return {
    showtaskModal: false,
    tasks: {
      pending: [],
      in_progress: [],
      in_review: [],
      success: [],
    },
    newTask: {
      title: '',
      description: '',
      status: 'pending',
      assigned_to: '',
    },
    users: [],

    async loadTasks() {
      const res = await fetch(`/projects/${projectId}/tasks`);
      const data = await res.json();
      if (data.success) this.tasks = data.tasks;
    },

    async loadUsers() {
      const res = await fetch('/users/mini');
      const data = await res.json();
      if (data.success) this.users = data.data;
    },

    async createTask() {
      if (!this.newTask.title) {
        alert('Title is required!');
        return;
      }
      const res = await fetch(`/projects/${projectId}/tasks`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        body: JSON.stringify(this.newTask),
      });
      const data = await res.json();
      if (data.success) {
        this.showtaskModal = false;
        this.loadTasks();
        this.newTask = { title: '', description: '', status: 'pending', assigned_to: '' };
      }
    },

    initSortable(el, status) {
      Sortable.create(el, {
        animation: 200,
        group: 'kanban',
        onEnd: async (evt) => {
          const taskId = evt.item.dataset.id;
          const newStatus = evt.to.dataset.status;
          await fetch(`/projects/${projectId}/tasks/${taskId}/status`, {
            method: 'PATCH',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify({ status: newStatus }),
          });
          this.loadTasks();
        },
      });
    },
  };
}
</script>





@endsection
