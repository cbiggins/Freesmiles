<?php
require_once('config.php');

$api_url = "http://api.flickr.com/services/rest/?format=php_serial&api_key={$flickr_key}";
$request = $api_url."&method=flickr.photos.search&tags=smiling&per_page=1&safe_search=1&content_type=1&page={$_REQUEST['page']}";

$output = unserialize(file_get_contents($request));

$response = array();

if ($output['stat'] == 'ok') {
    foreach($output['photos']['photo'] as $k => $data) {
      extract($data);
      $response['img'] = "http://farm{$farm}.static.flickr.com/{$server}/{$id}_{$secret}_z.jpg";
      $response['title'] = (isset($title) && strlen($title) > 0 ? $title : 'Free Smiles Baby!');
      $response['img_url'] = "http://www.flickr.com/photos/{$owner}/{$id}";
      // Now we'll get the owner details...
      $owner_request = $api_url . "&method=flickr.people.getInfo&user_id={$owner}";
      $owner = unserialize(file_get_contents($owner_request));
      $response['owner_username'] = $owner['person']['username']['_content'];
      $response['owner_name'] = (isset($owner['person']['realname']['_content']) ? $owner['person']['realname']['_content'] : $owner['person']['username']['_content']);
      $response['owner_url'] = $owner['person']['profileurl']['_content'];
    }
}

print json_encode($response);
