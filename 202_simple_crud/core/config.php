<?php

include_once "sql.php";

const DB_SERVER_NAME = "localhost";
const DB_USER_NAME = "root";
const DB_DATABASE_NAME = "202_crud_category";
const DB_PASSWORD = "";

// Automatically Create Our Database If Not Exist
createDB(DB_SERVER_NAME, DB_USER_NAME, DB_PASSWORD, DB_DATABASE_NAME);