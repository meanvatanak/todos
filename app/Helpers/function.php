<?php

use App\Models\Label;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

function resizeImage($item,$image,$upload)
{
  // $new_str = preg_replace("/\s+'/", "",html_entity_decode($item, ENT_QUOTES));
  $new_str = preg_replace("/[^a-zA-Z0-9]+/", "", html_entity_decode($item));
  $filename = $new_str.time().".".$image->getClientOriginalExtension();
  // $filename = time().$image->getClientOriginalName();

  $sourceProperties = getimagesize($image);
  $imageType = $sourceProperties[2];
  $filesize = filesize($image);
  $dst_w =760;
  $dst_h ='';
  if($filesize <= (300*1024))
  {		
    $path = move_uploaded_file($image->getPathName(), $upload. $filename);
    return $filename;
  }
  switch ($imageType) 
  {
      case IMAGETYPE_PNG:
          $imageResourceId = imagecreatefrompng($image); 
          $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1],$dst_w,$dst_h);
          imagepng($targetLayer,$upload. $filename);
          break;

      case IMAGETYPE_GIF:
          $imageResourceId = imagecreatefromgif($image); 
          $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1],$dst_w,$dst_h);
          imagegif($targetLayer,$upload. $filename);
          break;
      case IMAGETYPE_JPEG:
          $imageResourceId = imagecreatefromjpeg($image); 
          $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1],$dst_w,$dst_h);
          imagejpeg($targetLayer,$upload. $filename);
          break;
      default:
          echo "Invalid Image type.";
          exit;
          break;
      $path = move_uploaded_file($image->getPathName(), $upload. $filename);
  }

  return $filename;
}

//action resize image
function imageResize($imageResourceId,$src_w,$src_h,$dst_w,$dst_h) {   
	$src_x = $src_y = 0;
	if(!empty($dst_w) AND !empty($dst_h)){
		if($dst_w > $dst_h){
			$scale_w = $dst_w;
			$scale_h = ($src_h * $dst_w / $src_w);				
			if($scale_h < $dst_h){
				$scale_h = $dst_h;
				$scale_w = ($src_w * $dst_h / $src_h);
			}
		}else{
			$scale_h = $dst_h;
			$scale_w = ($src_w * $dst_h / $src_h);				
			if($scale_w < $dst_w){
				$scale_w = $dst_w;
				$scale_h = ($src_h * $dst_w / $src_w);			}
		}
		
		$dst_w = $scale_w;
		$dst_h = $scale_h;
	}else{		
		if(empty($dst_w)){
			if($src_h > $dst_h){
				$dst_w=($src_w/$src_h)*$dst_h;
			}else{
				$dst_w=$src_w;
				$dst_h=$src_h;
			}
		}
		if(empty($dst_h)){
			if($src_w > $dst_w){
				$dst_h=($src_h/$src_w)*$dst_w;
			}else{
				$dst_h=$src_h;
				$dst_w=$src_w;
			}
		}
	}
    $targetLayer=imagecreatetruecolor($dst_w,$dst_h);
    imagecopyresampled($targetLayer,$imageResourceId,0,0,0,0,$dst_w,$dst_h, $src_w,$src_h);	
    return $targetLayer;
}

function generateRandomString($length = 10) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}

function createDateRangeArray($strDateFrom,$strDateTo)
{
    // takes two dates formatted as YYYY-MM-DD and creates an
    // inclusive array of the dates between the from and to dates.

    // could test validity of dates here but I'm already doing
    // that in the main script

    $aryRange = [];

    $iDateFrom = mktime(1, 0, 0, substr($strDateFrom, 5, 2), substr($strDateFrom, 8, 2), substr($strDateFrom, 0, 4));
    $iDateTo = mktime(1, 0, 0, substr($strDateTo, 5, 2), substr($strDateTo, 8, 2), substr($strDateTo, 0, 4));

    if ($iDateTo >= $iDateFrom) {
        array_push($aryRange, date('Y-m-d', $iDateFrom)); // first entry
        while ($iDateFrom<$iDateTo) {
            $iDateFrom += 86400; // add 24 hours
            array_push($aryRange, date('Y-m-d', $iDateFrom));
        }
    }
    return $aryRange;
}
function random_color_part($threshold)
{
    $dt = '';
    for ($o = 1; $o <= 3; $o++) {
        $dt .= str_pad(dechex(mt_rand(0, $threshold)), 2, '0', STR_PAD_LEFT);
    }
    return '#' . $dt;
}

