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
        <div
          class="mt-8 grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-5 lg:grid-cols-3 lg:gap-6 xl:grid-cols-4"
        >
          <div class="card shadow-none">
            <div
              class="flex flex-1 flex-col justify-between rounded-lg bg-warning p-4 sm:p-5"
            >
              <div>
                <div class="flex items-start justify-between">
                  <img
                    class="size-12 rounded-lg object-cover object-center"
                   src="{{ asset('assets/images/others/smartphone.jpg') }}"
                    alt="image"
                  />
                  <p class="text-xs-plus text-amber-50">May 01, 2021</p>
                </div>
                <h3 class="mt-3 font-medium text-white line-clamp-2">
                  Mobile App
                </h3>
                <p class="text-xs-plus text-amber-50">Prototyping</p>
              </div>
              <div>
                <div class="mt-4">
                  <p class="text-xs-plus text-white">Progress</p>
                  <div class="progress my-2 h-1.5 bg-white/30">
                    <span class="w-8/12 rounded-full bg-white"></span>
                  </div>
                  <p class="text-right text-xs-plus font-medium text-white">78%</p>
                </div>

                <div class="mt-5 flex flex-wrap -space-x-3">
                  <div class="avatar size-8 hover:z-10">
                    <img
                      class="rounded-full border-2 border-warning"
                      src="assets/images/avatar/avatar-16.jpg"
                      alt="avatar"
                    />
                  </div>

                  <div class="avatar size-8 hover:z-10">
                    <div
                      class="is-initial rounded-full border-2 border-warning bg-info text-xs-plus uppercase text-white"
                    >
                      jd
                    </div>
                  </div>

                  <div class="avatar size-8 hover:z-10">
                    <img
                      class="rounded-full border-2 border-warning"
                      src="assets/images/avatar/avatar-20.jpg"
                      alt="avatar"
                    />
                  </div>

                  <div class="avatar size-8 hover:z-10">
                    <img
                      class="rounded-full border-2 border-warning"
                      src="assets/images/avatar/avatar-19.jpg"
                      alt="avatar"
                    />
                  </div>
                </div>

                <div class="mt-4 flex items-center justify-between space-x-2">
                  <div
                    class="badge h-5.5 rounded-full bg-black/20 px-2 text-xs-plus text-white"
                  >
                    1 week left
                  </div>
                  <div>
                    <button
                      class="btn -mr-1.5 size-8 rounded-full p-0 text-white hover:bg-white/20 focus:bg-white/20 active:bg-white/25"
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
                          d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
                        />
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                        />
                      </svg>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
      
        </div>



        
@endsection