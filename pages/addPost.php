<?php
if(isset($_POST["title"])){
    echo "Hej44";
    addPost(connectToDB());
}
?>
<article class="max-w-md mx-auto bg-gray-100 p-8 shadow-md rounded-md">
    <form method="post" action="#" class="space-y-4">
        <div>
            <label for="title" class="block mb-2 text-lg font-semibold text-gray-800">Titel</label>
            <input type="text" id="title" name="title" placeholder="Skriv din titel här"
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500 text-gray-800 placeholder-gray-400">
        </div>
        <div>
            <label for="pay" class="block mb-2 text-lg font-semibold text-gray-800">Lön</label>
            <input type="text" id="pay" name="pay" placeholder="Ange lön"
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500 text-gray-800 placeholder-gray-400">
        </div>
        <div>
            <label for="last_date" class="block mb-2 text-lg font-semibold text-gray-800">Sista ansökningsdatum</label>
            <input type="date" id="last_date" name="last_date"
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500 text-gray-800 placeholder-gray-400">
        </div>
        <div>
            <input type="submit" value="Lägg till inlägg"
                   class="w-full bg-blue-500 text-white py-2 rounded-md cursor-pointer transition duration-300 hover:bg-blue-600">
        </div>
    </form>
</article>


