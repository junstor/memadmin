<?php

$langs['title']="MemAdmin";
$langs['info']="A GUI Administration for memcached";
$langs['help']="Help";
$langs['exit']="Logout";

//memadmin.php
$langs['aboutcon']="Con Analysis";
$langs['statsinfo']="Stats";
$langs['settinginfo']="Settings";
$langs['slabinfo']="Slabs";
$langs['iteminfo']="Items";
$langs['sizeinfo']="Sizes";
$langs['monitor']="Monitors";
$langs['statmonitor']="Statistics";
$langs['datamonitor']="Data";
$langs['hitmonitor']="Hit Rate";
$langs['getset']="Storage";
$langs['getdata']="Get";
$langs['setdata']="Set";
$langs['countcom']="Count";
$langs['flushallt']="Flush All";
$langs['exmod']="Modules";
$langs['itemtravt']="Traverse";
$langs['itemfiltravt']="Filter";

//set_con.php
$langs['set_con_title']="Connection Settings";
$langs['set_con_listtit']="Connection List";
$langs['set_con_addcon']="Add Connection";
$langs['set_con_addconpool']="Add Connection Pool";
$langs['help_addcon']="Add a connection with Memcache::connect() method";
$langs['con_name']="Name";
$langs['con_host']="host"; 
$langs['con_port']="port";
$langs['con_name_def']="Default connection";
$langs['con_more']="More";
$langs['con_timeout']="timeout";
$langs['con_pcon']="pconnect";
$langs['con_se']="s";
$langs['con_add']="Add";
$langs['help_addcp']="Add a connection pool with Memcache::addServer() method";
$langs['conp_name']="Name";
$langs['conp_name_def']="Default connection pool";
$langs['conp_consltit']="Server";
$langs['conp_pcon']="persistent";
$langs['conp_status']="status";
$langs['con_retry']="retry_interval";
$langs['con_weight']="weight";
$langs['add_new_con']="Add a server";
$langs['no_cons']="No connection list";
$langs['con_exist']="Exists a same parameter connection in the list";
$langs['no_conname']="name cannot be empty";
$langs['no_host']="host cannot be empty";
$langs['no_port']="port cannot be empty";
$langs['con_del']="Delete";
$langs['con_arg']="Parameters";
$langs['con_arg_pcon']="persistent";
$langs['con_arg_yes']="Yes";
$langs['con_arg_no']="No";
$langs['con_arg_timeout']="timeout";
$langs['con_arg_se']="s";
$langs['con_arg_default']="Default";
$langs['con_failhost']="Illegal character exists";
$langs['con_failport']="Illegal port";
$langs['con_failtimeout']="Illegal timeout";
$langs['con_havecon']="Exists a same name connection in the list";
$langs['con_listm']="Management";
$langs['con_call']="Collapse";
$langs['con_eall']="Expand";
$langs['con_clearlist']="Clear List";
$langs['con_savelist']="Save List";
$langs['con_confirm']="Really Delete?";
$langs['con_confirm_clear']="Really clear the list? The information stored in cookie will be lost";
$langs['no_conpname']="name cannot be empty";
$langs['con_haveconp']="Exists a same name connection pool in the list";
$langs['con_failweight']="Illegal weight";
$langs['con_failretry']="retry_interval";
$langs['con_failnoconp']="No server in the connection pool";
$langs['con_exist_conp']="Exists a same parameter connection pool in the list";
$langs['conp_statusfail']="status=FALSE";
$langs['conp_noweight']="No";
$langs['con_go']="Manage";
$langs['con_nolist']="List Empty";
$langs['con_saveok']="Save successfully";
$langs['con_clearok']="Clear successfully";
$langs['con_listsavetime']="Save Time";
$langs['con_loadlist']="Load List";
$langs['con_loadnotice']="Load the list in cookie,the current list will be cleared?";

//memadmin.php
$langs['mad_con']="Con";
$langs['mad_conset']="Set Con";
$langs['mad_conlist']="Connection List";

