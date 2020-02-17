<html>
    <head>
        <title>@yield('title')</title>
        <style>
            .button[disabled] {
              opacity: 0.5;
              cursor: not-allowed;
            }


        </style>
        @include('aapps.head')
    </head>
    <body style="padding-top:100px;">
  	
		
        @yield('content')
        		
        	
        @include('aapps.scripts')
    </body>
</html>