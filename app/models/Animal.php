<?php
class Animal {
    private $dd;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllAnimals() {
        $this->db->query("SELECT * FROM animals ORDER BY species ASC");

        $results = $this->db->resultSet();

        return $results;
    }

    public function addAnimal($data) {
        $this->db->query("INSERT INTO animals(user_id, name, species, age, gender, breed, description, intake_date) 
VALUES(:user_id, :name, :species, :age, :gender, :breed, :description, :intake_date)");

        //bind values to placeholder in query
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':species', $data['species']);
        $this->db->bind(':age', $data['age']);
        $this->db->bind(':gender', $data['gender']);
        $this->db->bind(':breed', $data['breed']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':intake_date', $data['intake_date']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function findAnimalById($id) {
        $this->db->query("SELECT * FROM animals where id = :id");
        $this->db->bind(':id', $id);
        $row = $this->db->single();
        return $row;
    }

    public function updateAnimal($data) {
        $this->db->query("UPDATE animals SET user_id = :user_id, name = :name, species = :species, 
        age = :age, gender = :gender, breed = :breed, description = :description, intake_date = :intake_date
        where id = :id");

        //bind values to placeholder in query
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':species', $data['species']);
        $this->db->bind(':age', $data['age']);
        $this->db->bind(':gender', $data['gender']);
        $this->db->bind(':breed', $data['breed']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':intake_date', $data['intake_date']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteAnimal($id) {
        $this->db->query("DELETE from animals where id = :id");
        $this->db->bind(':id', $id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

}