<?php
$site_id=(isset($_GET['site_id']))?$_GET['site_id']:$_GET['siteid'];
switch($site_id)
{
case '1':    
header('Access-Control-Allow-Origin: http://www.coupay.co.in');
break;
case '4':
header('Access-Control-Allow-Origin: http://www.soclever.net');
break;
case '5':
header('Access-Control-Allow-Origin: http://www.coupay.com');
break;
}

include("include/config.php");

if(isset($_GET['like_url']) && $_GET['like_url']!='')
{
    
    $select_url="select id,is_dislike from cs_like_unlike where client_id='".mysql_real_escape_string($_GET['site_id'])."' and url='".mysql_real_escape_string($_GET['like_url'])."'";
    $res_sel=re_db_query($select_url);
    if(re_db_num_rows($res_sel) > 0)
    {
        $row_like=re_db_fetch_array($res_sel);
        if($_GET['is_like']=='0')
        {
            $set_query=' is_dislike=is_dislike+1,is_like=is_like-1';
        }
        else if($_GET['is_like']=='2')
        {
            $set_query=' is_tweet=is_tweet+1';
        }
        else if($_GET['is_like']=='3')
        {
            $set_query=' is_li=is_li+1';
        }
        else if($_GET['is_like']=='4')
        {
            $set_query=' is_gp=is_gp+1';
        }
        else
        {
                $set_query=' is_like=is_like+1';
                     
        }
        $update_query="update cs_like_unlike set  ".$set_query."  where id='".$row_like['id']."'";
        re_db_query($update_query);
    }
    else
    {
        $like_unlike="";
        if($_GET['is_like']=='1')
        {
        $like_unlike="is_like='1',";
        } 
        else if($_GET['is_like']=='2')
        {
            $like_unlike="is_tweet='1',";
        }
        else if($_GET['is_like']=='3')
        {
            $like_unlike="is_like='1',";
        }
        else if($_GET['is_like']=='4')
        {
            $like_unlike="is_gp='1',";
        }   
        $insert_into="insert into cs_like_unlike set  ".$like_unlike." url='".mysql_real_escape_string($_GET['like_url'])."',client_id='".mysql_real_escape_string($_GET['site_id'])."'";
        re_db_query($insert_into);
    }
    
    echo "Event Tracked success fully";
    exit;
    
}
if(isset($_GET['order_id']) && $_GET['order_id']!='')
{
   
   $select_order="select id from cs_track_orders where order_id='".mysql_real_escape_string($_GET['order_id'])."' and client_id='".mysql_real_escape_string($_GET['site_id'])."'"; 
   $res_ord=re_db_query($select_order);
   if(re_db_num_rows($res_ord) <=0)
   {
    
    $ins_order="insert into cs_track_orders (client_id,order_id,order_amt,ref_by,is_from,date_time,ip) 
                values ('".mysql_real_escape_string($_GET['site_id'])."','".mysql_real_escape_string($_GET['order_id'])."','".mysql_real_escape_string($_GET['order_amt'])."','".mysql_real_escape_string($_GET['csid'])."','".mysql_real_escape_string($_GET['is_from'])."','".date('Y-m-d H:i:s',mktime(gmdate('H'),gmdate('i'),gmdate('s'),gmdate('m'),gmdate('d'),gmdate('Y')))."','".$_SERVER['REMOTE_ADDR']."')";
    re_db_query($ins_order);
    echo"Order Tracked Successfully.";
    exit;            
   }
   else
   {
    echo"This order has been already tracked";
    exit;
   }
    
}

$udata=json_decode($_GET['other']);


if(isset($_GET['is_fb']) && $_GET['is_fb']=='1' )
{
    $u_email=$udata->email;
}
else if(isset($_GET['is_li']) && $_GET['is_li']=='1' )
{
    
    $u_email=$udata->emailAddress;
}
else
{
    $u_email='';
}

if(isset($_GET['ref_by']) && $_GET['ref_by']!='')
{
    
    $insert_into="insert into cs_referral(`ref_by`,`reg_user`,`is_from`,`date_time`,`ip`) 
                 values('".mysql_real_escape_string($_GET['ref_by'])."','".mysql_real_escape_string($_GET['reg_user'])."','".mysql_real_escape_string($_GET['is_from'])."','".date('Y-m-d H:i:s',mktime(gmdate('H'),gmdate('i'),gmdate('s'),gmdate('m'),gmdate('d'),gmdate('Y')))."','".$_SERVER['REMOTE_ADDR']."')";
   re_db_query($insert_into);          
}

