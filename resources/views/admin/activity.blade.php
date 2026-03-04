@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
  <h1 class="text-2xl font-semibold text-gray-900 mb-6">Activity Log</h1>

  <div class="bg-white shadow rounded-lg overflow-hidden">
    <table class="min-w-full">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Time</th>
          <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">User</th>
          <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Type</th>
          <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">IP</th>
          <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">User Agent</th>
        </tr>
      </thead>
      <tbody>
        @foreach($logs as $log)
          <tr class="border-t">
            <td class="px-4 py-3 text-sm text-gray-700">{{ $log->created_at->format('Y-m-d H:i') }}</td>
            <td class="px-4 py-3 text-sm text-gray-700">
              @if($log->user)
                <a class="text-indigo-600 hover:underline" href="{{ url('/admin/users/'.$log->user->id.'/orders') }}">{{ $log->user->email }}</a>
              @else
                System
              @endif
            </td>
            <td class="px-4 py-3 text-sm text-gray-700">{{ ucfirst($log->type) }}</td>
            <td class="px-4 py-3 text-sm text-gray-700">{{ $log->ip }}</td>
            <td class="px-4 py-3 text-sm text-gray-700">{{ \Illuminate\Support\Str::limit($log->user_agent, 80) }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="mt-4">{{ $logs->links() }}</div>

</div>

@endsection
