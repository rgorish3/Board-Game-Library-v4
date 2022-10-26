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



    function resetPassword($oldPassword, $newPassword1, $newPassword2){
        if(isset($_SESSION['user'])){
            if($newPassword1 == $newPassword2) {

                if(strlen($newPassword1) >= 8 && !preg_match('/^[a-zA-Z]+$/',$newPassword1))
                {

                    require(__DIR__."/database.php");

                    $statement = $pdo->prepare("SELECT accountPassword FROM users WHERE id = :id");
                    $statement -> bindValue(':id', $_SESSION['id']);
                    $statement -> execute();

                    if($statement->rowCount()){

                        $result=$statement->fetch(PDO::FETCH_ASSOC);

                        if(password_verify($oldPassword, $result['accountPassword'])){

                            $statement = $pdo->prepare("UPDATE users SET accountPassword = :newPassword WHERE id = :id");
                            $statement -> bindValue(':newPassword',password_hash($newPassword1,PASSWORD_DEFAULT));
                            $statement -> bindValue(':id', $_SESSION['id']);    
                            $statement -> execute();

                            return array( 'status' => 'success', 'message' => 'Password changed successfully.');


                        }

                        return array('status' => 'error', 'message' => 'Current password is incorrect.');

                    }

                    return array('status' => 'error', 'message'=> 'Something has gone stupidly wrong. Tell Robert this is a code 
                        "How in the heck did this even happen?" Better yet, take a screenshot. He\'s going to to a ctrl-f on those 
                        words and come to the offending part of the code. Let me tell you, he\'s going to spend at least a couple 
                        of hours trying to fix this nonsense. Look what you have condemned him to. Just so you understand, if 
                        you\'re getting this error it means either you\'re logged into an account that doesn\'t actually exist, or 
                        somehow you don\'t have a password. How did you even log in? Maybe bring him a cup of coffee when you tell him
                        because hoo boy is he gonna need it.');

                }

                return array('status' => 'error', 'message' => 'New password needs to be at least 8 characters and contain at least one number or symbol.');
            
            }

            return array('status' => 'error', 'message'=> 'New Passwords do not match.');
        }
        
        return array('status' => 'error', 'message'=> 'No User Logged In');
    }

    function changeLibrary($libraryID)
    {
        if(isset($_SESSION['user'])){
            require(__DIR__."/database.php");

            $statement = $pdo->prepare("UPDATE usersInLibraries SET libraryId = :libraryId WHERE userId = :userId");
            $statement -> bindValue(':libraryId', $libraryID);
            $statement -> bindValue(':userId', $_SESSION['id']);
            $statement -> execute();


            return array('status' => 'success', 'message' => 'Library changed successfully.');
        }
           
    }
