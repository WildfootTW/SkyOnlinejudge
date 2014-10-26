<?php
if(!defined('IN_SKYOJSYSTEM'))
{
    exit('Access denied');
}
require_once('class_zjcore.inc.php');
class class_zerojudge{
    public $version = '1.0';
    public $name = 'ZJ capturer';
	public $description = 'Zerojudge capturer';
	public $copyright = 'by ECHO_STATS';
	public $pattern = "/^zj:[a-z]{1}[0-9]+$/";
	private $zjcore;

	function __construct()
	{
	    $this->zjcore = new zjcore;
	    $this->zjcore->websiteurl = "http://zerojudge.tw/";
	    $this->zjcore->classname  = "class_zerojudge";
	}
	
	function install()
	{
	    $tb = DB::tname('ojlist');
	    DB::query("INSERT INTO `$tb`
	            (`id`, `class`, `name`, `description`, `available`) VALUES
	            (NULL,'class_zerojudge','Zerojudge','Account Name',1)");
	}
	
	function checkid($id)
	{
	    return $this->zjcore->checkid($id);
	}
	
    function preprocess($userlist,$problems)
    {
        global $_E;
        $this->zjcore->preprocess($userlist,$problems);
        return ;
    }
    
	function query($uid,$pid)
	{
	    global $_E;
	    $pid = $this->zjcore->reg_problemid($pid);
	    return $this->zjcore->query($uid,$pid);
	}
	
	function showname($pid){
	    $pname = $this->zjcore->reg_problemid($pid);
	    return "<a href='http://zerojudge.tw/ShowProblem?problemid=$pname' target='_blank'>ZJ $pname</a>";
	}
}