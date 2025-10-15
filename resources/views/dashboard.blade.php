@extends('layouts.master-layout')


@section('content')
   

      <div class="flex items-center justify-between py-5 lg:py-6">
          <div class="flex items-center space-x-1 group">
            <h2
              class="text-xl font-medium text-slate-700 line-clamp-1 dark:text-navy-50 lg:text-2xl"
            >
              Employees Card View
            </h2>
            <div
              x-data="usePopper({placement:'bottom-start',offset:4})"
              @click.outside="isShowPopper && (isShowPopper = false)"
              class="inline-flex"
            >
              <button
                x-ref="popperRef"
                @click="isShowPopper = !isShowPopper"
                class="p-0 rounded-full btn size-8 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
              >
                <i class="fas fa-chevron-down"></i>
              </button>

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
                        href="pages-card-user-2.html#"
                        class="flex items-center h-8 px-3 pr-8 space-x-3 font-medium tracking-wide transition-all outline-hidden hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                      >
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          class="mt-px size-4.5"
                          fill="none"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                          stroke-width="2"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 4v16m8-8H4"
                          />
                        </svg>
                        <span> New User</span></a
                      >
                    </li>
                    <li>
                      <a
                        href="pages-card-user-2.html#"
                        class="flex items-center h-8 px-3 pr-8 space-x-3 font-medium tracking-wide transition-all outline-hidden hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                      >
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          class="mt-px size-4.5"
                          fill="none"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                          stroke-width="2"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"
                          />
                        </svg>
                        <span>Export Users</span></a
                      >
                    </li>
                    <li>
                      <a
                        href="pages-card-user-2.html#"
                        class="flex items-center h-8 px-3 pr-8 space-x-3 font-medium tracking-wide transition-all outline-hidden hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                      >
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          class="mt-px size-4.5"
                          fill="none"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                          stroke-width="2"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
                          />
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                          />
                        </svg>
                        <span>Setting</span></a
                      >
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <div class="flex items-center space-x-2">
            <label class="relative hidden sm:flex">
              <input
                class="w-full px-3 py-2 bg-transparent border rounded-full form-input peer h-9 border-slate-300 pl-9 text-xs-plus placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                placeholder="Search users..."
                type="text"
              />
              <span
                class="absolute flex items-center justify-center w-10 h-full pointer-events-none text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="transition-colors duration-200 size-4"
                  fill="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path
                    d="M3.316 13.781l.73-.171-.73.171zm0-5.457l.73.171-.73-.171zm15.473 0l.73-.171-.73.171zm0 5.457l.73.171-.73-.171zm-5.008 5.008l-.171-.73.171.73zm-5.457 0l-.171.73.171-.73zm0-15.473l-.171-.73.171.73zm5.457 0l.171-.73-.171.73zM20.47 21.53a.75.75 0 101.06-1.06l-1.06 1.06zM4.046 13.61a11.198 11.198 0 010-5.115l-1.46-.342a12.698 12.698 0 000 5.8l1.46-.343zm14.013-5.115a11.196 11.196 0 010 5.115l1.46.342a12.698 12.698 0 000-5.8l-1.46.343zm-4.45 9.564a11.196 11.196 0 01-5.114 0l-.342 1.46c1.907.448 3.892.448 5.8 0l-.343-1.46zM8.496 4.046a11.198 11.198 0 015.115 0l.342-1.46a12.698 12.698 0 00-5.8 0l.343 1.46zm0 14.013a5.97 5.97 0 01-4.45-4.45l-1.46.343a7.47 7.47 0 005.568 5.568l.342-1.46zm5.457 1.46a7.47 7.47 0 005.568-5.567l-1.46-.342a5.97 5.97 0 01-4.45 4.45l.342 1.46zM13.61 4.046a5.97 5.97 0 014.45 4.45l1.46-.343a7.47 7.47 0 00-5.568-5.567l-.342 1.46zm-5.457-1.46a7.47 7.47 0 00-5.567 5.567l1.46.342a5.97 5.97 0 014.45-4.45l-.343-1.46zm8.652 15.28l3.665 3.664 1.06-1.06-3.665-3.665-1.06 1.06z"
                  />
                </svg>
              </span>
            </label>

            <div class="flex">
              <button
                class="p-0 rounded-full btn size-8 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25 sm:hidden sm:h-9 sm:w-9"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="size-5"
                  stroke="currentColor"
                  fill="none"
                  viewBox="0 0 24 24"
                >
                  <circle
                    cx="10.2"
                    cy="10.2"
                    r="7.2"
                    stroke-width="1.5"
                  ></circle>
                  <path
                    stroke-width="1.5"
                    stroke-linecap="round"
                    d="M21 21l-3.6-3.6"
                  />
                </svg>
              </button>
              <button
                class="p-0 rounded-full btn size-8 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25 sm:h-9 sm:w-9"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="size-5"
                  fill="none"
                  viewBox="0 0 24 24"
                >
                  <path
                    fill="currentColor"
                    d="M3 5.109C3 4.496 3.47 4 4.05 4h16.79c.58 0 1.049.496 1.049 1.109 0 .612-.47 1.108-1.05 1.108H4.05C3.47 6.217 3 5.721 3 5.11zM5.798 12.5c0-.612.47-1.109 1.05-1.109H18.04c.58 0 1.05.497 1.05 1.109s-.47 1.109-1.05 1.109H6.848c-.58 0-1.05-.497-1.05-1.109zM9.646 18.783c-.58 0-1.05.496-1.05 1.108 0 .613.47 1.109 1.05 1.109h5.597c.58 0 1.05-.496 1.05-1.109 0-.612-.47-1.108-1.05-1.108H9.646z"
                  />
                </svg>
              </button>
              <button
                class="p-0 rounded-full btn size-8 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25 sm:h-9 sm:w-9"
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
                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
                  />
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.5"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                  />
                </svg>
              </button>
            </div>
          </div>
        </div>
