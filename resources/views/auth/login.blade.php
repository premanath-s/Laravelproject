@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-[calc(100vh-80px)] px-4">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl shadow-slate-200/50 p-8 border border-slate-100">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-slate-900 tracking-tight">Welcome Back</h2>
            <p class="text-slate-500 mt-2">Please enter your details to sign in</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            @if ($errors->any())
                <div class="p-4 rounded-lg bg-red-50 border border-red-100 mb-6">
                    <ul class="text-sm text-red-600 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required 
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition outline-none" 
                    placeholder="name@gmail.com">
            </div>

            <div>
                <div class="flex justify-between items-center mb-1.5">
                    <label class="block text-sm font-semibold text-slate-700">Password</label>
                    <a href="#" class="text-xs font-semibold text-indigo-600 hover:text-indigo-500 transition">Forgot password?</a>
                </div>
                <input type="password" name="password" required 
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition outline-none" 
                    placeholder="••••••••">
            </div>

            <button type="submit" 
                class="w-full py-3.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-lg shadow-indigo-600/20 transition-all active:scale-[0.98]">
                Sign In
            </button>
        </form>

        <p class="text-center mt-8 text-sm text-slate-500">
            Don't have an account? 
            <a href="{{ route('register') }}" class="font-bold text-indigo-600 hover:text-indigo-500 transition ml-1">Create an account</a>
        </p>
    </div>
</div>
@endsection