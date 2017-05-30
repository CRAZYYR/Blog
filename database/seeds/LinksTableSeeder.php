<?php

use Illuminate\Database\Seeder;

class LinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$data=[
    	[
    	'link_name'=>'帅家军',
    	'link_title'=>'国内最大的集团',
    	'link_url'=>'http://www.baidu.com',
    	'link_order'=>1,
    	],
    	[
    	'link_name'=>'帅家论坛',
    	'link_title'=>'国内最大的论坛',
    	'link_url'=>'http://bbs.bolg.cn',
    	'link_order'=>2,
    	]
    ];
        DB::table('links')->insert($data);
    }
}
