<style>
    .help{border-left:1px solid #EAEAEA;padding: 0px 0px 0px 5px; transition: background ease-in-out .7s;}
    .help-head{color:#A82400;} 
    .form-group:hover .help{ background: #e3e3e3;}
</style> 

  <div class="col-md-4">
    <div class="panel panel-default">
     <div class="panel-heading">
        <div class="widget-head"> 
       <!--  <a class="btn btn-sm btn-danger pull-right col-md-2 Modal" >Create New Page</a> -->
         <a class="btn btn-sm btn-danger pull-right col-md-2" href="<?php echo site_url("dashboard/website/createPageLink"); ?>"><i class="glyphicon glyphicon-plus"></i></a>
        <small style="margin-left: 10px;">All Family</small> 
    </div> 

    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-12">
              <?php
            if (!empty($all_family)) {
                ?>
                <table id="datatable-fixed-header" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Family Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                     <?php
                        $i = 1;
                        foreach ($all_family as $all_familys) {
                            ?>
                            <tr> 
                                <td><?php echo $i; ?></td>
                                <td><?php echo $all_familys->FAMILY_NAME; ?></td>
                             
                                <td>

                                <a class="label btn-danger btn-xs deleteUrl" href="#">
                                <i class="glyphicon glyphicon-remove"></i>
                            </a>  
                                </td>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>
                      


                    </tbody>
                </table>
                <?php
            } else {
                echo "<p class='text-danh text-danger'><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No Data Found</p>";
            }
            ?>
            </div>
        </div>
    </div>
</div>
</div>
  <div class="col-md-4">
    <div class="panel panel-default">
     <div class="panel-heading">
        <div class="widget-head"> 
       <!--  <a class="btn btn-sm btn-danger pull-right col-md-2 Modal" >Create New Page</a> -->
         <a class="btn btn-sm btn-danger pull-right col-md-2" href="<?php echo site_url("dashboard/website/createPageLink"); ?>"><i class="glyphicon glyphicon-plus"></i></a>
        <small style="margin-left: 10px;">All Genus</small> 
    </div> 

    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-12">
              <?php
            if (!empty($all_genus)) {
                ?>
                <table id="datatable-fixed-header" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Genus Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                     <?php
                        $i = 1;
                        foreach ($all_genus as $all_genuss) {
                            ?>
                            <tr> 
                                <td><?php echo $i; ?></td>
                                <td><?php echo $all_genuss->GENUS_NAME; ?></td>
                             
                                <td>

                                <a class="label btn-danger btn-xs deleteUrl" href="#">
                                <i class="glyphicon glyphicon-remove"></i>
                            </a>  
                                </td>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>
                      


                    </tbody>
                </table>
                <?php
            } else {
                echo "<p class='text-danh text-danger'><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No Data Found</p>";
            }
            ?>
            </div>
        </div>
    </div>
</div>
</div>

  <div class="col-md-4">
    <div class="panel panel-default">
     <div class="panel-heading">
        <div class="widget-head"> 
       <!--  <a class="btn btn-sm btn-danger pull-right col-md-2 Modal" >Create New Page</a> -->
         <a class="btn btn-sm btn-danger pull-right col-md-2" href="<?php echo site_url("dashboard/website/createPageLink"); ?>"><i class="glyphicon glyphicon-plus"></i></a>
        <small style="margin-left: 10px;">All Species</small> 
    </div> 

    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-12">
              <?php
            if (!empty($all_species)) {
                ?>
                <table id="datatable-fixed-header" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Speciess Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                     <?php
                        $i = 1;
                        foreach ($all_species as $all_speciess) {
                            ?>
                            <tr> 
                                <td><?php echo $i; ?></td>
                                <td><?php echo $all_speciess->SPECIES_NAME; ?></td>
                             
                                <td>

                                <a class="label btn-danger btn-xs deleteUrl" href="#">
                                <i class="glyphicon glyphicon-remove"></i>
                            </a>  
                                </td>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>
                      


                    </tbody>
                </table>
                <?php
            } else {
                echo "<p class='text-danh text-danger'><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No Data Found</p>";
            }
            ?>
            </div>
        </div>
    </div>
</div>
</div>

    <script type="text/javascript">
  $(document).on("click", "span.deleteUrl", function (e) {
       var result = confirm("Are you sure want to delete it?");
       if(result == true){
        var url = $(this).attr('href');
         var removeRow = $(this).parent().parent();

                    $.ajax({
                        url: url,
                        type: 'POST',
                       // dataType: 'JSON',
                        success: function (data) {
                        window.location.href = "<?php echo site_url('dashboard/website/pageSetup');?>";
                           
                        }
                    });
       }
e.preventDefault();
});
</script>



