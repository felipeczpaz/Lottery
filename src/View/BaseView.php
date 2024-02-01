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

    public function renderBetForm()
    {
        $currentBalance = 10;
        $accumulatedReward = 1000000;

        // Main Content
        echo '<div class="container mx-auto max-w-md mt-8 p-4">';

        // Container for Current Balance
        echo '<div class="bg-white p-6 rounded-md shadow-md mb-4 text-center">';
        echo '<h2 class="text-2xl font-semibold mb-4">Current Balance</h2>';
        echo '<p class="text-xl text-green-500 mb-2">R$ ' . number_format($currentBalance, 2, ',', '.') . '</p>';
        echo '<a href="#" class="text-blue-500 underline">Deposit</a>';
        echo '</div>';

        // Accumulated Reward and Number Boxes
        echo '<div class="bg-white p-6 rounded-md shadow-md mb-8 text-center">';
        echo '<h2 class="text-2xl font-semibold mb-4">Accumulated Reward</h2>';

        // Assuming $accumulatedReward is a variable containing the dynamic value
        echo '<p class="text-xl text-blue-500 mb-4">R$ ' . number_format($accumulatedReward, 2, ',', '.') . '</p>';

        // Input for Allocating Balance
        echo '<div class="mb-4">';
        echo '<label for="balance" class="block text-gray-600 mb-2">Choose your betting amount:</label>';
        echo '<input type="text" id="amount" placeholder="Enter amount" class="p-3 border rounded-md w-full" oninput="formatBettingAmount(this)" />';
        echo '</div>';

        // Number Boxes for Betting
        echo '<div class="flex flex-col space-y-4 mb-4 items-center">';
        echo '<label for="bettingNumbers" class="block text-gray-600 mb-2">Choose your numbers:</label>';
        echo '<div class="w-full">';
        echo '<input type="number" id="bettingNumbers" placeholder="Enter number 1" class="p-3 border rounded-md w-full mb-2" />';
        echo '<input type="number" id="bettingNumbers" placeholder="Enter number 2" class="p-3 border rounded-md w-full mb-2" />';
        echo '<input type="number" id="bettingNumbers" placeholder="Enter number 3" class="p-3 border rounded-md w-full" />';
        echo '</div>';
        echo '</div>';

        // Bet Button
        echo '<button onclick="showConfirmationModal()" class="bg-blue-500 text-white py-3 px-6 rounded-md hover:bg-blue-600">Place Bet</button>';
        
        echo '</div>';
        echo '</div>';

        echo '<script>';
        echo 'function formatBettingAmount() {';
        echo 'var amountInput = document.getElementById("amount");';
        echo 'var amountValue = amountInput.value.replace(/\D/g, "");';
        echo 'amountValue = (parseFloat(amountValue) / 100).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,");';
        echo 'amountValue = amountValue.replace(".", ",");';
        echo 'amountInput.value = "R$ " + amountValue;';
        echo '}';
        echo '</script>';
    }
}