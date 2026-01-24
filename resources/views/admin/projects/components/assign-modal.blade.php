 <template x-teleport="#x-teleport-target">
        <div
            class="fixed inset-0 z-[100] flex items-center justify-center"
            x-show="showAssignModal"
            @keydown.window.escape="showAssignModal = false"
        >
            <div class="absolute inset-0 bg-slate-900/60"
                 @click="showAssignModal = false"></div>

            <div class="relative w-full max-w-md rounded-lg bg-white p-4 dark:bg-navy-700">
                <h3 class="text-lg font-medium mb-4">
                    Add users in the project
                </h3>

                <form
                    method="POST"
                    action="{{ route('projects.assign.users', $project) }}"
                >
                    @csrf

                    <label class="block">
                        <span>Select Users</span>
                        <select
                            name="users[]"
                            x-init="$el._tom = new Tom($el)"
                            class="mt-1.5 w-full"
                            multiple
                        >
                            @foreach($allUsers as $user)
                                <option
                                    value="{{ $user->id }}"
                                    @if($project->users->contains($user->id)) selected @endif
                                >
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </label>

                    <div class="mt-4 text-right space-x-2">
                        <button
                            type="button"
                            @click="showAssignModal = false"
                            class="btn border"
                        >
                            Cancel
                        </button>
                        <button
                            type="submit"
                            class="btn bg-primary text-white"
                        >
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </template>