//show_con.php
$langs['scon_tit']="Con Info";
$langs['scon_ptit']="Connection Pool Information";
$langs['scon_type']='Type';
$langs['scon_mcon']="Memcache connect";
$langs['scon_mpcon']="Memcache pconnect";
$langs['scon_mconp']="Memcache Connection Pool";
$langs['scon_confun']="Connection method";
$langs['scon_ispcon']="is pconnect";
$langs['scon_condemo']="Connect Demo";
$langs['scon_conlist']="Server List";
$langs['scon_conser']="Server";
$langs['scon_connum']="Server num";
$langs['scon_nohave']="no";

//debug.php
$langs['run_time']="Time";
$langs['run_memory']="Mem";

//con_status.php
$langs['cs_tit']="STATS";
$langs['confail']="Server can not be connected";
$langs['cs_arg']="Parameter";
$langs['cs_value']="Value";
$langs['cs_desc']="Description";
$langs['cs_pid']="memcache process id";
$langs['cs_uptime']="number of seconds since the process was started";
$langs['cs_time']="current time";
$langs['cs_version']="memcache version";
$langs['cs_libevent']="libevent version";
$langs['cs_pointer_size']="system pointer size ";
$langs['cs_rusage_user']="seconds the cpu has devoted to the process as the user";
$langs['cs_rusage_system']="seconds the cpu has devoted to the process as the system";
$langs['cs_curr_connections']="current number of open connections to memcached";
$langs['cs_total_connections']="total number of open connections to memcached";
$langs['cs_connection_structures']="the number of allocated connection structures";
$langs['cs_cmd_get']="total GET commands number";
$langs['cs_cmd_set']="total SET commands number";
$langs['cs_cmd_flush']="total FLUSH commands number";
$langs['cs_get_hits']="total GET hits number";
$langs['cs_get_misses']="total GET misses number";
$langs['cs_delete_hits']="total DELETE hits number";
$langs['cs_delete_misses']="total DELETE misses number";
$langs['cs_incr_hits']="total INCR hits number";
$langs['cs_incr_misses']="total INCR misses number";
$langs['cs_decr_hits']="total DECR hits number";
$langs['cs_decr_misses']="total DECR misses number";
$langs['cs_cas_hits']="total CAS hits number";
$langs['cs_cas_misses']="total CAS misses number";
$langs['cs_cas_badval']="number of CAS hits on this chunk where the existing value did not match";
$langs['cs_auth_cmds']="indicates the total number of authentication attempts.";
$langs['cs_auth_errors']="indicates the number of failed authentication attempts";
$langs['cs_bytes_read']="total number of bytes read by this server from network";
$langs['cs_bytes_written']="total number of bytes sent by this server to network";
$langs['cs_limit_maxbytes']="number of bytes this server is allowed to use for storage（byte）";
$langs['cs_accepting_conns']="accepting connections（0/1）";
$langs['cs_listen_disabled_num']="number of disabled listen";
$langs['cs_threads']="number of threads";
$langs['cs_conn_yields']="number of times any connection yielded to another";
$langs['cs_bytes']="current number of bytes used by this server to store items";
$langs['cs_curr_items']="current number of items stored by the server";
$langs['cs_total_items']="total number of items stored by this server ever since it started";
$langs['cs_evictions']="number of valid items removed from cache to free memory for new items";
$langs['cs_reclaimed']="how many times memcached re-used expired items";
$langs['nostats']="can not get STATS information";
$langs['cs_scon']="Select Server";
$langs['cs_cmd_set_hits']="total SET hits number（Tokyo Tyrant only）";
$langs['cs_cmd_set_misses']="total SET misses number（Tokyo Tyrant only）";
$langs['cs_cmd_delete']="total DELETE commands number（Tokyo Tyrant only）";
$langs['cs_cmd_delete_hits']="total DELETE hits number（Tokyo Tyrant only）";
$langs['cs_cmd_delete_misses']="total DELETE misses number（Tokyo Tyrant only）";
$langs['cs_cmd_get_hits']="total GET hits number（Tokyo Tyrant only）";
$langs['cs_cmd_get_misses']="total GET misses number（Tokyo Tyrant only）";
$langs['cs_reserved_fds']="number of misc fds used internally";
$langs['cs_cmd_touch']="total TOUCH commands number";
$langs['cs_touch_hits']="total TOUCH hits number";
$langs['cs_touch_misses']="total TOUCH misses number";
$langs['cs_hash_power_level']="hash table level";
$langs['cs_hash_bytes']="size of hash table";
$langs['cs_hash_is_expanding']="hash table is expanding";
$langs['cs_expired_unfetched']="number of items which expired but never touched";
$langs['cs_evicted_unfetched']="number of items which evicted but never touched";

