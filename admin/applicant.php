<?php $title = 'Applicant'; ?>
<?php include('header.php'); ?>
            <link rel="stylesheet" href="js/lib/datatables/css/datatables_beoro.css">
            <link rel="stylesheet" href="js/lib/datatables/extras/TableTools/media/css/TableTools.css">
            <h3>Applicant</h3>
                <div class="row-fluid">
                    <div class="span12">
                        <div class="w-box w-box-orange">
                            <div class="w-box-header">
                            </div>
                            <div class="w-box-content">
                                <table class="table table-striped table-condensed dt_colVis_Reorder">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Date Of Birth</th>
                                        <th>Place Of Birth</th>
                                        <th>Address</th>
                                        <th>Phone Number</th>
                                        <th>UserName</th>
                                        <th>Is Active</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                               <?php
                                   include_once('../classes/Helper.php');
                                   include_once('../classes/Applicant.php');
                                   include_once('../classes/Connection.php');
                                   $Conn = Connection::get_DefaultConnection();
                                   $Applicants = Applicant::LoadCollection($Conn);
                                   foreach($Applicants as $Applicant){
                               ?>
                                    <tr>
                                    <td><?php echo $Applicant->get_Id(); ?></td>
                                    <td><?php echo $Applicant->Name; ?></td>
                                    <td><?php echo date('Y-m-d',$Applicant->DateOfBirth); ?></td>
                                    <td><?php echo $Applicant->PlaceOfBirth; ?></td>
                                    <td><?php echo $Applicant->Address; ?></td>
                                    <td><?php echo $Applicant->PhoneNumber; ?></td>
                                    <td><?php echo $Applicant->UserName; ?></td>
                                    <td><?php echo Helper::getBooleanTextValue($Applicant->IsActive); ?></td>
                                    <td><a href="editapplicant.php?Id=<?php echo $Applicant->get_Id(); ?>">Edit</a> <a href="processdeleteapplicant.php?Id=<?php echo $Applicant->get_Id(); ?>">Delete</a></td>
                                    </tr>
                                    <?php
                                    }
                                ?>
                                </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
<?php include('footer.php'); ?>
            <script src="js/lib/datatables/js/jquery.dataTables.min.js"></script>
            <script src="js/lib/datatables/extras/ColReorder/media/js/ColReorder.min.js"></script>
            <script src="js/lib/datatables/extras/ColVis/media/js/ColVis.min.js"></script>
            <script src="js/lib/datatables/extras/TableTools/media/js/TableTools.min.js"></script>
            <script src="js/lib/datatables/extras/TableTools/media/js/ZeroClipboard.js"></script>
            <script src="js/lib/datatables/js/jquery.dataTables.bootstrap.min.js"></script>
            <script src="js/beoro_datatables.js"></script>