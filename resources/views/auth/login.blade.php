<div style="width:400px;margin:auto;margin-top:60px;padding:30px;border:1px solid #ddd;border-radius:10px;background:#f9f9f9;box-shadow:0px 0px 10px #ccc;">

<h2 style="text-align:center;margin-bottom:20px;">Login</h2>

<form method="POST" action="{{ route('login') }}">
@csrf

@if ($errors->any())
<div style="color:red;margin-bottom:10px;">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

<div style="margin-bottom:15px;">
<label>Email</label><br>
<input type="email" name="email" value="{{ old('email') }}" style="width:100%;padding:8px;">
</div>

<div style="margin-bottom:20px;">
<label>Password</label><br>
<input type="password" name="password" style="width:100%;padding:8px;">
</div>

<button type="submit" style="width:100%;padding:10px;background:#2196F3;color:white;border:none;border-radius:5px;">
Login
</button>

</form>

<p style="text-align:center;margin-top:15px;">
Don't have an account? <a href="{{ route('register') }}">Register</a>
</p>

</div>