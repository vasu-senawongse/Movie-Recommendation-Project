<?php


//Getting the word form searching box.
$str = $_GET['word'];


$word = '-filter:retweets%23'.$str.'%20review';


//set the key and token
$consumerKey = "VsjdGRpXmWkkezkjGLcyl5vXo";
$consumerSecret = "EKYsbp87adUemrmnHytvJDblYaBocqZNpCDlLY4CW9riZtQ3bD";
$accessToken = "282725534-pVdD7X5I7AOtoHWc5RF1L7jb2nooI5tSG9p8hQqc";
$accessTokenSecret ="0xpopqSFhSlOEVAyS8LiyBJvZd0noYwLwrIVZDGLksZKb";

require "twitteroauth\autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;
//use the key and token to create the object of TwitterOAuth
$connection = new TwitterOAuth($consumerKey,$consumerSecret,$accessToken,$accessTokenSecret);
//use get method form TwitterOAuth object to identify accounts
$content = $connection->get("account/verify_credentials");
//send query to web service and receive value in statuses variable
$statuses = $connection->get("search/tweets", ["q" => $word]);

// print_r($statuses)

// $statuses = $connection->get('https://api.twitter.com/1.1/search/tweets.json?q=-filter:retweets%23'.$word.'%20review&result_type=popular&count=4');

