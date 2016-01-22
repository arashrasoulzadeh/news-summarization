<?php
//wordcount analyzer
include "rss_php.php";
function loadNews($url)
{
      $rss = new rss_php;

  $rss->load($url);

  $items = $rss->getItems(); #returns all rss items
  $descs="";
   for ($i=0;$i<sizeof($items);$i++)
  {
    $a=$items[$i];
     $descs.=" ".$a["title"];
  }
  $descs = str_replace("برای","",$descs);
  $descs = str_replace("های","",$descs);
  $descs = str_replace("مثل","",$descs);
  $descs = str_replace("است","",$descs);
  $descs = str_replace("مثل","",$descs);
  $descs = str_replace("(+عکس)","",$descs);
  $descs = str_replace("(عکس)","",$descs);
  $descs = str_replace("کرد","",$descs);
  $descs = str_replace("درباره","",$descs);
  $descs = str_replace("سال","",$descs);
  $descs = str_replace("ایران","",$descs);
  $descs = str_replace("ایرانی","",$descs);
  $descs = str_replace("جدید","",$descs);
  $descs = str_replace("سال","",$descs);



  return $descs;
}
$descs=loadNews('http://127.0.0.1/news/RSS.rss');

$descs=loadNews('http://khabaronline.ir/rss');
$descs.=loadNews('http://www.farsnews.com/RSS');
$descs.=loadNews('http://www.farsnews.com/rss/social');
$descs.=loadNews('http://www.farsnews.com/rss/economy');
$descs.=loadNews('http://www.farsnews.com/rss/politics');
$descs.=loadNews('http://www.farsnews.com/rss/foreign_policy');
$descs.=loadNews('http://www.asriran.com/fa/rss/1');
$descs.=loadNews('http://www.asriran.com/fa/rss/1/1');
$descs.=loadNews('http://www.asriran.com/fa/rss/1/2');
$descs.=loadNews('http://www.asriran.com/fa/rss/1/3');
$descs.=loadNews('http://www.asriran.com/fa/rss/1/4');
$descs.=loadNews('http://www.asriran.com/fa/rss/1/5');
$descs.=loadNews('http://www.asriran.com/fa/rss/1/6');
$descs.=loadNews('http://www.asriran.com/fa/rss/1/7');
$descs.=loadNews('http://www.asriran.com/fa/rss/1/8');
$descs.=loadNews('http://www.asriran.com/fa/rss/1/9');
$descs.=loadNews('http://www.asriran.com/fa/rss/1/10');
$descs.=loadNews('http://www.asriran.com/fa/rss/1/11');
$descs.=loadNews('http://www.asriran.com/fa/rss/1/12');
$descs.=loadNews('http://itna.ir/rssgx.deagqagdd51kwvjoe.4rparz.a.xml');
$descs.=loadNews('http://itiran.com/rss/all/mostvisited');
$descs.=loadNews('http://khabaronline.ir/rss/service/politics');
$descs.=loadNews('http://khabaronline.ir/rss/service/economy');
$descs.=loadNews('http://khabaronline.ir/rss/service/culture');
$descs.=loadNews('http://khabaronline.ir/rss/service/society');
$descs.=loadNews('http://khabaronline.ir/rss/service/World');
$descs.=loadNews('http://khabaronline.ir/rss/service/sport');
$descs.=loadNews('http://khabaronline.ir/rss/service/science');
$descs.=loadNews('http://khabaronline.ir/rss/service/ict');
$descs.=loadNews('http://khabaronline.ir/rss/service/comic');
$descs.=loadNews('http://khabaronline.ir/rss/service/weblog');
$descs.=loadNews('http://www.irinn.ir/feed/اخبار');
$descs.=loadNews('http://khabarfarsi.com/rss/top/9');
$descs.=loadNews('http://khabarfarsi.com/rss/top/12');
$descs.=loadNews('http://khabarfarsi.com/rss/top/13');
$descs.=loadNews('http://khabarfarsi.com/rss/top/18');
$descs.=loadNews('http://khabarfarsi.com/rss/top/11');
$descs.=loadNews('http://khabarfarsi.com/rss/top/10');
$descs.=loadNews('http://khabarfarsi.com/rss/top/16');
$descs.=loadNews('http://khabarfarsi.com/rss/top/17');
$descs.=loadNews('http://khabarfarsi.com/rss/top/19');
$descs.=loadNews('http://khabarfarsi.com/rss/top/14');
$descs.=loadNews('http://khabarfarsi.com/rss/top/15');

$w=array();
$counts=array();
 error_reporting(0);
$words = explode(" ",$descs);
// echo " Before Fix : ".sizeof($words);
//  $words=  array_flip(array_flip($words));
//  echo " After Fix : ".sizeof($words);
echo "<br>";

//var_dump($words);
$result = array_combine($words, array_fill(0, count($words), 0));

foreach($words as $word) {
    $result[$word]++;
}
 foreach($result as $word => $count) {
    //echo "There are $count instances of $word.\n";
    array_push($w,$word);
    array_push($counts,$count);
 }
array_multisort($counts,SORT_NUMERIC, SORT_DESC,$w);
$output="";
$cnt=10;
$trends = array();
 for ($i=0;$i<sizeof($w);$i++)
{
  if (strlen($w[$i])>4)
  {
    if ($cnt>0)
    {
      array_push($trends,$w[$i]);
    //  $output.= "<Br> ".$words[$key] ." ".$w[$i]." <br> Said ".$counts[$i]." times";

      $cnt--;
    }
  }
}



foreach($trends as $t)
{
  $on=array();
  $ob=array();


  for ($i=0;$i<sizeof($words);$i++)
  {
    # code...
      $lastword=$words[$i - 1];
      $currentword=$words[$i];
      $nextword=$words[$i + 1];

      if ($t==$currentword){
        array_push($on,$nextword);
        array_push($ob,$lastword);

      }
  }












  $output.=  "<br>".mostused($ob)[0]." $t ".mostused($on)[0];
}

function mostUsed($occ)
{
  $w=array();
  $counts=array();


  $result = array_combine($occ, array_fill(0, count($occ), 0));

  foreach($occ as $word) {
      $result[$word]++;
  }
   foreach($result as $word => $count) {
      //echo "There are $count instances of $word.\n";
      array_push($w,$word);
      array_push($counts,$count);
   }
  array_multisort($counts,SORT_NUMERIC, SORT_DESC,$w);
return $w;

}
$file = 'index.php';

 $output.=" <br><br>Generated on ".date("Y/m/d h:i:sa ");
file_put_contents($file, $output);
echo $output;
echo "generated!";


//  for ($i=0;$i<sizeof($w);$i=$i)
// {
//   if ($c<50 )
//   {
//         echo $w[$i]."<hr>";
//        $c++;
//
//   }
// }

// $bigid = 0;
// for ($i=0;$i<sizeof($w);$i++)
// {
//   echo $w[$i]."   $c[$i] <br><hr>";
//     if (strlen($c[$i])>2)
//     {
//       if ($c[$i]>$c[$bigid]){
//         echo $w[$i];
//         $bigid=$i;
//       }
//     }
// }
// echo $w[$bigid]." repeated ".$c[$bigid];

 ?>
