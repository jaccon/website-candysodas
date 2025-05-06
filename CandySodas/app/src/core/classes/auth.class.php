<?php
class Auth
{
    public static function getUserData($email, $field){
        global $CONFIG;
        $file = $CONFIG["CONF"]["cacheDir"] . "/users.json";

        if (file_exists($file)) {
            $data = file_get_contents($file);
        }

        $objitems = json_decode($data);
        foreach ($objitems as $content) {
            if ($content->email === $email) {
                return $content->$field;
            }
        }
        return false;
    }

    // LOGIN
    public static function login($email, $password){
        global $CONFIG;

        $file = $CONFIG["CONF"]["cacheDir"] . "/users.json";

        if (!file_exists($file)) {
            return false;
        }

        $data = file_get_contents($file);
        $users = json_decode($data, true);

        if ($users === null) {
            return false;
        }

        foreach ($users as $user) {
            if (
                $user["email"] === $email &&
                password_verify($password, $user["password"])
            ) {
                $_SESSION["user"] = [
                    "email" => $user["email"],
                    "name" => $user["name"] ?? null,
                ];
                // Redireciona após login bem-sucedido
                header(
                    "Location: {$CONFIG["CONF"]["siteUrl"]}/index.html?login=true"
                );
                exit();
            }
        }

        return false;
    }

    public static function hasAdmin()
    {
        global $CONFIG;
        $usergroup = Auth::getUserData($_SESSION["user"], "usergroup");

        if ($usergroup !== "admin") {
            header("Location: " . $CONFIG["CONF"]["adminCMS"] . "/home.html");
            exit();
        }
    }

    public static function loginSession()
    {
        global $CONFIG;
        session_start();
        if (!isset($_SESSION["user"])) {
            header("Location: " . $CONFIG["CONF"]["adminCMS"] . "/index.html");
            exit();
        } 

        
    }

    public static function checkEmail($email, $users)
    {
        foreach ($users as $user) {
            if ($user["email"] === $email) {
                return true;
            }
        }
        return false;
    }

    public static function createUser($email, $password, $name, $mobile, $uuid)
    {
        $file = "../../../cached/users.json";
        $users = json_decode(file_get_contents($file), true);

        if (Auth::checkEmail($email, $users)) {
            return false;
        }

        $users[] = [
            "id" => $uuid,
            "email" => $email,
            "password" => password_hash($password, PASSWORD_BCRYPT),
            "name" => $name,
            "mobile" => $mobile,
            "createdAt" => date("Y-m-d H:i:s"),
            "usergroup" => "customer",
        ];

        file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));
        return true;
    }

    public static function logUserAction($userId, $action)
    {
        global $CONFIG;
        $ipAddress = $_SERVER["REMOTE_ADDR"]; // Get the user's IP address

        $logData = [
            "user_id" => $userId,
            "action" => $action,
            "created" => date("Y-m-d H:i:s"),
            "ip_address" => $ipAddress, // Log the user's IP address
        ];

        $logFilePath = $CONFIG["CONF"]["cacheDir"] . "/audit.json";

        if (file_exists($logFilePath)) {
            $existingLogs = json_decode(file_get_contents($logFilePath), true);
            if (!is_array($existingLogs)) {
                $existingLogs = [];
            }
        } else {
            $existingLogs = [];
        }

        $existingLogs[] = $logData;

        file_put_contents(
            $logFilePath,
            json_encode($existingLogs, JSON_PRETTY_PRINT)
        );
    }

    public static function updateUserData($id, $data)
    {
        global $CONFIG;

        $filePath = $CONFIG["CONF"]["siteDir"] . "/cached/users.json";

        try {
            $jsonData = file_get_contents($filePath);
            $users = json_decode($jsonData, true);
            $userFound = false;

            foreach ($users as &$user) {
                if ($user["id"] === $id) {
                    $user = array_merge($user, $data);
                    $userFound = true;
                    break;
                }
            }

            if ($userFound) {
                file_put_contents(
                    $filePath,
                    json_encode($users, JSON_PRETTY_PRINT)
                );
                return true;
            } else {
                echo "Usuário $id não encontrado no arquivo $filePath.";
                return false;
            }
        } catch (Expostalcodetion $e) {
            echo "Erro ao atualizar dados: " . $e->getMessage();
            return false;
        }
    }

    public static function getAvatar($avatar)
    {
        global $CONFIG;

        if (!$avatar) {
            $avatar =
                $CONFIG["CONF"]["adminCMS"] .
                "/assets/media/svg/avatars/user-thumbnail.svg";
        } else {
            $avatar =
                $CONFIG["CONF"]["siteUrl"] .
                "/" .
                Auth::getUserData($_SESSION["user"], "avatar");
        }
        return $avatar;
    }

    public static function getUserById($userId)
    {
        global $CONFIG;

        $customersFile = $CONFIG["CONF"]["cacheDir"] . "/users.json";
        if (!file_exists($customersFile)) {
            return "";
        }

        $users = json_decode(file_get_contents($customersFile), true);
        if (!is_array($users)) {
            return "";
        }

        foreach ($users as $user) {
            if (isset($user["id"]) && $user["id"] === $userId) {
                return $user["name"] ?? "";
            }
        }
        return "User not found";
    }


    public static function getUsergroupByEmail($email) {
        global $CONFIG;
        $file = $CONFIG['CONF']['cacheDir'] . '/users.json';
        $data = file_get_contents($file);
        $users = json_decode($data, true);

        foreach ($users as $user) {
            if ($user['email'] === $email) {
                return $user['usergroup'];
            }
        }
        return false;
    }

    public static function getUserDataById($id, $field) {
        global $CONFIG;
        $file = $CONFIG['CONF']['cacheDir'] . '/users.json';
        $data = file_get_contents($file);
        $users = json_decode($data, true);

        foreach ($users as $user) {
            if ($user['id'] === $id) {
                return $user[$field];
            }
        }
        return false;
    }

    public static function getUserLoginHistory($userId) {
        global $CONFIG;
        $file = $CONFIG['CONF']['cacheDir'] . '/audit.json';
    
        if (!file_exists($file)) {
            return ["error" => "File not found"];
        }
    
        $data = file_get_contents($file);
        $logs = json_decode($data, true);
    
        if ($logs === null) {
            return ["error" => "Invalid JSON format"];
        }
    
        $filteredLogs = array_filter($logs, function($log) use ($userId) {
            return isset($log['user_id'], $log['action']) 
                && $log['user_id'] === $userId 
                && in_array($log['action'], ['login', 'logout'], true);
        });
    
        $filteredLogs = array_values($filteredLogs);
    
        usort($filteredLogs, function($a, $b) {
            return strtotime($b['created']) - strtotime($a['created']);
        });
    
        $limit = isset($CONFIG['CONF']['loginHistoryResults']) ? (int)$CONFIG['CONF']['loginHistoryResults'] : 10; 
        $filteredLogs = array_slice($filteredLogs, 0, $limit);
    
        return empty($filteredLogs) ? ["message" => "No actions found for user_id: $userId"] : $filteredLogs;
    }

    static public function getPermissionsUsers($suppliers, $supplierId) {
        if (is_string($suppliers)) {
            $suppliers = explode(',', $suppliers);
        }
      
        if (is_array($suppliers)) {
            return in_array($supplierId, $suppliers);
        }
      
        return false;
    }

}
    

?>
