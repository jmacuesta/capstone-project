<html>
    <head>
<!--        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/t/bs-3.3.6/jqc-1.12.0,dt-1.10.11/datatables.min.css"/>-->
        <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/bootstrap.css">
        <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
        <script src="<?=base_url();?>assets/js/jqv1.js"></script>
<!--        <script type="text/javascript" src="https://cdn.datatables.net/t/bs-3.3.6/jqc-1.12.0,dt-1.10.11/datatables.min.js"></script>-->
        <script src="<?=base_url();?>assets/js/jquery.dataTables.min.js"></script>
        <script src="<?=base_url();?>assets/js/dataTables.bootstrap.min.js"></script>
        
    </head>
    <body>
        <table id="example" class="display table" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Age</th>
                    <th>Start date</th>
                    <th>Salary</th>
                </tr>
                
            </thead>
            <tbody>
                <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011/04/25</td>
                <td>$320,800</td>
            </tr>
            <tr>
                <td>Garrett Winters</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>63</td>
                <td>2011/07/25</td>
                <td>$170,750</td>
            </tr>
            </tbody>
        </table>
            <script>
            $(document).ready(function() {
                $('#example').DataTable();
            } );
        </script>
    </body>
</html>