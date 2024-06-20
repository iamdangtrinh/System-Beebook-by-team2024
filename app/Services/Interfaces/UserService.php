<?php
// app/Services/UserServiceInterface.php
namespace App\Services;

interface UserServiceInterface
{
    public function createUser(array $data);
    public function updateUser($id, array $data);
    public function deleteUser($id);
    public function getUserById($id);
    public function getAllUsers();
}