//con_settings.php
$langs['sett_tit']="SETTINGS";
$langs['sett_maxbytes']="the maximum number of bytes limited（0 no limited）";
$langs['sett_maxconns']="maximum number of connections allowed";
$langs['sett_tcpport']="TCP port";
$langs['sett_udpport']="UDP port";
$langs['sett_inter']="IP address";
$langs['sett_verbosity']="log（0=none,1=som,2=lots）";
$langs['sett_oldest']="the oldest object expiration time";
$langs['sett_evictions']="LRU is available（on/off）";
$langs['sett_domain_socket']="Socketpath";
$langs['sett_umask']="socket umask";
$langs['sett_growth_factor']="growth factor";
$langs['sett_chunk_size']="chunk size（key+value+flags）";
$langs['sett_num_threads']="number of threads（4 default,with -t to set）";
$langs['sett_num_threads_per_udp']="number of worker threads serving each udp";
$langs['sett_stat_key_prefix']="character that marks a key prefix for stats";
$langs['sett_detail_enabled']="nonzero if we're collecting detailed stats（yes/no）";
$langs['sett_reqs_per_event']="maximum number of io to process on each io-event （every event）";
$langs['sett_cas_enabled']="CAS is able（yes/no,-C to be disabled）";
$langs['sett_tcp_backlog']="TCP log";
$langs['sett_binding_protocol']="binding protocol";
$langs['sett_auth_enabled_sasl']="SASL is able（yes/no）";
$langs['sett_item_size_max']="maximum size of item";
$langs['nosettings']="No SETTINGS Information can be get,no permissions or version does not support";
$langs['confail_tokyo_cabinet']="No SETTINGS Information can be get,maybe the connection is Tokyo Tyrant or other memcached protocol service";
$langs['sett_maxconns_fast']="writes an error and closes the connection when connect the maximum";
$langs['sett_hashpower_init']="hash table level init";
$langs['sett_slab_reassign']="slab can be reassigned";
$langs['sett_slab_automove']="slab auto reassign";

//con_items.php
$langs['items_tit']="ITEMS";
$langs['noitems']="No ITEMS Information can be get,maybe there is no item in the memcached";
$langs['noitems_conp']="No ITEMS Information can be get,maybe there is no item in the memcached";
$langs['items_sslab']="Select Slab";
$langs['items_number']="number of items in this slab（Do not contain an expired object）";
$langs['items_age']="the oldest object expiration time in LRU queue";
$langs['items_evicted']="number of LRU release the objects";
$langs['items_evicted_nonzero']="the object was evicted early and did not have an infinite expiration time";
$langs['items_evicted_time']="how many seconds it's been since the last item to be evicted";
$langs['items_outofmemory']="number of items that can not be stored";
$langs['items_tailrepairs']="times of repair the slabs";
$langs['items_reclaimed']="how many times memcached re-used expired items";
$langs['items_expired_unfetched']="number of items which expired but never touched";
$langs['items_evicted_unfetched']="number of items which evicted but never touched";

//con_sizes.php
$langs['size_tit']="SIZES";
$langs['nosizes']="No SIZES Information can be get,maybe there is no item in the memcached";

