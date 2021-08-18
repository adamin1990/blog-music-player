<?php


namespace app\api\controller;


use app\common\controller\Base;
use app\common\Curl;

class Music extends Base
{

    use Curl;

    /**
     * 专辑列表
     */
    public function musicDoc()
    {
        $datas = <<<DATA
var playerName = 'Adamin Music Player', autoPlayer = 1, randomPlayer = 0, defaultVolume = 80, showLrc = 1, greeting = 'Welcome',
    showGreeting = 1, defaultAlbum = 1, siteName = '李大鹏', background = 1, playerWidth = 310, coverWidth = 110,
    showNotes = 1, autoPopupPlayer = 3;
var songSheetList = [{
    "songSheetName": "recommend",
    "author": "adamin",
    "songIds": ["502678329","109734","1441860073","1674192"],
    "songNames": ["Yasuo","凤凰花开的路口","Morsmordre","More Than I Can Say"],
    "songTypes": ["wy","wy", "wy","wy"],
    "albumNames": ["Yasuo","林志炫","Crazy Donkey","Leo Sayer" ],
    "artistNames": ["Yasuo","林志炫","Crazy Donkey","Leo Sayer" ],
    "albumCovers": ["https://p1.music.126.net/xOghBESBon_7xvF37PQEkQ==/109951165562353576.jpg?param=200y200","http://p1.music.126.net/0iKLtwsIwOMksbNkZUJLzg==/16671894812505379.jpg?param=130y130","http://p1.music.126.net/hZZF9j6Rd_Te3CXYqg5GIg==/109951165772600862.jpg?param=130y130"
    ,"http://p4.music.126.net/xjoGtl3hxnTQdldOsibxRA==/18593841139166266.jpg?param=200y200"]
},  ]
DATA;

        echo $datas;
        die;

    }

    /**
     * 音乐地址
     */
    public function musicUrl()
    {
        try {
            $id = $this->request->get("id");
            $api = "http://mos-00.736578.xyz/api/netease/song?id=" . $id;
            $res = $this->doGet($api,[],false,false);
          if($res){
              $res=json_decode($res,true);
           $url=$res["data"][0]["url"];
              header("Location: $url");
          }

            die;
        } catch (\Exception $e) {
            echo  $e->getMessage();
        }


    }

    /**
     * 随机色
     */
    public function  mainColor(){
        $c1=rand(10,255);
        $c2=rand(10,255);
        $c3=rand(10,255);
        $c4=rand(10,255);
        $c5=rand(10,255);
        $c6=rand(10,255);
        $color="var mainColor='$c1,$c2,$c3';font_color='$c4,$c5,$c6'";
        echo  $color;
    }

    /**
     * 歌词
     */
    public function  musicLyric(){
        try {
            $id = $this->request->get("id");
            $api = "http://mos-00.736578.xyz/api/netease/lyric?id=" . $id;
            $res = $this->doGet($api,[],false,false);
            if($res){
                $res=json_decode($res,true);
                if(isset($res['lrc'])){
                    $url=trim($res["lrc"]['lyric']);
                    $url = str_replace(PHP_EOL, '', $url);

                }else {
                    $url="";
                }

               $resp="var lrcstr =\"$url\"";
                echo  $resp;die;
                return;
            }else{
                $resp="var lrcstr =\"\"";
                echo  $resp;
                die;
                return;
            }

        } catch (\Exception $e) {
            echo  $e->getMessage();
        }
    }


}