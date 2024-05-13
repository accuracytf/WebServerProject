

<!--
// v0 by Vercel.
// https://v0.dev/t/VNdetBkHDIW
-->

<nav class="bg-gray-900 py-4 px-6">
    <div class="flex items-center justify-between">
        <div class="flex space-x-6 text-white">
            <a class="flex items-center hover:text-gray-400" href="index.php">
                <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="mr-2 h-5 w-5"
                >
                    <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
                2PG
            </a>
            <a class="flex items-center hover:text-gray-400" href="index.php?page=posts">
                <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="mr-2 h-5 w-5"
                >
                    <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"></path>
                    <path d="M14 2v4a2 2 0 0 0 2 2h4"></path>
                    <path d="M10 9H8"></path>
                    <path d="M16 13H8"></path>
                    <path d="M16 17H8"></path>
                </svg>
                Posts
            </a>
            <a class="flex items-center hover:text-gray-400" href="index.php?page=profile">
                <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="mr-2 h-5 w-5"
                >
                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
                Profil
            </a>
            <?php
            if (isset($_SESSION["user_id"])) {
                echo '<a class="flex items-center hover:text-gray-400"  href="index.php?page=logout">
                <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="mr-2 h-5 w-5"
                >
                    <path d="M13 4h3a2 2 0 0 1 2 2v14"></path>
                    <path d="M2 20h3"></path>
                    <path d="M13 20h9"></path>
                    <path d="M10 12v.01"></path>
                    <path d="M13 4.562v16.157a1 1 0 0 1-1.242.97L5 20V5.562a2 2 0 0 1 1.515-1.94l4-1A2 2 0 0 1 13 4.561Z"></path>
                </svg>
                Logga ut
            </a>';
            }
            else {
                echo '<a class="flex items-center hover:text-gray-400" href="index.php?page=login">
                <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="mr-2 h-5 w-5"
                >
                    <path d="M13 4h3a2 2 0 0 1 2 2v14"></path>
                    <path d="M2 20h3"></path>
                    <path d="M13 20h9"></path>
                    <path d="M10 12v.01"></path>
                    <path d="M13 4.562v16.157a1 1 0 0 1-1.242.97L5 20V5.562a2 2 0 0 1 1.515-1.94l4-1A2 2 0 0 1 13 4.561Z"></path>
                </svg>
                Logga in
            </a>';
            }
            ?>
        </div>
        <div class="flex items-center space-x-4">
            <button
                    class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-accent hover:text-accent-foreground h-10 w-10 rounded-full"
                    type="button"
                    id="radix-:rc:"
                    aria-haspopup="menu"
                    aria-expanded="false"
                    data-state="closed"
            >
                <img
                        src="/placeholder.svg"
                        width="32"
                        height="32"
                        class="rounded-full"
                        alt="Avatar"
                        style="aspect-ratio: 32 / 32; object-fit: cover;"
                />
                <span class="sr-only">Toggle user menu</span>
            </button>
        </div>
    </div>
</nav>