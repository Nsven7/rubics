<?php
include($_SERVER['DOCUMENT_ROOT'] . "/Rubics/model/dbconnect.php");

/**
 * This function inserts employee data into the database.
 * It first checks if the required fields are not empty and if the passwords match.
 * If there are no errors, it inserts the employee data into the `role` and `employee` tables.
 * It then retrieves the last inserted id and returns it.
 */
function updateData($firstName, $lastName, $birthdate, $biography, $pwd, $confirmPassword, $avatar)
{

    // Check datas received
    $errors = [];
    if (!empty($pwd) && $pwd == $confirmPassword) {
        $pwd = md5($pwd);
        $confirmPassword = $pwd;
    } elseif (empty($pwd) && empty($confirmPassword)) {
        if(isset($_SESSION['employee'])) {
            $pwd = $_SESSION['employee']['role']['pwd'];
            $confirmPassword = $pwd;
        } else {
            $pwd = $_SESSION['admin']['role']['pwd'];
            $confirmPassword = $pwd;
        }
    } else {
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
        if (empty($pwd)) {
            $errors[] = "Mot de passe requis";
        } elseif (strlen($pwd) < 8) {
            $errors[] = "Mot de passe doit contenir au moins 8 caractères";
        } elseif ($pwd !== $confirmPassword) {
            $errors[] = "Les mots de passe ne correspondent pas";
        } elseif (empty($confirmPassword)) {
            $errors[] = "Veuillez confirmer votre mot de passe";
        }
        if (empty($avatar)) {
            $avatar = $_SESSION['employee']['general']['avatar'];
        }
    }

    // Retrieve db connection
    global $bdd;

    // Check if client exists
    $stmtEmployeeId = $bdd->prepare("SELECT id FROM employee WHERE employee.first_name = ? AND employee.last_name = ?");
    $stmtEmployeeId->execute([$firstName, $lastName]);
    $employeeId = $stmtEmployeeId->fetchColumn();

    // Check if employee exists
    $sqlEmployee = "SELECT * FROM `employee` WHERE id = :id";
    $stmtEmployee = $bdd->prepare($sqlEmployee);
    $stmtEmployee->bindParam(":id", $employeeId, PDO::PARAM_INT);
    $stmtEmployee->execute();
    $employee = $stmtEmployee->fetch(PDO::FETCH_ASSOC);

    if ($employee === false) {
        $message = "L'employé n'existe pas";
        $errors[] = $message;
    }

    if (!empty($errors)) {
        return $errors;
    }

    // Update employee data
    $sqlEmployee = "UPDATE `employee` SET first_name = :first_name, last_name = :last_name, birthdate = :birthdate, biography = :biography, avatar = :avatar WHERE id = :id";
    $stmtEmployee = $bdd->prepare($sqlEmployee);
    $stmtEmployee->bindParam(":id", $employeeId);
    $stmtEmployee->bindParam(":first_name", $firstName);
    $stmtEmployee->bindParam(":last_name", $lastName);
    $stmtEmployee->bindParam(":birthdate", $birthdate);
    $stmtEmployee->bindParam(":biography", $biography);
    $stmtEmployee->bindParam(":avatar", $avatar);
    $stmtEmployee->execute();

    // Update employee's role
    $id = ($_SESSION['employee'] ? $_SESSION['employee']['role']['id'] : $_SESSION['admin']['role']['id']);

    $querysqlUpdateEmployee = "UPDATE role SET pwd = :pwd WHERE id = :id";
    $stmtUpdateEmployee = $bdd->prepare($querysqlUpdateEmployee);
    $stmtUpdateEmployee->bindParam(":id", $id, PDO::PARAM_INT);
    $stmtUpdateEmployee->bindParam(":pwd", $pwd);

    try {
        $stmtUpdateEmployee->execute();
    } catch (PDOException $e) {
        $message = "Une erreur s'est produite lors de la mise à jour des identifiants client";
        $errors[] = $message;
    }
}

