@extends('layouts.master-layout')

@section('content')



    <div
          class="mt-6 flex flex-col items-center justify-between space-y-2 text-center sm:flex-row sm:space-y-0 sm:text-left"
        >
          <div>
            <h3 class="text-xl font-semibold text-slate-700 dark:text-navy-100">
              Projects Board
            </h3>
            <p class="mt-1 hidden sm:block">List of your ongoing projects</p>
            
          </div>
           @role('Admin')
           <div   x-data="{
              showcreateModal: false,
              
            }"
            >
          <button
             @click="showcreateModal = true"
           
            class="btn space-x-2 bg-primary font-medium text-white shadow-lg shadow-primary/50 hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:shadow-accent/50 dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="size-5 text-indigo-50"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M12 6v6m0 0v6m0-6h6m-6 0H6"
              />
            </svg>
            <span> New Project </span>
          </button>

            @include('admin.projects.components.create-modal')
             </div>
          @endrole
        </div>
       <div class="mt-8 grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-5 lg:grid-cols-3 lg:gap-6 xl:grid-cols-4">
        @forelse($projects as $project)
          <div class="card shadow-none">
            <div class="flex flex-1 flex-col justify-between rounded-lg p-4 sm:p-5"
                style="background-color: {{ $project->color ?? '#3b82f6' }}">
              <div>
                <div class="flex items-start justify-between">
                  <img
                    class="size-12 rounded-lg object-cover object-center"
                    src="{{ $project->thumbnail ? asset('storage/'.$project->thumbnail) : asset('assets/images/others/smartphone.jpg') }}"
                    alt="{{ $project->name }}"
                  />
                  <p class="text-xs-plus text-white/80">
                    {{ \Carbon\Carbon::parse($project->start_date)->format('M d, Y') }}
                  </p>
                </div>

                <h3 class="mt-3 font-medium text-white line-clamp-2">
                  {{ $project->name }}
                </h3>
                <p class="text-xs-plus text-white/70">
                  {{ ucfirst($project->status) }}
                </p>
              </div>

              <div>
                <div class="mt-4">
                  <p class="text-xs-plus text-white">Progress</p>
                  <div class="progress my-2 h-1.5 bg-white/30">
                    <span class="rounded-full bg-white block"
                          style="width: {{ $project->progress ?? 0 }}%">
                    </span>
                  </div>
                  <p class="text-right text-xs-plus font-medium text-white">
                    {{ $project->progress ?? 0 }}%
                  </p>
                </div>

               <div class="mt-5 flex flex-wrap -space-x-3">
              @foreach($project->users as $user)
                @php
                  $initials = collect(explode(' ', $user->name))
                              ->map(fn($n) => strtoupper(substr($n, 0, 1)))
                              ->join('');
                @endphp

                @if(!empty($user->profile_image))
                  <div class="avatar size-8 hover:z-10" 
                      x-tooltip.duration.800="'{{ $user->name }}'">
                    <img
                      class="rounded-full border-2 border-white/50"
                      src="{{ asset('storage/'.$user->profile_image) }}"
                      alt="{{ $user->name }}"
                    />
                  </div>
                @else
                  <div class="avatar size-8 hover:z-10"
                      x-tooltip.duration.800="'{{ $user->name }}'">
                    <div class="is-initial rounded-full border-2 border-white/50 bg-info text-xs-plus uppercase text-white flex items-center justify-center">
                      {{ $initials }}
                    </div>
                  </div>
                @endif
              @endforeach
            </div>


               <div class="mt-4 flex items-center justify-between space-x-2">
            <div class="badge h-5.5 rounded-full bg-black/20 px-2 text-xs-plus text-white">
              {{ $project->end_date ? \Carbon\Carbon::parse($project->end_date)->diffForHumans() : 'No deadline' }}
            </div>
     
            <div class="ml-auto" style="margin-right: -0.25rem">
              <div 
                x-data="usePopper({ placement: 'bottom-end', strategy: 'fixed', offset: 6 })" 
                @click.outside="isShowPopper && (isShowPopper = false)" 
                class="relative inline-flex"
              >
                <button 
                  x-ref="popperRef" 
                  @click="isShowPopper = !isShowPopper" 
                  class="btn h-8 w-8 rounded-full p-0 text-white hover:bg-white/20 focus:bg-white/20 active:bg-white/25"
                >
                  <svg xmlns="http://www.w3.org/2000/svg" class="size-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                  </svg>
                </button>

                <div 
                  x-ref="popperRoot" 
                  class="popper-root z-50" 
                  :class="isShowPopper && 'show'"
                >
                  <div class="popper-box rounded-md border border-slate-150 bg-white py-1.5 font-inter shadow-xl dark:border-navy-500 dark:bg-navy-700">
                    <ul>
                      <li>
                        <button class="flex w-full h-8 items-center px-3 pr-8 text-left font-medium tracking-wide text-slate-700 transition-all hover:bg-slate-100 dark:text-navy-100 dark:hover:bg-navy-600">
                          View
                        </button>
                      </li>
                      @role('Admin')
                      <li>
                        <button class="flex w-full h-8 items-center px-3 pr-8 text-left font-medium tracking-wide text-slate-700 transition-all hover:bg-slate-100 dark:text-navy-100 dark:hover:bg-navy-600">
                          Edit
                        </button>
                      </li>
                      @endrole
                    </ul>
                    @role('Admin')
                    <div class="my-1 h-px bg-slate-150 dark:bg-navy-500"></div>
                    <ul>
                      
                      <li>
                        <button 
                          class="flex w-full h-8 items-center px-3 pr-8 text-left font-medium tracking-wide text-error hover:bg-error/10 dark:hover:bg-error/20"
                          onclick="deleteProject({{ $project->id }})"
                        >
                          Delete
                        </button>
                      </li>
                    </ul>
                  @endrole
                  </div>
                </div>
              </div>
            </div>
        
          </div>

              </div>
            </div>
          </div>
        @empty
    <p class="text-center text-slate-500">No projects found.</p>
  @endforelse
</div>




        
@endsection