<div class="grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-5 lg:grid-cols-3 lg:gap-6 xl:grid-cols-4">
    @foreach ($users as $u)
        <div class="card">
            <div class="p-2 text-right">
                <div
                    x-data="usePopper({placement:'bottom-end',offset:4})"
                    @click.outside="isShowPopper && (isShowPopper = false)"
                    class="inline-flex"
                >
                    <button
                        x-ref="popperRef"
                        @click="isShowPopper = !isShowPopper"
                        class="p-0 rounded-full btn size-8 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="flex flex-col items-center px-4 pb-5 grow sm:px-5">
                <div class="avatar size-20">
                    <img
                        class="rounded-full"
                        src="{{ $u->profile_image ? asset('storage/'.$u->profile_image) : asset('assets/images/avatar/avatar-12.jpg') }}"
                        alt="avatar"
                    />
                </div>

                <h3 class="pt-3 text-lg font-medium text-slate-700 dark:text-navy-100">
                    {{ $u->name }}
                </h3>

                <p class="text-xs-plus">
                    {{ $u->designation ?? 'No Designation' }}
                </p>

                <div class="mt-2 text-xs text-slate-500 dark:text-navy-300">
                    {{ $u->department ?? 'Unassigned Department' }}
                </div>

                {{-- Live Status Badge --}}
                <div class="mt-3">
                    @php
                    $color = match($u->live_status) {
                  'Clocked In' => 'bg-success/10 border border-success/30 text-success',
                  'AFK' => 'bg-warning/10 border border-warning/30 text-warning',
                  default => 'bg-error/10 border border-error/30 text-error'
              };

                    @endphp
                    <span class="px-2 py-1 text-xs font-medium rounded-full {{ $color }}">
                        {{ $u->live_status }}
                    </span>
                </div>

                <div class="grid w-full grid-cols-2 gap-2 mt-6">
                    <button class="px-0 space-x-2 font-medium text-white btn bg-primary hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4 shrink-0" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-width="2" d="M5 19.111c0-2.413 1.697-4.468 4.004-4.848l.208-.035a17.134 17.134 0 015.576 0l.208.035c2.307.38 4.004 2.435 4.004 4.848C19 20.154 18.181 21 17.172 21H6.828C5.818 21 5 20.154 5 19.111zM16.083 6.938c0 2.174-1.828 3.937-4.083 3.937S7.917 9.112 7.917 6.937C7.917 4.764 9.745 3 12 3s4.083 1.763 4.083 3.938z"/>
                        </svg>
                        <span>Profile</span>
                    </button>

                    <button class="px-0 space-x-2 font-medium btn bg-slate-150 text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        <span>Chat</span>
                    </button>
                </div>
            </div>
        </div>
    @endforeach
