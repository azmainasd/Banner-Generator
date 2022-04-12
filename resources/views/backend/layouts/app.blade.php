<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Banner Generator</title>
        @include("backend.layouts.links")
    </head>
    <body>
        <div class="container-scroller">
            {{-- Nav --}}
            @include('backend.layouts.navbar')
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
                {{-- Theme Setting --}}
                @include("backend.layouts.themeSetting")
                {{-- Sidebar --}}
                @include("backend.layouts.sidebar")
                <!-- partial -->
                <div class="main-panel">
                    @section("view")
                    @show
                    {{-- Footer --}}
                    @include("backend.layouts.footer")
                    <!-- partial -->
                </div>
                <!-- main-panel ends -->
            </div>
        </div>
        @include("backend.layouts.scripts")
    </body>
</html>