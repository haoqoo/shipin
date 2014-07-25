shipin
======

视频聚合信息


1.创建wp数据库，之后导入wp.sql文件
2.修改wp_options表数据
update wp_options set option_value='http://localhost/~qintao/shipin' where option_id=1;
http://localhost/~qintao/shipin更改为本地的路径。
