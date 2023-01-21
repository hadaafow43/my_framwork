<?php

include 'db.php';

$obj = new Database();

// $obj->select('studant','id,name',null,'name="nuur"','name',null);
// echo " sql result is :";
// print_r($obj->getResult());
?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 </head>
 <body>

     
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1>firt crud</h1>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST">
                        <div class="form-row">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">name</label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                                <div class="col-md-6">
                                    <label for="">phone</label>
                                    <input type="text" class="form-control mb-3" name="phone">
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                   <button type="submit" class="btn btn-success" name="save">add</button> 
                             </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </body>
 </html>