if(isset($_GET['clickurl']) && $_GET['clickurl']!='' && $_GET['is_fb']=='1')
{
$insert_into_link="insert into cs_fb_share (url,uid,ip,date_time,uname,app_id,client_id,email,member_id,comment) 
                   values('".mysql_real_escape_string($_GET['clickurl'])."','".mysql_real_escape_string($_GET['uid'])."','".mysql_real_escape_string($_SERVER['REMOTE_ADDR'])."','".date('Y-m-d H:i:s',mktime(gmdate('H'),gmdate('i'),gmdate('s'),gmdate('m'),gmdate('d'),gmdate('Y')))."','".mysql_real_escape_string($_GET['uname'])."','".mysql_real_escape_string($_GET['app_id'])."','".mysql_real_escape_string($_GET['siteid'])."','".mysql_real_escape_string($_GET['email'])."','".$_GET['member_id']."','".mysql_real_escape_string($_GET['comment'])."')";
                   
re_db_query($insert_into_link);
}
if(isset($_GET['url']) && $_GET['url']!='')
{
    
$insert_into_link="insert into cs_share_clicked (url,shared_by,clicked_by,is_from,date_time,ip) 
                   values('".mysql_real_escape_string($_GET['url'])."','".mysql_real_escape_string($_GET['sb'])."','".mysql_real_escape_string($_GET['cb'])."','".mysql_real_escape_string($_GET['is_from'])."','".date('Y-m-d H:i:s',mktime(gmdate('H'),gmdate('i'),gmdate('s'),gmdate('m'),gmdate('d'),gmdate('Y')))."','".$_SERVER['REMOTE_ADDR']."')";
              
re_db_query($insert_into_link);
    
}

