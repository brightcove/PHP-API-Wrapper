<?php

require_once 'brightcove.php';

class BrightcoveCMS extends BrightcoveAPI {

  protected function cmsRequest($method, $endpoint, $result, $post = NULL) {
    return $this->client->request($method, 'cms', $this->account, $endpoint, $result, $post);
  }

  /**
   * @return BrightcoveVideo[]
   */
  public function listVideos($search = NULL, $sort = NULL, $limit = NULL, $offset = NULL) {
    return $this->cmsRequest('GET', '/videos', 'BrightcoveVideo');
  }

  /**
   * @return BrightcoveVideo
   */
  public function postVideo(BrightcoveVideo $video) {
    return $this->cmsRequest('POST', '/videos', new BrightcoveVideo(), $video);
  }

}

class BrightcoveVideo {
  public $id;
  public $account_id;
  public $complete;
  public $created_at;
  /**
   * @var BrightcoveVideoCuePoint[]
   */
  public $cue_points;
  public $custom_fields;
  public $description;
  public $duration;
  public $economics;
  public $folder_id;
  /**
   * @var BrightcoveVideoGEO
   */
  public $geo;
  /**
   * @var BrightcoveVideoImage[]
   */
  public $images;
  public $link;
  public $long_description;
  public $name;
  public $reference_id;
  /**
   * @var BrightcoveVideoSchedule
   */
  public $schedule;
  public $sharing;
  public $state;
  public $tags;
  public $text_tracks;
  public $updated_at;
}

class BrightcoveVideoImage {
  public $id;
  public $src;
}

class BrightcoveVideoCuePoint {
  public $id;
  public $name;
  public $type;
  public $time;
  public $metadata;
  public $force_stop;
}

class BrightcoveVideoGEO {
  public $countries = [];
  public $exclude_countries = FALSE;
  public $restricted = FALSE;
}

class BrightcoveVideoSchedule {
  public $starts_at;
  public $ends_at;
}