//con_slabs.php
$langs['slabs_tit']="SLABS";
$langs['noslabs']="No SLABS Information can be get";
$langs['slabs_sslab']="Select Slab";
$langs['slabs_active_slabs']="number of slabs";
$langs['slabs_total_malloced']="total memory to be malloced";
$langs['slabs_chunk_size']="chunk size（byte）";
$langs['slabs_chunks_per_page']="chunk size of per page";
$langs['slabs_total_pages']="number of pages";
$langs['slabs_total_chunks']="total number of chunks（chunks_per_page*total_pages）";
$langs['slabs_used_chunks']="number of chunks that be used";
$langs['slabs_free_chunks']="number of chunks left";
$langs['slabs_free_chunks_end']="number of free chunks at the end of the last allocated page";
$langs['slabs_mem_requested']="the true amount of memory of memory requested within this chunk";
$langs['slabs_get_hits']="GET hits number";
$langs['slabs_cmd_set']="SET commands number";
$langs['slabs_delete_hits']="DELETE hits number";
$langs['slabs_incr_hits']="INCR hits number";
$langs['slabs_decr_hits']="DECR hits number";
$langs['slabs_cas_hits']="CAS hits number";
$langs['slabs_cas_badval']="number of CAS hits on this chunk where the existing value did not match";
$langs['noslabs_conp']="No SLABS Information can be get";
$langs['noslabs_noitems']="No SLABS Information can be get,maybe there is no item in the memcached";
$langs['slabs_touch_hits']="TOUCH hits number";

//stats_monitor.php
$langs['statsmo_tit']="Statistics Monitor";
$langs['statsmo_check']="Check";
$langs['statsmo_scon']="Select the server to be monitored";
$langs['statsmo_arg']="Select the parameters to be monitored";
$langs['nocheck']="Please select at least one monitoring parameter";
$langs['statsmo_sall']="All";
$langs['statsmo_call']="Cancel";
$langs['statsmo_oall']="Inverse";
$langs['statsmo_start']="Start";

//show_monitor_stats.php
$langs['showmo_stats_tit']="Statistics Monitor";
$langs['showmo_stats_conptit']="Server";
$langs['showmo_nostats']="No STATS Information can be get,monitor stop";
$langs['showmo_relayout']="Resume layout";
$langs['showmo_aftit']="Auto Refresh";
$langs['showmo_afstart']="Start";
$langs['showmo_afstop']="Stop";
$langs['showmo_lasttime']="Last refresh time";
$langs['afsempty']="time can not be empty";
$langs['afsfail']="Illegal time";
$langs['afsjsonfail']="Refresh fail,stop monitor";
$langs['sautof_des']="s auto Refresh";

//data_monitor.php
$langs['datamo_tit']="Data Monitor";
$langs['datamo_noitems']="There is no item in the memcached,can not be monitored";
$langs['datamo_arg_tit']="Memcache Data Monitor";
$langs['datamo_slabarg']="SLAB Parameter";
$langs['datamo_gloarg']="Global Parameter";
$langs['showmo_data_tit']="Data Information Monitor";
$langs['showmo_data_lostmem']="number of memory that be wasted";
$langs['showmo_slab_arg']="SLAB Parameter";

//hit_monitor.php
$langs['hm_gettit']="GET Hits";
$langs['hm_deletetit']="DELETE Hits";
$langs['hm_incrtit']="INCR Hits";
$langs['hm_decrtit']="DECR Hits";
$langs['hm_castit']="CAS Hits";
$langs['hm_settit']="SET Hits";
$langs['hm_touchtit']="TOUCH Hits";

//show_monitor_hit.php
$langs['hitmo_tit']="Hits Monitor";
$langs['hitmo_cmdcount']="Requests";
$langs['hitmo_hitcount']="Hits";
$langs['hitmo_misscount']="Misses";
$langs['hitmo_hitrate']="Hit Rate";
$langs['hitmo_hittit']="Hits";
$langs['hitmo_nochart']="No chart";
$langs['hitmo_hit']="hit";
$langs['hitmo_miss']="miss";

//mem_get.php
$langs['memg_tit']="GET Command";
$langs['memg_nokey']="Input the KEY";
$langs['memg_delconfirm']="be sure to delete?";
$langs['memg_unserfail']="Unserialize fail,the value can not be unserialized";
$langs['memg_inputnot']="more than one key,separated by space";
$langs['memg_notget']="No result";
$langs['memg_getres']="Results";
$langs['memg_resnot']="Auto serialize array/object,JSON after unserialize displayed as an array";
$langs['memg_geterror']="WRONG：can not be decompressed or unserialized,the reason the flag is wrong";
$langs['memg_butvalue']="Get";
$langs['memg_ser']="Serialize";
$langs['memg_unser']="Unserialize";
$langs['memg_tnum']="Total Num";
$langs['memg_updateres']="Refresh";
$langs['memg_reget']="charset is wrong，try to transform";

