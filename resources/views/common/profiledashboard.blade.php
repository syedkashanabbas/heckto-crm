@extends('layouts.master-layout')

@section('content')    
<div class="flex items-center space-x-4 py-5 lg:py-6">
    <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
        Profile Information
    </h2>
    <div class="hidden h-full py-1 sm:flex">
        <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
    </div>
</div>

<div class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6">
    <div class="col-span-12 lg:col-span-4">
        <div class="card p-4 sm:p-5">
            <div class="flex items-center space-x-4">
                <div class="avatar size-14">
                    <img
                        class="rounded-full"
                        src="{{ $user->profile_image ? asset('storage/'.$user->profile_image) : asset('assets/images/avatar/avatar-12.jpg') }}"
                        alt="avatar"
                    />
                </div>
                <div>
                    <h3 class="text-base font-medium text-slate-700 dark:text-navy-100">
                        {{ $user->name }}
                    </h3>
                    <p class="text-xs-plus">{{ $user->email }}</p>
                </div>
            </div>
            <ul class="mt-6 space-y-1.5 font-inter font-medium">
                <li>
                    <a class="flex items-center space-x-2 rounded-lg bg-primary px-4 py-2.5 tracking-wide text-white outline-hidden transition-all dark:bg-accent"
                        href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Account</span>
                    </a>
                </li>
                <li>
                    <a class="group flex space-x-2 rounded-lg px-4 py-2.5 tracking-wide outline-hidden transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"
                        href="#">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="size-5 text-slate-400 transition-colors group-hover:text-slate-500 group-focus:text-slate-500 dark:text-navy-300 dark:group-hover:text-navy-200 dark:group-focus:text-navy-200"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        <span> Privacy & data </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="col-span-12 lg:col-span-8">
        <div class="card">
            <form method="POST" action="{{ route('common_profile.update') }}" enctype="multipart/form-data">
                @csrf
                <div
                    class="flex flex-col items-center space-y-4 border-b border-slate-200 p-4 dark:border-navy-500 sm:flex-row sm:justify-between sm:space-y-0 sm:px-5">
                    <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                        Account Setting
                    </h2>
                    <div class="flex justify-center space-x-2">
                        <a href="{{ url()->previous() }}"
                            class="btn min-w-[7rem] rounded-full border border-slate-300 font-medium text-slate-700 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-100 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90">
                            Cancel
                        </a>
                        <button type="submit"
                            class="btn min-w-[7rem] rounded-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                            Save
                        </button>
                    </div>
                </div>

                <div class="p-4 sm:p-5">
                    <div class="flex flex-col">
                        <span class="text-base font-medium text-slate-600 dark:text-navy-100">Avatar</span>
                        <div class="avatar mt-1.5 size-20">
                            <img class="mask is-squircle"
                                src="{{ $user->profile_image ? asset('storage/'.$user->profile_image) : asset('assets/images/avatar/avatar-12.jpg') }}"
                                alt="avatar" />
                            <div
                                class="absolute bottom-0 right-0 flex items-center justify-center rounded-full bg-white dark:bg-navy-700">
                                <input type="file" name="profile_image" class="hidden" id="profile_image">
                                <label for="profile_image"
                                    class="btn size-6 rounded-full border border-slate-200 p-0 hover:bg-slate-300/20 cursor-pointer dark:border-navy-500 dark:hover:bg-navy-300/20">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                    </svg>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="my-7 h-px bg-slate-200 dark:bg-navy-500"></div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <label class="block">
                            <span>Display name</span>
                            <input class="form-input w-full rounded-full border px-3 py-2"
                                type="text" name="name" value="{{ old('name',$user->name) }}">
                        </label>

                        <label class="block">
                            <span>Date of Birth</span>
                            <input class="form-input w-full rounded-full border px-3 py-2"
                                type="date" name="dob" value="{{ old('dob',$user->dob) }}">
                        </label>

                        <label class="block">
                            <span>Email Address</span>
                            <input class="form-input w-full rounded-full border px-3 py-2"
                                type="email" name="email" value="{{ old('email',$user->email) }}">
                        </label>

                        <label class="block">
                            <span>Phone Number</span>
                            <input class="form-input w-full rounded-full border px-3 py-2"
                                type="text" name="phone" value="{{ old('phone',$user->phone) }}">
                        </label>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
