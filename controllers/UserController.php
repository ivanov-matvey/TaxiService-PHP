<?php

namespace controllers;

use core\DatabaseHandler;
use Exception;
use models\User;

include_once __DIR__ . '/../db_connection.php';
include_once __DIR__ . '/../core/DatabaseHandler.php';
include_once __DIR__ . '/../models/User.php';

class UserController extends DatabaseHandler
{
    public function getUser(int $id): ?User
    {
        $sql = "SELECT * FROM users WHERE id = $id";
        $stmt = $this->connection->query($sql);
        if ($stmt->num_rows > 0) {
            $row = $stmt->fetch_assoc();
            $user = new User($row["id"], $row["phone"], $row["password_hash"], $row["role"]);
            $stmt->close();
            return $user;
        }
        $stmt->close();
        return null;
    }

    public function registerUser($user, $name, $birthday): void
    {
        try {
            $this->connection->begin_transaction();

            $sql = "SELECT id FROM users WHERE phone = ?";
            $stmt = $this->connection->prepare($sql);
            $phone = $user->getPhone();
            $stmt->bind_param("s", $phone);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                throw new Exception("Пользователь с таким номером уже существует");
            }
            $stmt->close();

            $password = $user->getPasswordHash();
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (phone, password_hash, role) VALUES (?, ?, ?)";
            $stmt = $this->connection->prepare($sql);
            $phone = $user->getPhone();
            $role = $user->getRole();
            $stmt->bind_param(
                "sss",
                $phone,
                $passwordHash,
                $role
            );
            $stmt->execute();

            $userId = $this->connection->insert_id;

            if ($user->getRole() === 'client') {
                $sql = "INSERT INTO clients (name, birthday, rate, user_id) VALUES (?, ?, ?, ?)";
            } else {
                $sql = "INSERT INTO drivers (name, birthday, rate, user_id) VALUES (?, ?, ?, ?)";
            }
            $stmt = $this->connection->prepare($sql);
            $rate = 5.0;
            $stmt->bind_param(
                "ssdi",
                $name,
                $birthday,
                $rate,
                $userId
            );
            $stmt->execute();

            $this->connection->commit();

            header("Location: auth.php");
            exit();
        } catch (Exception $error) {
            $this->connection->rollBack();
            throw $error;
        }
    }

    public function loginUser($phone, $password): void
    {
        try {
            $sql = "SELECT * FROM users WHERE phone = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->bind_param("s", $phone);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 0) {
                throw new Exception("Пользователь с таким номером не найден");
            }

            $user = $result->fetch_assoc();
            $storedPasswordHash = $user['password_hash'];
            if (!password_verify($password, $storedPasswordHash)) {
                throw new Exception("Неверный пароль");
            }

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            header("Location: ../orders/orders.php");
            exit();
        } catch (Exception $error) {
            throw $error;
        }
    }
}