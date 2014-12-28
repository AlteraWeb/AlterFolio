<!-- BEGIN: MAIN -->
<div class="top-title-area">
    <div class="container">
        <div class="col-md-5">
            <a href="{PRD_OWNER_DETAILSLINK}" class="top_avatar pull-left">
                {PRD_OWNER_AVATAR}
            </a>
            <div class="thumb-list-item-caption">
                <p>
                    <b>
                    <!-- IF {PRD_OWNER_FNAME} && {PRD_OWNER_LNAME} -->
                    <a href="{PRD_OWNER_DETAILSLINK}">{PRD_OWNER_FNAME} {PRD_OWNER_LNAME} [{PRD_OWNER_NICKNAME}]</a>
                    <!-- ELSE -->
                    <a href="{PRD_OWNER_DETAILSLINK}">{PRD_OWNER_NICKNAME}</a>
                    <!-- ENDIF -->
                    <!-- IF {PRD_OWNER_ISPRO} -->
                        <span class="label label-important">PRO</span> 
                    <!-- ENDIF -->
                        <span class="vrf_icon">{PRD_OWNER_VRF_ICON}</span>
                    </b>
                </p>
                <p>
                   <small>На сайте {PRD_OWNER_REGDATE|calc_day($this)}</small>
                </p>
                <p>
                <!-- IF {PRD_OWNER_STATUS} -->
                <div class="user_status">
                    {PRD_OWNER_STATUS}
                </div>
                <!-- ENDIF -->
                </p>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="col-md-4 user_info_data">
            <!-- IF {PRD_OWNER_WEBSITE} -->
                <div><i class="fa fa-globe"></i> <a href="{PRD_OWNER_WEBSITE}" target="_blank">{PRD_OWNER_WEBSITE}</a></div>
            <!-- ENDIF -->
            <!-- IF {PRD_OWNER_SKYPE} -->
                <div><i class="fa fa-skype"></i> {PRD_OWNER_SKYPE}</div>
            <!-- ENDIF -->
            <!-- IF {PRD_OWNER_EMAIL} != Скрыто -->
                <div><i class="fa fa-envelope"></i> <a href="{PRD_OWNER_WEBSITE}">{PRD_OWNER_EMAIL}</a></div>
            <!-- ENDIF -->
            <!-- IF {PRD_OWNER_PHONE} -->
                <div><i class="fa fa-phone"></i> {PRD_OWNER_PHONE}</div>
            <!-- ENDIF -->
            <!-- IF {PRD_OWNER_REGION} -->
                <div><i class="fa fa-map-marker"></i> {PRD_OWNER_REGION}, {PRD_OWNER_CITY}</div>
            <!-- ENDIF -->
            <div><i class="fa fa-comment"></i> <a href="pm?m=send&to={PRD_OWNER_ID}">Оставить сообщение</a></div>
            
        </div>
        <div class="col-md-3 user_info_data">
            <div>
                <i class="fa fa-bar-chart-o"></i> Рейтинг <span class="pull-right">{PRD_OWNER_USERPOINTS}</span>
            </div>
            <!-- IF {PRD_USER_IS_ADMIN} -->
            <div style="margin-top: 20px;">
                {PRD_ADMIN_EDIT} &nbsp; 
                <!-- IF {PRD_STATE} != 2 -->
                <a href="{PRD_HIDEPRODUCT_URL}">{PRD_HIDEPRODUCT_TITLE}</a>
                <!-- ENDIF -->
            </div>
            <!-- ENDIF -->
        </div>
    </div>
</div>
<div class="gap"></div>
<div class="container">
    <div class="row">
        <div class="pull-right">
            <!-- IF {PRD_PREV} -->
            <a href="{PRD_PREV}" class="btn btn-primary">Предыдущая работа</a>
            <!-- ELSE -->
            <span class="btn label-default">Предыдущая работа</span>
            <!-- ENDIF -->
            <!-- IF {PRD_NEXT} -->
            <a href="{PRD_NEXT}" class="btn btn-primary">Следующая работа</a>
            <!-- ELSE -->
            <span class="btn label-default">Следующая работа</span>
            <!-- ENDIF -->
        </div>
        <h1>{PRD_SHORTTITLE}</h1>
        <!-- IF {PRD_TEXT} -->
        <div class="prj_text">
            {PRD_TEXT}
        </div>
        <!-- ENDIF -->
        <div class="prj_info">
            <span class="date"><i class="fa fa-calendar"></i> {PRD_DATE}</span>
            <!-- IF {PRD_COST} -->
            <span class="price"><i class="fa fa-money"></i> {PRD_COST} {PHP.cfg.payments.valuta}</span>
            <!-- ENDIF -->
        </div>
        <!-- IF {PRD_STATE} == 2 -->
        <div class="alert alert-warning">{PHP.L.folio_forreview}</div>
        <!-- ENDIF -->
        <!-- IF {PRD_STATE} == 1 -->
        <div class="alert alert-warning">{PHP.L.folio_hidden}</div>
        <!-- ENDIF -->
        <div id="my-carousel" class="carousel slide">
            <div class="carousel-inner">
                <!-- IF {PRD_MAVATARCOUNT} -->
                    <!-- FOR {KEY}, {VALUE} IN {PRD_MAVATAR} -->
                    <div class="item <!-- IF {KEY} == 1 --> active<!-- ENDIF -->">
                        <img src="{VALUE.FILE}" alt="" title="">
                    </div>
                     <!-- ENDFOR -->
                <!-- ENDIF -->
            </div>
            <a class="carousel-control left" href="#my-carousel" data-slide="prev"></a>
            <a class="carousel-control right" href="#my-carousel" data-slide="next"></a>
        </div>  
    </div>
</div>
<!-- END: MAIN -->