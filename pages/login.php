<?php
try{
    if(isset($_SESSION["user_id"])){
        echo "Redan Inloggad";
    }
    if(isset($_POST["firstname"])){
        loginUser(connectToDB());
    }

}
catch (Exception $e){
    echo "Error: " . $e->getMessage();
}


?>

<!--
// v0 by Vercel.
// https://v0.dev/t/Drg0KSbLX8h
-->

<form method="post" class="mx-auto max-w-md">
    <div class="rounded-lg border bg-card text-card-foreground shadow-sm" data-v0-t="card">
        <div class="flex flex-col space-y-1.5 p-6">
            <h3 class="whitespace-nowrap text-2xl font-semibold leading-none tracking-tight">Login</h3>
        </div>
        <div class="p-6 space-y-4">
            <div class="space-y-2">
                <label
                        class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                        for="firstname"
                >
                    Firstname
                </label>
                <input
                        class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                        id="firstname"
                        placeholder="Firstname"
                        required=""
                        type="text"
                        name="firstname"
                />
            </div>
            <div class="space-y-2">
                <label
                        class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                        for="lastname"
                >
                    Lastname
                </label>
                <input
                        class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                        id="lastname"
                        placeholder="Lastname"
                        required=""
                        type="text"
                        name="lastname"
                />
            </div>
            <div class="space-y-2">
                <label
                        class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                        for="password"
                >
                    Password
                </label>
                <input
                        class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                        id="password"
                        placeholder="Password"
                        required=""
                        type="password"
                        name="password"
                />
            </div>
        </div>
        <div class="flex items-center p-6">
            <input
                    class="inline-flex items-center bg-gray-900 text-gray-50 justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2 w-full"
                    type="submit"
                    value="Login"
            >
        </div>
    </div>
</form>

<p class="mt-4 text-center">
    <a href="index.php?page=addUser" class="text-gray-900 hover:underline">Registrera konto</a>
</p>