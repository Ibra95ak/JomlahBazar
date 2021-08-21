<?php
/**
  ** Users object
  * addUser --> Store new user
  * EditUser --> edit user
  * EditUserFNEM --> Edit user fullname and email
  * IsExistUser --> Check if user already exists
  * IsActivatedUser --> Check if existing user is activated
  * ActivateUserAccount --> Activate new user account
  * getUserByEmailAndPassword  --> Fetch user data of same email and password.
  * loggedUser --> set user login flag to true
  * getUserBygoogle --> login with google
  * getUserBylinkedin --> login with linkedin
  * getUserByotp --> login with phone
  * getUserById --> get user info
  * getUserByJBID --> get user info
  * getallUsers --> get all JB users
  * getnonAdmin --> get all JB users that are not admins
  * hashSSHA --> Encrypt text
  * checkhashSSHA --> Check if encryption match
  * getUserId --> get user Id from session hash
  * updateUserAuthy --> update user authyId
  * EditStore  --> update user store
  */

class Ser_Users
{
    /*Database connection variable*/
    private $conn;
    /*Constructor*/
    public function __construct(){
        /*Connecting to database*/
        require_once 'DB_Connect.php';
        /*Creating a connection instance*/
        $db = new DB_Connect();
        $this->conn = $db->connect();
    }
    /*Destructor*/
    public function __destruct()
    {
    }
    /**
     * Store new user
     * Parameters {fullname,email,phone,googlesub}
     * returns json/Null
     */
    public function AddUser($fullname, $email, $phone, $usertype, $is_buyer, $is_seller, $googlesub, $linkedinidentifier, $authyId, $jbidentifier)
    {
        if ($email!="") {
          /*Email activation code*/
          $hash_act = $this->hashSSHA($email.date("Y-m-d h:i:s")); /*generating unique code from user email and registered time*/
          $activation_code = $hash_act["encrypted"]; /*encrypted Activation code*/
          $activation_salt = $hash_act["salt"]; /*salt for activation code*/
        }
        else {
          $activation_code = "";
          $activation_salt = "";
        }
        $stmt = $this->conn->prepare("CALL sp_addUser(?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssiiissss", $fullname, $email, $phone, $activation_code, $activation_salt, $usertype, $is_buyer, $is_seller, $googlesub, $linkedinidentifier, $authyId, $jbidentifier);
        if ($stmt->execute()) {
            $users = $stmt->get_result()->fetch_assoc(); /*fetch data in json array*/
            $users['activation_code']=$activation_code;
            $users['activation_salt']=$activation_salt;
            $stmt->close();
            if ($users) {
                return $users;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }
    /**
     * Verify user
     * Parameters {verifieduserId, verifiedbyuserId, work_other}
     * returns json/Null
     */
    public function VerifyUserById($verifieduserId, $verifiedbyuserId, $work_other)
    {
        $stmt = $this->conn->prepare("CALL sp_VerifyUserById(?,?,?);");
        $stmt->bind_param("iii",$verifieduserId, $verifiedbyuserId, $work_other);
    		$result = $stmt->execute();
        $stmt->close();
        // check for successful store
        if ($result) return true;
        else return false;
    }
    /**
     * UnVerify user
     * Parameters {verifieduserId, verifiedbyuserId}
     * returns json/Null
     */
    public function unVerifyUserById($verifieduserId, $verifiedbyuserId)
    {
        $stmt = $this->conn->prepare("CALL sp_unVerifyUserById(?,?);");
        $stmt->bind_param("ii",$verifieduserId, $verifiedbyuserId);
    		$result = $stmt->execute();
        $stmt->close();
        // check for successful store
        if ($result) return true;
        else return false;
    }
    /**
     * check if already Verified by user
     * Parameters {verifieduserId, verifiedbyuserId}
     * returns json/Null
     */
    public function isVerifiedByUser($verifieduserId, $verifiedbyuserId)
    {
        $stmt = $this->conn->prepare("CALL sp_isVerifiedByUser(?,?)");
        $stmt->bind_param("ii",$verifieduserId, $verifiedbyuserId);
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_assoc();/*fetch data in json array*/
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return Null;
        }
    }
    /**
     * Edit user info
     * Parameters {userId,fullname,email,otp,roleId}
     * returns Boolean
     */
    public function EditUser($userId,$fullname, $email, $otp)
    {
        $stmt = $this->conn->prepare("CALL sp_EditUser(?,?,?,?)");
        $stmt->bind_param("isss", $userId,$fullname, $email, $otp);
        $result = $stmt->execute();
        $stmt->close();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Edit user fullname and email
     * Parameters {userId,fullname,email}
     * returns Boolean
     */
    public function EditUserFNEM($userId,$fullname, $email)
    {
        $stmt = $this->conn->prepare("CALL sp_EditUserFNEM(?,?,?)");
        $stmt->bind_param("iss", $userId,$fullname, $email);
        $result = $stmt->execute();
        $stmt->close();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Edit user info
     * Parameters {userId,fullname,email,otp,roleId}
     * returns Boolean
     */
    public function Admin_EditUser($userId, $fullname, $email, $otp, $nationality, $encrypted_password, $salt, $activation_code, $activation_salt, $active, $profile_pic, $roleId, $is_buyer, $is_seller, $login, $googlesub, $linkedinidentifier, $authyId, $jbidentifier)
    {
        $stmt = $this->conn->prepare("CALL sp_Admin_EditUser(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("issssssssisiiiisiis", $userId, $fullname, $email, $otp, $nationality, $encrypted_password, $salt, $activation_code, $activation_salt, $active, $profile_pic, $roleId, $is_buyer, $is_seller, $login, $googlesub, $linkedinidentifier, $authyId, $jbidentifier);
        $result = $stmt->execute();
        $stmt->close();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Check if user already exist
     * Parameters { phone}
     * returns json/null
     */
    public function IsExistUser($phone)
    {
        $stmt = $this->conn->prepare("CALL sp_IsExistUser(?)");
        $stmt->bind_param("s",$phone);
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_assoc();/*fetch data in json array*/
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
    /**
     * Check if email already exist
     * Parameters {email, phone}
     * returns json/null
     */
    public function IsActivatedUser($userId)
    {
        $stmt = $this->conn->prepare("CALL sp_IsActivatedUser(?)");
        $stmt->bind_param("i",$userId);
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_assoc();/*fetch data in json array*/
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
    /**
     * activate new user account
     * Parameters {usersId, activation_code, activation_salt}
     * returns boolean
     */
    public function ActivateUserAccount($userId,$activation_code,$activation_salt)
    {
        $stmt = $this->conn->prepare("CALL sp_ActivateUser(?,?,?)");
        $stmt->bind_param("iss",$userId,$activation_code,$activation_salt);
        $result = $stmt->execute();
        $stmt->close();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Get user by email and password
     * Parameters {email, password}
     * Returns json/Null
     */
    public function getUserByEmailAndPassword($email, $password)
    {
        $stmt = $this->conn->prepare("CALL sp_GetUserByEmail(?)");
        $stmt->bind_param("s", $email);
        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc(); /*Fetch data in json array*/
            $stmt->close();
            if($user){
              /*Verifying user password*/
              $salt = $user['salt'];
              $encrypted_password = $user['encrypted_password'];

              $hash = $this->checkhashSSHA($salt, $password); /*Verify encryption function*/
              /*Check for password equality*/
              if ($encrypted_password == $hash) {
                  /*user authentication details are correct*/
                  return $user;
              }
            }else{
              return null;
            }

        } else {
            return null;
        }
    }
    /**
     * Set user as logged in
     * parameters userId
     * returns Boolean
     */
    public function loggedUser($userId)
    {
        $stmt = $this->conn->prepare("CALL sp_LoggedUser(?)");
        $stmt->bind_param("i", $userId);
        $result = $stmt->execute();
        $stmt->close();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Get user by google ID
     * Parameters {googlesub}
     * Returns json/Null
     */
    public function getUserBygoogle($googlesub)
    {
        $stmt = $this->conn->prepare("CALL sp_getUserBygoogle(?)");
        $stmt->bind_param("s", $googlesub);
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_assoc();/*fetch data in json array*/
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
    /**
     * Get user company
     * Parameters {usercompanyId}
     * Returns json/Null
     */
    public function getUserCompany($usercompanyId)
    {
        $stmt = $this->conn->prepare("CALL sp_getUserCompany(?)");
        $stmt->bind_param("i", $usercompanyId);
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_assoc();/*fetch data in json array*/
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
    /**
     * Get user by linkedin Id
     * Parameters {linkedinidentifier}
     * Returns json/Null
     */
    public function getUserBylinkedin($linkedinidentifier)
    {
        $stmt = $this->conn->prepare("CALL sp_getUserBylinkedin(?)");
        $stmt->bind_param("s", $linkedinidentifier);
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_assoc();/*fetch data in json array*/
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
    /**
     * Get user by phone
     * Parameters {phone}
     * Returns json/Null
     */
    public function getUserByotp($phone)
    {
        $stmt = $this->conn->prepare("CALL sp_getUserByotp(?)");
        $stmt->bind_param("s", $phone);
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_assoc();/*fetch data in json array*/
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
    /**
     * Get user by Id
     * Parameters {userId}
     * returns json/null
     */
    public function getUserById($userId)
    {
        $stmt = $this->conn->prepare("CALL sp_getUserById(?)");
        $stmt->bind_param("i", $userId);
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_assoc();/*fetch data in json array*/
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
    /**
     * Get user by jbidentifier
     * Parameters {jbidentifier}
     * returns json/null
     */
    public function getUserByJBID($jbidentifier)
    {
        $stmt = $this->conn->prepare("CALL sp_getUserByJBID(?)");
        $stmt->bind_param("s", $jbidentifier);
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_assoc();/*fetch data in json array*/
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
    /**
     * Get user Id
     * Parameters {jbidentifier}
     * returns json/null
     */
    public function getUserId($jbidentifier)
    {
        $stmt = $this->conn->prepare("CALL sp_getUserId(?)");
        $stmt->bind_param("s", $jbidentifier);
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_assoc();/*fetch data in json array*/
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
    /**
     * Get user Id
     * Parameters {jbidentifier}
     * returns json/null
     */
    public function getUserVerifyById($userId)
    {
        $stmt = $this->conn->prepare("CALL sp_getUserVerifyById(?)");
        $stmt->bind_param("i", $userId);
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_assoc();/*fetch data in json array*/
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
    /**
     * Get all users
     * Parameters {}
     * returns json/null
     */
    public function getallUsers($sql)
    {
        $stmt = $this->conn->prepare("CALL sp_getallUsers(?)");
        $stmt->bind_param("s",$sql);
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
    /**
     * Get users count
     * Parameters {query}
     * returns json/null
     */
    public function getUserscount($sql)
    {
        $stmt = $this->conn->prepare("CALL sp_getUserscount(?)");
        $stmt->bind_param("s",$sql);
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_assoc(); /*fetch data in json object*/
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
    /**
     * Get all users
     * Parameters {}
     * returns json/null
     */
    public function getallUsersFiltered()
    {
        $stmt = $this->conn->prepare("CALL sp_getallUsersFiltered()");
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
    /**
     * Get all non admin users
     * Parameters {}
     * returns json/null
     */
    public function getnonAdmin()
    {
        $stmt = $this->conn->prepare("CALL sp_getnonAdmin()");
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
    /**
     * delete user by id
     * params userId
     * returns boolean
     */
    public function DeleteUserById($userId) {
      echo "CALL sp_DeleteUserbyId($userId)";
      $stmt = $this->conn->prepare("CALL sp_DeleteUserbyId(?)");
      $stmt->bind_param("i",$userId);
      $result = $stmt->execute();
      $stmt->close();
      /*check for successful delete*/
  		if($result) return true;
  		else return false;
    }
    /**
     * delete user brands
     * params userId
     * returns boolean
     */
    public function DeleteSupplierbrand($userId) {
      $stmt = $this->conn->prepare("CALL sp_DeleteSupplierbrand(?)");
      $stmt->bind_param("i",$userId);
      $result = $stmt->execute();
      $stmt->close();
      /*check for successful delete*/
  		if($result) return true;
  		else return false;
    }
    /**
     * delete user categories
     * params userId
     * returns boolean
     */
    public function DeleteSupplierCategory($userId) {
      $stmt = $this->conn->prepare("CALL sp_DeleteSupplierCategory(?)");
      $stmt->bind_param("i",$userId);
      $result = $stmt->execute();
      $stmt->close();
      /*check for successful delete*/
  		if($result) return true;
  		else return false;
    }
    /**
     * Get user's contact list
     * Parameters {userId}
     * Returns json/Null
     */
    public function getUserContactList($userId)
    {
        $stmt = $this->conn->prepare("CALL sp_getUserContactList(?)");
        $stmt->bind_param("i", $userId);
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);/*fetch data in json object*/
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
    /**
     * Get user's categories
     * Parameters {userId}
     * Returns json/Null
     */
    public function getUserCategories($userId)
    {
        $stmt = $this->conn->prepare("CALL sp_getUserCategories(?)");
        $stmt->bind_param("i", $userId);
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);/*fetch data in json object*/
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
    /**
     * Get user's brands
     * Parameters {userId}
     * Returns json/Null
     */
    public function getUserBrands($userId)
    {
        $stmt = $this->conn->prepare("CALL sp_getUserBrands(?)");
        $stmt->bind_param("i", $userId);
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);/*fetch data in json object*/
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
    /**
     * Get suppliers of same categories
     * Parameters {categories, userId}
     * Returns json/Null
     */
    public function GetsuppliersBycategories($categories,$userId)
    {
        $stmt = $this->conn->prepare("CALL sp_GetsuppliersBycategories(?,?)");
        $stmt->bind_param("si", $categories, $userId);
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);/*fetch data in json object*/
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
    /**
     * storing new supplier category
     * parameters userId, categoryId
     * returns Boolean
     */
    public function addSupplierCategory($userId,$categoryId)
    {
        $stmt = $this->conn->prepare("CALL sp_addSupplierCategory(?,?)");
        $stmt->bind_param("ii", $userId,$categoryId);
        $result = $stmt->execute();
        $stmt->close();
        /*check for successful store*/
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * storing new supplier brand
     * parameters userId, brandId
     * returns Boolean
     */
    public function addSupplierBrand($userId,$brandId)
    {
        $stmt = $this->conn->prepare("CALL sp_addSupplierBrand(?,?)");
        $stmt->bind_param("ii", $userId,$brandId);
        $result = $stmt->execute();
        $stmt->close();
        /*check for successful store*/
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * get active suppliers
     * returns json/null
     */
    public function GetActiveSuppliers() {
      $stmt = $this->conn->prepare("CALL sp_GetActiveSuppliers()");
      if ($stmt->execute()) {
        $products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data and store in json object*/
        $stmt->close();
        if ($products) return $products;
        else return NULL;
      }else return NULL;
    }
    /**
     * count products
     * returns json/Null
     */
    public function countSuppliers($query) {
      $stmt = $this->conn->prepare("CALL sp_GetActiveSupplierscount(?)");
      $stmt->bind_param("s",$query);
      if ($stmt->execute()) {
        $products = $stmt->get_result()->fetch_assoc(); /*fetch data in json array*/
        $stmt->close();
        if ($products==true) return $products;
        else return NULL;
      } else return NULL;
    }
    /**
     * Get user company
     * Parameters {userId}
     * Returns json/Null
     */
    public function getAllCompanies()
    {
        $stmt = $this->conn->prepare("CALL sp_getAllCompanies()");
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);/*fetch data in json array*/
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
    /**
     * Edit user type
     * Parameters {userId}
     * returns Boolean
     */
    public function SetSupplier($userId)
    {
        $stmt = $this->conn->prepare("CALL sp_SetSupplier(?)");
        $stmt->bind_param("i",$userId);
        $result = $stmt->execute();
        $stmt->close();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Edit user type
     * Parameters {otp}
     * returns Boolean
     */
    public function SetAffiliate($otp)
    {
        $stmt = $this->conn->prepare("CALL sp_SetAffiliate(?)");
        $stmt->bind_param("s",$otp);
        $result = $stmt->execute();
        $stmt->close();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Add user license
     * Parameters {userId,fullname,email,otp,roleId}
     * returns Boolean
     */
    public function AddUserlicense($userId,$license,$vat)
    {
        $stmt = $this->conn->prepare("CALL sp_AddUserlicense(?,?,?)");
        $stmt->bind_param("iss", $userId,$license,$vat);
        $result = $stmt->execute();
        $stmt->close();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * delete user license
     * params userId
     * returns boolean
     */
    public function DeleteUserlicense($userId) {
      $stmt = $this->conn->prepare("CALL sp_DeleteUserlicense(?)");
      $stmt->bind_param("i",$userId);
      $result = $stmt->execute();
      $stmt->close();
      /*check for successful delete*/
      if($result) return true;
      else return false;
    }
    /**
     * Get suppliers of same categories
     * Parameters {categories, userId}
     * Returns json/Null
     */
    public function GetUserlicenses($userId)
    {
        $stmt = $this->conn->prepare("CALL sp_GetUserlicenses(?)");
        $stmt->bind_param("i", $userId);
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);/*fetch data in json object*/
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
    public function GetstatmentsBysellerId($userId)
    {
        $stmt = $this->conn->prepare("CALL sp_GetstatmentsBysellerId(?)");
        $stmt->bind_param("i", $userId);
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);/*fetch data in json object*/
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
    public function updateUserAuthy($userId,$authy_id)
    {
        $stmt = $this->conn->prepare("CALL sp_updateUserAuthy(?,?)");
        $stmt->bind_param("ii", $userId,$authy_id);
        $result = $stmt->execute();
        $stmt->close();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function EditStore($storeId,$name,$trn,$pic)
    {
        $stmt = $this->conn->prepare("CALL sp_EditStore(?,?,?,?)");
        $stmt->bind_param("isss", $storeId, $name, $trn, $pic);
        $result = $stmt->execute();
        $stmt->close();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function AddStore($name, $trn, $pic)
    {
        $stmt = $this->conn->prepare("CALL sp_AddStore(?,?,?)");
        $stmt->bind_param("sss", $name, $trn, $pic);
        $result = $stmt->execute();
        $stores = $stmt->get_result()->fetch_assoc();/*fetch data in json object*/
        $stmt->close();
        if ($stores) {
            return $stores;
        } else {
            return Null;
        }
    }
    public function UpdateUsercompanyId($supplierId,$storeId)
    {
        $stmt = $this->conn->prepare("CALL sp_UpdateUsercompanyId(?,?)");
        $stmt->bind_param("ii", $supplierId,$storeId);
        $result = $stmt->execute();
        $stmt->close();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function UpdateReachoutId($userId,$reachoutId)
    {
        $stmt = $this->conn->prepare("CALL sp_UpdateReachoutId(?,?)");
        $stmt->bind_param("ii", $userId,$reachoutId);
        $result = $stmt->execute();
        $stmt->close();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Encryption
     * Parameters {text}
     * returns array
     */
    public function hashSSHA($text)
    {
        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode(sha1($text . $salt, true) . $salt);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);
        return $hash;
    }
    /**
     * Decryption
     * Parameters {salt,text}
     * returns string
     */
    public function checkhashSSHA($salt, $text)
    {
        $hash = base64_encode(sha1($text . $salt, true) . $salt);
        return $hash;
    }
    /*************************Admin Functions********************************/
    /**
     * Get all users
     * Parameters {}
     * returns json/null
     */
    public function Admin_getallUsers($sql)
    {
        $stmt = $this->conn->prepare("CALL sp_Admin_getallUsers(?)");
        $stmt->bind_param("s",$sql);
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
    public function Admin_getallStores()
    {
        $stmt = $this->conn->prepare("CALL sp_Admin_getallStores()");
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
    public function Admin_getUserById($Id)
    {
        $stmt = $this->conn->prepare("CALL sp_Admin_getUserById(?)");
        $stmt->bind_param("i", $Id);
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_assoc(); /*fetch data in json object*/
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
    public function Admin_getUserCompany($Id)
    {
        $stmt = $this->conn->prepare("CALL sp_Admin_getUserCompany(?)");
        $stmt->bind_param("i", $Id);
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_assoc(); /*fetch data in json object*/
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
    public function Admin_getUserDevices($Id)
    {
        $stmt = $this->conn->prepare("CALL sp_Admin_getUserDevices(?)");
        $stmt->bind_param("i", $Id);
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
    public function Admin_getUserWallets($Id)
    {
        $stmt = $this->conn->prepare("CALL sp_Admin_getUserWallets(?)");
        $stmt->bind_param("i", $Id);
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
    public function Admin_getUserCreditCards($Id)
    {
        $stmt = $this->conn->prepare("CALL sp_Admin_getUserCreditCards(?)");
        $stmt->bind_param("i", $Id);
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
    public function getUserCreditCards($Id)
    {
        $stmt = $this->conn->prepare("CALL sp_getUserCreditCards(?)");
        $stmt->bind_param("i", $Id);
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
    public function Admin_getUserPaypals($Id)
    {
        $stmt = $this->conn->prepare("CALL sp_Admin_getUserPaypals(?)");
        $stmt->bind_param("i", $Id);
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); /*fetch data in json object*/
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
    public function Admin_getStoreById($Id)
    {
        $stmt = $this->conn->prepare("CALL sp_Admin_getStoreById(?)");
        $stmt->bind_param("i", $Id);
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_assoc(); /*fetch data in json object*/
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
    public function Admin_updateStatus($Id,$status)
    {
        $stmt = $this->conn->prepare("CALL sp_Admin_updateStatus(?,?)");
        $stmt->bind_param("ii",$Id,$status);
        $result = $stmt->execute();
        $stmt->close();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
