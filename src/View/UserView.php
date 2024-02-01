<?php

namespace App\View;

class UserView extends BaseView
{
    public function renderRegisterForm($error = '')
    {
        echo '<div class="flex items-center justify-center min-h-screen bg-gray-100 mt-8">';
        echo '<form action="/register" method="post" class="bg-white p-8 rounded shadow-md w-full sm:w-96">';
        echo '<h2 class="text-2xl font-semibold mb-4">Register</h2>';

        if (!empty($error)) {
            echo '<p class="text-red-500 mb-4">' . $error . '</p>';
        }
        
        echo '<div class="mb-4">';
        echo '<label for="fullName" class="block text-gray-600 mb-2">Full Name</label>';
        echo '<input type="text" id="fullName" name="fullName" placeholder="John Doe" class="w-full p-3 border rounded-md" />';
        echo '</div>';
        
        echo '<div class="mb-4">';
        echo '<label for="cpf" class="block text-gray-600 mb-2">CPF</label>';
        echo '<input type="text" id="cpf" name="cpf" placeholder="123.456.789-00" class="w-full p-3 border rounded-md" />';
        echo '</div>';
        
        echo '<div class="mb-4">';
        echo '<label for="email" class="block text-gray-600 mb-2">Email</label>';
        echo '<input type="email" id="email" name="email" placeholder="john@example.com" class="w-full p-3 border rounded-md" />';
        echo '</div>';
        
        echo '<div class="mb-4">';
        echo '<label for="password" class="block text-gray-600 mb-2">Password</label>';
        echo '<input type="password" id="password" name="password" placeholder="********" class="w-full p-3 border rounded-md" />';
        echo '</div>';
        
        echo '<div class="mb-6">';
        echo '<label for="confirmPassword" class="block text-gray-600 mb-2">Confirm Password</label>';
        echo '<input type="password" id="confirmPassword" name="confirmPassword" placeholder="********" class="w-full p-3 border rounded-md" />';
        echo '</div>';
        
        echo '<div class="mb-6">';
        echo '<label class="flex items-center">';
        echo '<input type="checkbox" class="form-checkbox mr-2">';
        echo '<span class="text-gray-600">I accept the <a href="#" class="text-blue-500">Terms of Use</a>, <a href="#" class="text-blue-500">Privacy Policy</a>, and <a href="#" class="text-blue-500">Data Policy</a></span>';
        echo '</label>';
        echo '</div>';
        
        echo '<button type="submit" class="bg-blue-500 text-white py-3 px-6 rounded-md hover:bg-blue-600 w-full">Register</button>';
        
        echo '</form>';
        echo '</div>';
    }

    public function renderLoginForm($error = '')
    {
        echo '<div class="flex items-center justify-center min-h-screen bg-gray-100">';
        echo '<form action="/login" method="post" class="bg-white p-8 rounded shadow-md w-full sm:w-96">';
        echo '<h2 class="text-2xl font-semibold mb-4">Login</h2>';

        if (!empty($error)) {
            echo '<p class="text-red-500 mb-4">' . $error . '</p>';
        }
        
        echo '<div class="mb-4">';
        echo '<label for="email" class="block text-gray-600 mb-2">Email</label>';
        echo '<input type="email" id="email" name="email" placeholder="john@example.com" class="w-full p-3 border rounded-md" />';
        echo '</div>';
        
        echo '<div class="mb-6">';
        echo '<label for="password" class="block text-gray-600 mb-2">Password</label>';
        echo '<input type="password" id="password" name="password" placeholder="********" class="w-full p-3 border rounded-md" />';
        echo '</div>';
        
        echo '<div class="mb-4 text-right">';
        echo '<a href="#" class="text-blue-500">Forgot Password?</a>';
        echo '</div>';
        
        echo '<button type="submit" class="bg-blue-500 text-white py-3 px-6 rounded-md hover:bg-blue-600 w-full">Login</button>';
        echo '<p class="mt-4 text-center text-gray-600">Don\'t have an account? <a href="/register" class="text-blue-500">Register here</a></p>';
        
        echo '</form>';
        echo '</div>';
    }
}