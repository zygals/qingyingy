<?php


namespace Admin\Controller;

class PublicController extends ComController
{

    
    public function sql()
    {
        $this->display();
    }

   
    public function update()
    {
		if(get_magic_quotes_gpc()){
			$sql=I('post.sql','','strtolower,stripslashes');
		}else{
			$sql=I('post.sql','','strtolower');
		}
        
		$sql=str_replace('qw_',C('DB_PREFIX'),$sql);
		$sql=str_replace('[db_pre]',C('DB_PREFIX'),$sql);

        if (!$sql) {
            $this->error('请填写sql语句！');
        }
		
        $m=M();
		$res=$m->execute($sql);
		
		addlog('执行SQL语句 成功' );
		$this->success('恭喜，操作成功！');
        
    }
}