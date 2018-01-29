<?php 

namespace App\Services;
use App\Upload;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\User;
use App\Tourist;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Support\Facades\Auth;

class CreateService
{

    function getIP() { 
    if (getenv('HTTP_CLIENT_IP')) { 
    $ip = getenv('HTTP_CLIENT_IP'); 
    } 
    elseif (getenv('HTTP_X_FORWARDED_FOR')) { 
    $ip = getenv('HTTP_X_FORWARDED_FOR'); 
    } 
    elseif (getenv('HTTP_X_FORWARDED')) { 
    $ip = getenv('HTTP_X_FORWARDED'); 
    } 
    elseif (getenv('HTTP_FORWARDED_FOR')) { 
    $ip = getenv('HTTP_FORWARDED_FOR'); 

    } 
    elseif (getenv('HTTP_FORWARDED')) { 
    $ip = getenv('HTTP_FORWARDED'); 
    } 
    else { 
    $ip = $_SERVER['REMOTE_ADDR']; 
    } 
    return $ip; 
    } 


    public function opinion($request)/*点赞逻辑*/
    {
        $ip = $this->getIP();
        $article_id = $request->id;//文章id
        $opinion = $request->type; //支持或反对 0/1
        $the_tourist = Tourist::find($ip);
        // return var_dump($the_touurist);
        // dd($the_tourist);
        if($the_tourist==NULL||!(isset($obj)))//不存在
        {
            Tourist::create(['ip'=>$ip,'s_article_id'=>$article_id,'opinion'=>$opinion]);/*创建一个*/
            return true;
        }
        else
        {
            if($this->isData(false,$request)<2)//存在一个对应值 b不应该继续点赞
            {
                return false;
            }
            /*保存*/
            else
            {
                $this->isData(true,$request);
            }
        }
    }   

    public function creator($type,$request)
    {
    	if ($request->hasFile('file')&&$request->file('file')->isValid()) 
    	{
    		$file = $request->file('file');
    		$extension = $request->file->getClientOriginalExtension();
    		$path = $file->store('upload/'.Auth::id());
    		Upload::create(['path'=>"$path",'type'=>"$type",'user_id'=>Auth::id()]);
            return url($path);
		}
    }
    public function judgeTime($timeSize)/*传入ip的地址，与限制时间大小*/
    {
        $ip = $this->getIP();
        if(session()->has($ip))
        {
            if(time()-session($ip)<$timeSize)
            {
                return $timeSize-(time()-session($ip));
            }
            else
            {
                session([$ip=>time()]);
                return true;
            }
        }
        else
        {
            session([$ip=>time()]);
            return true;
        }
    }
    public function isData($saveData,$request)
    {
            /*获取数据库信息*/
            


            $ip = $_SERVER['REMOTE_ADDR'];
            $the_tourist = Tourist::find($ip);
            if($the_tourist==NULL)
                return 2;
            $s_article_id = $the_tourist->s_article_id;
            $s_opinion = $the_tourist->opinion;
            $arr_article = explode(';',$s_article_id);//分割成数组
            $arr_opinion = explode(';',$s_opinion);


            $article_id = $request->id;//文章id
            $opinion = $request->type; //支持或反对 0/1


            

            if(in_array($article_id,$arr_article))//在里面
            {
                $article_index = array_search($article_id,$arr_article);
                return $arr_opinion[$article_index];/*返回观点*/
            }
            else
            {
                if($saveData)
                {
                    $s_article_id = $s_article_id.";".$article_id;
                    
                    $s_opinion = $s_opinion.";".$opinion;
                    /*跟新保存*/
                    $the_tourist->s_article_id = $s_article_id;
                    $the_tourist->opinion = $s_opinion;
                    $the_tourist->save();
                }
                return 2;/*返回一个大于1得数 来判断是否有结果s*/
            }
    }

}
