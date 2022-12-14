<?php

/**
 * Client Model
 * PHP version 7
 *
 * @category PHP
 * @package  Core_Required
 * @author   Fabiano Oliveira <fabiano.one@gmail.com>
 * @license  GNU http://opensource.org/licenses/gpl-license.php
 * @link     https://github.com/fabianoone
 */

/**
 * User Class
 *
 * @category PHP
 * @package  Required
 * @author   Fabiano Oliveira <fabiano.one@gmail.com>
 * @license  GNU http://opensource.org/licenses/gpl-license.php
 * @link     https://github.com/fabianoone
 */
class Client
{
    /**
     * Database private variable
     *
     * @var Database [type]
     */
    private Database $_db;

    /**
     * Constructor method
     */
    public function __construct()
    {
        $this->_db = new Database;
    }

    public function getClients($limit = null)
    {
        $this->_db->query('SELECT * FROM clients ');
        return $this->_db->resultSet();
    }

    /**
     * Register client
     *
     * @param [type] data
     *
     * @return bool
     */
    public function create($data)
    {
        $this->_db->query('INSERT INTO clients (name, last_name, email, phone, status) VALUES (:name, :last_name, :email, :phone, :status)');
        // Bind values
        $this->_db->bind(':name', $data['name']);
        $this->_db->bind(':last_name', $data['last_name']);
        $this->_db->bind(':email', $data['email']);
        $this->_db->bind(':phone', $data['phone']);
        $this->_db->bind(':status', $data['status']);

        // Execute
        if ($this->_db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Find client by email
     *
     * @param [type] $email
     *
     * @return bool
     */
    public function findClientByEmail($email)
    {
        $this->_db->query('SELECT * FROM clients WHERE email = :email limit 1');
        // Bind value
        $this->_db->bind(':email', $email);
        $row = $this->_db->single();

        // check row
        if ($this->_db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get client by id
     *
     * @param [$type] $id
     *
     * @return object
     */
    public function getClientById($id)
    {
        $this->_db->query('SELECT * FROM clients WHERE id = :id');
        // Bind value
        $this->_db->bind(':id', $id);

        return $this->_db->single();
    }

    /**
     * Update client
     *
     * @param
     *
     * @return bool
     */
    public function updateClient($data)
    {
        $this->_db->query('UPDATE clients SET name = :name, last_name = :last_name, email = :email, phone = :phone, status = :status WHERE id = :id');
        // Bind values
        $this->_db->bind(':id', $data['id']);
        $this->_db->bind(':name', $data['name']);
        $this->_db->bind(':last_name', $data['last_name']);
        $this->_db->bind(':email', $data['email']);
        $this->_db->bind(':phone', $data['phone']);
        $this->_db->bind(':status', $data['status']);
        // Execute
        if ($this->_db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteClient($id)
    {
        $this->_db->query('DELETE FROM clients WHERE id = :id');
        // Bind values
        $this->_db->bind(':id', $id);
        // Execute
        if ($this->_db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}