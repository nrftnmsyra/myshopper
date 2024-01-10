<?php
if ($order_status == 'To Pay') {
    ?>
    <ol class="items-center sm:flex">
        <li class="relative mb-6 sm:mb-0">
            <div class="flex items-center">
                <div
                    class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-green-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                        class="w-3 h-3text-green-800 dark:text-green-300">
                        <path d="M4.5 3.75a3 3 0 00-3 3v.75h21v-.75a3 3 0 00-3-3h-15z" />
                        <path fill-rule="evenodd"
                            d="M22.5 9.75h-21v7.5a3 3 0 003 3h15a3 3 0 003-3v-7.5zm-18 3.75a.75.75 0 01.75-.75h6a.75.75 0 010 1.5h-6a.75.75 0 01-.75-.75zm.75 2.25a.75.75 0 000 1.5h3a.75.75 0 000-1.5h-3z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="hidden sm:flex w-60 bg-gray-200 h-0.5 dark:bg-gray-700"></div>
            </div>
            <div class="mt-3 sm:pe-8">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">To Pay</h3>
                <p class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Please make a
                    payment</p>
            </div>
        </li>
        <li class="relative mb-6 sm:mb-0">
            <div class="flex items-center">
                <div
                    class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                        class="w-3 h-3text-blue-800 dark:text-blue-300">
                        <path
                            d="M9.375 3a1.875 1.875 0 000 3.75h1.875v4.5H3.375A1.875 1.875 0 011.5 9.375v-.75c0-1.036.84-1.875 1.875-1.875h3.193A3.375 3.375 0 0112 2.753a3.375 3.375 0 015.432 3.997h3.943c1.035 0 1.875.84 1.875 1.875v.75c0 1.036-.84 1.875-1.875 1.875H12.75v-4.5h1.875a1.875 1.875 0 10-1.875-1.875V6.75h-1.5V4.875C11.25 3.839 10.41 3 9.375 3zM11.25 12.75H3v6.75a2.25 2.25 0 002.25 2.25h6v-9zM12.75 12.75v9h6.75a2.25 2.25 0 002.25-2.25v-6.75h-9z" />
                    </svg>
                </div>
                <div class="hidden sm:flex w-64 bg-gray-200 h-0.5 dark:bg-gray-700"></div>
            </div>
            <div class="mt-3 sm:pe-8">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">To Ship</h3>
                <p class="block mb-2 text-sm font-normal leading-none text-gray-800 dark:text-gray-800">nothing here..</p>
            </div>
        </li>
        <li class="relative mb-6 sm:mb-0">
            <div class="flex items-center">
                <div
                    class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                        class="w-3 h-3text-blue-800 dark:text-blue-300">
                        <path
                            d="M3.375 4.5C2.339 4.5 1.5 5.34 1.5 6.375V13.5h12V6.375c0-1.036-.84-1.875-1.875-1.875h-8.25zM13.5 15h-12v2.625c0 1.035.84 1.875 1.875 1.875h.375a3 3 0 116 0h3a.75.75 0 00.75-.75V15z" />
                        <path
                            d="M8.25 19.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0zM15.75 6.75a.75.75 0 00-.75.75v11.25c0 .087.015.17.042.248a3 3 0 015.958.464c.853-.175 1.522-.935 1.464-1.883a18.659 18.659 0 00-3.732-10.104 1.837 1.837 0 00-1.47-.725H15.75z" />
                        <path d="M19.5 19.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z" />
                    </svg>
                </div>
                <div class="hidden sm:flex w-56 bg-gray-200 h-0.5 dark:bg-gray-700"></div>
            </div>
            <div class="mt-3 sm:pe-8">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">To Receive</h3>
                <p class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-800">nothing here..</p>
            </div>
        </li>
        <li class="relative mb-6 sm:mb-0">
            <div class="flex items-center">
                <div
                    class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                        class="w-3 h-3text-blue-800 dark:text-blue-300">
                        <path fill-rule="evenodd"
                            d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
            <div class="mt-3 sm:pe-8">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Completed</h3>
                <p class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-800">nothing here..</p>
            </div>
        </li>
    </ol>
    <?php
} else if ($order_status == 'To Ship') {
    ?>
        <ol class="items-center sm:flex">
            <li class="relative mb-6 sm:mb-0">
                <div class="flex items-center">
                    <div
                        class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-green-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                            class="w-3 h-3text-green-800 dark:text-green-300">
                            <path d="M4.5 3.75a3 3 0 00-3 3v.75h21v-.75a3 3 0 00-3-3h-15z" />
                            <path fill-rule="evenodd"
                                d="M22.5 9.75h-21v7.5a3 3 0 003 3h15a3 3 0 003-3v-7.5zm-18 3.75a.75.75 0 01.75-.75h6a.75.75 0 010 1.5h-6a.75.75 0 01-.75-.75zm.75 2.25a.75.75 0 000 1.5h3a.75.75 0 000-1.5h-3z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="hidden sm:flex w-60 bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                </div>
                <div class="mt-3 sm:pe-8">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">To Pay</h3>
                    <p class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Payment have been
                        made at
                    <?php echo date_format($time, "g:i A"); ?>
                    </p>
                </div>
            </li>
            <li class="relative mb-6 sm:mb-0">
                <div class="flex items-center">
                    <div
                        class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-green-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                            class="w-3 h-3text-green-800 dark:text-green-300">
                            <path
                                d="M9.375 3a1.875 1.875 0 000 3.75h1.875v4.5H3.375A1.875 1.875 0 011.5 9.375v-.75c0-1.036.84-1.875 1.875-1.875h3.193A3.375 3.375 0 0112 2.753a3.375 3.375 0 015.432 3.997h3.943c1.035 0 1.875.84 1.875 1.875v.75c0 1.036-.84 1.875-1.875 1.875H12.75v-4.5h1.875a1.875 1.875 0 10-1.875-1.875V6.75h-1.5V4.875C11.25 3.839 10.41 3 9.375 3zM11.25 12.75H3v6.75a2.25 2.25 0 002.25 2.25h6v-9zM12.75 12.75v9h6.75a2.25 2.25 0 002.25-2.25v-6.75h-9z" />
                        </svg>
                    </div>
                    <div class="hidden sm:flex w-64 bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                </div>
                <div class="mt-3 sm:pe-8">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">To Ship</h3>
                    <p class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Shopper is preparing
                        to ship your parcel</p>
                </div>
            </li>
            <li class="relative mb-6 sm:mb-0">
                <div class="flex items-center">
                    <div
                        class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                            class="w-3 h-3text-blue-800 dark:text-blue-300">
                            <path
                                d="M3.375 4.5C2.339 4.5 1.5 5.34 1.5 6.375V13.5h12V6.375c0-1.036-.84-1.875-1.875-1.875h-8.25zM13.5 15h-12v2.625c0 1.035.84 1.875 1.875 1.875h.375a3 3 0 116 0h3a.75.75 0 00.75-.75V15z" />
                            <path
                                d="M8.25 19.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0zM15.75 6.75a.75.75 0 00-.75.75v11.25c0 .087.015.17.042.248a3 3 0 015.958.464c.853-.175 1.522-.935 1.464-1.883a18.659 18.659 0 00-3.732-10.104 1.837 1.837 0 00-1.47-.725H15.75z" />
                            <path d="M19.5 19.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z" />
                        </svg>
                    </div>
                    <div class="hidden sm:flex w-56 bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                </div>
                <div class="mt-3 sm:pe-8">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">To Receive</h3>
                    <p class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-800">nothing here..</p>
                </div>
            </li>
            <li class="relative mb-6 sm:mb-0">
                <div class="flex items-center">
                    <div
                        class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                            class="w-3 h-3text-blue-800 dark:text-blue-300">
                            <path fill-rule="evenodd"
                                d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <div class="mt-3 sm:pe-8">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Completed</h3>
                    <p class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-800">nothing here..</p>
                </div>
            </li>
        </ol>
    <?php
} else if ($order_status == 'To Receive') {
    ?>
            <ol class="items-center sm:flex">
                <li class="relative mb-6 sm:mb-0">
                    <div class="flex items-center">
                        <div
                            class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-green-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="w-3 h-3text-green-800 dark:text-green-300">
                                <path d="M4.5 3.75a3 3 0 00-3 3v.75h21v-.75a3 3 0 00-3-3h-15z" />
                                <path fill-rule="evenodd"
                                    d="M22.5 9.75h-21v7.5a3 3 0 003 3h15a3 3 0 003-3v-7.5zm-18 3.75a.75.75 0 01.75-.75h6a.75.75 0 010 1.5h-6a.75.75 0 01-.75-.75zm.75 2.25a.75.75 0 000 1.5h3a.75.75 0 000-1.5h-3z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="hidden sm:flex w-60 bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                    </div>
                    <div class="mt-3 sm:pe-8">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">To Pay</h3>
                        <p class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Payment have been
                            made at
                    <?php echo date_format($time, "g:i A"); ?>
                        </p>
                    </div>
                </li>
                <li class="relative mb-6 sm:mb-0">
                    <div class="flex items-center">
                        <div
                            class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-green-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="w-3 h-3text-green-800 dark:text-green-300">
                                <path
                                    d="M9.375 3a1.875 1.875 0 000 3.75h1.875v4.5H3.375A1.875 1.875 0 011.5 9.375v-.75c0-1.036.84-1.875 1.875-1.875h3.193A3.375 3.375 0 0112 2.753a3.375 3.375 0 015.432 3.997h3.943c1.035 0 1.875.84 1.875 1.875v.75c0 1.036-.84 1.875-1.875 1.875H12.75v-4.5h1.875a1.875 1.875 0 10-1.875-1.875V6.75h-1.5V4.875C11.25 3.839 10.41 3 9.375 3zM11.25 12.75H3v6.75a2.25 2.25 0 002.25 2.25h6v-9zM12.75 12.75v9h6.75a2.25 2.25 0 002.25-2.25v-6.75h-9z" />
                            </svg>
                        </div>
                        <div class="hidden sm:flex w-56 bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                    </div>
                    <div class="mt-3 sm:pe-8">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">To Ship</h3>
                        <p class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Shopper have shipped
                            your parcel</p>
                    </div>
                </li>
                <li class="relative mt-4 mb-6 sm:mb-0">
                    <div class="flex items-center">
                        <div
                            class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-green-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="w-3 h-3text-green-800 dark:text-green-300">
                                <path
                                    d="M3.375 4.5C2.339 4.5 1.5 5.34 1.5 6.375V13.5h12V6.375c0-1.036-.84-1.875-1.875-1.875h-8.25zM13.5 15h-12v2.625c0 1.035.84 1.875 1.875 1.875h.375a3 3 0 116 0h3a.75.75 0 00.75-.75V15z" />
                                <path
                                    d="M8.25 19.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0zM15.75 6.75a.75.75 0 00-.75.75v11.25c0 .087.015.17.042.248a3 3 0 015.958.464c.853-.175 1.522-.935 1.464-1.883a18.659 18.659 0 00-3.732-10.104 1.837 1.837 0 00-1.47-.725H15.75z" />
                                <path d="M19.5 19.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z" />
                            </svg>
                        </div>
                        <div class="hidden sm:flex w-56 bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                    </div>
                    <div class="mt-3 sm:pe-8">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    <?php echo $order_status; ?>
                        </h3>
                    </div>
                    <div>
                        <!-- <p class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Kindly wait for delivery</p> -->
                        <button
                            class="mt-2.5 dark:border-white dark:hover:bg-gray-900 dark:bg-transparent dark:text-white py-1 px-4 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-gray-800 border border-gray-800 text-sm text-gray-800">Order
                            Received</button>
                    </div>
                </li>
                <li class="relative mb-6 sm:mb-0">
                    <div class="flex items-center">
                        <div
                            class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="w-3 h-3text-blue-800 dark:text-blue-300">
                                <path fill-rule="evenodd"
                                    d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3 sm:pe-8">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Completed</h3>
                        <p class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-800">nothing here..</p>
                    </div>
                </li>
            </ol>
    <?php
} else if ($order_status == 'Completed') {
    ?>
                <ol class="items-center sm:flex">
                    <li class="relative mt-2.5 mb-6 sm:mb-0">
                        <div class="flex items-center">
                            <div
                                class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-green-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="w-3 h-3text-green-800 dark:text-green-300">
                                    <path d="M4.5 3.75a3 3 0 00-3 3v.75h21v-.75a3 3 0 00-3-3h-15z" />
                                    <path fill-rule="evenodd"
                                        d="M22.5 9.75h-21v7.5a3 3 0 003 3h15a3 3 0 003-3v-7.5zm-18 3.75a.75.75 0 01.75-.75h6a.75.75 0 010 1.5h-6a.75.75 0 01-.75-.75zm.75 2.25a.75.75 0 000 1.5h3a.75.75 0 000-1.5h-3z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="hidden sm:flex w-60 bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                        </div>
                        <div class="mt-3 sm:pe-8">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">To Pay</h3>
                            <p class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Payment have been
                                made at
                    <?php echo date_format($time, "g:i A"); ?>
                            </p><br>
                        </div>
                    </li>
                    <li class="relative mb-6 sm:mb-0">
                        <div class="flex items-center">
                            <div
                                class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-green-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="w-3 h-3text-green-800 dark:text-green-300">
                                    <path
                                        d="M9.375 3a1.875 1.875 0 000 3.75h1.875v4.5H3.375A1.875 1.875 0 011.5 9.375v-.75c0-1.036.84-1.875 1.875-1.875h3.193A3.375 3.375 0 0112 2.753a3.375 3.375 0 015.432 3.997h3.943c1.035 0 1.875.84 1.875 1.875v.75c0 1.036-.84 1.875-1.875 1.875H12.75v-4.5h1.875a1.875 1.875 0 10-1.875-1.875V6.75h-1.5V4.875C11.25 3.839 10.41 3 9.375 3zM11.25 12.75H3v6.75a2.25 2.25 0 002.25 2.25h6v-9zM12.75 12.75v9h6.75a2.25 2.25 0 002.25-2.25v-6.75h-9z" />
                                </svg>
                            </div>
                            <div class="hidden sm:flex w-64 bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                        </div>
                        <div class="mt-3 sm:pe-8">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">To Ship</h3>
                            <p class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Shopper have shipped
                                your parcel</p><br>
                        </div>
                    </li>
                    <li class="relative mb-6 sm:mb-0">
                        <div class="flex items-center">
                            <div
                                class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-green-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="w-3 h-3text-green-800 dark:text-green-300">
                                    <path
                                        d="M3.375 4.5C2.339 4.5 1.5 5.34 1.5 6.375V13.5h12V6.375c0-1.036-.84-1.875-1.875-1.875h-8.25zM13.5 15h-12v2.625c0 1.035.84 1.875 1.875 1.875h.375a3 3 0 116 0h3a.75.75 0 00.75-.75V15z" />
                                    <path
                                        d="M8.25 19.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0zM15.75 6.75a.75.75 0 00-.75.75v11.25c0 .087.015.17.042.248a3 3 0 015.958.464c.853-.175 1.522-.935 1.464-1.883a18.659 18.659 0 00-3.732-10.104 1.837 1.837 0 00-1.47-.725H15.75z" />
                                    <path d="M19.5 19.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z" />
                                </svg>
                            </div>
                            <div class="hidden sm:flex w-44 bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                        </div>
                        <div class="mt-3 sm:pe-8">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">To Receive</h3>
                            <p class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Order delivered</p>
                            <br>
                        </div>
                    </li>
                    <li class="relative mb-10 sm:mb-0">
                        <div class="flex items-center">
                            <div
                                class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-green-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="w-3 h-3text-green-800 dark:text-green-300">
                                    <path fill-rule="evenodd"
                                        d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                <?php
                $sqlSelectReview = "SELECT
                        *
                        FROM
                        review r
                        JOIN
                        orders o ON r.rv_order_id = o.order_id
                        WHERE
                        o.order_code = '$order_code'";

                $resultR = $conn->query($sqlSelectReview);
                // Check if there are rows in the result
                $rowReview = mysqli_fetch_assoc($resultR);
                if ($rowReview > 1) {
                    ?>
                            <div class="mt-3 sm:pe-8">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Completed</h3>
                                <p class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Thank you for your
                                    review
                                </p>
                            </div>
            <?php } else { ?>
                            <div class="mt-3 sm:pe-8">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Completed</h3>
                                <p class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Leave us some review
                                    <a class="text-gray-50 border-b border-green-300 hover:text-green-300"
                                        href="review.php?order_code=<?php echo $order_code; ?>">here</a>
                                </p>
                            </div>
            <?php } ?>
                    </li>
                </ol>
    <?php
}
?>