<html>
<head>
<style type="text/css">
#tagcloud{
        color: #dda0dd;
        font-family: Arial, verdana, sans-serif;
        width:200px;
        border: 1px solid black;
	text-align: center;
}

#tagcloud a{
        color: green;
        text-decoration: none;
        text-transform: capitalize;
}
</style>
</head>
<body>
<div id="tagcloud">
<?php
/** this is our array of tags
 * We feed this array of tags and links the tagCloud
 * class method createTagCloud
 */
$tags = array(
        array('weight'  =>40, 'tagname' =>'tutorials', 'url'=>'http://www.phpro.org/tutorials/'),
        array('weight'  =>12, 'tagname' =>'examples', 'url'=>'http://www.phpro.org/examples/'),
        array('weight'  =>10, 'tagname' =>'contact', 'url'=>'http://www.phpro.org/contact/'),
        array('weight'  =>15, 'tagname' =>'quotes', 'url'=>'http://www.phpro.org/quotes/'),
        array('weight'  =>28, 'tagname' =>'devel', 'url'=>'http://www.phpro.org/phpdev/'),
        array('weight'  =>35, 'tagname' =>'manual', 'url'=>'http://www.phpro.org/en/index.html'),
        array('weight'  =>20, 'tagname' =>'articles', 'url'=>'http://www.phpro.org/articles/'),
);

 
/*** create a new tag cloud object ***/
$tagCloud = new tagCloud($tags);

echo $tagCloud -> displayTagCloud();

?>
</div>
</body>
</html>
<?php

class tagCloud{

/*** the array of tags ***/
private $tagsArray;


public function __construct($tags){
 /*** set a few properties ***/
 $this->tagsArray = $tags;
}

/**
 *
 * Display tag cloud
 *
 * @access public
 *
 * @return string
 *
 */
public function displayTagCloud(){
 $ret = '';
 shuffle($this->tagsArray);
 foreach($this->tagsArray as $tag)
    {
    $ret.='<a style="font-size: '.$tag['weight'].'px;" href="'.$tag['url'].'">'.$tag['tagname'].'</a>'."\n";
    }
 return $ret;
}
    

} /*** end of class ***/

?>
</body>
</html>