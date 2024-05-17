<section>

    <div class="w-full py-12 lg:py-16">
        <div class="container grid items-center gap-4 px-4 text-center md:px-6">
            <div class="space-y-2">
                <h2 class="text-3xl font-bold tracking-tighter sm:text-4xl">We're Hiring</h2>
                <p class="mx-auto max-w-3xl text-gray-500 md:text-xl/relaxed lg:text-base/relaxed xl:text-xl/relaxed dark:text-gray-400">
                    Join our team of talented individuals who are passionate about shipping the best code.
                </p>
            </div>
            <div class="divide-y rounded-lg border">

            </div>
        </div>
    </div>
    <!--
// v0 by Vercel.
// https://v0.dev/t/4KMs8Z1PAf4
-->

    <div class="px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">
        <div class="grid gap-12 lg:grid-cols-2 lg:gap-8 items-start">
            <div class="space-y-12">
                <div class="space-y-2">
                    <h1 class="text-3xl font-bold">Customer Support Representative</h1>
                    <p class="text-sm leading-none">at Acme Corporation</p>
                </div>
                <div class="space-y-2 text-base text-gray-500">
                    <p class="line-clamp-6">
                        Acme Corporation is looking for a dedicated Customer Support Representative to join our team. The ideal
                        candidate will be responsible for managing customer inquiries via phone, email, and chat, providing timely
                        and accurate information while ensuring the highest level of customer satisfaction. The role will also
                        involve identifying and escalating priority issues to management and following up with customers to ensure
                        their issues are resolved.
                    </p>
                    <p>
                        <strong>Location:</strong> Remote (US-based)
                    </p>
                    <p>
                        <strong>Date Posted:</strong> March 23, 2024
                    </p>
                </div>
                <div class="mt-12">
                    <a class="flex items-center" href="#">
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
                                class="w-4 h-4 mr-1.5"
                        >
                            <path d="M5 12h14"></path>
                            <path d="m12 5 7 7-7 7"></path>
                        </svg>
                        <span class="underline">Back to all jobs</span>
                    </a>
                </div>
                <div class="flex flex-col gap-2 min-[400px]:flex-row">
                    <a
                            class="inline-flex h-10 items-center justify-center rounded-md bg-gray-900 px-8 text-sm font-medium text-gray-50 shadow transition-colors hover:bg-gray-900/90 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-gray-950 disabled:pointer-events-none disabled:opacity-50 dark:bg-gray-50 dark:text-gray-900 dark:hover:bg-gray-50/90 dark:focus-visible:ring-gray-300"
                            href="index.php?page=addPost"
                    >
                        Add New Post
                    </a>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-8">
                <?php
                if(true){
                    try{

                        $dbh = connectToDB();
                        $stmt = getPosts($dbh);
                        CreatePost($stmt);
                    }
                    catch(Exception $e){
                        echo "Error: " . $e->getMessage();
                    }
                }
                ?>
            </div>
        </div>
    </div>


</section>