/**
 * This function logs the employee
 * It takes two parameters: the first name and the last name.
 * It then retrieves the employee with the identifiers.
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
                                JOIN team ON employee.team_id = team.id
                                JOIN role ON employee.role_id = role.id
                                WHERE employee.first_name = ? AND employee.last_name = ?");
            $stmt->execute([$firstName, $lastName]);
            $employeeDetails = $stmt->fetch(PDO::FETCH_ASSOC);

            $stmtEmployeeId = $bdd->prepare("SELECT id FROM employee WHERE employee.first_name = ? AND employee.last_name = ?");
            $stmtEmployeeId->execute([$firstName, $lastName]);
            $employeeId = $stmtEmployeeId->fetchColumn();

            // Verify the password
            if ($employeeDetails['pwd'] === $pwd) {
                $_SESSION[$employeeDetails['priority'] == 1 ? 'admin' : 'employee'] = [
                    'general' => [
                        'id' => $employeeId,
                        'avatar' => $employeeDetails['avatar'],
                        'firstName' => $employeeDetails['first_name'],
                        'lastName' => $employeeDetails['last_name'],
                        'birthdate' => $employeeDetails['birthdate'],
                        'biography' => $employeeDetails['biography'],
                        'createdAt' => $employeeDetails['created_at'],
                        'actif' => $employeeDetails['actif'],
                        'teamId' => $employeeDetails['team_id'],
                        'roleId' => $employeeDetails['role_id'],
                    ],
                    'role' => [
                        'id' => $employeeDetails['role_id'],
                        'priority' => $employeeDetails['priority'],
                        'pwd' => $employeeDetails['pwd'],
                        'createdAt' => $employeeDetails['created_at'],
                        'actif' => $employeeDetails['actif'],
                    ],
                    'team' => [
                        'id' => $employeeDetails['team_id'],
                        'name' => $employeeDetails['name'],
                        'actif' => $employeeDetails['actif'],
                    ]
                ];
            } else {
                $message = "Mot de passe incorrect";
                $errors[] = $message;
            }
        } else {
            $message = "Employé non existant";
            $errors[] = $message;
        }
    } catch (PDOException $e) {
        $message = "Une erreur s'est produite, veuillez réessayer";
        $errors[] = $message;
    }
    if (!empty($errors)) {
        return $errors;
    }
}

/**
 * This function 
 * logout the employee
 * and destroy
 * the session
 */
function logout()
{
    session_destroy();
}

// Retrieve all employees except specific id
function employees($id)
{
    global $bdd;

    $query = "SELECT * FROM employee WHERE id != :id";
    $stmt = $bdd->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $employees;
}

// 
function employee($id)
{
    // Retrieve db connection
    global $bdd;

    $sql = "SELECT e.*, t.*, r.*
    FROM employee e
    JOIN team t ON e.team_id = team_id
    JOIN role r ON e.role_id = role_id
    WHERE e.id = :id";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $employee = $stmt->fetch(PDO::FETCH_ASSOC);

    $employee['id'] = $id;

    return $employee;
}

// Retrieve active employees by their team
function getActiveEmployeesByTeam()
{

    // Retrieve db connection
    global $bdd;

    // Prepare the SQL query
    $query = "
    SELECT e.id, e.first_name, e.last_name, t.name AS team_name
    FROM employee e
    JOIN team t ON e.team_id = t.id
    WHERE e.actif = 1
    ORDER BY t.name, e.first_name
    ";

    // Prepare and execute the statement
    $statement = $bdd->prepare($query);
    $statement->execute();

    // Fetch the results
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $results;
}

// Retrievve all active employees if team is not specified. Else retrieve active employees by their team
function getActiveEmployees($idTeam = null)
{
    global $bdd;

    if ($idTeam === null) {
        $query = "SELECT employee.*, team.name AS team_name FROM employee LEFT JOIN team ON employee.team_id = team.id WHERE employee.actif = 1";
        $stmt = $bdd->prepare($query);
    } else {
        $query = "SELECT employee.*, team.name AS team_name FROM employee LEFT JOIN team ON employee.team_id = team.id WHERE employee.actif = 1 AND employee.team_id = :team_id";
        $stmt = $bdd->prepare($query);
        $stmt->bindParam(':team_id', $idTeam, PDO::PARAM_INT);
    }

    $stmt->execute();
    $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $employees;
}
