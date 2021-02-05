<?php
// Models
use App\Models\Auth_Model;

function parentCategoryName($parent_id)
{
    $myModel = new Auth_Model();
    return $myModel->get('categories', ['id' => $parent_id])->title;
}

function datetotimestamp($time)
{
    return date("Y-m-d H:i:s", strtotime($time));
}

function timestamptotime($time)
{
    return date("h:i A", strtotime($time));
}

function timestamptodatepicker($time)
{
    return date("Y-m-d H:i A", strtotime($time));
}

function timestamptodate($time)
{
    return date("d-m-Y h:i A", strtotime($time));
}

function getThumbImage($type, $name)
{
    if ($name) {
        return '<img src="'.base_url('core/public/'.$type.'/'.$name).'" width="80px" height="80px">';
    }
}

function getCoverImage($type, $name)
{
    if ($name) {
        return '<label class="ace-file-input ace-file-multiple ace-file-multiple23">
				<span class="ace-file-container hide-placeholder selected">
					<span class="ace-file-name" data-title="'.$name.'">
						<img class="middle" style="background-image: url('.base_url('core/public/'.$type.'/'.$name).'); width: 50px; height: 50px;" src="'.base_url('core/public/'.$type.'/'.$name).'">
						<i class=" ace-icon fa fa-picture-o file-image"></i>
					</span>
				</span>
				<a class="remove" href="#"><i class=" ace-icon fa fa-times"></i></a>
			</label>';
    }
}

function getIframe($url, $width = "250", $height = "150")
{
    return '<iframe width="'.$width.'" height="'.$height.'" src="'.$url.'?autoplay=1&mute=1">
		</iframe>';
}

function getPostViews($postId, $type)
{
    $myModel = new Auth_Model();
    $data = $myModel->getCount('views_and_shares', ['post_id' => $postId , 'post_type' => $type , 'view' => 1]);
    return count($data);
}

function getPostShare($postId, $type)
{
    $myModel = new Auth_Model();
    $data = $myModel->getCount('views_and_shares', ['post_id' => $postId , 'post_type' => $type , 'share' => 1]);
    return count($data);
}

function getToken($authHeader)
{

        $token = null;

        $arr = explode(" ", $authHeader);

        return $token = $arr[1];
}
