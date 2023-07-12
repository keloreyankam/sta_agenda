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

// Récupérer les événements depuis la base de données
$sql = "SELECT * FROM evenement";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$evenements = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
                            <p class="mb-0">Your business dashboard template</p>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">App</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Calerdar</a></li>
                        </ol>
                    </div>
                    <div class="col-sm-6 p-md-0">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modelId">
                          Creer un evenement
                        </button>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Ajouter un evenement</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                       <!-- Afficher le formulaire pour ajouter un événement -->
                                        <form method="post" action="function.php">
                                            <label for="titre">Titre :</label>
                                            <input class="form-control" type="text" name="titre" id="titre" required>
                                            <br>
                                            <label for="date_debut">Date de début :</label>
                                            <input class="form-control" type="datetime-local" name="date_debut" id="date_debut" required>
                                            <br>
                                            <label for="date_fin">Date de fin :</label>
                                            <input class="form-control" type="datetime-local" name="date_fin" id="date_fin" required>
                                            <br>
                                            
                                            <label for="description">Description :</label>
                                            <textarea class="form-control" type="datetime-local" name="description" id="description" required></textarea>
                                            <br>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button class="btn btn-primary" type="submit" name="ajouter" value="Ajouter">enregistrer</button>
                                    </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- row -->


                <div class="row">
                    <?php
                        // Formater les événements pour FullCalendar
                        $evenements_format = array();
                        foreach ($evenements as $evenement) {
                            $evenement_format = array(
                                'id' => $evenement['id_eve'],
                                'title' => $evenement['Nom'],
                                'start' => $evenement['Date_de_debut'],
                                'end' => $evenement['Date_de_fin'],
                                'description' => $evenement['Description'],
                            );
                            array_push($evenements_format, $evenement_format);
                        }

                    ?>
                        <div id='calendrier'></div>

                      
                    <!-- <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-intro-title">Calendar</h4>

                                <div class="">
                                    <div id="external-events" class="my-3">
                                        <p>Drag and drop your event or click in the calendar</p>
                                        <div class="external-event" data-class="bg-primary"><i class="fa fa-move"></i>New Theme Release</div>
                                        <div class="external-event" data-class="bg-success"><i class="fa fa-move"></i>My Event
                                        </div>
                                        <div class="external-event" data-class="bg-warning"><i class="fa fa-move"></i>Meet manager</div>
                                        <div class="external-event" data-class="bg-dark"><i class="fa fa-move"></i>Create New theme</div>
                                    </div>
                                    <div class="checkbox checkbox-event pt-3 pb-5">
                                        <input id="drop-remove" class="styled-checkbox" type="checkbox">
                                        <label class="ml-2 mb-0" for="drop-remove">Remove After Drop</label>
                                    </div>
                                    <a href="javascript:void()" data-toggle="modal" data-target="#add-category" class="btn btn-primary btn-event w-100">
                                        <span class="align-middle"><i class="ti-plus"></i></span> Create New
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="col-lg-9">
                        <div class="card">
                            <div class="card-body">
                                <div id="calendar" class="app-fullcalendar"></div>
                            </div>
                        </div>
                    </div> -->
                    <!-- BEGIN MODAL -->
                    <!-- <div class="modal fade none-border" id="event-modal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"><strong>Add New Event</strong></h4>
                                </div>
                                <div class="modal-body"></div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-success save-event waves-effect waves-light">Create
                                        event</button>

                                    <button type="button" class="btn btn-danger delete-event waves-effect waves-light" data-dismiss="modal">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- Modal Add Category -->
                    <!-- <div class="modal fade none-border" id="add-category">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"><strong>Add a category</strong></h4>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="control-label">Category Name</label>
                                                <input class="form-control form-white" placeholder="Enter name" type="text" name="category-name">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="control-label">Choose Category Color</label>
                                                <select class="form-control form-white" data-placeholder="Choose a color..." name="category-color">
                                                    <option value="success">Success</option>
                                                    <option value="danger">Danger</option>
                                                    <option value="info">Info</option>
                                                    <option value="pink">Pink</option>
                                                    <option value="primary">Primary</option>
                                                    <option value="warning">Warning</option>
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-danger waves-effect waves-light save-category" data-dismiss="modal">Save</button>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>

            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


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
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>
  <script>
$(document).ready(function() {
    $('#calendrier').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,basicWeek,basicDay'
        },
        defaultDate: '<?php echo date('Y-m-d'); ?>',
        editable: true,
        eventLimit: true,
        events: <?php echo json_encode($evenements_format); ?>
    });
});
</script>
</body>

</html>