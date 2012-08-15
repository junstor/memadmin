<?php

$langs['title']="MemAdmin";
$langs['info']="可视化的Memcache管理工具";
$langs['help']="帮助";
$langs['exit']="退出";

//memadmin.php
$langs['aboutcon']="服务器信息";
$langs['statsinfo']="统计信息";
$langs['settinginfo']="设置信息";
$langs['slabinfo']="区块统计";
$langs['iteminfo']="数据项统计";
$langs['sizeinfo']="对象数量统计";
$langs['monitor']="性能监控";
$langs['statmonitor']="统计监控";
$langs['datamonitor']="数据监控";
$langs['hitmonitor']="命中监控";
$langs['getset']="数据存取";
$langs['getdata']="读取数据";
$langs['setdata']="写入数据";
$langs['countcom']="计数命令";
$langs['flushallt']="全部失效";
$langs['exmod']="扩展功能";
$langs['itemtravt']="数据遍历";
$langs['itemfiltravt']="条件遍历";

//set_con.php
$langs['set_con_title']="服务器连接设置";
$langs['set_con_listtit']="服务器连接列表";
$langs['set_con_addcon']="添加服务器连接";
$langs['set_con_addconpool']="添加服务器连接池";
$langs['help_addcon']="Memcache::connect()方法添加一个服务器连接";
$langs['con_name']="名称";
$langs['con_host']="host"; 
$langs['con_port']="port";
$langs['con_name_def']="默认连接";
$langs['con_more']="高级参数";
$langs['con_timeout']="连接超时时间(timeout)";
$langs['con_pcon']="持久化连接(pconnect)";
$langs['con_se']="秒";
$langs['con_add']="添加";
$langs['help_addcp']="Memcache::addServer()方法添加一个服务器连接池";
$langs['conp_name']="连接池名称";
$langs['conp_name_def']="默认连接池";
$langs['conp_consltit']="服务器";
$langs['conp_pcon']="持久化连接(persistent)";
$langs['conp_status']="status";
$langs['con_retry']="retry_interval";
$langs['con_weight']="权重(weight)";
$langs['add_new_con']="加入一台服务器";
$langs['no_cons']="无服务器连接";
$langs['con_exist']="列表中已经存在一个参数相同的连接";
$langs['no_conname']="名称不能为空";
$langs['no_host']="host不能为空";
$langs['no_port']="端口不能为空";
$langs['con_del']="删除";
$langs['con_arg']="连接参数";
$langs['con_arg_pcon']="持久连接";
$langs['con_arg_yes']="是";
$langs['con_arg_no']="否";
$langs['con_arg_timeout']="超时时间";
$langs['con_arg_se']="秒";
$langs['con_arg_default']="默认";
$langs['con_failhost']="存在非法字符";
$langs['con_failport']="端口非法";
$langs['con_failtimeout']="连接超时时间输入非法";
$langs['con_havecon']="存在一个同名的连接";
$langs['con_listm']="管理";
$langs['con_call']="收起所有";
$langs['con_eall']="展开所有";
$langs['con_clearlist']="清空列表";
$langs['con_savelist']="保存列表";
$langs['con_confirm']="确定删除?";
$langs['con_confirm_clear']="确定清空列表 ? 保存在cookie中的信息将全部清空";
$langs['no_conpname']="连接池名称不能为空";
$langs['con_haveconp']="存在一个同名的连接池";
$langs['con_failweight']="权重输入非法";
$langs['con_failretry']="retry_interval";
$langs['con_failnoconp']="连接池中无服务器";
$langs['con_exist_conp']="列表中已经存在一个参数相同的连接池";
$langs['conp_statusfail']="status=FALSE";
$langs['conp_noweight']="无";
$langs['con_go']="开始管理";
$langs['con_nolist']="列表为空";
$langs['con_saveok']="列表保存成功";
$langs['con_clearok']="列表已清空";
$langs['con_listsavetime']="列表保存时间";
$langs['con_loadlist']="读取列表";
$langs['con_loadnotice']="载入保存在cookie中的列表，已有列表将被清空，确定载入？";

//memadmin.php
$langs['mad_con']="连接";
$langs['mad_conset']="连接设置";
$langs['mad_conlist']="连接列表";

