<?php $title = 'Admin'; ?>
<?php include('header.php'); ?>
            <link rel="stylesheet" href="js/lib/datatables/css/datatables_beoro.css">
            <link rel="stylesheet" href="js/lib/datatables/extras/TableTools/media/css/TableTools.css">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="w-box w-box-orange">
                            <div class="w-box-header">
                                <a href="javascript:void(0)" class="btn btn-inverse btn-mini">New</a>
                            </div>
                            <div class="w-box-content">
                                <table class="table table-striped table-condensed dt_colVis_Reorder">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>UserName</th>
                                        <th>Is Active</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                               <?php
                                   include_once('../classes/Helper.php');
                                   include_once('../classes/Admin.php');
                                   include_once('../classes/Connection.php');
                                   $Conn = Connection::get_DefaultConnection();
                                   $Admins = Admin::LoadCollection($Conn);
                                   foreach($Admins as $Admin){
                               ?>
                                    <tr><td><?php echo $Admin->get_Id(); ?></td><td><?php echo $Admin->UserName; ?></td><td><?php echo Helper::getBooleanTextValue($Admin->IsActive); ?></td></tr>
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