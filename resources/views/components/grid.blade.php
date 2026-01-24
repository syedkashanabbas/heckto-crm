    <div
          class="mt-4 grid grid-cols-12 gap-4 px-[var(--margin-x)] transition-all duration-[.25s] sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6">
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