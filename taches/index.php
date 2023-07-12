<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>STA</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon.png">
<!-- Inclure la bibliothèque FullCalendar -->
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.print.min.css' media='print' />


    <link href="../css/style.css" rel="stylesheet">

</head>

<?php
include('../inc/db.php');
include('function.php');

// Récupérer les événements depuis la base de données

?>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
    <?php include('../components/header2.php');?>

<!--**********************************
    Sidebar start
***********************************-->
<?php include('../components/sidebar2.php');?>

<!--**********************************
    Sidebar end
***********************************-->
<div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Hi, welcome back!</h4>
                            <span class="ml-1">Element</span>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Form</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Element</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-xl-6 col-xxl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Ajouter une Equipe</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                <form action="ajouter_tache.php" method="post">
   <div class="form-group">
      <label for="nom">Nom de la tâche:</label>
      <input type="text" class="form-control" id="nom" name="nom" required>
   </div>

   <div class="form-group">
      <label for="description">Description:</label>
      <textarea class="form-control" id="description" name="description"></textarea>
   </div>

   <div class="form-group">
      <label for="date_echeance">Date d'échéance:</label>
      <input type="date" class="form-control" id="date_echeance" name="date_echeance" required>
   </div>

   <div class="form-group">
      <label for="id_utilisateur">Assignée à:</label>
      <select class="form-control" id="id_utilisateur" name="id_utilisateur">
         <option value="">--Choisir un utilisateur--</option>
         <option value="1">Utilisateur 1</option>
         <option value="2">Utilisateur 2</option>
         <option value="3">Utilisateur 3</option>
      </select>
   </div>

   <div class="form-group">
      <label for="id_equipe">Assignée à l'équipe:</label>
      <select class="form-control" id="id_equipe" name="id_equipe">
         <option value="">--Choisir une équipe--</option>
         <option value="1">Équipe 1</option>
         <option value="2">Équipe 2</option>
         <option value="3">Équipe 3</option>
      </select>
   </div>

   <div class="form-group">
      <label for="id_agenda">Assignée à l'agenda:</label>
      <select class="form-control" id="id_agenda" name="id_agenda">
         <option value="">--Choisir un agenda--</option>
         <option value="1">Agenda 1</option>
         <option value="2">Agenda 2</option>
         <option value="3">Agenda 3</option>
      </select>
   </div>

   <button type="submit" class="btn btn-primary" name="add_task">Ajouter</button>
</form>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Table Stripped</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped verticle-middle table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">NOM</th>
                                                <th scope="col">DESCRIPTION</th>
                                                <th scope="col">ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($result as $equipe):?>
                                                <tr>
                                                    <td><?php echo $equipe['ID_equipe'];?></td>
                                                    <td><?php echo $equipe['Nom'];?></td>
                                                    <td><?php echo $equipe['Description'];?></td>
                                                    <td>
                                                        <span>
                                                            <form action="" method="POST">
                                                                <input type="hidden" value="<?php echo $equipe['ID_equipe']?>" name="id">
                                                                <button type="button" class="btn btn-primary btn-lg border-0 bg-transparent text-primary" data-toggle="modal" data-target="#model<?php echo $equipe['ID_equipe']?>">
                                                                    <i class="fa fa-pencil color-muted"></i> 
                                                                </button>
                                                                <button type="submit" class="border-0 bg-transparent text-danger" name="supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette équipe ?')">
                                                                    <i class="fa fa-close color-danger"></i>
                                                                </button>
                                                            </form>
                                                        </span>
                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="model<?php echo $equipe['ID_equipe']?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Modification de l'équipe</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                            </div>
                                                                <form action='' method='POST'>
                                                                    <div class="modal-body">
                                                                        <input type='hidden' name='id' value="<?php echo $equipe["ID_equipe"]?>">
                                                                        <label for='nom'>Nom :</label>
                                                                        <input type='text' id='nom' class="form-control" name='nom' value="<?php echo $equipe["Nom"]?>" required><br><br>
                                                                        <label for='description'>Description :</label>
                                                                        <textarea id='description' class="form-control" name='description' rows='4' cols='50'><?php echo $equipe["Description"]?></textarea><br><br>
                                                                        
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button class="btn btn-primary" type='submit' name='modifier'>Save</button>
                                                                        </form>
                                                                    </div>
                                                                </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
<!-- Button trigger modal -->


<!-- Modal -->


        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="#" target="_blank">Quixkit</a> 2019</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

        


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="../vendor/global/global.min.js"></script>
    <script src="../js/quixnav-init.js"></script>
    <script src="../js/custom.min.js"></script>
    <!--removeIf(production)-->
    <!-- Demo scripts -->
    <script src="../js/styleSwitcher.js"></script>



    <script src="../vendor/jqueryui/js/jquery-ui.min.js"></script>
    <script src="../vendor/moment/moment.min.js"></script>

    <script src="../vendor/fullcalendar/js/fullcalendar.min.js"></script>
    <script src="../js/plugins-init/fullcalendar-init.js"></script>
    <!-- Afficher le calendrier avec les événements -->
</body>

</html>



