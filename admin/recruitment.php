<?php $title = 'Recruitment'; ?>
<?php include('header.php'); ?>
            <link rel="stylesheet" href="js/lib/datatables/css/datatables_beoro.css">
            <link rel="stylesheet" href="js/lib/datatables/extras/TableTools/media/css/TableTools.css">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="w-box w-box-orange">
                            <div class="w-box-header">
                                <h4>Column Reorder & toggle visibility</h4>
                            </div>
                            <div class="w-box-content">
                                <table class="table table-striped table-condensed dt_colVis_Reorder">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Short name</th>
                                        <th>Long Name</th>
                                        <th>Calling Code</th>
                                        <th>ISO 2</th>
                                        <th>ISO 3</th>
                                        <th>ISO #</th>
                                        <th>ccTLD</th>
                                        <th>UN Member</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td>1</td><td>Afghanistan</td><td>Islamic Republic of Afghanistan</td><td>93</td><td>AF</td><td>AFG</td><td>004</td><td>.af</td><td>yes</td></tr>
                                    <tr><td>2</td><td>Aland Islands</td><td>Åland Islands</td><td>358</td><td>AX</td><td>ALA</td><td>248</td><td>.ax</td><td>no</td></tr>
                                    <tr><td>3</td><td>Albania</td><td>Republic of Albania</td><td>355</td><td>AL</td><td>ALB</td><td>008</td><td>.al</td><td>yes</td></tr>
                                    <tr><td>4</td><td>Algeria</td><td>People's Democratic Republic of Algeria</td><td>213</td><td>DZ</td><td>DZA</td><td>012</td><td>.dz</td><td>yes</td></tr>
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