@extends('layouts.master-layout')

@section('content')
    <div class="mt-6 flex flex-col items-center justify-between space-y-2 text-center sm:flex-row sm:space-y-0 sm:text-left">
        <div>
            <h3 class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                Projects Board
            </h3>
            <p class="mt-1 hidden sm:block">List of your ongoing projects</p>
        </div>
        
        @role('Admin')
        <div x-data="{ showcreateModal: false }">
            <button
                @click="showcreateModal = true"
                class="btn space-x-2 bg-primary font-medium text-white shadow-lg shadow-primary/50 hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:shadow-accent/50 dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
            >
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

    @if(session('success'))
        <div x-data="{ show: true }" 
             x-show="show" 
             x-init="setTimeout(() => show = false, 3000)"
             class="alert mt-4 flex rounded-lg bg-success px-4 py-4 text-white sm:px-5">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div x-data="{ show: true }" 
             x-show="show" 
             x-init="setTimeout(() => show = false, 4000)"
             class="alert mt-4 flex rounded-lg bg-error px-4 py-4 text-white sm:px-5">
            {{ session('error') }}
        </div>
    @endif

    <div class="mt-8 grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-5 lg:grid-cols-3 lg:gap-6 xl:grid-cols-4">
        @forelse($projects as $project)
            <div class="card shadow-none hover:shadow-lg transition-shadow duration-300">
                <div class="flex flex-1 flex-col justify-between rounded-lg p-4 sm:p-5"
                    style="background-color: {{ $project->color ?? '#3b82f6' }}">
                    
                    <!-- Project Header -->
                    <div>
                        <div class="flex items-start justify-between">
                            <img
                                class="size-12 rounded-lg object-cover object-center border-2 border-white/30"
                                src="{{ $project->thumbnail ? asset('storage/'.$project->thumbnail) : asset('assets/images/project-default.jpg') }}"
                                alt="{{ $project->name }}"
                                onerror="this.src='{{ asset('assets/images/project-default.jpg') }}'"
                            />
                            <p class="text-xs-plus text-white/90 bg-black/20 px-2 py-1 rounded">
                                {{ \Carbon\Carbon::parse($project->start_date)->format('M d, Y') }}
                            </p>
                        </div>

                        <h3 class="mt-3 font-medium text-white line-clamp-2">
                            {{ $project->name }}
                        </h3>
                        
                        <div class="flex items-center justify-between mt-2">
                            <span class="badge rounded-full bg-white/20 px-2.5 py-0.5 text-xs-plus text-white">
                                {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                            </span>
                            
                            @if($project->end_date)
                                <span class="text-xs-plus text-white/80">
                                    <i class="mr-1">📅</i> {{ \Carbon\Carbon::parse($project->end_date)->format('M d') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Project Content -->
                    <div>
                        <!-- Progress Section - Only show if there's an end date -->
                        @if($project->end_date)
                            <div class="mt-4">
                                <div class="flex justify-between text-xs-plus text-white mb-1">
                                    <span>Progress</span>
                                    <span class="font-semibold">{{ $project->progress ?? 0 }}%</span>
                                </div>
                                <div class="progress h-2 bg-white/30 rounded-full overflow-hidden">
                                    <div class="h-full bg-white rounded-full transition-all duration-500" 
                                         style="width: {{ $project->progress ?? 0 }}%"></div>
                                </div>
                            </div>
                        @else
                            <div class="mt-4">
                                <div class="flex items-center text-xs-plus text-white/80">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>No deadline set</span>
                                </div>
                                <div class="mt-2 text-xs text-white/60">
                                    Progress tracking disabled
                                </div>
                            </div>
                        @endif

                        <!-- Assigned Users -->
                        <div class="mt-5">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs-plus text-white/80">Team Members</span>
                                <span class="text-xs text-white/60">{{ $project->users->count() }} assigned</span>
                            </div>
                            
                            <div class="flex flex-wrap -space-x-3">
                                @foreach($project->users->take(5) as $user)
                                    @php
                                        $initials = collect(explode(' ', $user->name))
                                                    ->map(fn($n) => strtoupper(substr($n, 0, 1)))
                                                    ->join('');
                                    @endphp

                                    @if(!empty($user->profile_image))
                                        <div class="avatar size-8 hover:z-10 transition-transform duration-200 hover:scale-110" 
                                            x-tooltip.duration.800="'{{ $user->name }}'">
                                            <img
                                                class="rounded-full border-2 border-white/50"
                                                src="{{ asset('storage/'.$user->profile_image) }}"
                                                alt="{{ $user->name }}"
                                                onerror="this.nextElementSibling.style.display='flex'"
                                            />
                                            <div class="is-initial rounded-full border-2 border-white/50 bg-info text-xs-plus uppercase text-white hidden items-center justify-center absolute inset-0">
                                                {{ $initials }}
                                            </div>
                                        </div>
                                    @else
                                        <div class="avatar size-8 hover:z-10 transition-transform duration-200 hover:scale-110"
                                            x-tooltip.duration.800="'{{ $user->name }}'">
                                            <div class="is-initial rounded-full border-2 border-white/50 bg-gradient-to-br from-blue-400 to-purple-500 text-xs-plus uppercase text-white flex items-center justify-center">
                                                {{ $initials }}
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                
                                @if($project->users->count() > 5)
                                    <div class="avatar size-8">
                                        <div class="is-initial rounded-full border-2 border-white/50 bg-black/40 text-xs-plus text-white flex items-center justify-center">
                                            +{{ $project->users->count() - 5 }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Footer Actions -->
                        <div class="mt-4 flex items-center justify-between">
                            <div>
                                @if($project->end_date)
                                    @php
                                        // $daysLeft = \Carbon\Carbon::parse($project->end_date)->diffInDays(now());
                                        $isOverdue = \Carbon\Carbon::parse($project->end_date)->isPast();
                                    @endphp
                                    
                                    {{-- <div class="badge h-5.5 rounded-full px-2 text-xs-plus 
                                        {{ $isOverdue ? 'bg-red-500/80' : ($daysLeft <= 3 ? 'bg-amber-500/80' : 'bg-green-500/80') }} 
                                        text-white">
                                        @if($isOverdue)
                                            Overdue {{ \Carbon\Carbon::parse($project->end_date)->diffForHumans() }}
                                        @else
                                            {{ $daysLeft }} {{ Str::plural('day', $daysLeft) }} left
                                        @endif
                                    </div> --}}
                                @else
                                    <div class="badge h-5.5 rounded-full bg-gray-500/80 px-2 text-xs-plus text-white">
                                        No deadline
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Actions Menu -->
                            <div class="ml-auto" style="margin-right: -0.25rem">
                                <div 
                                    x-data="usePopper({ placement: 'bottom-end', strategy: 'fixed', offset: 6 })" 
                                    @click.outside="isShowPopper && (isShowPopper = false)" 
                                    class="relative inline-flex"
                                >
                                    <button 
                                        x-ref="popperRef" 
                                        @click="isShowPopper = !isShowPopper" 
                                        class="btn h-8 w-8 rounded-full p-0 text-white hover:bg-white/20 focus:bg-white/20 active:bg-white/25 transition-colors duration-200"
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
                                        <div class="popper-box rounded-lg border border-slate-150 bg-white shadow-xl dark:border-navy-500 dark:bg-navy-700 min-w-[180px]">
                                            <ul>
                                                <li>
                                                    <button 
                                                        onclick="window.location.href='{{ route('projects.board', $project->id) }}'"
                                                        class="flex w-full items-center gap-2 px-3 py-2 text-sm font-medium text-slate-700 transition-all hover:bg-slate-100 dark:text-navy-100 dark:hover:bg-navy-600"
                                                    >
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                        </svg>
                                                        View Board
                                                    </button>
                                                </li>
                                                
                                                <li>
                                                    <button 
                                                        onclick="window.location.href='{{ route('projects.show', $project->id) }}'"
                                                        class="flex w-full items-center gap-2 px-3 py-2 text-sm font-medium text-slate-700 transition-all hover:bg-slate-100 dark:text-navy-100 dark:hover:bg-navy-600"
                                                    >
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                        View Details
                                                    </button>
                                                </li>

                                                @role('Admin')
                                                <li>
                                                    <button 
                                                        onclick="editProject({{ $project->id }})"
                                                        class="flex w-full items-center gap-2 px-3 py-2 text-sm font-medium text-slate-700 transition-all hover:bg-slate-100 dark:text-navy-100 dark:hover:bg-navy-600"
                                                    >
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                        Edit Project
                                                    </button>
                                                </li>
                                                @endrole
                                            </ul>
                                            
                                            @role('Admin')
                                            <div class="my-1 h-px bg-slate-150 dark:bg-navy-500"></div>
                                            <ul>
                                                <li>
                                                    <button 
                                                        class="flex w-full items-center gap-2 px-3 py-2 text-sm font-medium text-error hover:bg-error/10 dark:hover:bg-error/20"
                                                        onclick="deleteProject({{ $project->id }}, '{{ addslashes($project->name) }}')"
                                                    >
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                        Delete Project
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
            <div class="col-span-full">
                <div class="flex flex-col items-center justify-center rounded-lg border-2 border-dashed border-slate-300 p-12 dark:border-navy-450">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-16 text-slate-400 dark:text-navy-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-slate-700 dark:text-navy-100">No projects yet</h3>
                    <p class="mt-1 text-sm text-slate-500 dark:text-navy-300">Get started by creating your first project</p>
                    @role('Admin')
                    <button
                        @click="showcreateModal = true"
                        class="btn mt-4 space-x-2 bg-primary font-medium text-white shadow-lg shadow-primary/50 hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:shadow-accent/50 dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        <span>Create First Project</span>
                    </button>
                    @endrole
                </div>
            </div>
        @endforelse
    </div>


@endsection

@push('scripts')
<script>
// Edit project function
function editProject(projectId) {
    // This will be implemented when you create the edit modal
    window.location.href = `/projects/${projectId}/edit`;
}

// Enhanced delete project function
function deleteProject(projectId, projectName = '') {
    Swal.fire({
        title: "Delete Project?",
        html: projectName ? 
            `<p class="text-slate-600 dark:text-navy-300">You are about to delete:</p>
             <p class="font-semibold text-lg text-error mt-2">"${projectName}"</p>
             <p class="text-sm text-slate-500 dark:text-navy-300 mt-3">This action cannot be undone.</p>` :
            "Are you sure you want to delete this project? This action cannot be undone.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#e3342f",
        cancelButtonColor: "#6c757d",
        confirmButtonText: "Yes, Delete Project",
        cancelButtonText: "Cancel",
        reverseButtons: true,
        backdrop: true,
        allowOutsideClick: false,
        showLoaderOnConfirm: true,
        preConfirm: () => {
            return $.ajax({
                url: `/projects/${projectId}`,
                type: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                }
            }).then(response => {
                return response;
            }).catch(error => {
                Swal.showValidationMessage(
                    `Request failed: ${error.responseJSON?.message || error.statusText}`
                );
            });
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const response = result.value;
            if (response.success) {
                Swal.fire({
                    title: "Deleted!",
                    text: response.message || "Project has been deleted.",
                    icon: "success",
                    timer: 1500,
                    showConfirmButton: false,
                    willClose: () => {
                        window.location.reload();
                    }
                });
            } else {
                Swal.fire("Error!", response.message || "Failed to delete project.", "error");
            }
        }
    });
}
</script>
@endpush