<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>myShopper</title>
  <link rel="icon" type="image/x-icon" href="assets/logo1.ico">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
</head>

<body class="bg-gradient-to-r from-gray-900 via-gray-800 to-gray-700 ...">
  <div class="flex flex-col items-center justify-center h-screen">
    <div class="flex items-center justify-center mb-12">
      <img src="assets/logo1.png" class="h-12 me-3" alt="FlowBite Logo" />
      <div class="flex flex-col">
        <span class="font-bold sm:text-2xl whitespace-nowrap dark:text-white">
          <span class="text-4xl">myShopper</span>
          <span class="text-sm font-semibold dark:text-gray-300">(Customer and Personal Shopper <a
              href="admin/login.php">Management</a>)</span>
        </span>
      </div>
    </div>
    <div class="flex items-center justify-center mt-4">
      <!-- Pricing Card 1 -->
      <div
        class="bg-white w-96 rounded-lg overflow-hidden shadow-lg transition-transform transform hover:scale-105 mr-10">
        <div class="p-1 bg-blue-200">
        </div>
        <div class="p-8">
          <div class="flex items-center mb-4 sm:mb-2.5">
            <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
              viewBox="0 0 18 20">
              <path
                d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z" />
            </svg>
            <h2 class="text-3xl font-bold text-gray-800 ml-2">Be a Customer</h2>
          </div>

          <p class="text-gray-600 mb-6">Find a personal shopper to buy all you need!</p>
          <!-- <ul class="text-sm text-gray-600 mb-6">
            <li class="mb-2 flex items-center">
              <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
              10 Users
            </li>
            <li class="mb-2 flex items-center">
              <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
              Basic Features
            </li>
            <li class="flex items-center">
              <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
              24/7 Support
            </li>
          </ul> -->
        </div>
        <div class="p-4">
          <button
            class="w-full bg-blue-500 text-white rounded-full px-4 py-2 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue active:bg-blue-800"
            type="button" onClick="parent.location='customer/login.php'">
            Select Customer
          </button>
        </div>
      </div>

      <!-- Pricing Card 2 -->
      <div class="bg-white w-96 rounded-lg overflow-hidden shadow-lg transition-transform transform hover:scale-105">
        <div class="p-1 bg-blue-200">
        </div>
        <div class="p-8">
          <div class="flex items-center mb-4 sm:mb-2.5">
            <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
              viewBox="0 0 18 21">
              <path
                d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z" />
            </svg>
            <h2 class="text-3xl font-bold text-gray-800 ml-2">Be a Shopper</h2>
          </div>
          <p class="text-gray-600 mb-6">Growing your service with being a Shopper</p>
          <!-- <ul class="text-sm text-gray-600 mb-6">
            <li class="mb-2 flex items-center">
              <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
              25 Users
            </li>
            <li class="mb-2 flex items-center">
              <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
              Advanced Features
            </li>
            <li class="flex items-center">
              <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
              24/7 Support
            </li>
          </ul> -->
        </div>
        <div class="p-4">
          <button
            class="w-full bg-blue-500 text-white rounded-full px-4 py-2 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue active:bg-blue-800"
            type="button" onClick="parent.location='personal_shopper/login.php'">
            Select Shopper
          </button>
        </div>
      </div>
    </div>
  </div>
</body>