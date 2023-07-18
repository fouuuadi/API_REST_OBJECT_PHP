<?php
class ProfileUser{

    private $id = id;
    private $username = username;
    private $firstname = firstname;
    private $lastname = lastname;
    private $age = age;
    private $description = description;
    private $sexe = sexe;

    /**
     * @param $id
     * @param $username
     * @param $firstname
     * @param $lastname
     * @param $age
     * @param $description
     * @param $sexe
     */
    public function __construct($id, $username, $firstname, $lastname, $age, $description, $sexe)
    {
        $this->id = $id;
        $this->username = $username;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->age = $age;
        $this->description = $description;
        $this->sexe = $sexe;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * @param mixed $sexe
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;
    }

    public function readAllUser(){

        $db = new Database();
        $connection = $db->getConnection();

        $request = $connection->prepare("select * from Users");
        $request->execute();

        $rows = $request->fetchAll(PDO::FETCH_ASSOC);
        $users = [];

        foreach($rows as $row){
            $user = new ProfileUser(
                $row["id"],
                $row["username"],
                $row["firstname"],
                $row["lastname"],
                $row["age"],
                $row["description"],
                $row["sexe"]
            );

            $users[] = $user;
        }
        return $users;

    }

    public function updateUser() {
        $db = new Database();
        $connection = $db->getConnection();

        $query = "UPDATE Users SET username = :username, firstname = :firstname, lastname = :lastname, age = :age, description = :description, sexe = :sexe WHERE id = :id";

        $request = $connection->prepare($query);
        $request->bindParam(':id', $this->id);
        $request->bindParam(':username', $this->username);
        $request->bindParam(':firstname', $this->firstname);
        $request->bindParam(':lastname', $this->lastname);
        $request->bindParam(':age', $this->age);
        $request->bindParam(':description', $this->description);
        $request->bindParam(':sexe', $this->sexe);

        return $request->execute();
    }
    public function getUserById($id) {
        $db = new Database();
        $connection = $db->getConnection();

        $query = "SELECT * FROM Users WHERE id = :id";
        $request = $connection->prepare($query);
        $request->bindParam(':id', $id);
        $request->execute();

        $row = $request->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $user = new ProfileUser(
                $row["id"],
                $row["username"],
                $row["firstname"],
                $row["lastname"],
                $row["age"],
                $row["description"],
                $row["sexe"]
            );
            return $user;
        } else {
            return null;
        }
    }

    public function deleteUser() {
        $db = new Database();
        $connection = $db->getConnection();

        $query = "DELETE FROM Users WHERE id = :id";
        $request = $connection->prepare($query);
        $request->bindParam(':id', $this->id);

        return $request->execute();
    }


}
?>