//show_con.php
$langs['scon_tit']="连接信息";
$langs['scon_ptit']="连接池信息";
$langs['scon_type']='类型';
$langs['scon_mcon']="Memcache连接";
$langs['scon_mpcon']="Memcache持久连接";
$langs['scon_mconp']="Memcache连接池";
$langs['scon_confun']="连接函数";
$langs['scon_ispcon']="是否持久连接";
$langs['scon_condemo']="连接示例";
$langs['scon_conlist']="服务器列表";
$langs['scon_conser']="服务器";
$langs['scon_connum']="服务器数";
$langs['scon_nohave']="无";

//debug.php
$langs['run_time']="耗时";
$langs['run_memory']="内存";

//con_status.php
$langs['cs_tit']="服务器STATS信息";
$langs['confail']="服务器无法连接";
$langs['cs_arg']="参数";
$langs['cs_value']="值";
$langs['cs_desc']="描述";
$langs['cs_pid']="memcache服务器进程ID";
$langs['cs_uptime']="服务器已运行秒数";
$langs['cs_time']="服务器当前Unix时间戳";
$langs['cs_version']="memcache版本";
$langs['cs_libevent']="libevent版本";
$langs['cs_pointer_size']="操作系统指针大小";
$langs['cs_rusage_user']="进程累计用户时间";
$langs['cs_rusage_system']="进程累计系统时间";
$langs['cs_curr_connections']="当前连接数量";
$langs['cs_total_connections']="Memcached运行以来连接总数";
$langs['cs_connection_structures']="Memcached分配的连接结构数量";
$langs['cs_cmd_get']="get命令请求次数";
$langs['cs_cmd_set']="set命令请求次数";
$langs['cs_cmd_flush']="flush命令请求次数";
$langs['cs_get_hits']="get命令命中次数";
$langs['cs_get_misses']="get命令未命中次数";
$langs['cs_delete_hits']="delete命令命中次数";
$langs['cs_delete_misses']="delete命令未命中次数";
$langs['cs_incr_hits']="incr命令命中次数";
$langs['cs_incr_misses']="incr命令未命中次数";
$langs['cs_decr_hits']="decr命令命中次数";
$langs['cs_decr_misses']="decr命令未命中次数";
$langs['cs_cas_hits']="cas命令命中次数";
$langs['cs_cas_misses']="cas命令未命中次数";
$langs['cs_cas_badval']="使用擦拭次数";
$langs['cs_auth_cmds']="认证命令处理的次数";
$langs['cs_auth_errors']="认证失败数目";
$langs['cs_bytes_read']="读取总字节数";
$langs['cs_bytes_written']="发送总字节数";
$langs['cs_limit_maxbytes']="分配的内存总大小（字节）";
$langs['cs_accepting_conns']="接受新的连接";
$langs['cs_listen_disabled_num']="失效的监听数";
$langs['cs_threads']="当前线程数";
$langs['cs_conn_yields']="连接操作主动放弃数目";
$langs['cs_bytes']="当前存储占用的字节数";
$langs['cs_curr_items']="当前存储的数据总数";
$langs['cs_total_items']="启动以来存储的数据总数";
$langs['cs_evictions']="LRU释放的对象数目";
$langs['cs_reclaimed']="已过期的数据条目来存储新数据的数目";
$langs['nostats']="无法获取STATS信息，可能由于版本不支持所致";
$langs['cs_scon']="选择服务器";
$langs['cs_cmd_set_hits']="set命令命中次数（Tokyo Tyrant服务特有）";
$langs['cs_cmd_set_misses']="set命令未命中次数（Tokyo Tyrant服务特有）";
$langs['cs_cmd_delete']="delete命令请求次数（Tokyo Tyrant服务特有）";
$langs['cs_cmd_delete_hits']="delete命令未命中次数（Tokyo Tyrant服务特有）";
$langs['cs_cmd_delete_misses']="delete命令未命中次数（Tokyo Tyrant服务特有）";
$langs['cs_cmd_get_hits']="get命令命中次数（Tokyo Tyrant服务特有）";
$langs['cs_cmd_get_misses']="get命令未命中次数（Tokyo Tyrant服务特有）";
$langs['cs_reserved_fds']="内部使用的FD数";
$langs['cs_cmd_touch']="touch命令请求次数";
$langs['cs_touch_hits']="touch命令命中次数";
$langs['cs_touch_misses']="touch命令未命中次数";
$langs['cs_hash_power_level']="hash表等级";
$langs['cs_hash_bytes']="当前hash表大小";
$langs['cs_hash_is_expanding']="hash表正在扩展";
$langs['cs_expired_unfetched']="已过期但未获取的对象数目";
$langs['cs_evicted_unfetched']="已驱逐但未获取的对象数目";

