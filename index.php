<?php session_start(); ?>
<html>
    <!Doctype html>

    <head>
        <meta charset ="UTF-8"/>
        <meta name= "viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet"  href="styles/style.css"/>
        <title>main</title>
    </head>

    <body>
        <section id="flex-parent">

            <header>
                <img src="images/dolphin.png"/> 
                <p id="logotitle">Dolphin CRM</p>
            </header>

            <div id="central">

                <aside class="hide">
                    <div class="menu"><button id="home"> <img src="images/home.png"/> Home</button></div>
                    <div class="menu"><button id ="newcontact"> <img src="images/new_contact.png"/> New Contact</button></div>
                    <div class="menu"><button id="users"> <img src="images/users.png"/>Users</button></div>
                    <hr>
                    <div class="menu"><button id="logout"> <img src="images/logout.png"/>Logout</button></div>
                </aside>

                <section id="changearea"> 
                    <form id="login">
                        <h1 class="formtitle">Login</h2>
                        <div class="formstatus"> </div>
                        <div class="formgrp"> 
                            <input class="inputnormal" type="email" placeholder="Email address" name="email" required>
                        </div>
                        <div class="formgrp"> 
                            <input class="inputnormal" type="password" placeholder="Password" name="password" required>
                        </div>
                        <button type= "submit" name="submitbtn" id="submitbtn"> <img src="images/lock.png"/> <span> Login </span></button>
                    </form> 
                </section>

           </div>

           <footer>
                <hr>
                <p>Copyright &copy; 2022 Dolphin CRM</p>
            </footer>

        </section>
    </body>

</html>