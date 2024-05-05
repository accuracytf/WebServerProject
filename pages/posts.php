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
            </div>
            <div class="grid grid-cols-2 gap-8">
                <?php
                if(true){
                    try{

                        $dbh = connectToDB();
                        $stmt = getPosts($dbh);
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
                        {
                            echo '<div class="rounded-lg border text-card-foreground shadow-sm bg-gray-100" data-v0-t="card">';
                            echo '    <div class="p-6 grid gap-1.5 h-full">';
                            echo '        <h3 class="whitespace-nowrap font-semibold tracking-tight text-base line-clamp-2">';
                            echo '            <span>' . $row['title'] . '</span>';
                            echo '        </h3>';
                            echo '        <p class="text-sm text-muted-foreground line-clamp-4">';
                            echo '            <span>' . $row['bio'] . '</span>';
                            echo '        </p>';
                            echo '        <div class="flex items-center space-x-2 text-sm">';
                            echo '            <img';
                            echo '                    src="' . $row['img_src'] . '"';
                            echo '                    width="32"';
                            echo '                    height="32"';
                            echo '                    alt="Acme Corporation"';
                            echo '                    class="rounded-full"';
                            echo '                    style="aspect-ratio: 32 / 32; object-fit: cover;"';
                            echo '            />';
                            echo '            <span>' .  $row["firstname"] . " " .
                                $row["lastname"] . '</span>';
                            echo '        </div>';
                            echo '        <div class="flex items-center space-x-2 text-sm">';
                            echo '            <svg';
                            echo '                    xmlns="http://www.w3.org/2000/svg"';
                            echo '                    width="24"';
                            echo '                    height="24"';
                            echo '                    viewBox="0 0 24 24"';
                            echo '                    fill="none"';
                            echo '                    stroke="currentColor"';
                            echo '                    stroke-width="2"';
                            echo '                    stroke-linecap="round"';
                            echo '                    stroke-linejoin="round"';
                            echo '                    class="w-4 h-4 opacity-50"';
                            echo '            >';
                            echo '                <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path>';
                            echo '                <circle cx="12" cy="10" r="3"></circle>';
                            echo '            </svg>';
                            echo '            <span>' . $row['location'] . '</span>';
                            echo '        </div>';
                            echo '        <div class="flex items-center space-x-2 text-sm">';
                            echo '            <svg';
                            echo '                    xmlns="http://www.w3.org/2000/svg"';
                            echo '                    width="24"';
                            echo '                    height="24"';
                            echo '                    viewBox="0 0 24 24"';
                            echo '                    fill="none"';
                            echo '                    stroke="currentColor"';
                            echo '                    stroke-width="2"';
                            echo '                    stroke-linecap="round"';
                            echo '                    stroke-linejoin="round"';
                            echo '                    class="w-4 h-4 opacity-50"';
                            echo '            >';
                            echo '                <circle cx="12" cy="12" r="10"></circle>';
                            echo '                <polyline points="12 6 12 12 16 14"></polyline>';
                            echo '            </svg>';
                            echo '            <span>' . $row['last_date'] . '</span>';
                            echo '        </div>';
                            echo '        <div class="flex items-center space-x-2 text-sm">';
                            echo '            <svg';
                            echo '                    xmlns="http://www.w3.org/2000/svg"';
                            echo '                    width="24"';
                            echo '                    height="24"';
                            echo '                    viewBox="0 0 24 24"';
                            echo '                    fill="none"';
                            echo '                    stroke="currentColor"';
                            echo '                    stroke-width="2"';
                            echo '                    stroke-linecap="round"';
                            echo '                    stroke-linejoin="round"';
                            echo '                    class="w-4 h-4 opacity-50"';
                            echo '            >';
                            echo '                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />';
                            echo '            </svg>';
                            echo '            <span>Favorite</span>'; // Placeholder for the star icon
                            echo '        </div>';
                            echo '    </div>';
                            echo '</div>';




                        }
                    }
                    catch(Exception $e){
                        echo "Error: " . $e->getMessage();
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <a href="index.php?page=addPost">Hej<a/>

</section>