//con_settings.php
$langs['sett_tit']="服务器SETTINGS信息";
$langs['sett_maxbytes']="最大字节数限制（0无限制）";
$langs['sett_maxconns']="允许最大连接数";
$langs['sett_tcpport']="TCP端口";
$langs['sett_udpport']="UDP端口";
$langs['sett_inter']="IP地址";
$langs['sett_verbosity']="日志（0=none,1=som,2=lots）";
$langs['sett_oldest']="最老对象过期时间";
$langs['sett_evictions']="LRU可用（on/off）";
$langs['sett_domain_socket']="Socketpath";
$langs['sett_umask']="创建Socket的掩码";
$langs['sett_growth_factor']="增长因子";
$langs['sett_chunk_size']="chunk大小（key+value+flags）";
$langs['sett_num_threads']="线程数（默认4,可通过-t参数设置）";
$langs['sett_num_threads_per_udp']="每UDP Socket中的工作线程数";
$langs['sett_stat_key_prefix']="stats分隔符";
$langs['sett_detail_enabled']="显示stats细节信息（yes/no）";
$langs['sett_reqs_per_event']="最大IO吞吐量（每event）";
$langs['sett_cas_enabled']="是否启用CAS（yes/no,-C禁用）";
$langs['sett_tcp_backlog']="TCP监控日志";
$langs['sett_binding_protocol']="绑定协议";
$langs['sett_auth_enabled_sasl']="是否启用SASL验证（yes/no）";
$langs['sett_item_size_max']="数据最大尺寸";
$langs['nosettings']="无法获取SETTINGS信息，可能由于无权限或版本不支持";
$langs['confail_tokyo_cabinet']="无法获取信息，可能由于该连接为支持 memcache 协议的其他服务（如 Tokyo Tyrant 等）";
$langs['sett_maxconns_fast']="达到最大连接时是否报错并关闭连接";
$langs['sett_hashpower_init']="初始hash表等级";
$langs['sett_slab_reassign']="是否开启slab重分配";
$langs['sett_slab_automove']="slab自动重分配";

//con_items.php
$langs['items_tit']="服务器ITEMS信息";
$langs['noitems']="无法获取ITEMS信息，可能由于 memcache 中暂无数据";
$langs['noitems_conp']="无法获取ITEMS信息，可能由于 memcache 中暂无数据或无法连接";
$langs['items_sslab']="选择内存区块";
$langs['items_number']="该slab中对象数（不包含过期对象）";
$langs['items_age']="LRU队列中最老对象的过期时间";
$langs['items_evicted']="LRU释放对象数";
$langs['items_evicted_nonzero']="设置了非0时间的LRU释放对象数";
$langs['items_evicted_time']="最后一次LRU释放的对象存在时间";
$langs['items_outofmemory']="不能存储对象次数";
$langs['items_tailrepairs']="修复slabs次数";
$langs['items_reclaimed']="使用过期对象空间存储对象次数";
$langs['items_expired_unfetched']="已过期但未获取的对象数目";
$langs['items_evicted_unfetched']="已驱逐但未获取的对象数目";

//con_sizes.php
$langs['size_tit']="服务器SIZES信息";
$langs['nosizes']="无法获取SIZES信息，可能由于 memcache 中暂无数据";