/*LI Share Track*/ 
if(isset($_GET['clickurl']) && $_GET['clickurl']!='' && $_GET['is_li']=='1')
{
    
    $inser_share_li="insert into cs_li_share set member_id='".mysql_real_escape_string($_GET['uid'])."',share_url='".mysql_real_escape_string($_GET['clickurl'])."',share_content='".mysql_real_escape_string($_GET['comment'])."',share_picture='".mysql_real_escape_string($_GET['imgurl'])."',datetime='".date('Y-m-d H:i:s',mktime(gmdate('H'),gmdate('i'),gmdate('s'),gmdate('m'),gmdate('d'),gmdate('Y')))."',ip='".$_SERVER['REMOTE_ADDR']."'";
    re_db_query($inser_share_li);
    echo"Thanks for Sharing";
    exit;

}
/*LI Share Track end*/
if($u_email!='')
{
    
if($_GET['is_fb']=='1')
{
    $set_query=" is_fb='1' ";
}
else if($_GET['is_li']=='1')
{
    $set_query=" is_li='1'";
}

$select_cs="select id from cs_users where email='".mysql_real_escape_string($u_email)."' and client_id='".mysql_real_escape_string($_GET['siteid'])."'";

$res_cs=re_db_query($select_cs);
if(mysql_num_rows($res_cs) > 0)
{
    $row_cs=mysql_fetch_array($res_cs);
    $member_id=$row_cs['id'];
    
    re_db_query("update cs_users set ".$set_query." where id='".$member_id."'");
}
else
{
    
    re_db_query("insert into cs_users set email='".mysql_real_escape_string($u_email)."',".$set_query.",client_id='".mysql_real_escape_string($_GET['siteid'])."'");
    $member_id=mysql_insert_id();
    
}
/*FB DATA START*/
if($_GET['is_fb']=='1')
{
$select_user="select id from cs_fb_share_users where email='".mysql_real_escape_string($udata->email)."' and app_id='".mysql_real_escape_string($_GET['app_id'])."' and client_id='".mysql_real_escape_string($_GET['siteid'])."'";
$res_user=re_db_query($select_user);
$csuser_id=0;
if(mysql_num_rows($res_user) > 0)
{
    $row_user=mysql_fetch_array($res_user);
    $csuser_id=$row_user['id'];
    $update_query="update cs_fb_share_users";
    $where=" where email='".mysql_real_escape_string($udata->email)."' and app_id='".mysql_real_escape_string($_GET['app_id'])."' and client_id='".mysql_real_escape_string($_GET['siteid'])."'";
    
}  
else
{
    $update_query="insert into cs_fb_share_users";
    $where="";
} 
$likes="";
for($i=0;$i<count($udata->likes->data);$i++)
{    
$likes .=$udata->likes->data[$i]->name.",";
}

if($udata->id)
{
$set_query=$update_query." set

                    profile_pic='".mysql_real_escape_string($udata->picture->data->url)."',
                    relationship_status='".mysql_real_escape_string($udata->relationship_status)."', 
                    member_id='".mysql_real_escape_string($member_id)."',
                    uid='".mysql_real_escape_string($udata->id)."',
                    client_id='".mysql_real_escape_string($_GET['siteid'])."',
                    app_id='".mysql_real_escape_string($_GET['app_id'])."',  
                    uname='".mysql_real_escape_string($udata->first_name.' '.$udata->last_name)."',
                    birthday='".date('Y-m-d',strtotime($udata->birthday))."',
                    gender='".mysql_real_escape_string($udata->gender)."',
                    email='".mysql_real_escape_string($udata->email)."',
                    location='".mysql_real_escape_string($udata->location->name)."',
                    username='".mysql_real_escape_string($udata->link)."',
                    hometown='".mysql_real_escape_string($udata->hometown->name)."',
                    school='".mysql_real_escape_string($udata->school->name)."',
                    interests='".mysql_real_escape_string($udata->interests)."',
                    timezone='".mysql_real_escape_string($udata->timezone)."',
                    locale='".mysql_real_escape_string($udata->locale)."',
                    friends='".mysql_real_escape_string($udata->friends->summary->total_count)."',
                    likes='".mysql_real_escape_string($likes)."'
                    ".$where."
           ";
        //echo $set_query;   
 re_db_query($set_query); 
 if(!isset($_GET['clickurl']))
 {
echo $member_id;
exit;
 }
   
 }
}
/*FB DATA END*/

/*LINKEDIN DATA START*/
if(isset($_GET['is_li']) && $_GET['is_li']=='1')
{    
$select_user="select id from cs_li_data where member_id='".$member_id."'";

$res_user=re_db_query($select_user);
$csuser_id=0;
if(mysql_num_rows($res_user) > 0)
{
    $row_user=mysql_fetch_array($res_user);
    $csuser_id=$row_user['id'];
    $update_query="update cs_li_data";
    $where=" where member_id='".mysql_real_escape_string($member_id)."'";
    
}  
else
{
    $update_query="insert into cs_li_data";
    $where="";
}
if(intval($udata->byear)=='0')
{
    $byear="0000";
}
else
{
    $byear=intval($udata->byear);
}
$set_query=$update_query." set                    
                    member_id='".mysql_real_escape_string($member_id)."',
                    profile_id='".mysql_real_escape_string($udata->id)."',                      
                    firstname='".mysql_real_escape_string($udata->firstName)."',
                    lastname='".mysql_real_escape_string($udata->lastName)."',
                    bday='".mysql_real_escape_string(intval($udata->bday))."',
                    bmonth='".mysql_real_escape_string(intval($udata->bmonth))."',
                    byear='".mysql_real_escape_string($byear)."',
                    headline='".mysql_real_escape_string($udata->headline)."',
                    industry='".mysql_real_escape_string($udata->industry)."',
                    location='".mysql_real_escape_string($udata->location)."',
                    numConnections='".mysql_real_escape_string($udata->numConnections)."',
                    pictureUrl='".mysql_real_escape_string($udata->pictureUrl)."',
                    publicProfileUrl='".mysql_real_escape_string($udata->publicProfileUrl)."'                    
                    ".$where."
           ";
    
 re_db_query($set_query);
 
 if(!isset($_GET['clickurl']) && $_GET['to_share']=='1' )
 {
echo $member_id;
exit;
 }
 
 if(!isset($_GET['clickurl']) && $_GET['to_share']=='0')
  {
    
    echo"no_share~".$udata->emailAddress;
    exit;
  }
 
}
/*LINKED DATA END*/ 
}       
?>

