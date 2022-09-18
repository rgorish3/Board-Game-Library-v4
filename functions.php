<?php
    
    
    function randomString($n)
    {
        $characters = '0213456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $str='';
        for($i=0; $i<$n; $i++){
            $index = rand(0, strlen($characters) - 1 );
            $str .= $characters[$index];
        }

        return $str;
    }


    function checkCredentials($email, $password)
    {

        require(__DIR__."/database.php");

        $statement = $pdo->prepare("SELECT id, fullName, accountStatus, accountPassword, accountType FROM users WHERE email = :email");
        $statement -> bindValue(':email', $email);
        $statement -> execute();

        if($statement->rowCount())
        {
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            if(password_verify($password, $result['accountPassword']))
            {
                if($result['accountStatus'] == 1)
                {
                    return array('status' => 'success', 'id' => $result['id'], 'fullName' => $result['fullName'], 'type'=>$result['accountType']);
                }

                return array('status' => 'error', 'message'=> 'This account is inactive.');
            }
    
        }

        return array('status' => 'error', 'message'=> 'Invalid email/password');
    }