<?php
Defined('BASE_PATH') or die(ACCESS_DENIED);

class UserModel extends Database {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Method getUserData
     * Get User Data
     * @param {string} username
     * @return {object} result
     *                  result.success {boolean}
     *                  result.message {string}
     *                  result.data {array}
     */
    public function getUserData($username) {
        $result = (object)array(
            'success' => false,
            'message' => '',
            'data' => null
        );

        $query  = "SELECT u.username, u.password, u.contactId, c.name, c.email ";
        $query .= "FROM user u JOIN contact c ON c.id = u.contactId ";
        $query .= "WHERE (BINARY u.username = :username OR BINARY c.email = :username);";
        try {
            $statement = $this->connection->prepare($query);
            $statement->bindParam(':username', $username, PDO::PARAM_STR);
            $statement->execute();
            $result->data = $statement->fetchAll(PDO::FETCH_ASSOC);
            if(count($result->data) < 1) {
                throw new Exception("Username or Password is wrong");
            }

            $result->success = true;
        } 
        catch (PDOException $e) {
            $result->message = $e->getMessage();
        }
        catch (Exception $e) {
            $result->message = $e->getMessage();
        }

        return $result;
    }

    /**
     * Method getAccessList
     * Get Access List by username
     * @param {string} username
     * @return {object} result
     *                  result.success {boolean}
     *                  result.message {string}
     *                  result.data {array}
     */
    public function getAccessList($username) {
        $result = (object)array(
            'success' => false,
            'message' => '',
            'data' => null
        );

        $query  = "SELECT a.name, a.title, a.icon, a.router, a.position, ar.isCanInsert, ar.isCanUpdate, ar.isCanDelete, ar.isCanRead ";
        $query .= "FROM access_right ar ";
        $query .= "JOIN access a ON a.id = ar.accessId ";
        $query .= "JOIN user u ON u.id = ar.userId ";
        $query .= "WHERE BINARY u.username = :username ";
        $query .= "ORDER BY a.position ASC;";
        try {
            $statement = $this->connection->prepare($query);
            $statement->bindParam(':username', $username, PDO::PARAM_STR);
            $statement->execute();
            $result->data = $statement->fetchAll(PDO::FETCH_ASSOC);
            if(count($result->data) < 1) {
                throw new Exception("This user haven't access");
            }

            $result->success = true;
        } 
        catch (PDOException $e) {
            $result->message = $e->getMessage();
        }
        catch (Exception $e) {
            $result->message = $e->getMessage();
        }

        return $result;
    }

    public function __destruct() {
        $this->close();
    }
}