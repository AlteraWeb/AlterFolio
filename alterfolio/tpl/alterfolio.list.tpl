<!-- BEGIN: MAIN -->
<h1 class="mb20">
    <!-- IF {PHP.usr.id} == {PHP.urr.user_id} AND {RPD_ADDPRD_SHOWBUTTON} -->
     <div class="pull-right">
            <a href="{PRD_ADDPRD_URL}" class="btn btn-success">{PHP.L.folio_add_work}</a>
     </div>
    <!-- ENDIF -->
    {PHP.L.folio}
</h1>

<div class="row row-wrap">
    <!-- BEGIN: PRD_ROWS -->
    <a class="col-md-2" href="{PRD_ROW_URL_ABC}">
        <div class="product-thumb">
            <!-- IF {PRD_ROW_MAVATAR.1} -->
            <header class="product-header">
                <img src="{PRD_ROW_MAVATAR.1|cot_mav_thumb($this, 200, 200, crop)}" alt="{PRD_ROW_SHORTTITLE}" title="{PRD_ROW_SHORTTITLE}">
            </header>
            <!-- ENDIF -->
            <div class="folio-inner">
                <p class="folio-title">{PRD_ROW_SHORTTITLE|mb_substr($this, 0, 30, "UTF-8")}</p>
                <p class="product-location"><i class="fa fa-bullhorn"></i> {PRD_ROW_LOCALSTATUS}</p>
            </div>
        </div>
    </a>
    <!-- END: PRD_ROWS -->
    <!-- IF {PAGENAV_COUNT} > 0 -->	
    <div class="pagination"><ul>{PAGENAV_PAGES}</ul></div>
    <!-- ELSE -->
    <div class="alert">{PHP.L.folio_empty}</div>
    <!-- ENDIF -->
</div>
<!-- END: MAIN -->