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

    <title>Heckto Crm</title>
   <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}" />

    <!-- CSS Assets -->
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}" />

    <!-- Javascript Assets -->
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

  <body
    x-data
    x-bind="$store.global.documentBody"
    class="is-header-blur is-sidebar-open"
  >
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
      <!-- Sidebar -->
     @include('includes.sidebar')

      <!-- App Header Wrapper-->
       @include('includes.app-header')
     

      <!-- Mobile Searchbar -->
        @include('includes.mobile-searchbar')

      <!-- Right Sidebar -->
         @include('includes.right-sidebar')

      <!-- Main Content Wrapper -->
      <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="flex items-center py-5 space-x-4 lg:py-6">
            @yield('content')
        </div>
      </main>
    </div>

    <div id="x-teleport-target"></div>
    <script>
      window.addEventListener("DOMContentLoaded", () => Alpine.start());
    </script>
  </body>
</html>
