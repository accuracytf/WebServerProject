<!--
posts sidan
-->
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

    <div class="px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">
        <div class="grid gap-12 lg:grid-cols-2 lg:gap-8 items-start">
            <div class="space-y-12">
                <?php
                try{
                    if (isset($_POST['post_id'])) {
                        $dbh = ConnectToDB();
                        $post_id = $_POST['post_id'];

                        // tar alla posts
                        $sql = "SELECT posts.*
                    FROM posts 
                    WHERE posts.post_id = :post_id";
                        $stmt = $dbh->prepare($sql);
                        $stmt->bindValue(':post_id', $post_id);
                        $stmt->execute();


                        //visar detaljer för det post du clickat på
                        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo '<div class="grid gap-12 lg:grid-cols-2 lg:gap-8 items-start">';
                            echo '    <div class="space-y-12">';
                            echo '        <div class="space-y-2">';
                            echo '            <h1 class="text-3xl font-bold">' . $row['title']. '</h1>';
                            echo '            <p class="text-sm leading-none">at Acme Corporation</p>';
                            echo '        </div>';
                            echo '        <div class="space-y-2 text-base text-gray-500">';
                            echo '            <p class="line-clamp-6">';
                            echo                $row['bio'];
                            echo '            </p>';
                            echo '            <p>';
                            echo '                <strong>Location: </strong>' .  $row['location'];
                            echo '            </p>';
                            echo '            <p>';
                            echo '                <strong>Date Posted:</strong> '.$row['last_date'];
                            echo '            </p>';
                            echo '        </div>';
                            echo '    </div>';
                            echo '</div>';


                        }
                    }
                    //visar en place holder för detaljerna för ett post
                    else{
                        echo '<div class="grid gap-12 lg:grid-cols-2 lg:gap-8 items-start">';
                        echo '    <div class="space-y-12">';
                        echo '        <div class="space-y-2">';
                        echo '            <h1 class="text-3xl font-bold"> Find a job</h1>';
                        echo '            <p class="text-sm leading-none">at Acme Corporation</p>';
                        echo '        </div>';
                        echo '        <div class="space-y-2 text-base text-gray-500">';
                        echo '            <p class="line-clamp-6">';
                        echo                'a job at acme corporation' ;
                        echo '            </p>';
                        echo '            <p>';
                        echo '                <strong>Location: Toledo</strong>';
                        echo '            </p>';
                        echo '            <p>';
                        echo '                <strong>Date Posted: last-date</strong> ';
                        echo '            </p>';
                        echo '        </div>';
                        echo '    </div>';
                        echo '</div>';
                    }
                }
                catch(Exception $e){
                    echo "Error: " . $e->getMessage();
                }



                ?>
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
                //skapar alla posts
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