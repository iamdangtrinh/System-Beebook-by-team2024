<?php
// app/Services/UserService.php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(array $data)
    {
        // Validate $data if needed
        
        // Create user using UserRepository
        return $this->userRepository->create($data);
    }

    public function updateUser($id, array $data)
    {
        // Validate $data if needed

        // Update user using UserRepository
        return $this->userRepository->update($id, $data);
    }

    public function deleteUser($id)
    {
        // Delete user using UserRepository
        return $this->userRepository->delete($id);
    }

    public function getUserById($id)
    {
        // Get user by id using UserRepository
        return $this->userRepository->findById($id);
    }

    public function getAllUsers()
    {
        // Get all users using UserRepository
        return $this->userRepository->all();
    }
}
