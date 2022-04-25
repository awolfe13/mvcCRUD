<?php

class Animals extends Controller {
    public function __construct() {
        $this->animalModel = $this->model('Animal');
    }

    public function index() {
        $animals = $this->animalModel->getAllAnimals();
        //var_dump($animals);
        //array of animals
        $data = [
           'animals' => $animals
        ];

        $this->view('animals/index', $data);
    }

    public function create() {
        if(!isLoggedIn()) {
            //header is redirect
            header("Location: " . URLROOT . "/animals");
        }
        $data = [
            'name' => '',
            'species' => '',
            'age' => '',
            'gender' => '',
            'breed' => '',
            'description' => '',
            'intake_date' => '',
            'nameError' => '',
            'descriptionError' => '',
        ];

        //check if form was posted
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //sanitize form data before sending to db
            //$_POST = filter_input_array('INPUT_POST', FILTER_SANITIZE_STRING);
            $data = [
                //$_POST['name of input field']
                'user_id' => $_SESSION['user_id'],
                'name' => trim($_POST['name']),
                'species' => $_POST['species'],
                'age' => $_POST['age'],
                'gender' => $_POST['gender'],
                'breed' => trim($_POST['breed']),
                'description' => trim($_POST['description']),
                'intake_date' => date('Y-m-d', time()),
                'nameError' => '',
                'descriptionError' => '',
            ];

            //VALIDATION
            if (empty($data['name'])) {
                $data['nameError'] = 'The name of animal cannot be empty.';
            }

            if (empty($data['description'])) {
                $data['descriptionError'] = 'The description the of animal cannot be empty.';
            }

            if (empty($data['nameError']) && empty($data['descriptionError'])) {
                //CREATE ANIMAL (addAnimal method in model)
                if ($this->animalModel->addAnimal($data)) {
                    //redirect user if animal created
                    header("Location: " . URLROOT . "/animals");
                } else {
                    die("Something went wrong, please try again.");
                }
            } else {
                //return to create view with error messages
                $this->view('animals/create', $data);
            }
        }

        $this->view('animals/create', $data);
    }

    //pass in animal id
    public function update($id) {
        //findAnimalById function in model
        $animal = $this->animalModel->findAnimalById($id);

        if(!isLoggedIn()) {
            header("Location: " . URLROOT . "/animals");
        } elseif ($animal->user_id != $_SESSION['user_id']) {
            header("Location: " . URLROOT . "/animals");
        }

        //var_dump($animal);
        $data = [
            'animal' => $animal,
            'name' => '',
            'species' => '',
            'age' => '',
            'gender' => '',
            'breed' => '',
            'description' => '',
            'intake_date' => '',
        ];

        //no error check
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //sanitize form data before sending to db
            //$_POST = filter_input_array('INPUT_POST', FILTER_SANITIZE_STRING);
            $data = [
                //$_POST['name of input field']
                'id' => $id, //same id passed into from view
                'user_id' => $_SESSION['user_id'],
                'animal' => $animal,
                'name' => trim($_POST['name']),
                'species' => $_POST['species'],
                'age' => $_POST['age'],
                'gender' => $_POST['gender'],
                'breed' => trim($_POST['breed']),
                'description' => trim($_POST['description']),
                'intake_date' => date('Y-m-d', time()),
                'nameError' => '',
                'descriptionError' => '',
            ];

            //check if same or new data entered
//            if($data['animal']->name == $this->animalModel->findAnimalById($id)->title) {
//                $data['nameError'] = "Please change the name"
//            }

            //Update animal
            if($this->animalModel->updateAnimal($data)) {
                header("Location: " . URLROOT . "/animals");
            } else {
                die("Something went wrong, please try again!");
            }
        }

        $this->view('animals/update', $data);
    }

    //passed in from view
    public function delete($id) {
        $animal = $this->animalModel->findAnimalById($id);

        if(!isLoggedIn()) {
            header("Location: " . URLROOT . "/animals");
        } elseif ($animal->user_id != $_SESSION['user_id']) {
            header("Location: " . URLROOT . "/animals");
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if($this->animalModel->deleteAnimal($id)) {
                header("Location: " . URLROOT . "/animals");
            } else {
                die("Something went wrong, please try again!");
            }
        }
    }
}