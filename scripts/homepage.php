<?php
session_start();
require "dbconnect.php";
if (isset($_SESSION['first_name'])&& isset($_SESSION['last_name'])){
    $tableconstruct = "";
    if($_GET['btn'] == "Support"){
        $type = "Support";
        $supportsql = "SELECT * FROM contacts WHERE type = :type";
        $supportstmt = $conn->prepare($supportsql);
        $supportstmt->execute(array(
            ':type' => $type
        ));
        $supportcontacts = $supportstmt->fetchAll(PDO::FETCH_ASSOC);
        $tableconstruct= "
            <section class=\"contactlistheadparent\">
                <h2 class=\"contactlisthead\"> Dashboard </h2>
                <button id=\"createcontactbtn\"> Add Contact </button>
            </section>
            <section id=\"filter\"> 
                <span>Filter by: </span>
                <button id=\"all\"> All </button>
                <button id=\"SalesLeads\"> Sales Leads </button>
                <button id=\"Support\"> Support </button>
                <button id=\"assigned\"> Assigned to me </button>
            </section>
            <table id='contacttable'>
                <thead>
                    <th>Name</th> 
                    <th>Email</th>
                    <th>Company</th> 
                    <th>Type</th>  
                </thead>";
    
                foreach($supportcontacts as $supportcontact){
                    $namesql = "SELECT * FROM users WHERE id = :id";
                    $namestmt = $conn -> prepare($namesql);
                    $namestmt->execute(array(
                        ':id' => $supportcontact['assigned_to']
                    ));
                    $user = $namestmt->fetch(PDO::FETCH_ASSOC);

                    $typeid="";
                    if($supportcontact['type'] == "Support"){
                        $typeid = "Support";
                    }
                    else if($supportcontact['type'] == "Sales Lead"){
                        $typeid = "SalesLead";
                    }
                    $capitaltype = strtoupper($supportcontact['type']);
                    $tableconstruct .= 
                    "<tr class=\"temprow\"> 
                     <td><b><span class=\"fullname\">{$supportcontact['title']} {$supportcontact['firstname']} {$supportcontact['lastname']}</span></b></td>
                     <td>{$supportcontact['email']} </td>
                     <td>{$supportcontact['company']} </td>
                     <td id={$typeid}><span>{$capitaltype}</span><a href=\"{$supportcontact['id']}\"> View </a></td>
                    </tr>";  
                 }
    
                 $tableconstruct.=  "</table>";

    }
    else if($_GET['btn'] == "SalesLeads"){
        $type = "Sales Leads";
        $salesleadssql = "SELECT * FROM contacts WHERE type = :type";
        $salesleadsstmt = $conn->prepare($salesleadssql);
        $salesleadsstmt->execute(array(
            ':type' => $type
        ));
        $salesleadscontacts = $salesleadsstmt->fetchAll(PDO::FETCH_ASSOC);
        $tableconstruct= "
           <section id=\"contactlistheaduniverse\">
            <section class=\"contactlistheadparent\">
                <h2 class=\"contactlisthead\"> Dashboard </h2>
                <button id=\"createcontactbtn\"> Add Contact </button>
            </section>
            <section id=\"filter\"> 
                <span>Filter by: </span>
                <button id=\"all\"> All </button>
                <button id=\"SalesLeads\"> Sales Leads </button>
                <button id=\"Support\"> Support </button>
                <button id=\"assigned\"> Assigned to me </button>
            </section></section>
            <table id='contacttable'>
                <thead>
                    <th>Name</th> 
                    <th>Email</th>
                    <th>Company</th> 
                    <th>Type</th>  
                </thead>";
    
                foreach($salesleadscontacts as $salesleadscontact){
                    $namesql = "SELECT * FROM users WHERE id = :id";
                    $namestmt = $conn -> prepare($namesql);
                    $namestmt->execute(array(
                        ':id' => $salesleadscontact['assigned_to']
                    ));
                    $user = $namestmt->fetch(PDO::FETCH_ASSOC);

                    $typeid="";
                    if($salesleadscontact['type'] == "Support"){
                        $typeid = "Support";
                    }
                    else if($salesleadscontact['type'] == "Sales Lead"){
                        $typeid = "SalesLead";
                    }
                    $capitaltype = strtoupper($salesleadscontact['type']);
                    $tableconstruct .= 
                    "<tr class=\"temprow\"> 
                     <td><span class=\"fullname\">{$salesleadscontact['title']} {$salesleadscontact['firstname']} {$salesleadscontact['lastname']}</span></td>
                     <td>{$salesleadscontact['email']} </td>
                     <td>{$salesleadscontact['company']} </td>
                     <td id={$typeid}><span>{$capitaltype}</span><a href=\"{$salesleadscontact['id']}\"> View </a></td>
                    </tr>";  
                 }
    
                 $tableconstruct.=  "</table>";

    }
    else if($_GET['btn'] == "assigned"){
        $myid = $_SESSION['uid'];
        $myctssql = "SELECT * FROM contacts WHERE assigned_to = :myid";
        $myctsstmt = $conn->prepare($mytkssql);
        $myctsstmt->execute(array(
            ':myid' => $myid
        ));
        $mycontacts = $myctsstmt->fetchAll(PDO::FETCH_ASSOC);
        $tableconstruct= "
           <section id=\"contactlistheaduniverse\">
            <section class=\"contactlistheadparent\">
                <h2 class=\"contactlisthead\"> Dashboard </h2>
                <button id=\"createcontactbtn\"> Add Contact </button>
            </section>
            <section id=\"filter\"> 
                <span>Filter by: </span>
                <button id=\"all\"> All </button>
                <button id=\"SalesLeads\"> Sales Leads </button>
                <button id=\"Support\"> Support </button>
                <button id=\"assigned\"> Assigned to me </button>
            </section></section>
            <table id='contacttable'>
                <thead>
                    <th>Name</th> 
                    <th>Email</th>
                    <th>Company</th> 
                    <th>Type</th>  
                </thead>";
    
                foreach($mycontacts as $mycontact){
                    $namesql = "SELECT * FROM users WHERE id = :id";
                    $namestmt = $conn -> prepare($namesql);
                    $namestmt->execute(array(
                        ':id' => $mycontact['assigned_to']
                    ));
                    $user = $namestmt->fetch(PDO::FETCH_ASSOC);
                    $typeid="";
                    if($mycontact['type'] == "Support"){
                        $typeid = "Support";
                    }
                    else if($mycontact['type'] == "Sales Lead"){
                        $typeid = "SalesLead";
                    }
                    $capitaltype = strtoupper($mycontact['type']);
                    $tableconstruct .= 
                    "<tr class=\"temprow\">
                     <td><span class=\"fullname\">{$mycontact['title']} {$mycontact['firstname']} {$mycontact['lastname']}</span></td>
                     <td>{$mycontact['email']} </td>
                     <td>{$mycontact['company']} </td>
                     <td id={$typeid}><span>{$capitaltype}</span><a href=\"{$mycontact['id']}\"> View </a></td>
                    </tr>";  
                 }
    
                 $tableconstruct.=  "</table>";
        
    }
    else if ($_GET['btn'] == "all"){
        $sql = "SELECT * FROM contacts";
        $stmt = $conn->query($sql);
        $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $tableconstruct= "
            <section class=\"contactlistheadparent\">
                <h2 class=\"contactlisthead\"> Dashboard </h2>
                <button id=\"createcontactbtn\"> Add Contact </button>
            </section>
            <section class=\"contactlistfootparent\">
            <section id=\"filter\"> 
                <span>Filter by: </span>
                <button id=\"all\"> All </button>
                <button id=\"SalesLeads\"> Sales Leads </button>
                <button id=\"Support\"> Support </button>
                <button id=\"assigned\"> Assigned to me </button>
            </section>
            <table id='contacttable'>
                <thead>
                    <th>Name</th> 
                    <th>Email</th>
                    <th>Company</th> 
                    <th>Type</th>  
                </thead>";
    
                foreach($contacts as $contact){
                    $namesql = "SELECT * FROM users WHERE id = :id";
                    $namestmt = $conn -> prepare($namesql);
                    $namestmt->execute(array(
                        ':id' => $contact['assigned_to']
                    ));
                    $user = $namestmt->fetch(PDO::FETCH_ASSOC);
                    $typeid="";
                    if($contact['type'] == "Support"){
                        $typeid = "Support";
                    }
                    else if($contact['type'] == "Sales Lead"){
                        $typeid = "SalesLead";
                    }
                    $capitaltype = strtoupper($contact['type']);
                    $tableconstruct .= 
                    "<tr class=\"temprow\"> 
                    <td><span class=\"fullname\">{$contact['title']} {$contact['firstname']} {$contact['lastname']}</span></td>
                    <td>{$contact['email']} </td>
                    <td>{$contact['company']} </td>
                    <td id={$typeid}><span>{$capitaltype}</span><a href=\"{$contact['id']}\"> View </a></td>
                    </tr>";  
                 }
    
                 $tableconstruct.=  "</table></section>";
                

    }

    echo $tableconstruct;
}
