<?php

/**
 * Product Model
 * PHP version 7
 *
 * @category PHP
 * @package  Core_Required
 * @author   Fabiano Oliveira <fabiano.one@gmail.com>
 * @license  GNU http://opensource.org/licenses/gpl-license.php
 * @link     https://github.com/fabianoone
 */

/**
 * Product Model
 *
 * @category PHP
 * @package  Required
 * @author   Fabiano Oliveira <fabiano.one@gmail.com>
 * @license  GNU http://opensource.org/licenses/gpl-license.php
 * @link     https://github.com/fabianoone
 */
class Product
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

    public function getProducts($start = 0, $limit = 100)
    {
        $this->_db->query("SELECT * FROM products LIMIT $start, $limit");
        return $this->_db->resultSet();
    }

    public function createProduct($data)
    {
        $this->_db->query('INSERT INTO products (code, title, description, price, active) VALUES(:code, :title, :description, :price, :active)');
        // Bind values
        $this->_db->bind(':code', $data['code']);
        $this->_db->bind(':title', $data['title']);
        $this->_db->bind(':description', $data['description']);
        $this->_db->bind(':price', $data['price']);
        $this->_db->bind(':active', $data['active']);

        // Execute
        if ($this->_db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function countId()
    {
        $this->_db->query('SELECT count(id) as id FROM products');
        return $this->_db->resultSet();
    }

    public function getProductById($id)
    {
        $this->_db->query('SELECT * FROM products WHERE id = :id');
        // Bind values
        $this->_db->bind(':id', $id);

        return $this->_db->single();
    }

    /**
     * Update product
     *
     * @param
     *
     * @return bool
     */
    public function updateProduct($data)
    {
        $this->_db->query('UPDATE products SET title = :title, code = :code, price = :price, active = :active, description = :description WHERE id = :id');
        // Bind values
        $this->_db->bind(':id', $data['id']);
        $this->_db->bind(':title', $data['title']);
        $this->_db->bind(':code', $data['code']);
        $this->_db->bind(':price', $data['price']);
        $this->_db->bind(':active', $data['active']);
        $this->_db->bind(':description', $data['description']);

        // Execute
        if ($this->_db->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function deleteProduct($id)
    {
        $this->_db->query('DELETE FROM products WHERE id = :id');
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