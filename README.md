# 1. Team MVST  
**Team name:**  **MVST** – ***M***o***V***ie***S***i***T***e  
**Web Site:**  **FlixGO**
   
# **2. Project description** 

## **Purpose and benefits in the real world:**  
   Our project is to create a website where people can find movies to their liking during their holidays and have a good time. The problem is that nowadays there are a lot of movies being shot and it becomes difficult for us to find something worthy among all this. We offer movies that are in our personal tops.
## **Scope of the project:**  
   Our team can complete this project completely and fulfill all the goals and solve problems.
## **Type of the user-interface:**  
   We have chosen the web user-interface as it is the easiest way to connect this interface with the **Oracle** database server.
## **Programming language and database server:**  
   We will link the selected database server (**Oracle**) using the **PHP** programming language. The choice was **PHP** because in this language it is also easy to connect our Web interface and the database server.  

# **3. Project Use-Case diagram and questions over the data**  
 
## **General questions:**  
  1. What movie did Scarlett Johansson star in ?
  2. How many movies are longer than 130 minutes ?  
  3. Which movie is the longest ? 
  4. What is the oldest movie in your database ?  
  5. How many movies have titles beginning with the letter "A" in your database ? 
  6. How many movies each country has produced ?  
  7. What movies has the woman starred in in your database ?    
  8. How many movies of each genre ?
  9. Which genre is the most in your database ?  
  10. Which country has produced the most movies ?  
  11. Which movie has the longest title ?
  12. How many movies were produced each year ?
  13. What is the full information about all movies (link all tables) ?
  14. How many movies have been produced since 2014 ?
  15. What movies were produced in the USA after 2015 ?   

## **Dataset for the project:**  
  
The idea in our project is that the admins add movies that they like. For this reason, we did not import data, but created our own.
It is impossible to export CSV files from the Oracle server, so we exported a pdf file and json file, it is stored in the **"data"** folder.  

## **Use-case UML diagram:**  

<p align="center">
<img src="images/MVST-UseCase-UML.png" alt="UML" width="700" align="center"/>
</p>

# **4. Data modeling and database design**  

## **E/R Diagram:**
![ERD](images/MVST-ER.png)  

## **DDL queries:**  

DDL queries stored in the **"data/DDL"** folder.  

## **DML queries:**  

DML queries stored in the **"data/DML"** folder.  

# **5. SQL queries**  

SQL queries stored in the **"data/SQL"** folder. 

# **6. UI implementation and DB connection** 

1. We have created a web application that is stored in the **"site"** folder.

2. We connected the **Oracle** database server using the **PHP** programming language.
   The code for connecting the database is stored in the **"site/db.php"** file.
   
   
><?php

$conn = oci_connect('hr', 'hr', 'localhost/orcl');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
session_start();
?>

3. The code for trigger corresponding SQL queries to retrieve the necessary data is stored in the **"site/admin.php"** file.

4. The code for display the retrieved data to the users is stored in the **"site/index.php"** file.

