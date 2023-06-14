<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Coderthemes" name="author">

        @include('include.header')

        @yield('head')
    </head>

    <body class="loading" 
            data-layout-config='{"leftSideBarTheme":"{{ Auth::user()->theme->theme }}",
            "layoutBoxed":false,
            @if( Auth::user()->theme->compact == "condensed")
            "leftSidebarCondensed":true,
            @else
            "leftSidebarCondensed":false,
            @endif
            @if( Auth::user()->theme->compact == "scrollable")
            "leftSidebarScrollable":true,
            @else
            "leftSidebarScrollable":false,
            @endif
            "darkMode":false, 
            "showRightSidebarOnStart":false}' 
            id="page-top">
        <!-- Begin page -->
        <div class="wrapper">
            <!-- ========== Left Sidebar Start ========== -->
            @include('include.nav')
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
                    <!-- Topbar Start -->
                    @include('include.topbar')
                    <!-- end Topbar -->
                    
                    <!-- Start Content-->
                    @yield('content')
                    <!-- container -->

                </div>
                <!-- content -->

                <!-- Footer Start -->
                
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->
        @include('include.endbar')
        <!-- Right Sidebar -->
        

        <div class="zeynep-overlay"></div>
        <div class="rightbar-overlay"></div>
        <!-- /End-bar -->
        
        @include('sweetalert::alert')
        @include('include.script')

        @yield('javascript')
    </body>

    <script>
        $(function() {
        // init zeynepjs side menu
        var zeynep = $('.zeynep').zeynep({
        opened: function() {
            // log
            console.log('the side menu opened')
        },
        closed: function() {
            // log
            console.log('the side menu closed')
        }
        })

        // dynamically bind 'closing' event
        zeynep.on('closing', function() {
        // log
        console.log('this event is dynamically binded')
        })

        // handle zeynepjs overlay click
        $('.zeynep-overlay').on('click', function() {
        zeynep.close()
        })

        // open zeynepjs side menu
        $('.btn-open').on('click', function() {
        zeynep.open()
        })
    });
    </script>
</html>