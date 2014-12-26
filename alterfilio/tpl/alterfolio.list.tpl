<!-- BEGIN: MAIN -->
<h4><!-- IF {PHP.usr.id} == {PHP.urr.user_id} AND {RPD_ADDPRD_SHOWBUTTON} --><div class="pull-right"><a href="{PRD_ADDPRD_URL}" class="btn btn-success">{PHP.L.folio_add_work}</a></div><!-- ENDIF -->{PHP.L.folio}</h4>

<div class="row">
<!-- BEGIN: PRD_ROWS -->

   <div class="col-md-3">
        <h5><a href="{PRD_ROW_URL_ABC}">{PRD_ROW_SHORTTITLE}</a></h5>
        <!-- IF {PRD_ROW_USER_IS_ADMIN} --><span class="label label-info">{PRD_ROW_LOCALSTATUS}</span><!-- ENDIF -->
        <!-- IF {PRD_ROW_MAVATAR.1} -->
        <a href="{PRD_ROW_URL}"><img src="{PRD_ROW_MAVATAR.1|cot_mav_thumb($this, 200, 200, crop)}" /></a>
        <!-- ENDIF -->
        <!-- IF {PRD_ROW_COST} > 0 --><div class="cost">{PRD_ROW_COST} {PHP.cfg.payments.valuta}</div><!-- ENDIF -->
    </div>

<!-- END: PRD_ROWS -->


</div>


<!-- END: MAIN -->
