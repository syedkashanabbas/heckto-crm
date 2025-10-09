<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <title>Heckto Crm Login</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}" />

    <!-- CSS Assets -->
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}" />

    <!-- Javascript Assets -->
    <script src="{{ asset('assets/js/app.js') }}" defer></script>
  </head>
  <body class="is-header-blur">
    <div id="root" class="flex min-h-100vh grow bg-slate-50 dark:bg-navy-900">
      <main class="grid w-full grid-cols-1 grow place-items-center">
        <div class="w-full max-w-[26rem] p-4 sm:px-5">
          <div class="text-center">
            <img class="mx-auto size-52" src="{{ asset('assets/images/heckto_icon.webp') }}" alt="logo" />
            <div class="mt-4">
              <h2 class="text-2xl font-semibold text-slate-600 dark:text-navy-100">Welcome Back</h2>
              <p class="text-slate-400 dark:text-navy-300">Please sign in to continue</p>
            </div>
          </div>

          <!-- Login Form -->
          <div class="p-5 mt-5 rounded-lg card lg:p-7">
            <form method="POST" action="{{ route('login') }}">
              @csrf

              <!-- Email -->
              <label class="block">
                <span>Email:</span>
                <span class="relative mt-1.5 flex">
                  <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required autofocus
                    class="w-full px-3 py-2 bg-transparent border rounded-lg form-input peer border-slate-300 pl-9 placeholder:text-slate-400/70 focus:border-primary dark:border-navy-450 dark:focus:border-accent"
                    placeholder="Enter Email"
                  />
                  <span
                    class="absolute flex items-center justify-center w-10 h-full pointer-events-none text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                    <!-- Mail Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                  </span>
                </span>
                @error('email')
                  <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
              </label>

              <!-- Password -->
              <label class="block mt-4">
                <span>Password:</span>
                <span class="relative mt-1.5 flex">
                  <input
                    type="password"
                    name="password"
                    required
                    class="w-full px-3 py-2 bg-transparent border rounded-lg form-input peer border-slate-300 pl-9 placeholder:text-slate-400/70 focus:border-primary dark:border-navy-450 dark:focus:border-accent"
                    placeholder="Enter Password"
                  />
                  <span
                    class="absolute flex items-center justify-center w-10 h-full pointer-events-none text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                    <!-- Lock Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                  </span>
                </span>
                @error('password')
                  <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
              </label>

              <!-- Remember Me + Forgot -->
              <div class="flex items-center justify-between mt-4 space-x-2">
                <label class="inline-flex items-center space-x-2">
                  <input type="checkbox" name="remember"
                         class="rounded-sm form-checkbox size-5 border-slate-400/70 checked:bg-primary dark:border-navy-400 dark:checked:bg-accent" />
                  <span>Remember me</span>
                </label>
                @if (Route::has('password.request'))
                  <a href="{{ route('password.request') }}" class="text-xs text-slate-400 hover:text-slate-800 dark:text-navy-300">
                    Forgot Password?
                  </a>
                @endif
              </div>

              <!-- Submit -->
              <button type="submit"
                      class="w-full mt-5 font-medium text-white btn bg-primary hover:bg-primary-focus dark:bg-accent">
                Sign In
              </button>
            </form>

            <!-- Register -->
           
          </div>
        </div>
      </main>
    </div>
  </body>
</html>