//mem_set.php
$langs['mems_tit']="Set Command";
$langs['mems_noempty']="KEY or VALUE can not be empty";
$langs['mems_setsuss']="Set Successfully";
$langs['mems_settit']="Set";
$langs['mems_consavefail']="Set Fail";
$langs['mems_conpsavefail']="Set Fail，the reason may be CRC32 rules mapped to the server is unavailable";

//mem_count.php
$langs['mems_counttit']="Count Command";
$langs['mems_countsuss']="Count Successfully,VALUE after count： ";
$langs['mems_countfail']="Count Fail,no KEY exists or the VALUE is not a number";
$langs['mems_valuenonum']="VALUE can only be positive number";
$langs['mems_countsave']="Save";


//item_trav.php
$langs['itemt_tit']="Items Traverse";
$langs['itemt_nonum']="Traverse num can not be empty";
$langs['itemt_numonly']="positive number only";
$langs['itemt_numwrong']="number is too large";
$langs['itemt_notexist']="the item does no exists or be expired";
$langs['itemt_novaluetime']="expired time";
$langs['itemt_loading']="Loading";
$langs['itemt_conpgeterror']="the item does no exists or be expired,or CRC32 rules mapped to the server fail";
$langs['itemt_getres']="Results";
$langs['itemt_prepage']="Previous";
$langs['itemt_nexpage']="Next";
$langs['itemt_pagenumno']="Enter the correct number of pages";
$langs['itemt_pagingerr']="Traverse Fail";
$langs['itemt_totalnum']="Total Num";
$langs['itemt_sleslabid']="Select Slab";
$langs['itemt_slabtotalnum']="number";
$langs['itemt_travtit']="Get the first";
$langs['itemt_travtitnum']="items";
$langs['itemt_getbut']="Traverse";
$langs['itemt_numnott']="2MB max response size for csachedump";
$langs['itemt_moreinfo']="More";
$langs['itemt_closemore']="Close";
$langs['itemt_size']="Size";
$langs['itemt_expiretime']="No";
$langs['itemt_valuetype']="Type";
$langs['itemt_charsettit']="Charset";

//item_filtertrav.php
$langs['itemft_tit']="Filter";
$langs['itemft_nofiltercheck']="Please limited the KEY or VALUE";
$langs['itemft_filterkeyemp']="the Regular Expressions of Key can not be empty";
$langs['itemft_filtervalueemp']="the Regular Expressions of Value can not be empty";
$langs['itemft_keyfilterfail']="the Regular Expressions of Key is wrong";
$langs['itemft_valuefilterfail']="the Regular Expressions of Value is wrong";
$langs['itemft_noreturn']="No items";
$langs['itemft_conpcannotfilter']="the connection pool can not visit items with CRC32 rules,can not determine whether the item is you want";
$langs['itemft_keyfiltertit']="Limited the KEY";
$langs['itemft_valuefiltertit']="Limited the VALUE";
$langs['itemft_filter']="Regex";
$langs['itemft_perlonly']="Accept Perl-compatible Regex";
$langs['itemft_demo']="Regex Demo";
$langs['itemft_notforvalue']="Limited the VALUE will GET all items,serialize array/object first,then match them,please mind the extra char after serialize";
$langs['itemft_close']="Close";
$langs['itemft_demo1']="Contains abc";
$langs['itemft_demo2']="Contains abc and ignore case";
$langs['itemft_demo3']="Begin with abc";
$langs['itemft_demo4']="End with abc";
$langs['itemft_demo5']="End with digital";
$langs['itemft_demo6']="Don't include letters a and b";

//mem_flush.php
$langs['flush_tit']="Flush All";
$langs['flush_delnot']="Really Flush All?";
$langs['flush_delok']="Done";
$langs['flush_not']="Make all items expired,be carefully";
$langs['flush_but']="Flush";
?>