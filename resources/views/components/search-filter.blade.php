<div class="bg-white p-4 rounded-lg shadow-md mb-6">
    <div class="flex flex-col md:flex-row md:items-center md:space-x-4">
      <!-- Search Input -->
      <div class="flex-1 mb-4 md:mb-0">
        <div class="relative">
          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
            </svg>
          </div>
          <input type="text" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary" placeholder="Search events...">
        </div>
      </div>

      <!-- Category Filter -->
      <div class="w-full md:w-48 mb-4 md:mb-0">
        <select class="block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary rounded-md">
          <option value="">All Categories</option>
          <option value="music">Music</option>
          <option value="sports">Sports</option>
          <option value="seminar">Seminar</option>
          <option value="festival">Festival</option>
        </select>
      </div>

      <!-- Location Filter -->
      <div class="w-full md:w-48 mb-4 md:mb-0">
        <select class="block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary rounded-md">
          <option value="">All Locations</option>
          <option value="jakarta">Jakarta</option>
          <option value="bandung">Bandung</option>
          <option value="surabaya">Surabaya</option>
          <option value="bali">Bali</option>
        </select>
      </div>

      <!-- Date Filter -->
      <div class="w-full md:w-48">
        <input type="date" class="block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary rounded-md">
      </div>
    </div>
  </div>
