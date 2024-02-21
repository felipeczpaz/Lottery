<?php

namespace App\View;

class BaseView
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function renderHeader()
    {
        echo '<!DOCTYPE html>';
        echo '<html lang="en">';
        echo '<head>';
        echo '<meta charset="UTF-8">';
        echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
        echo '<title>' . $this->data['title'] . '</title>';
        echo '<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">';
        echo '</head>';
        echo '<body class="bg-gray-100">';
        echo '<nav class="bg-blue-500 p-4">';
        echo '<div class="container mx-auto flex justify-between items-center">';
        echo '<a href="/" class="text-white text-lg font-semibold">Lottery</a>';
        echo '<div class="space-x-4">';

        if (isset($_SESSION['user_id'])) {
            echo '<div class="flex items-center space-x-4">';
            echo '<span class="text-white">Welcome, ' . $_SESSION['full_name'] . '</span>';
            echo '<form action="/logout" method="post">';
            echo '<button type="submit" class="text-white">Logout</button>';
            echo '</form>';
            echo '</div>';
        } else {
            echo '<a href="/login" class="text-white">Login</a>';
            echo '<a href="/register" class="text-white">Register</a>';
        }

        echo '</div>';
        echo '</div>';
        echo '</nav>';
    }

    public function renderFooter()
    {
        echo '<footer class="text-gray-600">';
        echo '<div class="container mx-auto py-4">';
        echo '<p>&copy; <script>document.write(new Date().getFullYear());</script> Lottery. All rights reserved.</p>';
        echo '</div>';
        echo '</footer>';
        echo '</body>';
        echo '</html>';
    }
}