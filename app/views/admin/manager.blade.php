{{--Created by vvliebe on 2014/12/24.--}}
{{--Created by vvliebe on 2014/12/23.--}}
<html>
<head>
    {{HTML::style('lib/jqgrid/ui.jqgrid.css')}}
    {{HTML::style('lib/jqgrid/ace.min.css')}}
    {{HTML::style('lib/jqgrid/ace-fonts.css')}}
    {{HTML::style('lib/bootstrap/css/bootstrap.css')}}
    {{HTML::style('lib/jqgrid/font-awesome.min.css')}}
    {{HTML::script('lib/jquery.js')}}
    {{HTML::script('lib/bootstrap/js/bootstrap.js')}}
    {{HTML::script('lib/jqgrid/jquery.jqGrid.min.js')}}
    {{HTML::script('lib/jqgrid/grid.locale-cn.js')}}
</head>
<body style="overflow-x:hidden;">
<div class="row" style="padding: 0;margin:0;">
    <div class="col-sm-12">
        <table id="department-table"></table>
        <div id="department-pager"></div>
    </div>
    <div class="col-sm-12">
        <table id="doctor-table"></table>
        <div id="doctor-pager"></div>
    </div>
    <div class="col-sm-12">
        <table id="visit-table"></table>
        <div id="visit-pager"></div>
    </div>
    <div class="col-sm-12">
        <table id="order-table"></table>
        <div id="order-pager"></div>
    </div>
</div>
</body>
</html>





