<div class="widget-head">
    <h4 class="heading glyphicons forward"><i></i>Module Report Category Parameters</h4>
</div>
<div class="widget-body">
    <table class="dynamicTable  table table-striped table-bordered" width="100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Short Name</th>
                <th>Serial</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if(!empty($parameters)){
            foreach($parameters as $row){ ?>
            <tr>
                <td><?php echo $row->CATEGORY_NAME; ?></td>
                <td><?php echo $row->SHORT_NAME; ?></td>
                <td><?php echo $row->UD_SL_NO; ?></td>
                <td><span class="editCatParameter" style="cursor:pointer; color: #4a8bc2;" title="Edit" cat_no="<?php echo $row->CATEGORY_ID; ?>"><i class="fa fa-edit"></i></span></td>
            </tr>
            <?php } }else { ?>
            <tr>
                <td colspan="4">No Data found</td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>