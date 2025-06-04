<div class="bg-white p-4 rounded-lg shadow-md mb-4 border-l-4 border-secondary">
    <div class="flex items-start">
      <div class="flex-shrink-0">
        <div class="h-10 w-10 rounded-full bg-secondary bg-opacity-20 flex items-center justify-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-secondary" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z" clip-rule="evenodd" />
          </svg>
        </div>
      </div>
      <div class="ml-3 flex-1">
        <div class="flex justify-between">
          <h4 class="text-sm font-medium text-gray-900">{{ $notification->title }}</h4>
          <span class="text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}</span>
        </div>
        <p class="text-sm text-gray-600 mt-1">{{ $notification->message }}</p>
      </div>
    </div>
  </div>