//con_slabs.php
$langs['slabs_tit']="服务器SLABS信息";
$langs['noslabs']="无法获取SLABS信息";
$langs['slabs_sslab']="选择内存区块";
$langs['slabs_active_slabs']="slab数量";
$langs['slabs_total_malloced']="总内存数量";
$langs['slabs_chunk_size']="chunk大小（byte）";
$langs['slabs_chunks_per_page']="每个page的chunk数量";
$langs['slabs_total_pages']="page数量";
$langs['slabs_total_chunks']="chunk总数量（chunks_per_page*total_pages）";
$langs['slabs_used_chunks']="已被分配的chunk数量";
$langs['slabs_free_chunks']="过期数据空出的chunk数";
$langs['slabs_free_chunks_end']="从未被使用过的chunk数";
$langs['slabs_mem_requested']="请求存储的字节数";
$langs['slabs_get_hits']="get命令命中数";
$langs['slabs_cmd_set']="set命令请求数";
$langs['slabs_delete_hits']="delete命令命中数";
$langs['slabs_incr_hits']="incr命令命中数";
$langs['slabs_decr_hits']="decr命令命中数";
$langs['slabs_cas_hits']="cas命令命中数";
$langs['slabs_cas_badval']="cas数据类型错误数";
$langs['noslabs_conp']="无法获取SLABS信息";
$langs['noslabs_noitems']="无法获取SLABS信息，可能由于 memcache 中暂无数据";
$langs['slabs_touch_hits']="touch命令命中数";

//stats_monitor.php
$langs['statsmo_tit']="统计信息监控";
$langs['statsmo_check']="选择";
$langs['statsmo_scon']="选择要监控的服务器";
$langs['statsmo_arg']="选择要监控的参数";
$langs['nocheck']="请选择至少一个监控参数";
$langs['statsmo_sall']="全选";
$langs['statsmo_call']="取消";
$langs['statsmo_oall']="反选";
$langs['statsmo_start']="开始监控";

//show_monitor_stats.php
$langs['showmo_stats_tit']="统计信息监控";
$langs['showmo_stats_conptit']="中的服务器";
$langs['showmo_nostats']="无法获取STATS信息，监控终止";
$langs['showmo_relayout']="恢复布局";
$langs['showmo_aftit']="自动刷新";
$langs['showmo_afstart']="开始";
$langs['showmo_afstop']="停止";
$langs['showmo_lasttime']="上次刷新时间";
$langs['afsempty']="刷新时间不能为空";
$langs['afsfail']="刷新时间填写非法";
$langs['afsjsonfail']="刷新失败，监控终止";
$langs['sautof_des']="秒自动刷新";

//data_monitor.php
$langs['datamo_tit']="数据监控";
$langs['datamo_noitems']="memcache 中暂无数据，无法进行监控";
$langs['datamo_arg_tit']="Memcache 服务器数据状态监控";
$langs['datamo_slabarg']="SLAB 参数";
$langs['datamo_gloarg']="全局参数";
$langs['showmo_data_tit']="数据信息监控";
$langs['showmo_data_lostmem']="被浪费内存数";
$langs['showmo_slab_arg']="SLAB 参数";

//hit_monitor.php
$langs['hm_gettit']="GET 命中情况";
$langs['hm_deletetit']="DELETE 命中情况";
$langs['hm_incrtit']="INCR 命中情况";
$langs['hm_decrtit']="DECR 命中情况";
$langs['hm_castit']="CAS 命中情况";
$langs['hm_settit']="SET 命中情况";
$langs['hm_touchtit']="TOUCH 命中情况";

//show_monitor_hit.php
$langs['hitmo_tit']="命中情况监控";
$langs['hitmo_cmdcount']="请求总数";
$langs['hitmo_hitcount']="命中次数";
$langs['hitmo_misscount']="未命中次数";
$langs['hitmo_hitrate']="命中率";
$langs['hitmo_hittit']="命中情况";
$langs['hitmo_nochart']="暂无统计图";
$langs['hitmo_hit']="命中";
$langs['hitmo_miss']="未命中";

//mem_get.php
$langs['memg_tit']="GET 操作";
$langs['memg_nokey']="请输入要查询的KEY";
$langs['memg_delconfirm']="确定从memcached中立即删除？";
$langs['memg_unserfail']="反序列化失败，非序列化字符串";
$langs['memg_inputnot']="查询多个KEY以 空格 分隔";
$langs['memg_notget']="未查到";
$langs['memg_getres']="查询结果";
$langs['memg_resnot']="数组/对象 序列化后显示，JSON字符串反序列化后以数组形式显示";
$langs['memg_geterror']="错误：无法解压缩或反序列化，原因可能为设置了对应的flags位，但内容为非有效的压缩或序列化格式";
$langs['memg_butvalue']="查询";
$langs['memg_ser']="序列化";
$langs['memg_unser']="反序列化";
$langs['memg_tnum']="获取总数";
$langs['memg_updateres']="刷新";
$langs['memg_reget']="编码指定错误，尝试转换编码中";