// loop for each tweet
foreach ($statuses->statuses as $key => $tweet){
echo '<table>';
 //show the user profile image and name
 echo '<div class="row-sm-xx"><tr><div class="col-sm-2"><td width="10"><img src="'.$tweet->user->profile_image_url.'"/></td></div><div class="col-sm-8"><td><b>Name : </b>'.$tweet->user->screen_name.'</td></div></tr></div>';
 //show the user tweet
 echo '<div class="row-sm-xx"><tr><div class="col-sm-xx"><td colspan="2"><b>Comment : </b>'.$tweet->text.'</td></div></tr></div>';

    //split the tweet of user to be a words, make it to string lower and remove the # 
    $listWord = explode(" ",str_replace("#","",strtolower($tweet->text)));
    //list of positive words
    $positiveWord = array("absolutely","adorable","accepted","acclaimed","accomplish","accomplishment","achievement","action","active","admire","adventure","affirmative","affluent","agree","agreeable","amazing","angelic","appealing","approve","aptitude","attractive","awesome","beaming","beautiful","believe","beneficial","bliss","bountiful","bounty","brave","bravo","brilliant","bubbly","calm","celebrated","certain","champ","champion","charming","cheery","choice","classic","classical","clean","commend","composed","congratulation","constant","cool","courageous","creative","cute","dazzling","delight","delightful","distinguished","divine","earnest","easy","ecstatic","effective","effervescent","efficient","effortless","electrifying","elegant","enchanting","encouraging","endorsed","energetic","energized","engaging","enthusiastic","essential","esteemed","ethical","excellent","exciting","exquisite","fabulous","fair","familiar","famous","fantastic","favorable","fetching","fine","fitting","flourishing","fortunate","free","fresh","friendly","fun","funny","generous","genius","genuine","giving","glamorous","glowing","good","gorgeous","graceful","great","green","grin","growing","handsome","happy","harmonious","healing","healthy","hearty","heavenly","honest","honorable","honored","hug","idea","ideal","imaginative","imagine","impressive","independent","innovate","innovative","instant","instantaneous","instinctive","intuitive","intellectual","intelligent","inventive","jovial","joy","jubilant","keen","kind","knowing","knowledgeable","laugh","legendary","light","learned","lively","lovely","lucid","lucky","luminous","marvelous","masterful","meaningful","merit","meritorious","miraculous","motivating","moving","natural","nice","novel","now","nurturing","nutritious","okay","one","onehundredpercent","open","optimistic","paradise","perfect","phenomenal","pleasurable","plentiful","pleasant","poised","polished","popular","positive","powerful","prepared","pretty","principled","productive","progress","prominent","protected","proud","quality","quick","quiet","ready","reassuring","refined","refreshing","rejoice","reliable","remarkable","resounding","respected","restored","reward","rewarding","right","robust","safe","satisfactory","secure","seemly","simple","skilled","skillful","smile","soulful","sparkling","special","spirited","spiritual","stirring","stupendous","stunning","success","successful","sunny","super","superb","supporting","surprising","terrific","thorough","thrilling","thriving","tops","tranquil","transforming","transformative","trusting","truthful","unreal","unwavering","up","upbeat","upright","upstanding","valued","vibrant","victorious","victory","vigorous","virtuous","vital","vivacious","wealthy","welcome","well","whole","wholesome","willing","wonderful","wondrous","worthy","wow","yes","yummy","zeal","zealous");
    //list of negative words
    $negativeWord = array("abysmal","adverse","alarming","angry","annoy","anxious","apathy","appalling","atrocious","awful","bad","banal","barbed","belligerent","bemoan","beneath","boring","broken","callous","can't","clumsy","coarse","cold","coldhearted","collapse","confused","contradictory","contrary","corrosive","corrupt","crazy","creepy","criminal","cruel","cry","cutting","dead","decaying","damage","damaging","dastardly","deplorable","depressed","deprived","deformed","deny","despicable","detrimental","dirty","disease","disgusting","disheveled","dishonest","dishonorable","dismal","distress","don't","dreadful","dreary","enraged","eroding","evil","fail","faulty","fear","feeble","fight","filthy","foul","frighten","frightful","gawky","ghastly","grave","greed","grim","grimace","gross","grotesque","gruesome","guilty","haggard","hard","hardhearted","harmful","hate","hideous","homely","horrendous","horrible","hostile","hurt","hurtful","icky","ignore","ignorant","ill","immature","imperfect","impossible","inane","inelegant","infernal","injure","injurious","insane","insidious","insipid","jealous","junky","lose","lousy","lumpy","malicious","mean","menacing","messy","misshapen","missing","misunderstood","moan","moldy","monstrous","naive","nasty","naughty","negate","negative","never","no","nobody","nondescript","nonsense","not","noxious","objectionable","odious","offensive","old","oppressive","pain","perturb","pessimistic","petty","plain","poisonous","poor","prejudice","questionable","quirky","quit","reject","renege","repellant","reptilian","repulsive","repugnant","revenge","revolting","rocky","rotten","rude","ruthless","sad","savage","scare","scary","scream","severe","shoddy","shocking","sick","sickening","sinister","slimy","smelly","sobbing","sorry","spiteful","sticky","stinky","stormy","stressful","stuck","stupid","substandard","suspect","suspicious","tense","terrible","terrifying","threatening","ugly","undermine","unfair","unfavorable","unhappy","unhealthy","unjust","unlucky","unpleasant","upset","unsatisfactory","unsightly","untoward","unwanted","unwelcome","unwholesome","unwieldy","unwise","upset","vice","vicious","vile","villainous","vindictive","wary","weary","wicked","woeful","worthless","wound","yell","yucky","zero");
    //comment particular score
    $score = 0;

    //loop for every word to count the score of comment
    //score will increase for each positive word and decrease for each negative word
    foreach($listWord as $eachWord){
        // echo $eachWord;
        foreach($positiveWord as $posi){
            if($posi == $eachWord){
                // echo 'บวก';
                $score++;
            }
        }
        foreach($negativeWord as $nega){
            if($nega == $eachWord){
                // echo 'ลบ';
                $score--;
            }
        }
    }


    //if score are equal to 0 it is Neutral, if more than 0 it is positive and if less than 0 it is negative
    echo '<div class="row-sm-xx"><tr><div class="col-sm-xx"><td colspan="2"><b>Comment particular : </b>';
    if($score>0){
        echo 'Positive<br>';
    }else if($score<0){
        echo 'Negative<br>';
    }else{
        echo 'Neutral<br>';
    }
    echo '</td></div></tr></div><br>';
echo '</table>';

}


?>
