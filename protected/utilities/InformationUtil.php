<?php

class InformationUtil
{

    public static function genInformation()
    {
        if (! UserLoginUtils::isLogin()) {
            header("Location: " . ConfigUtil::getSiteName());
            die();
        }
        
        $info = '';
        $criteria = new CDbCriteria();
        $criteria->condition = "'" . date("Y-m-d") . "' between period_start and period_end and status='A'";
        
        $infos = Information::model()->findAll($criteria);
        if (isset($infos)) {
            $info = $info . "<ul class=\"media-list\">";
            $idx1 = 1;
            foreach ($infos as $item) {
                
                $info = $info . "	<li class=\"media\"><a class=\"pull-left\" href=\"javascript:;\"> ";
                $info = $info . "		<img class=\"media-object\" src=\"" . ConfigUtil::getAppName() . '' . $item->image_path . "\" style=\"width: 64px; height: 64px;\"></a>";
                $info = $info . "		<div class=\"media-body\">";
                $info = $info . "			<h4 class=\"media-heading\">" . $item->short_description . "</h4>";
                $info = $info . "			<p>" . $item->description . "</p>";
                $info = $info . "			<h6><a  href=\"#form_modal_" . $idx1 . "\" data-toggle=\"modal\"> อ่านต่อ...<i class=\"fa fa-share\"></i></a></h6>";
                
                $info = $info . "		</div>";
                $info = $info . "	</li>";
                $idx1 ++;
            }
            $info = $info . "</ul>";
            $idx2 = 1;
            foreach ($infos as $item) {
                
                $info = $info . "<div id=\"form_modal_" . $idx2 . "\" class=\"modal fade\" role=\"dialog\" aria-labelledby=\"myModalLabel10\" aria-hidden=\"true\">";
                $info = $info . "		<div class=\"modal-dialog\">";
                $info = $info . "			<div class=\"modal-content\">";
                $info = $info . "			<div class=\"modal-header\">";
                $info = $info . "					<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\"></button>";
                $info = $info . "					<h4 class=\"modal-title\">" . $item->short_description . "</h4>";
                $info = $info . "			</div>";
                $info = $info . "			<div class=\"modal-body\">";
                $info = $info . "" . $item->description;
                $info = $info . "				</div>";
                $info = $info . "			<div class=\"modal-footer\">";
                $info = $info . "					<button class=\"btn grey-salsa btn-outline\" data-dismiss=\"modal\" aria-hidden=\"true\">Close</button>";
                $info = $info . "				</div>";
                $info = $info . "			</div>";
                $info = $info . "		</div>";
                $info = $info . "	</div>";
                $idx2 ++;
            }
        }
        
        return $info;
    }

    public static function genInformation_2()
    {
        if (! UserLoginUtils::isLogin()) {
            header("Location: " . ConfigUtil::getSiteName());
            die();
        }
        
        $info = '';
        $criteria = new CDbCriteria();
        $criteria->condition = "'" . date("Y-m-d") . "' between period_start and period_end and status='A'";
        
        $infos = Information::model()->findAll($criteria);
        if (isset($infos)) {
            $info = $info . "<ul class=\"chats\">";
            $idx1 = 1;
            foreach ($infos as $item) {
                
                $info = $info . "	<li class=\"in\">";
                $info = $info . "		<img class=\"avatar\" src=\"" . ConfigUtil::getAppName() . '' . $item->image_path . "\" style=\"width: 64px; height: 64px;\">";
                $info = $info . "		<div class=\"message\">";
                $info = $info . "			<span class=\"arrow\"> </span> <a href=\"javascript:;\" class=\"name\">" . $item->short_description . " </a> <span class=\"datetime\"></span> ";
                $info = $info . "			<span class=\"body\">" . $item->description . "<a  href=\"#form_modal_" . $idx1 . "\" data-toggle=\"modal\"> อ่านต่อ...<i class=\"fa fa-share\"></i></a></span>  ";
                $info = $info . "		</div>";
                $info = $info . "	</li>";
                $idx1 ++;
            }
            $info = $info . "</ul>";
            $idx2 = 1;
            foreach ($infos as $item) {
                
                $info = $info . "<div id=\"form_modal_" . $idx2 . "\" class=\"modal fade\" role=\"dialog\" aria-labelledby=\"myModalLabel10\" aria-hidden=\"true\">";
                $info = $info . "		<div class=\"modal-dialog\">";
                $info = $info . "			<div class=\"modal-content\">";
                $info = $info . "			<div class=\"modal-header\">";
                $info = $info . "					<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\"></button>";
                $info = $info . "					<h4 class=\"modal-title\">" . $item->short_description . "</h4>";
                $info = $info . "			</div>";
                $info = $info . "			<div class=\"modal-body\">";
                $info = $info . "" . $item->description;
                $info = $info . "				</div>";
                $info = $info . "			<div class=\"modal-footer\">";
                $info = $info . "					<button class=\"btn grey-salsa btn-outline\" data-dismiss=\"modal\" aria-hidden=\"true\">Close</button>";
                $info = $info . "				</div>";
                $info = $info . "			</div>";
                $info = $info . "		</div>";
                $info = $info . "	</div>";
                $idx2 ++;
            }
        }
        
        return $info;
    }

    public static function getNotification()
    {
        // if (! UserLoginUtils::isLogin ()) {
        // header ( "Location: " . ConfigUtil::getSiteName () );
        // die ();
        // }

        $badge = 0;
        $items = '';
       
        $criteria = new CDbCriteria();
        $criteria->condition = " isRead=0";
        
        $infos = Notify::model()->findAll($criteria);
        if (isset($infos)) {
            $badge = count($infos);
            $count =0;
            foreach ($infos as $item) {
                
                $date = strtotime($item->create_date);
                $new_date = date('d-m-Y', $date);
                
                $items = $items . "<li>";
                $items = $items . "<a href=\"javascript:;\">";
                $items = $items . "<span class=\"time\">". $new_date ."</span>";
                $items = $items . "<span class=\"details\"> <span class=\"label label-sm label-icon label-success\"> <i class=\"fa fa-plus\"></i>";
                $items = $items . "</span>". $item->title ."</span>";
                $items = $items . "</a>";
                $items = $items . "</li>";
                $count++;
                
                if($count>5){
                    break;
                }
                
            }
        }
//         NotifyList
        $html = '
	    <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <i class="icon-bell"></i> <span class="badge badge-default"> '.$badge.' </span>
            </a>
	        <ul class="dropdown-menu">
	           <li class="external">
	               <h3><span class="bold">'.$badge.' pending</span> notifications</h3><a href="'.ConfigUtil::getAppName().'/index.php/DashBoard/NotifyList">view all</a>
	           </li>
	           <li>
	                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 280px;">
	                    <ul class="dropdown-menu-list scroller" style="height: 280px; overflow: hidden; width: auto;" data-handle-color="#637283" data-initialized="1">
                        '.$items.'
                        </ul>
                    </div>
                </li>
            </ul>
        </li>';
        return $html;
    }
}