<?php
session_start(); 

if (!isset($_SESSION['uid'], $_SESSION['first_name'], $_SESSION['last_name'])){
    echo "Oops, your session was disrupted, try again later.";
}
else {

echo " <section class=\"formheadparent\">
            <h2 class='formtitle'>New User</h2>
                <div class='newuserstat'> </div>
        </section>
        <section class=\"formfootparent\">
            <table id= 'userformtable'>
                <form id='userform'>
                    <tr>
                        <td>
                            <label>Firstname</label>
                        </td>
                        <td>
                            <label>Lastname</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input id ='firstname'class='inputnormal userinput' type='text' placeholder='Jane' name='firstname' required>
                        </td>
                        <td>
                            <input id='lastname'class='inputnormal userinput' type='text' placeholder='Doe' name='lastname' required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Email</label>
                        </td>
                        <td>
                            <label>Password</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input id='email' class='inputnormal userinput' type='email' placeholder='something@example.com' name='email' required>
                        </td>
                        <td>
                            <input id='password'class='inputnormal userinput' type='password' name='password' required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for='Role'>Role</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select class='inputnormal userinput' name='role' id='role'>
                                <option value='Member'>Member</option>
                                <option value='Admin'>Admin</option>
                            </select>
                        </td>
                        <td>
                            <div class='formstatus' id='userstatus'> </div>
                        </td>
                    </tr>
                    <tr class='buttonrow'>
                        <td>
                        </td>
                        <td>
                            <button type= 'submit' name='adduserbtn' id='adduserbtn'> Save </button>
                        </td>
                    </tr>
                </form>
            </table>
        </section>";
} 


