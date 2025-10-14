@extends('layouts.master-layout')


@section('content')



<div class="flex items-center justify-between space-x-2 px-[var(--margin-x)] py-5 transition-all duration-[.25s]">
        >
          <div class="flex items-center space-x-1">
            <h3
              class="text-lg font-medium text-slate-700 line-clamp-1 dark:text-navy-50"
            >
              Heckto Board
            </h3>
         
          </div>
          
          <div class="flex space-x-1">
            <div class="flex -space-x-2">
              <div class="avatar size-6 hover:z-10 sm:h-8 sm:w-8">
                <img
                  class="rounded-full border-2 border-slate-50 dark:border-navy-900"
                  src="images/avatar/avatar-20.jpg"
                  alt="avatar"
                />
              </div>
              <div class="avatar size-6 hover:z-10 sm:h-8 sm:w-8">
                <img
                  class="rounded-full border-2 border-slate-50 dark:border-navy-900"
                  src="images/avatar/avatar-17.jpg"
                  alt="avatar"
                />
              </div>
             
              <div
                class="avatar hidden size-6 hover:z-10 sm:inline-flex sm:h-8 sm:w-8"
              >
                <img
                  class="rounded-full border-2 border-slate-50 dark:border-navy-900"
                  src="images/avatar/avatar-11.jpg"
                  alt="avatar"
                />
              </div>
              <div class="avatar size-6 sm:h-8 sm:w-8">
                <div
                  class="is-initial rounded-full border-2 border-slate-50 bg-info text-xs uppercase text-white dark:border-navy-900"
                >
                  +5
                </div>
              </div>
            </div>
            <button
              class="btn size-6 rounded-full p-0 font-medium text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25 sm:h-8 sm:w-8"
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

        <div class="flex h-[calc(100vh-8.5rem)] grow flex-col">
          <div
            x-init="Sortable.create($el,{
            animation: 200,
            easing: 'cubic-bezier(0, 0, 0.2, 1)',
            delay: 150,
            delayOnTouchOnly: true,
            draggable: '.board-draggable',
            handle: '.board-draggable-handler'
          })"
            class="kanban-scrollbar grow flex w-full items-start space-x-4 overflow-x-auto overflow-y-hidden px-[var(--margin-x)] transition-all duration-[.25s]"
          >
            <div
              class="board-draggable relative flex max-h-full w-72 shrink-0 flex-col"
            >
              <div
                class="board-draggable-handler flex items-center justify-between px-0.5 pb-3"
              >
                <div class="flex items-center space-x-2">
                  <div
                    class="flex size-8 items-center justify-center rounded-lg bg-info/10 text-info"
                  >
                    <i class="fa fa-spinner text-base"></i>
                  </div>
                  <h3 class="text-base text-slate-700 dark:text-navy-100">
                    In Progress
                  </h3>
                </div>

                <div
                  x-data="usePopper({placement:'bottom-end',offset:4})"
                  @click.outside="isShowPopper && (isShowPopper = false)"
                  class="inline-flex"
                >
                  <button
                    x-ref="popperRef"
                    @click="isShowPopper = !isShowPopper"
                    class="btn size-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="size-5"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                      stroke-width="2"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"
                      />
                    </svg>
                  </button>

                  <template x-teleport="#x-teleport-target">
                    <div
                      x-ref="popperRoot"
                      class="popper-root"
                      :class="isShowPopper && 'show'"
                    >
                      <div
                        class="popper-box rounded-md border border-slate-150 bg-white py-1.5 font-inter dark:border-navy-500 dark:bg-navy-700"
                      >
                        <ul>
                          <li>
                            <a
                              href="apps-kanban.html#"
                              class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-hidden transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                              >Action</a
                            >
                          </li>
                          <li>
                            <a
                              href="apps-kanban.html#"
                              class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-hidden transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                              >Another Action</a
                            >
                          </li>
                          <li>
                            <a
                              href="apps-kanban.html#"
                              class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-hidden transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                              >Something else</a
                            >
                          </li>
                        </ul>
                        <div
                          class="my-1 h-px bg-slate-150 dark:bg-navy-500"
                        ></div>
                        <ul>
                          <li>
                            <a
                              href="apps-kanban.html#"
                              class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-hidden transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                              >Separated Link</a
                            >
                          </li>
                        </ul>
                      </div>
                    </div>
                  </template>
                </div>
              </div>
              <div
                class="is-scrollbar-hidden relative space-y-2.5 overflow-y-auto p-0.5"
                x-init="Sortable.create($el,{
                          animation: 200,
                          group:'board-cards',
                          easing: 'cubic-bezier(0, 0, 0.2, 1)',
                          direction: 'vertical',
                          delay: 150,
                          delayOnTouchOnly: true,
                        })"
              >
                
                <div class="card cursor-pointer shadow-xs">
                  <div class="space-y-3 px-2.5 pb-2 pt-1.5">
                    <div>
                      <div class="flex justify-between">
                        <p
                          class="font-medium tracking-wide text-slate-600 line-clamp-2 dark:text-navy-100"
                        >
                          Sync With Google Analytics
                        </p>
                  
                      </div>

                      <p
                        class="mt-px text-xs text-slate-400 dark:text-navy-300"
                      >
                        Google Workspace
                      </p>
                    </div>
                    <div class="flex items-end justify-between">
                      <div class="flex items-center space-x-2">
                        <div class="avatar size-6">
                          <img
                            class="rounded-full"
             
                            src="{{ asset('assets/images/illustrations/creativedesign-char.svg') }}"
                            alt="avatar"
                          />
                        </div>
                        <p>Travis F.</p>
                      </div>
                   
                    </div>
                  </div>
                </div>
             
              </div>
              <div class="flex justify-center py-2">
                    <button
                      class="flex items-center justify-center space-x-2 font-medium text-slate-600 hover:text-primary focus:text-primary dark:text-navy-100 dark:hover:text-accent-light dark:focus:text-accent-light"
                    >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="size-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.5"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                    />
                  </svg>
                  <span>New Task</span>
                </button>
              </div>
            </div>

            <div
              class="board-draggable relative flex max-h-full w-72 shrink-0 flex-col"
            >
              <div
                class="board-draggable-handler flex items-center justify-between px-0.5 pb-3"
              >
                <div class="flex items-center space-x-2">
                  <div
                    class="flex size-8 items-center justify-center rounded-lg bg-warning/10 text-warning"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="size-5"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.5"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                      />
                    </svg>
                  </div>
                  <h3 class="text-base text-slate-700 dark:text-navy-100">
                    Pending
                  </h3>
                </div>

                <div
                  x-data="usePopper({placement:'bottom-end',offset:4})"
                  @click.outside="isShowPopper && (isShowPopper = false)"
                  class="inline-flex"
                >
                  <button
                    x-ref="popperRef"
                    @click="isShowPopper = !isShowPopper"
                    class="btn size-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="size-5"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                      stroke-width="2"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"
                      />
                    </svg>
                  </button>

                  <template x-teleport="#x-teleport-target">
                    <div
                      x-ref="popperRoot"
                      class="popper-root"
                      :class="isShowPopper && 'show'"
                    >
                      <div
                        class="popper-box rounded-md border border-slate-150 bg-white py-1.5 font-inter dark:border-navy-500 dark:bg-navy-700"
                      >
                        <ul>
                          <li>
                            <a
                              href="apps-kanban.html#"
                              class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-hidden transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                              >Action</a
                            >
                          </li>
                          <li>
                            <a
                              href="apps-kanban.html#"
                              class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-hidden transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                              >Another Action</a
                            >
                          </li>
                          <li>
                            <a
                              href="apps-kanban.html#"
                              class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-hidden transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                              >Something else</a
                            >
                          </li>
                        </ul>
                        <div
                          class="my-1 h-px bg-slate-150 dark:bg-navy-500"
                        ></div>
                        <ul>
                          <li>
                            <a
                              href="apps-kanban.html#"
                              class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-hidden transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                              >Separated Link</a
                            >
                          </li>
                        </ul>
                      </div>
                    </div>
                  </template>
                </div>
              </div>
              <div
                class="is-scrollbar-hidden relative space-y-2.5 overflow-y-auto p-0.5"
                x-init="Sortable.create($el,{
                        animation: 200,
                        group:'board-cards',
                        easing: 'cubic-bezier(0, 0, 0.2, 1)',
                        direction: 'vertical',
                        delay: 150,
                        delayOnTouchOnly: true,
                      })"
              >
            <div class="card cursor-pointer shadow-xs">
                  <div class="space-y-3 px-2.5 pb-2 pt-1.5">
                    <div>
                      <div class="flex justify-between">
                        <p
                          class="font-medium tracking-wide text-slate-600 line-clamp-2 dark:text-navy-100"
                        >
                          Sync With Google Analytics
                        </p>
                  
                      </div>

                      <p
                        class="mt-px text-xs text-slate-400 dark:text-navy-300"
                      >
                        Google Workspace
                      </p>
                    </div>
                    <div class="flex items-end justify-between">
                      <div class="flex items-center space-x-2">
                        <div class="avatar size-6">
                          <img
                            class="rounded-full"
             
                            src="{{ asset('assets/images/illustrations/creativedesign-char.svg') }}"
                            alt="avatar"
                          />
                        </div>
                        <p>Travis F.</p>
                      </div>
                   
                    </div>
                  </div>
                </div>
              </div>
              <div class="flex justify-center py-2">
                <button
                  class="flex items-center justify-center space-x-2 font-medium text-slate-600 hover:text-primary focus:text-primary dark:text-navy-100 dark:hover:text-accent-light dark:focus:text-accent-light"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="size-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.5"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                    />
                  </svg>
                  <span>New Task</span>
                </button>
              </div>
            </div>

            <div
              class="board-draggable relative flex max-h-full w-72 shrink-0 flex-col"
            >
              <div
                class="board-draggable-handler flex items-center justify-between px-0.5 pb-3"
              >
                <div class="flex items-center space-x-2">
                  <div
                    class="flex size-8 items-center justify-center rounded-lg bg-secondary/10 text-secondary dark:bg-secondary-light/15 dark:text-secondary-light"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="size-5"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.5"
                        d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z"
                      />
                    </svg>
                  </div>
                  <h3 class="text-base text-slate-700 dark:text-navy-100">
                    In Review
                  </h3>
                </div>

                <div
                  x-data="usePopper({placement:'bottom-end',offset:4})"
                  @click.outside="isShowPopper && (isShowPopper = false)"
                  class="inline-flex"
                >
                  <button
                    x-ref="popperRef"
                    @click="isShowPopper = !isShowPopper"
                    class="btn size-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="size-5"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                      stroke-width="2"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"
                      />
                    </svg>
                  </button>

                  <template x-teleport="#x-teleport-target">
                    <div
                      x-ref="popperRoot"
                      class="popper-root"
                      :class="isShowPopper && 'show'"
                    >
                      <div
                        class="popper-box rounded-md border border-slate-150 bg-white py-1.5 font-inter dark:border-navy-500 dark:bg-navy-700"
                      >
                        <ul>
                          <li>
                            <a
                              href="apps-kanban.html#"
                              class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-hidden transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                              >Action</a
                            >
                          </li>
                          <li>
                            <a
                              href="apps-kanban.html#"
                              class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-hidden transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                              >Another Action</a
                            >
                          </li>
                          <li>
                            <a
                              href="apps-kanban.html#"
                              class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-hidden transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                              >Something else</a
                            >
                          </li>
                        </ul>
                        <div
                          class="my-1 h-px bg-slate-150 dark:bg-navy-500"
                        ></div>
                        <ul>
                          <li>
                            <a
                              href="apps-kanban.html#"
                              class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-hidden transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                              >Separated Link</a
                            >
                          </li>
                        </ul>
                      </div>
                    </div>
                  </template>
                </div>
              </div>
              <div
                class="is-scrollbar-hidden relative space-y-2.5 overflow-y-auto p-0.5"
                x-init="Sortable.create($el,{
                      animation: 200,
                      group:'board-cards',
                      easing: 'cubic-bezier(0, 0, 0.2, 1)',
                      direction: 'vertical',
                      delay: 150,
                      delayOnTouchOnly: true,
                    })"
              >
                   <div class="card cursor-pointer shadow-xs">
                  <div class="space-y-3 px-2.5 pb-2 pt-1.5">
                    <div>
                      <div class="flex justify-between">
                        <p
                          class="font-medium tracking-wide text-slate-600 line-clamp-2 dark:text-navy-100"
                        >
                          Sync With Google Analytics
                        </p>
                  
                      </div>

                      <p
                        class="mt-px text-xs text-slate-400 dark:text-navy-300"
                      >
                        Google Workspace
                      </p>
                    </div>
                    <div class="flex items-end justify-between">
                      <div class="flex items-center space-x-2">
                        <div class="avatar size-6">
                          <img
                            class="rounded-full"
             
                            src="{{ asset('assets/images/illustrations/creativedesign-char.svg') }}"
                            alt="avatar"
                          />
                        </div>
                        <p>Travis F.</p>
                      </div>
                   
                    </div>
                  </div>
                </div>
              </div>
              <div class="flex justify-center py-2">
                <button
                  class="flex items-center justify-center space-x-2 font-medium text-slate-600 hover:text-primary focus:text-primary dark:text-navy-100 dark:hover:text-accent-light dark:focus:text-accent-light"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="size-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.5"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                    />
                  </svg>
                  <span>New Task</span>
                </button>
              </div>
            </div>

            <div
              class="board-draggable relative flex max-h-full w-72 shrink-0 flex-col"
            >
              <div
                class="board-draggable-handler flex items-center justify-between px-0.5 pb-3"
              >
                <div class="flex items-center space-x-2">
                  <div
                    class="flex size-8 items-center justify-center rounded-lg bg-success/10 text-success dark:bg-success/15"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="size-5"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                      stroke-width="1.5"
                    >
                      <path
                        d="M12.5293 18L20.9999 8.40002"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                      <path
                        d="M3 13.2L7.23529 18L17.8235 6"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                  </div>
                  <h3 class="text-base text-slate-700 dark:text-navy-100">
                    Success
                  </h3>
                </div>

                <div
                  x-data="usePopper({placement:'bottom-end',offset:4})"
                  @click.outside="isShowPopper && (isShowPopper = false)"
                  class="inline-flex"
                >
                  <button
                    x-ref="popperRef"
                    @click="isShowPopper = !isShowPopper"
                    class="btn size-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="size-5"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                      stroke-width="2"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"
                      />
                    </svg>
                  </button>

                  <template x-teleport="#x-teleport-target">
                    <div
                      x-ref="popperRoot"
                      class="popper-root"
                      :class="isShowPopper && 'show'"
                    >
                      <div
                        class="popper-box rounded-md border border-slate-150 bg-white py-1.5 font-inter dark:border-navy-500 dark:bg-navy-700"
                      >
                        <ul>
                          <li>
                            <a
                              href="apps-kanban.html#"
                              class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-hidden transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                              >Action</a
                            >
                          </li>
                          <li>
                            <a
                              href="apps-kanban.html#"
                              class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-hidden transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                              >Another Action</a
                            >
                          </li>
                          <li>
                            <a
                              href="apps-kanban.html#"
                              class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-hidden transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                              >Something else</a
                            >
                          </li>
                        </ul>
                        <div
                          class="my-1 h-px bg-slate-150 dark:bg-navy-500"
                        ></div>
                        <ul>
                          <li>
                            <a
                              href="apps-kanban.html#"
                              class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-hidden transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                              >Separated Link</a
                            >
                          </li>
                        </ul>
                      </div>
                    </div>
                  </template>
                </div>
              </div>
              <div
                class="is-scrollbar-hidden relative space-y-2.5 overflow-y-auto p-0.5"
                x-init="Sortable.create($el,{
                    animation: 200,
                    group:'board-cards',
                    easing: 'cubic-bezier(0, 0, 0.2, 1)',
                    direction: 'vertical',
                    delay: 150,
                    delayOnTouchOnly: true,
                  })"
              >
                     <div class="card cursor-pointer shadow-xs">
                  <div class="space-y-3 px-2.5 pb-2 pt-1.5">
                    <div>
                      <div class="flex justify-between">
                        <p
                          class="font-medium tracking-wide text-slate-600 line-clamp-2 dark:text-navy-100"
                        >
                          Sync With Google Analytics
                        </p>
                  
                      </div>

                      <p
                        class="mt-px text-xs text-slate-400 dark:text-navy-300"
                      >
                        Google Workspace
                      </p>
                    </div>
                    <div class="flex items-end justify-between">
                      <div class="flex items-center space-x-2">
                        <div class="avatar size-6">
                          <img
                            class="rounded-full"
             
                            src="{{ asset('assets/images/illustrations/creativedesign-char.svg') }}"
                            alt="avatar"
                          />
                        </div>
                        <p>Travis F.</p>
                      </div>
                   
                    </div>
                  </div>
                </div>
              </div>
              <div class="flex justify-center py-2">
                <button
                  class="flex items-center justify-center space-x-2 font-medium text-slate-600 hover:text-primary focus:text-primary dark:text-navy-100 dark:hover:text-accent-light dark:focus:text-accent-light"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="size-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.5"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                    />
                  </svg>
                  <span>New Task</span>
                </button>
              </div>
            </div>

           
          </div>
        </div>
@endsection