//mem_set.php
$langs['mems_tit']="写入数据";
$langs['mems_noempty']="KEY或VALUE不能为空";
$langs['mems_setsuss']="保存成功";
$langs['mems_settit']="数据存储";
$langs['mems_consavefail']="保存失败";
$langs['mems_conpsavefail']="保存记录失败，原因可能为连接池根据CRC32规则映射到的服务器不可用";

//mem_count.php
$langs['mems_counttit']="计数命令";
$langs['mems_countsuss']="设置成功，修改后的VALUE值： ";
$langs['mems_countfail']="设置失败，无该KEY或VALUE不为数值";
$langs['mems_valuenonum']="VALUE只能为正整数";
$langs['mems_countsave']="保存";


//item_trav.php
$langs['itemt_tit']="数据遍历";
$langs['itemt_nonum']="遍历数目不能为空";
$langs['itemt_numonly']="只能为正整数";
$langs['itemt_numwrong']="数目填写过大";
$langs['itemt_notexist']="该条记录不存在或已失效";
$langs['itemt_novaluetime']="失效时间";
$langs['itemt_loading']="数据载入中";
$langs['itemt_conpgeterror']="该记录不存在或已失效，或连接池无法根据CRC32规则访问该记录，如需遍历请单独对该台服务器进行遍历";
$langs['itemt_getres']="遍历结果";
$langs['itemt_prepage']="上一页";
$langs['itemt_nexpage']="下一页";
$langs['itemt_pagenumno']="输入正确的页数";
$langs['itemt_pagingerr']="遍历失败，可能由于该页元素已失效或数据量太大";
$langs['itemt_totalnum']="记录总数";
$langs['itemt_sleslabid']="选择区块";
$langs['itemt_slabtotalnum']="区块内共有记录";
$langs['itemt_travtit']="遍历前";
$langs['itemt_travtitnum']="条记录";
$langs['itemt_getbut']="获取数据";
$langs['itemt_numnott']="由于memcached源码对cachedump命令的限制，最多遍历2M的key";
$langs['itemt_moreinfo']="更多";
$langs['itemt_closemore']="收起";
$langs['itemt_size']="大小";
$langs['itemt_expiretime']="永久有效";
$langs['itemt_valuetype']="类型";
$langs['itemt_charsettit']="字符集";

//item_filtertrav.php
$langs['itemft_tit']="条件遍历";
$langs['itemft_nofiltercheck']="请对KEY或VALUE进行限定";
$langs['itemft_filterkeyemp']="限定KEY的正则表达式不能为空";
$langs['itemft_filtervalueemp']="限定VALUE的正则表达式不能为空";
$langs['itemft_keyfilterfail']="限定KEY的正则表达式输入错误";
$langs['itemft_valuefilterfail']="限定VALUE的正则表达式输入错误";
$langs['itemft_noreturn']="未查到符合条件的记录";
$langs['itemft_conpcannotfilter']="连接池无法根据CRC32规则访问该记录，无法确定该记录是否满足VALUE限定条件，请单独遍历该台服务器";
$langs['itemft_keyfiltertit']="对 KEY 限定条件";
$langs['itemft_valuefiltertit']="对 VALUE 限定条件";
$langs['itemft_filter']="正则表达式";
$langs['itemft_perlonly']="仅支持 Perl兼容正则表达式";
$langs['itemft_demo']="正则表达式示例";
$langs['itemft_notforvalue']="对VALUE进行条件限定会遍历所有数据，消耗较大，对于数组/对象等结构先序列化后匹配，请考虑序列化过程产生的额外字符对结果的影响";
$langs['itemft_close']="关闭";
$langs['itemft_demo1']="包含abc";
$langs['itemft_demo2']="包含abc且不区分大小写";
$langs['itemft_demo3']="以abc开头";
$langs['itemft_demo4']="以abc结尾";
$langs['itemft_demo5']="以数字结尾";
$langs['itemft_demo6']="不包含字母a和b";

//mem_flush.php
$langs['flush_tit']="全部失效";
$langs['flush_delnot']="确定使全部记录失效吗？";
$langs['flush_delok']="完成";
$langs['flush_not']="立即使所有已经存在的元素失效，请谨慎使用";
$langs['flush_but']="全部失效";
?>