<script type="text/javascript">

    jQuery(function($) {
        // 这里是标签id
        var grid_selector1 = "#department-table";
        var pager_selector1 = "#department-pager";

        var grid_selector2 = "#doctor-table";
        var pager_selector2 = "#doctor-pager";

        var grid_selector3 = "#visit-table";
        var pager_selector3 = "#visit-pager";

        var grid_selector4 = "#order-table";
        var pager_selector4 = "#order-pager";

        //resize to fit page size
        $(window).on('resize.jqGrid', function () {
            $(grid_selector1).jqGrid( 'setGridWidth', $(".page-content").width() );
        })
        //resize on sidebar collapse/expand
        var parent_column = $(grid_selector1).closest('[class*="col-"]');
        $(document).on('settings.ace.jqGrid' , function(ev, event_name, collapsed) {
            if( event_name === 'sidebar_collapsed' || event_name === 'main_container_fixed' ) {
                $(grid_selector1).jqGrid( 'setGridWidth', parent_column.width() );
            }
        })

        function stuFormatter(cellvalue, options, rowObject) {
            if (cellvalue == 1) return "<span class='green'>完成</span>";
            else return "<span class='orange'>未完成</span>";
        }

        function sexFormatter(cellvalue, options, rowObject) {
            if (cellvalue == 1) return "男";
            else return "女";
        }

        function sexUnFormatter(cellvalue, options, rowObject) {
            if (cellvalue == '男') return 1;
            if (cellvalue == '女') return 0;
        }

        function nativeplaceFormatter(cellvalue, options, rowObject) {
            if (cellvalue == 1) return "城镇";
            else return "农村";
        }

        function nativeplaceUnFormatter(cellvalue, options, rowObject) {
            if (cellvalue == '城镇') return 1;
            if (cellvalue == '农村') return 0;
        }

        function singletonFormatter(cellvalue, options, rowObject) {
            if (cellvalue == 1) return "是";
            else return "否";
        }

        function singletonUnFormatter(cellvalue, options, rowObject) {
            if (cellvalue == '是') return 1;
            if (cellvalue == '否') return 0;
        }

        ///　十分重要　////
        jQuery(grid_selector1).jqGrid({
            /// 获取数据的地址，格式是ＧＥＴ
            url: "/admin/showdepartment",
            datatype: "json",
            height: '400px',

            // 编辑用地址
            editurl: "/admin/departmentmanage",

            // 标题
            caption: "科室",

            // 表头
            colNames:[' ', 'ID','科室','类别','描述','电话'],

            // 和数据库的对应项
            colModel:[
                {name:'myac',index:'', width:80, fixed:true, sortable:false, resize:false,formatter:'actions'
                    ,formatoptions:{
                    keys:true,
                    delOptions:{recreateForm: true, beforeShowForm:beforeDeleteCallback}
                }
                },
                {name:'d_id',index:'d_id', width:60,sortable:true, editable: false, key :true},
                {name:'name',index:'name',width:210,sortable:false, editable:true},
                {name:'class_id',index:'class_id', width:60, sorttype:"int", sortable:true,editable: true},
                {name:'description',index:'description', width:230,sortable:false,editable: true},
                {name:'tel',index:'tel', width:80, sortable:false,editable: true}
//                {name:'tel',index:'tel', width:90, sortable:false,editable: true,
//                    formatter: sexFormatter, unformat: sexUnFormatter }
            ],

            viewrecords : true,
            rowNum:10,
            rowList:[10,20,30],
            pager : pager_selector1,
            altRows: true,
            //toppager: true,

            multiselect: true,
            //multikey: "ctrlKey",
            multiboxonly: true,
            //subgrid options
            subGrid : false,
            onSelectRow: function(ids,status) {
                var id = 0;
                if (status == true) id = ids;
                var row = jQuery(grid_selector1).jqGrid('getRowData',id);
                updateDoctor(row.d_id);
            },
            loadComplete : function() {
                var table = this;
                setTimeout(function(){
                    styleCheckbox(table);

                    updateActionIcons(table);
                    updatePagerIcons(table);
                    enableTooltips(table);
                }, 0);
            },
            shrinkToFit:false,
            autowidth: true
        });

        jQuery(grid_selector2).jqGrid({
            /// 获取数据的地址，格式是ＧＥＴ
            url: "/admin/showdoctor",
            datatype: "json",
            height: '400px',

            // 编辑用地址
            editurl: "/admin/doctormanage",

            // 标题
            caption: "医生信息表格",

            // 表头
            colNames:[' ', 'ID','用户名','密码','姓名','电话','权限'],

            // 和数据库的对应项
            colModel:[
                {name:'myac',index:'', width:80, fixed:true, sortable:false, resize:false,formatter:'actions'
                    ,formatoptions:{
                    keys:true,
                    delOptions:{recreateForm: true, beforeShowForm:beforeDeleteCallback}
                }
                },
                {name:'id',index:'id', width:60,sortable:true, editable: false, key :true},
                {name:'username',index:'username',width:210,sortable:false, editable:true},
                {name:'password',index:'password', width:60, sortable:false,editable: true},
                {name:'name',index:'name', width:60, sortable:false,editable: true},
                {name:'tel',index:'tel', width:60, sortable:false,editable: true},
                {name:'auth',index:'auth', width:230,sortable:false,editable: true}

//                {name:'tel',index:'tel', width:90, sortable:false,editable: true,
//                    formatter: sexFormatter, unformat: sexUnFormatter }
            ],

            viewrecords : true,
            rowNum:10,
            rowList:[10,20,30],
            pager : pager_selector2,
            altRows: true,
            //toppager: true,

            multiselect: true,
            //multikey: "ctrlKey",
            multiboxonly: true,
            //subgrid options
            subGrid : false,
            onSelectRow: function(ids,status) {
                var id = 0;
                if (status == true) id = ids;
                var row = jQuery(grid_selector2).jqGrid('getRowData',id);
                updateVisit(row.id);
            },
            loadComplete : function() {
                var table = this;
                setTimeout(function(){
                    styleCheckbox(table);

                    updateActionIcons(table);
                    updatePagerIcons(table);
                    enableTooltips(table);
                }, 0);
            },
            shrinkToFit:false,
            autowidth: true
        });

        jQuery(grid_selector3).jqGrid({
            /// 获取数据的地址，格式是ＧＥＴ
            url: "/admin/showvisit",
            datatype: "json",
            height: '400px',

            // 编辑用地址
            editurl: "/admin/visitmanage",

            // 标题
            caption: "工作时间表",

            // 表头
            colNames:[' ', 'ID','工作时间','早上','中午','晚上'],

            // 和数据库的对应项
            colModel:[
                {name:'myac',index:'', width:80, fixed:true, sortable:false, resize:false,formatter:'actions'
                    ,formatoptions:{
                    keys:true,
                    delOptions:{recreateForm: true, beforeShowForm:beforeDeleteCallback}
                }
                },
                {name:'v_id',index:'v_id', width:60,sortable:true, editable: false, key :true},
                {name:'work_date',index:'work_date',width:210,sortable:false, editable:true},
                {name:'am',index:'am', width:60, sortable:false,editable: true},
                {name:'pm',index:'pm', width:230,sortable:false,editable: true},
                {name:'ng',index:'ng', width:80, sortable:false,editable: true}

//                {name:'tel',index:'tel', width:90, sortable:false,editable: true,
//                    formatter: sexFormatter, unformat: sexUnFormatter }
            ],

            viewrecords : true,
            rowNum:10,
            rowList:[10,20,30],
            pager : pager_selector3,
            altRows: true,
            //toppager: true,

            multiselect: true,
            //multikey: "ctrlKey",
            multiboxonly: true,
            //subgrid options
            subGrid : false,
            onSelectRow: function(ids,status) {
                var id = 0;
                if (status == true) id = ids;
                var row = jQuery(grid_selector3).jqGrid('getRowData',id);
                updateOrder(row.v_id);
            },
            loadComplete : function() {
                var table = this;
                setTimeout(function(){
                    styleCheckbox(table);

                    updateActionIcons(table);
                    updatePagerIcons(table);
                    enableTooltips(table);
                }, 0);
            },
            shrinkToFit:false,
            autowidth: true
        });

        jQuery(grid_selector4).jqGrid({
            /// 获取数据的地址，格式是ＧＥＴ
            url: "/admin/showorder",
            datatype: "json",
            height: '400px',

            // 编辑用地址
            editurl: "/admin/ordermanage",

            // 标题
            caption: "订单信息表格",

            // 表头
            colNames:[' ', 'ID','患者ID','时间','状态'],

            // 和数据库的对应项
            colModel:[
                {name:'myac',index:'', width:80, fixed:true, sortable:false, resize:false,formatter:'actions'
                    ,formatoptions:{
                    keys:true,
                    delOptions:{recreateForm: true, beforeShowForm:beforeDeleteCallback}
                }
                },
                {name:'o_id',index:'o_id', width:60,sortable:true, editable: false, key :true},
                {name:'owner_id',index:'owner_id',width:210,sortable:false, editable:true},
                {name:'time',index:'time', width:60, sortable:false,editable: true},
                {name:'status',index:'status', width:230,sortable:false,editable: true}

//                {name:'tel',index:'tel', width:90, sortable:false,editable: true,
//                    formatter: sexFormatter, unformat: sexUnFormatter }
            ],

            viewrecords : true,
            rowNum:10,
            rowList:[10,20,30],
            pager : pager_selector4,
            altRows: true,
            //toppager: true,

            multiselect: true,
            //multikey: "ctrlKey",
            multiboxonly: true,
            //subgrid options
            subGrid : false,
            loadComplete : function() {
                var table = this;
                setTimeout(function(){
                    styleCheckbox(table);

                    updateActionIcons(table);
                    updatePagerIcons(table);
                    enableTooltips(table);
                }, 0);
            },
            shrinkToFit:false,
            autowidth: true
        });


        //更新医生表
        function updateDoctor(department_id){
            //此处可以添加对查询数据的合法验证
            $(grid_selector2).jqGrid('setGridParam',{
                datatype:'json',
                postData:{'department_id':department_id}, //发送数据
                page:1
            }).trigger("reloadGrid"); //重新载入
        }
        function updateVisit(doctor_id){
            //此处可以添加对查询数据的合法验证
            $(grid_selector3).jqGrid('setGridParam',{
                datatype:'json',
                postData:{'doctor_id':doctor_id}, //发送数据
                page:1
            }).trigger("reloadGrid"); //重新载入
        }
        function updateOrder(visit_id){
            //此处可以添加对查询数据的合法验证
            $(grid_selector4).jqGrid('setGridParam',{
                datatype:'json',
                postData:{'visit_id':visit_id}, //发送数据
                page:1
            }).trigger("reloadGrid"); //重新载入
        }



        ////////// 此处以下不用看，贴进去用就行了///////////


        $(window).triggerHandler('resize.jqGrid');//trigger window resize to make the grid get the correct size

        //switch element when editing inline
        function aceSwitch( cellvalue, options, cell ) {
            setTimeout(function(){
                $(cell) .find('input[type=checkbox]')
                        .addClass('ace ace-switch ace-switch-5')
                        .after('<span class="lbl"></span>');
            }, 0);
        }
        //enable datepicker
        function pickDate( cellvalue, options, cell ) {
            setTimeout(function(){
                $(cell) .find('input[type=text]')
                        .datepicker({format:'yyyy-mm-dd' , autoclose:true});
            }, 0);
        }


        //navButtons
        jQuery(grid_selector1).jqGrid('navGrid',pager_selector1,
                {   //navbar options
                    edit: true,
                    editicon : 'ace-icon fa fa-pencil blue',
                    add: true,
                    addicon : 'ace-icon fa fa-plus-circle purple',
                    del: true,
                    delicon : 'ace-icon fa fa-trash-o red',
                    search: true,
                    searchicon : 'ace-icon fa fa-search orange',
                    refresh: true,
                    refreshicon : 'ace-icon fa fa-refresh green',
                    view: true,
                    viewicon : 'ace-icon fa fa-search-plus grey'
                },
                {
                    recreateForm: true,
                    beforeShowForm : function(e) {
                        var form = $(e[0]);
                        form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
                        style_edit_form(form);
                    }
                },
                {
                    closeAfterAdd: true,
                    recreateForm: true,
                    viewPagerButtons: false,
                    beforeShowForm : function(e) {
                        var form = $(e[0]);
                        form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar')
                                .wrapInner('<div class="widget-header" />')
                        style_edit_form(form);
                    }
                },
                {
                    //delete record form
                    recreateForm: true,
                    beforeShowForm : function(e) {
                        var form = $(e[0]);
                        if(form.data('styled')) return false;

                        form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
                        style_delete_form(form);

                        form.data('styled', true);
                    },
                    onClick : function(e) {
                        alert(1);
                    }
                },
                {
                    recreateForm: true,
                    afterShowSearch: function(e){
                        var form = $(e[0]);
                        form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
                        style_search_form(form);
                    },
                    afterRedraw: function(){
                        style_search_filters($(this));
                    }
                    ,
                    multipleSearch: true
                },
                {
                    //view record form
                    recreateForm: true,
                    beforeShowForm: function(e){
                        var form = $(e[0]);
                        form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
                    }
                }
        )

        function style_edit_form(form) {
            //enable datepicker on "sdate" field and switches for "stock" field
            form.find('input[name=sdate]').datepicker({format:'yyyy-mm-dd' , autoclose:true})
                    .end().find('input[name=stock]')
                    .addClass('ace ace-switch ace-switch-5').after('<span class="lbl"></span>');
            //update buttons classes
            var buttons = form.next().find('.EditButton .fm-button');
            buttons.addClass('btn btn-sm').find('[class*="-icon"]').hide();//ui-icon, s-icon
            buttons.eq(0).addClass('btn-primary').prepend('<i class="ace-icon fa fa-check"></i>');
            buttons.eq(1).prepend('<i class="ace-icon fa fa-times"></i>')

            buttons = form.next().find('.navButton a');
            buttons.find('.ui-icon').hide();
            buttons.eq(0).append('<i class="ace-icon fa fa-chevron-left"></i>');
            buttons.eq(1).append('<i class="ace-icon fa fa-chevron-right"></i>');
        }

        function style_delete_form(form) {
            var buttons = form.next().find('.EditButton .fm-button');
            buttons.addClass('btn btn-sm btn-white btn-round').find('[class*="-icon"]').hide();//ui-icon, s-icon
            buttons.eq(0).addClass('btn-danger').prepend('<i class="ace-icon fa fa-trash-o"></i>');
            buttons.eq(1).addClass('btn-default').prepend('<i class="ace-icon fa fa-times"></i>')
        }

        function style_search_filters(form) {
            form.find('.delete-rule').val('X');
            form.find('.add-rule').addClass('btn btn-xs btn-primary');
            form.find('.add-group').addClass('btn btn-xs btn-success');
            form.find('.delete-group').addClass('btn btn-xs btn-danger');
        }
        function style_search_form(form) {
            var dialog = form.closest('.ui-jqdialog');
            var buttons = dialog.find('.EditTable')
            buttons.find('.EditButton a[id*="_reset"]').addClass('btn btn-sm btn-info').find('.ui-icon').attr('class', 'ace-icon fa fa-retweet');
            buttons.find('.EditButton a[id*="_query"]').addClass('btn btn-sm btn-inverse').find('.ui-icon').attr('class', 'ace-icon fa fa-comment-o');
            buttons.find('.EditButton a[id*="_search"]').addClass('btn btn-sm btn-purple').find('.ui-icon').attr('class', 'ace-icon fa fa-search');
        }

        function beforeDeleteCallback(e) {
            var form = $(e[0]);
            if(form.data('styled')) return false;

            form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
            style_delete_form(form);

            form.data('styled', true);
        }

        function beforeEditCallback(e) {
            var form = $(e[0]);
            form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
            style_edit_form(form);
        }

        function styleCheckbox(table) {

        }


        function updateActionIcons(table) {
        }

        //replace icons with FontAwesome icons like above
        function updatePagerIcons(table) {
            var replacement =
            {
                'ui-icon-seek-first' : 'ace-icon fa fa-angle-double-left bigger-140',
                'ui-icon-seek-prev' : 'ace-icon fa fa-angle-left bigger-140',
                'ui-icon-seek-next' : 'ace-icon fa fa-angle-right bigger-140',
                'ui-icon-seek-end' : 'ace-icon fa fa-angle-double-right bigger-140'
            };
            $('.ui-pg-table:not(.navtable) > tbody > tr > .ui-pg-button > .ui-icon').each(function(){
                var icon = $(this);
                var $class = $.trim(icon.attr('class').replace('ui-icon', ''));

                if($class in replacement) icon.attr('class', 'ui-icon '+replacement[$class]);
            })
        }

        function enableTooltips(table) {
            $('.navtable .ui-pg-button').tooltip({container:'body'});
            $(table).find('.ui-pg-div').tooltip({container:'body'});
        }
    });

</script>