function get_ip_function() {
  $mainIp = '';
  if (getenv('HTTP_CLIENT_IP'))
    $mainIp = getenv('HTTP_CLIENT_IP');
  else if(getenv('HTTP_X_FORWARDED_FOR'))
    $mainIp = getenv('HTTP_X_FORWARDED_FOR');
  else if(getenv('HTTP_X_FORWARDED'))
    $mainIp = getenv('HTTP_X_FORWARDED');
  else if(getenv('HTTP_FORWARDED_FOR'))
    $mainIp = getenv('HTTP_FORWARDED_FOR');
  else if(getenv('HTTP_FORWARDED'))
    $mainIp = getenv('HTTP_FORWARDED');
  else if(getenv('REMOTE_ADDR'))
    $mainIp = getenv('REMOTE_ADDR');
  else
    $mainIp = 'UNKNOWN';
  return $mainIp;
}

function userinfo()
{
  $userinfo = array();
  $nav_roles = DB::table('roles')->where('id', Auth::user()->role_id )->get();
  $nav_emps = DB::table('roles')->where('id', Auth::user()->role_id )->get();
  $userinfo['role_name'] = $nav_roles[0]->role_name;
  $userinfo['emp_name'] = $nav_roles[0]->role_name;
  return $userinfo;
}

// function permission($role_id,$page)
// {
// 	// $role_has_per = Role_has_per::where('role_id', $role_id)->get();
//   checkNewPermission($role_id);
//   $permission = Permission::where([
// 		['role_id',$role_id],
// 		['name', $page]
//   ])
// 	->orWhere([
// 		['name', '=', "0_".$page],
// 		['role_id', '=', $role_id],
// 	])->first();

//   return $permission;
// }

// function checkNewPermission($id)
// {
//   $labels = Label::orderBy('id', 'ASC')->get();
//   // $role = Role::findOrFail($id);
//   foreach($labels as $label)
//   {
// 		$no = Permission::where([
// 			['name', '=', $label->name],
// 			['role_id', '=', $id],
// 		])
// 		->orWhere([
// 			['name', '=', "0_".$label->name],
// 			['role_id', '=', $id],
// 		])->first();

// 		if(!isset($no))
// 		{
// 			// if(Auth::user()->role_id != 1)
// 			if($id != 1)
// 			{
// 				$permission = new Permission();

// 				$permission->role_id = $id;
// 				$permission->header = 0;

// 				$permission->name = "0_".$label->name;

// 				$permission->optView = 0;

// 				$permission->optCreate = 0;

// 				$permission->optShow = 0;

// 				$permission->optEdit = 0;

// 				$permission->optDelete = 0;

// 				$permission->timestamps = false;
// 				$permission->save();
// 			}
// 			else
// 			{
// 				$permission = new Permission();

// 				$permission->role_id = $id;
// 				$permission->header = $label->header;

// 				$permission->name = $label->name;

// 				$permission->optView = 1;

// 				$permission->optCreate = 1;

// 				$permission->optShow = 1;

// 				$permission->optEdit = 1;

// 				$permission->optDelete = 1;

// 				$permission->timestamps = false;
// 				$permission->save();
// 			}
// 		}
//   }
// }

function checkNewPermission($id)
{
  $labels = Label::orderBy('id', 'ASC')->get();
  foreach($labels as $label)
  {
		$no = Permission::where([
			['name', '=', $label->name],
			['role_id', '=', $id],
		])
		->orWhere([
			['name', '=', "0_".$label->name],
			['role_id', '=', $id],
		])->first();

		if(!isset($no))
		{
			if($id != 1)
			{
				$permission = new Permission();

				$permission->role_id = $id;
				$permission->header = 0;

				$permission->name = "0_".$label->name;

				$permission->optView = 0;

				$permission->optCreate = 0;

				$permission->optShow = 0;

				$permission->optEdit = 0;

				$permission->optDelete = 0;

				$permission->timestamps = false;
				$permission->save();
			}
			else
			{
				$permission = new Permission();

				$permission->role_id = $id;
				$permission->header = $label->header;

				$permission->name = $label->name;

				$permission->optView = 1;

				$permission->optCreate = 1;

				$permission->optShow = 1;

				$permission->optEdit = 1;

				$permission->optDelete = 1;

				$permission->timestamps = false;
				$permission->save();
			}
		}
  }
}

// function navbarCheck()
// {
// 	checkNewPermission(Auth::user()->role_id);
//   $permissions = Permission::where([
// 		['role_id', Auth::user()->role_id],
//   ])->get();
//   return $permissions;
// }

function navbarCheck()
{
  return session('permissions');
}

