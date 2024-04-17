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
                <?php
                if(true){
                    try{

                        $dbh = connectToDB();
                        $stmt = getPosts($dbh);
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
                        {
                            echo '<div class="grid w-full gap-4 md:grid-cols-2 xl:gap-10">';
                            echo '<div class="flex flex-col w-full gap-1">';
                            echo '<h3 class="font-semibold">' . $row["title"] . '</h3>';
                            echo '<p class="text-sm">' . $row["pay"] . '</p>';
                            echo '</div>';
                            echo '<div class="flex flex-col w-full gap-1 justify-self-end">';
                            echo '<p class="text-sm">' . $row["last_date"] . '</p>';
                            echo '</div>';
                            echo '</div>';

                            echo '<button class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-11 rounded-md px-8">
                                  Apply
                                  </button>';



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