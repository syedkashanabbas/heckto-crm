<!doctype html>
<html lang="en">
  <head>
    <!-- Meta tags  -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    />

    <title>Heckto | 404 Page Not Found</title>
    <link rel="icon" type="image/png" href="images/favicon.png" />
<link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
<script src="{{ asset('assets/js/app.js') }}" defer></script>

   
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />
    <script>
      /**
       * THIS SCRIPT REQUIRED FOR PREVENT FLICKERING IN SOME BROWSERS
       */
      localStorage.getItem("_x_darkMode_on") === "true" &&
        document.documentElement.classList.add("dark");
    </script>
  </head>
  <body x-data class="is-header-blur" x-bind="$store.global.documentBody">
    <!-- App preloader-->
    <div
      class="fixed z-50 grid w-full h-full app-preloader place-content-center bg-slate-50 dark:bg-navy-900"
    >
      <div class="relative inline-block app-preloader-inner size-48"></div>
    </div>

    <!-- Page Wrapper -->
    <div
      id="root"
      class="flex min-h-100vh grow bg-slate-50 dark:bg-navy-900"
      x-cloak
    >
      <main class="grid w-full grid-cols-1 grow place-items-center">
        <div
          class="grid max-w-screen-lg grid-cols-1 gap-12 p-6 place-items-center lg:grid-cols-2 lg:gap-24"
        >
          <div class="absolute p-6 opacity-20 lg:static lg:opacity-100">
            <img
              width="440"
              x-show="!$store.global.isDarkModeEnabled"
             
              src="{{ asset('assets/images/illustrations/penguins.svg') }}"
              alt="404 image"
            />
            <img
              width="440"
              x-show="$store.global.isDarkModeEnabled"
              src="{{ asset('assets/images/illustrations/penguins-dark.svg') }}" 
              alt="404 image"
            />
          </div>
          <div class="text-center z-2 lg:text-left">
            <p
              class="mt-4 font-bold text-7xl text-primary dark:text-accent lg:mt-0"
            >
              404
            </p>
            <p
              class="mt-6 text-xl font-semibold text-slate-800 dark:text-navy-50 lg:mt-10 lg:text-3xl"
            >
              Oops. This Page Not Found.
            </p>
            <p class="pt-2 text-slate-500 dark:text-navy-200 lg:text-lg">
              This page you are looking not available
            </p>

            <button
              class="mt-10 text-base font-medium text-white btn h-11 bg-primary hover:bg-primary-focus hover:shadow-lg hover:shadow-primary/50 focus:bg-primary-focus focus:shadow-lg focus:shadow-primary/50 active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:hover:shadow-accent/50 dark:focus:bg-accent-focus dark:focus:shadow-accent/50 dark:active:bg-accent/90"
            >
              Back To Home
            </button>
          </div>
        </div>
      </main>
    </div>

    <!-- 
        This is a place for Alpine.js Teleport feature 
        @see https://alpinejs.dev/directives/teleport
      -->
    <div id="x-teleport-target"></div>
    <script>
      window.addEventListener("DOMContentLoaded", () => Alpine.start());
    </script>
  </body>
</html>
