<?php
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/dbconnect.php");

/**
 * This function inserts user data into the database.
 * It first checks if the required fields are not empty and if the passwords match.
 * If there are any errors, it returns an array of error messages.
 * If there are no errors, it inserts the user data into the `identifier` and `client` tables.
 * It then retrieves the last inserted id and returns it.
 */
function updateData($firstName, $lastName, $birthdate, $biography, $avatar)
{
    // Check datas received
    $errors = [];
    if (empty($firstName)) {
        $message = "Le prénom est obligatoire";
        $errors[] = $message;
    }
    if (empty($lastName)) {
        $message = "Le nom est obligatoire";
        $errors[] = $message;
    }
    if (empty($birthdate)) {
        $message = "La date de naissance est obligatoire";
        $errors[] = $message;
    }
    if (empty($biography)) {
        $message = "La biographie est obligatoire";
        $errors[] = $message;
    }
    if (empty($avatar)) {
        $message = "L'avatar est obligatoire";
        $errors[] = $message;
    }

    // Retrieve db connection
    global $bdd;

    // Check if client exists
    $id = $_SESSION['employee']['general']['id'];

    // Check if employee exists
    $sqlEmployee = "SELECT * FROM `employee` WHERE id = :id";
    $stmtEmployee = $bdd->prepare($sqlEmployee);
    $stmtEmployee->bindParam(":id", $id);
    $stmtEmployee->execute();
    $employee = $stmtEmployee->fetch(PDO::FETCH_ASSOC);

    if ($employee === false) {
        $message = "L'employé n'existe pas";
        return $message;
    }

    // Update employee data
    $sqlEmployee = "UPDATE `employee` SET first_name = :first_name, last_name = :last_name, birthdate = :birthdate, biography = :biography, avatar = :avatar WHERE id = :id";
    $stmtEmployee = $bdd->prepare($sqlEmployee);
    $stmtEmployee->bindParam(":id", $id);
    $stmtEmployee->bindParam(":first_name", $firstName);
    $stmtEmployee->bindParam(":last_name", $lastName);
    $stmtEmployee->bindParam(":birthdate", $birthdate);
    $stmtEmployee->bindParam(":biography", $biography);
    $stmtEmployee->bindParam(":avatar", $avatar);
    $stmtEmployee->execute();
}

/**
 * This function logs the client
 * It takes two parameters: the mail and the password.
 * It then retrieves the client with the identifiers.
 * If there are no errors, it returns the client data with its identifiers.
 * It then stocks this array in session.
 */
function login($firstName, $lastName, $pwd)
{
    // Retrieve db connection
    global $bdd;

    try {
        // Check if the employee exists with the provided first name, last name, and password
        $stmt = $bdd->prepare("SELECT * FROM employee WHERE first_name = ? AND last_name = ?");
        $stmt->execute([$firstName, $lastName]);
        $employee = $stmt->fetch(PDO::FETCH_ASSOC);


        if ($employee) {
            // Retrieve all information about the employee, their team, and their role
            $stmt = $bdd->prepare("SELECT employee.*, team.*, role.* FROM employee
                                JOIN team ON employee.id_team = team.id
                                JOIN role ON employee.id_role = role.id
                                WHERE employee.first_name = ? AND employee.last_name = ?");
            $stmt->execute([$firstName, $lastName]);
            $employeeDetails = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verify the password
            if ($employeeDetails['pwd'] === $pwd) {
                // Add everything to the session
                session_start();
                $_SESSION['employee'] = $employeeDetails;
                echo "Employee information retrieved and added to session successfully.";
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "Employee not found.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Stocks datas in session 'employee'
    // $_SESSION['employee'] = [
    //     'general' => [
    //         'id' => $employee['id'],
    //         'first_name' => $employee['first_name'],
    //         'last_name' => $employee['last_name'],
    //         'birthdate' => $employee['birthdate'],
    //         'biography' => $employee['biography'],
    //         'avatar' => $employee['avatar'],
    //         'created_at' => $employee['created_at'],
    //         'actif' => $employee['actif'],
    //         'id_team' => $employee['id_team'],
    //         'id_role' => $employee['id_role'],
    //     ],
    //     'team' => [
    //         'id' => $employee['id'],
    //         'name' => $employee['name'],
    //         'actif' => $employee['actif'],
    //     ],
    //     'role' => [
    //         'id' => $employee['id'],
    //         'priority' => $employee['priority'],
    //         'created_at' => $employee['created_at'],
    //         'actif' => $employee['actif'],
    //     ]
    // ];

    die(var_dump($_SESSION['employee']));
}


/**
 * This function 
 * logout the client
 * and destroy
 * the session
 */
function logout()
{
    session_destroy();
}
