<?php
function Clear(string $a): string
{
    return htmlspecialchars(stripslashes(trim($a)));
}

