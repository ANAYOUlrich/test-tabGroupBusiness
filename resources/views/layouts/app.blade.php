<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="icon" type="image/gif" href="https://tabgroup-business.com/wp-content/uploads/2020/09/logo-120x120.png" />


        <!-- Fonts -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/prism.css') }}">
        <link rel="stylesheet" href="{{ asset('css/chosen.css') }}">
        <link rel="stylesheet" href="{{ asset('css/my-style.css') }}">
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <script src="{{ asset('js/jquery.2.1.1.min.js') }}"></script>
        <script src="{{ asset('js/jquery-ui.custom.min.js') }}"></script>
        <script src="{{ asset('js/jquery.ui.touch-punch.min.js') }}"></script>
        <script src="{{ asset('js/chosen.jquery.min.js') }}"></script>

        <script>
            $(document).ready(function() {
                $(".chosen-select").chosen({
                    disable_search_threshold: 10,
                    no_results_text: "Oops, nothing found!",
                    width: "100%",
                });

                $(".reset").click(function(){
                        $(".chosen-select").val([]).trigger("chosen:updated");
                })

                $("#role_id").change(function(){
                    roleChange()
                })
                roleChange()



            })
            function roleChange(){
                var permissions = ''
                permissions = $( "#role_id option:selected" ).attr('permissions');

                if(typeof(permissions) !== "undefined"){
                    permissions = permissions.split(',')
                    $(".chosen-select").val(permissions).trigger("chosen:updated");
                }
            }
        </script>

    </body>
</html>
