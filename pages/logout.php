<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    session_unset();
    session_destroy();
}
?>
<form id="formLogout" action="#" method="post">
    <div class="flex items-center justify-center h-screen">
        <div
                class="rounded-lg bg-card text-card-foreground p-6 shadow-lg border border-gray-200 dark:border-gray-700"
                data-v0-t="card"
        >
            <div class="flex flex-col space-y-1.5 p-6">
                <h3 class="whitespace-nowrap font-semibold tracking-tight text-2xl">Logout</h3>
                <p class="text-sm text-muted-foreground">Are you sure you want to log out of your account?</p>
            </div>
            <div class="p-6 space-y-4">
                <input
                        class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2 w-full"
                        type="submit"
                        value="Log out"
                >
            </div>
        </div>
    </div>
</form>
