
<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
</head>
<body>
<h1>Welcome Home</h1>

@if(Auth::user())
   Hello  {{ Auth::user()->name }} , with email :{{ Auth::user()->email }}
@else
    Hello  guest
@endif
</body>
</html>
