  <!-- Header -->
  <header class="bg-[#0f4c81] text-white py-4 shadow-md">
      <div class="max-w-7xl mx-auto px-4 flex items-center justify-between">

          <!-- Logo -->
          <div class="flex items-center gap-2">
              <i class="ri-store-2-line text-2xl"></i>
              <span class="text-xl font-semibold">ShopZone</span>
          </div>

          <!-- Search Bar -->
          <div class="hidden md:block">
              <div class="flex">
                  <input type="text" placeholder="Search products..."
                      class="w-[400px] rounded-l-md px-4 py-2 text-[#0f4c81] placeholder-[#b3d1e7] border border-[#cce7ff] focus:outline-none" />
                  <button class="bg-white px-4 rounded-r-md border border-l-0 border-[#cce7ff]">
                      <i class="ri-search-line text-[#0f4c81]"></i>
                  </button>
              </div>
          </div>

          <!-- Icons -->
          <div class="flex items-center gap-8 text-white">

              <!-- Wishlist -->
              <button class="relative hover:text-[#ffd700] transition">
                  <i class="ri-heart-line text-xl"></i>
                  <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs px-1.5 rounded-full">3</span>
              </button>

              <!-- Cart -->
              <button class="relative hover:text-[#ffd700] transition">
                  <i class="ri-shopping-cart-line text-xl"></i>
                  <span
                      class="absolute -top-2 -right-2 bg-red-600 text-white text-xs px-1.5 rounded-full font-bold">5</span>
              </button>

              <!-- Account -->
              <button class="hover:text-[#ffd700] transition">
                  <i class="ri-user-line text-xl"></i>
              </button>

          </div>
      </div>

      <!-- Mobile Search Bar -->
      <div class="md:hidden mt-3 px-2">
          <div class="flex">
              <input type="text" placeholder="Search..."
                  class="w-full rounded-l-md px-3 py-2 text-[#0f4c81] placeholder-[#b3d1e7] border border-[#cce7ff] focus:outline-none" />
              <button class="bg-white px-3 rounded-r-md border border-l-0 border-[#cce7ff]">
                  <i class="ri-search-line text-[#0f4c81]"></i>
              </button>
          </div>
      </div>
  </header>

  <!-- Category + Navigation Bar -->
  <nav class="bg-white shadow-sm md:block hidden shadow border-b border-gray-50">
      <div class="max-w-7xl mx-auto px-4 flex items-center gap-6 py-3">

          <!-- Category Item -->
          <div
              class="flex items-center gap-1 border border-[#0f4c81] text-[#0f4c81] px-3 py-1.5 rounded hover:bg-[#0f4c81] hover:text-white transition cursor-pointer">
              <i class="ri-grid-fill text-base"></i>
              <span class="text-sm font-medium leading-none">Category</span>
              <i class="ri-arrow-down-s-line text-base"></i>
          </div>

          <!-- Navigation Links -->
          <div class="hidden md:flex items-center gap-6 text-[#0f4c81] font-medium">
              <a href="#" class="hover:text-[#0056a3] transition">Shop</a>
              <a href="#" class="hover:text-[#0056a3] transition">Today's Products</a>
              <a href="#" class="hover:text-[#0056a3] transition">Hot Deals</a>
              <a href="#" class="hover:text-[#0056a3] transition">New Arrivals</a>
              <a href="#" class="hover:text-[#0056a3] transition">Best Sellers</a>
          </div>
      </div>
  </nav>