</div>


 <div
          class="mt-4 grid grid-cols-12 gap-4 px-[var(--margin-x)] transition-all duration-[.25s] sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6"
        >
          <div class="card col-span-12 sm:col-span-6">
            <div class="my-3 flex items-center justify-between px-4 sm:px-5">
              <h2
                class="font-medium tracking-wide text-slate-700 dark:text-navy-100"
              >
                Bandwidth Report
              </h2>
              <div
                x-data="usePopper({placement:'bottom-end',offset:4})"
                @click.outside="isShowPopper && (isShowPopper = false)"
                class="inline-flex"
              >
                <button
                  x-ref="popperRef"
                  @click="isShowPopper = !isShowPopper"
                  class="btn -mr-1.5 size-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
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
                          href="dashboards-crm-analytics.html#"
                          class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-hidden transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                          >Action</a
                        >
                      </li>
                      <li>
                        <a
                          href="dashboards-crm-analytics.html#"
                          class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-hidden transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                          >Another Action</a
                        >
                      </li>
                      <li>
                        <a
                          href="dashboards-crm-analytics.html#"
                          class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-hidden transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                          >Something else</a
                        >
                      </li>
                    </ul>
                    <div class="my-1 h-px bg-slate-150 dark:bg-navy-500"></div>
                    <ul>
                      <li>
                        <a
                          href="dashboards-crm-analytics.html#"
                          class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-hidden transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                          >Separated Link</a
                        >
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

            <div
              class="grid grid-cols-1 gap-4 px-4 sm:gap-5 sm:px-5 lg:grid-cols-2"
            >
              <div
                class="rounded-lg border border-slate-150 p-4 dark:border-navy-600"
              >
                <div class="flex justify-between">
                  <div>
                    <span
                      class="text-2xl font-medium text-slate-700 dark:text-navy-100"
                      >393</span
                    >
                    <span class="text-xs">Mb</span>
                  </div>
                  <p class="text-xs-plus">HTTP Traffic</p>
                </div>

                <div class="progress mt-3 h-1.5 bg-slate-150 dark:bg-navy-500">
                  <div
                    class="is-active relative w-8/12 overflow-hidden rounded-full bg-success"
                  ></div>
                </div>
                <div
                  class="mt-2 flex justify-between text-xs text-slate-400 dark:text-navy-300"
                >
                  <p>Monthly target</p>
                  <p>17%</p>
                </div>
              </div>
              <div
                class="rounded-lg border border-slate-150 p-4 dark:border-navy-600"
              >
                <div class="flex justify-between">
                  <div>
                    <span
                      class="text-2xl font-medium text-slate-700 dark:text-navy-100"
                      >293</span
                    >
                    <span class="text-xs">Mb</span>
                  </div>
                  <p class="text-xs-plus">SMTP Traffic</p>
                </div>

                <div class="progress mt-3 h-1.5 bg-slate-150 dark:bg-navy-500">
                  <div
                    class="relative w-8/12 overflow-hidden rounded-full bg-warning"
                  ></div>
                </div>
                <div
                  class="mt-2 flex justify-between text-xs text-slate-400 dark:text-navy-300"
                >
                  <p>Monthly target</p>
                  <p>65%</p>
                </div>
              </div>
              <div
                class="rounded-lg border border-slate-150 p-4 dark:border-navy-600"
              >
                <div class="flex justify-between">
                  <div>
                    <span
                      class="text-2xl font-medium text-slate-700 dark:text-navy-100"
                      >293</span
                    >
                    <span class="text-xs">Mb</span>
                  </div>
                  <p class="text-xs-plus">FTP Traffic</p>
                </div>

                <div class="progress mt-3 h-1.5 bg-slate-150 dark:bg-navy-500">
                  <div
                    class="relative w-5/12 overflow-hidden rounded-full bg-secondary"
                  ></div>
                </div>
                <div
                  class="mt-2 flex justify-between text-xs text-slate-400 dark:text-navy-300"
                >
                  <p>Monthly target</p>
                  <p>79%</p>
                </div>
              </div>
              <div
                class="rounded-lg border border-slate-150 p-4 dark:border-navy-600"
              >
                <div class="flex justify-between">
                  <div>
                    <span
                      class="text-2xl font-medium text-slate-700 dark:text-navy-100"
                      >36</span
                    >
                    <span class="text-xs">Mb</span>
                  </div>
                  <p class="text-xs-plus">POP3 Traffic</p>
                </div>

                <div class="progress mt-3 h-1.5 bg-slate-150 dark:bg-navy-500">
                  <div
                    class="is-active relative w-4/12 overflow-hidden rounded-full bg-slate-500 dark:bg-navy-400"
                  ></div>
                </div>
                <div
                  class="mt-2 flex justify-between text-xs text-slate-400 dark:text-navy-300"
                >
                  <p>Monthly target</p>
                  <p>79%</p>
                </div>
              </div>
            </div>

            <div
              class="mt-4 flex grow items-center justify-between px-4 sm:px-5"
            >
              <div class="flex items-center space-x-2">
                <p class="text-xs-plus">Performance</p>

                <p class="text-slate-800 dark:text-navy-100">3.2%</p>

                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="size-4 text-success"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M7 11l5-5m0 0l5 5m-5-5v12"
                  />
                </svg>
              </div>
              <a
                href="dashboards-crm-analytics.html#"
                class="border-b border-dotted border-current pb-0.5 text-xs-plus font-medium text-primary outline-hidden transition-colors duration-300 hover:text-primary/70 focus:text-primary/70 dark:text-accent-light dark:hover:text-accent-light/70 dark:focus:text-accent-light/70"
                >Download Report</a
              >
            </div>

            <div class="ax-transparent-gridline ax-rounded-b-lg">
              <div
                x-init="$nextTick(() => { $el._x_chart = new ApexCharts($el,pages.charts.analyticsBandwidth); $el._x_chart.render() });"
              ></div>
            </div>
          </div>
          <div class="card col-span-12 pb-4 sm:col-span-6">
            <div class="my-3 flex items-center justify-between px-4 sm:px-5">
              <h2
                class="font-medium tracking-wide text-slate-700 dark:text-navy-100"
              >
                Users Activity
              </h2>
              <div
                x-data="usePopper({placement:'bottom-end',offset:4})"
                @click.outside="isShowPopper && (isShowPopper = false)"
                class="inline-flex"
              >
                <button
                  x-ref="popperRef"
                  @click="isShowPopper = !isShowPopper"
                  class="btn -mr-1.5 size-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
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
                          href="dashboards-crm-analytics.html#"
                          class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-hidden transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                          >Action</a
                        >
                      </li>
                      <li>
                        <a
                          href="dashboards-crm-analytics.html#"
                          class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-hidden transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                          >Another Action</a
                        >
                      </li>
                      <li>
                        <a
                          href="dashboards-crm-analytics.html#"
                          class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-hidden transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                          >Something else</a
                        >
                      </li>
                    </ul>
                    <div class="my-1 h-px bg-slate-150 dark:bg-navy-500"></div>
                    <ul>
                      <li>
                        <a
                          href="dashboards-crm-analytics.html#"
                          class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-hidden transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                          >Separated Link</a
                        >
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <ol class="timeline line-space px-4 [--size:1.5rem] sm:px-5">
              <li class="timeline-item">
                <div
                  class="timeline-item-point rounded-full border border-current bg-white text-secondary dark:bg-navy-700 dark:text-secondary-light"
                >
                  <i class="fa fa-user-edit text-tiny"></i>
                </div>
                <div class="timeline-item-content flex-1 pl-4 sm:pl-8">
                  <div
                    class="flex flex-col justify-between pb-2 sm:flex-row sm:pb-0"
                  >
                    <p
                      class="pb-2 font-medium leading-none text-slate-600 dark:text-navy-100 sm:pb-0"
                    >
                      User Photo Changed
                    </p>
                    <span class="text-xs text-slate-400 dark:text-navy-300"
                      >12 minute ago</span
                    >
                  </div>
                  <p class="py-1">John Doe changed his avatar photo</p>
                  <div class="avatar mt-2 size-16">
                    <img
                      class="mask is-squircle"
                      src="images/avatar/avatar-19.jpg"
                      alt="avatar"
                    />
                  </div>
                </div>
              </li>
              <li class="timeline-item">
                <div
                  class="timeline-item-point rounded-full border border-current bg-white text-success dark:bg-navy-700"
                >
                  <i class="fa fa-leaf text-tiny"></i>
                </div>
                <div class="timeline-item-content flex-1 pl-4 sm:pl-8">
                  <div
                    class="flex flex-col justify-between pb-2 sm:flex-row sm:pb-0"
                  >
                    <p
                      class="pb-2 font-medium leading-none text-slate-600 dark:text-navy-100 sm:pb-0"
                    >
                      Design Completed
                    </p>
                    <span class="text-xs text-slate-400 dark:text-navy-300"
                      >3 hours ago</span
                    >
                  </div>
                  <p class="py-1">
                    Robert Nolan completed the design of the CRM application
                  </p>
                  <a
                    href="dashboards-crm-analytics.html#"
                    class="inline-flex items-center space-x-1 pt-2 text-slate-600 transition-colors hover:text-primary dark:text-navy-100 dark:hover:text-accent"
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
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                      />
                    </svg>
                    <span>File_final.fig</span>
                  </a>
                  <div class="pt-2">
                    <a
                      href="dashboards-crm-analytics.html#"
                      class="tag rounded-full border border-secondary/30 bg-secondary/10 text-secondary hover:bg-secondary/20 focus:bg-secondary/20 active:bg-secondary/25 dark:border-secondary-light/30 dark:bg-secondary-light/10 dark:text-secondary-light dark:hover:bg-secondary-light/20 dark:focus:bg-secondary-light/20 dark:active:bg-secondary-light/25"
                    >
                      UI/UX
                    </a>

                    <a
                      href="dashboards-crm-analytics.html#"
                      class="tag rounded-full border border-info/30 bg-info/10 text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25"
                    >
                      CRM
                    </a>

                    <a
                      href="dashboards-crm-analytics.html#"
                      class="tag rounded-full border border-success/30 bg-success/10 text-success hover:bg-success/20 focus:bg-success/20 active:bg-success/25"
                    >
                      Dashboard
                    </a>
                  </div>
                </div>
              </li>
              <li class="timeline-item">
                <div
                  class="timeline-item-point rounded-full border border-current bg-white text-warning dark:bg-navy-700"
                >
                  <i class="fa fa-project-diagram text-tiny"></i>
                </div>
                <div class="timeline-item-content flex-1 pl-4 sm:pl-8">
                  <div
                    class="flex flex-col justify-between pb-2 sm:flex-row sm:pb-0"
                  >
                    <p
                      class="pb-2 font-medium leading-none text-slate-600 dark:text-navy-100 sm:pb-0"
                    >
                      ER Diagram
                    </p>
                    <span class="text-xs text-slate-400 dark:text-navy-300"
                      >a day ago</span
                    >
                  </div>
                  <p class="py-1">Team completed the ER diagram app</p>
                  <div>
                    <p class="text-xs text-slate-400 dark:text-navy-300">
                      Members:
                    </p>
                    <div class="mt-2 flex justify-between">
                      <div class="flex flex-wrap -space-x-2">
                        <div class="avatar size-7 hover:z-10">
                          <img
                            class="rounded-full ring-2 ring-white dark:ring-navy-700"
                            src="images/avatar/avatar-16.jpg"
                            alt="avatar"
                          />
                        </div>

                        <div class="avatar size-7 hover:z-10">
                          <div
                            class="is-initial rounded-full bg-info text-xs-plus uppercase text-white ring-2 ring-white dark:ring-navy-700"
                          >
                            jd
                          </div>
                        </div>

                        <div class="avatar size-7 hover:z-10">
                          <img
                            class="rounded-full ring-2 ring-white dark:ring-navy-700"
                            src="images/avatar/avatar-20.jpg"
                            alt="avatar"
                          />
                        </div>

                        <div class="avatar size-7 hover:z-10">
                          <img
                            class="rounded-full ring-2 ring-white dark:ring-navy-700"
                            src="images/avatar/avatar-8.jpg"
                            alt="avatar"
                          />
                        </div>

                        <div class="avatar size-7 hover:z-10">
                          <img
                            class="rounded-full ring-2 ring-white dark:ring-navy-700"
                            src="images/avatar/avatar-5.jpg"
                            alt="avatar"
                          />
                        </div>
                      </div>
                      <button
                        class="btn size-7 rounded-full bg-slate-150 p-0 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90"
                      >
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          class="size-5 rotate-45"
                          fill="none"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M7 11l5-5m0 0l5 5m-5-5v12"
                          />
                        </svg>
                      </button>
                    </div>
                  </div>
                </div>
              </li>
              <li class="timeline-item">
                <div
                  class="timeline-item-point rounded-full border border-current bg-white text-error dark:bg-navy-700"
                >
                  <i class="fa fa-history text-tiny"></i>
                </div>
                <div class="timeline-item-content flex-1 pl-4 sm:pl-8">
                  <div
                    class="flex flex-col justify-between pb-2 sm:flex-row sm:pb-0"
                  >
                    <p
                      class="pb-2 font-medium leading-none text-slate-600 dark:text-navy-100 sm:pb-0"
                    >
                      Weekly Report
                    </p>
                    <span class="text-xs text-slate-400 dark:text-navy-300"
                      >a day ago</span
                    >
                  </div>
                  <p class="py-1">The weekly report was uploaded</p>
                </div>
              </li>
            </ol>
          </div>
        </div>

@endsection

