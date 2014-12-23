{{--Created by vvliebe on 2014/12/23.--}}
<html>
    <head>
        {{--<link rel="stylesheet" href="js/jqGrid/css/ui.jqgrid.css">--}}
        {{--<link rel="stylesheet" href="css/ace.min.css">--}}
        {{--<link rel="stylesheet" href="css/ace-fonts.css">--}}
        {{--<link rel="stylesheet" href="css/font-awesome.min.css">--}}
        {{--'jqGrid/jquery.jqGrid.min.js',--}}
        {{--'jqGrid/js/i18n/grid.locale-cn.js'--}}
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
    <body style="overflow: hidden;padding: 0px;">
        <div class="row" style="padding: 0;margin:0;">
            <ul class="nav nav-pills nav-stacked col-sm-2" role="tablist" style="margin: 0;">
                <li role="presentation" class="active">
                    <a href="#home" role="tab" data-toggle="tab">医院管理</a>
                </li>
                <li role="presentation">
                    <a href="#profile" role="tab" data-toggle="tab">医院管理员管理</a>
                </li>
            </ul>
            <div class="tab-content col-sm-10" style="padding: 0px;">
                <div role="tabpanel" class="tab-pane active" id="home">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="grid-table"></table>
                            <div id="grid-pager"></div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="profile">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="doctor-table"></table>
                            <div id="doctor-pager"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>





<script type="text/javascript">

    jQuery(function($) {
        // 这里是标签id
        var grid_selector = "#grid-table";
        var pager_selector = "#grid-pager";

        var grid_selector2 = "#doctor-table";
        var pager_selector2 = "#doctor-pager";

        //resize to fit page size
        $(window).on('resize.jqGrid', function () {
            $(grid_selector).jqGrid( 'setGridWidth', $(".page-content").width() );
        })
        //resize on sidebar collapse/expand
        var parent_column = $(grid_selector).closest('[class*="col-"]');
        $(document).on('settings.ace.jqGrid' , function(ev, event_name, collapsed) {
            if( event_name === 'sidebar_collapsed' || event_name === 'main_container_fixed' ) {
                $(grid_selector).jqGrid( 'setGridWidth', parent_column.width() );
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
        jQuery(grid_selector).jqGrid({
            /// 获取数据的地址，格式是ＧＥＴ
            url: "/admin/showhospital",
            datatype: "json",
            height: '400px',

            // 编辑用地址
            editurl: "/admin/hospitalmanage",

            // 标题
            caption: "医院管理表格",

            // 表头
            colNames:[' ', 'ID','医院','预约价格','地址','省份','等级','电话'],

            // 和数据库的对应项
            colModel:[
                {name:'myac',index:'', width:80, fixed:true, sortable:false, resize:false,formatter:'actions'
                    ,formatoptions:{
                    keys:true,
                    delOptions:{recreateForm: true, beforeShowForm:beforeDeleteCallback}
                }
                },
                {name:'h_id',index:'h_id', width:60,sortable:true, editable: false, key :true},
                {name:'name',index:'name',width:210,sortable:false, editable:true},
                {name:'price',index:'price', width:60, sorttype:"int", sortable:true,editable: true},
                {name:'address',index:'address', width:230,sortable:false,editable: true},
                {name:'province',index:'province', width:80, sortable:false,editable: true},
                {name:'rank',index:'rank', width:80,sortable:false, editable: true},
                {name:'tel',index:'tel', width:120, sortable:false, editable: true }
//                {name:'tel',index:'tel', width:90, sortable:false,editable: true,
//                    formatter: sexFormatter, unformat: sexUnFormatter }
            ],

            viewrecords : true,
            rowNum:10,
            rowList:[10,20,30],
            pager : pager_selector,
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

        jQuery(grid_selector2).jqGrid({
            /// 获取数据的地址，格式是ＧＥＴ
            url: "/admin/showadmin",
            datatype: "json",
            height: '400px',

            // 编辑用地址
            editurl: "/admin/adminmanage",

            // 标题
            caption: "管理员信息表格",

            // 表头
            colNames:[' ', 'ID','用户名','密码','权限','医院ID'],

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
                {name:'auth',index:'auth', width:230,sortable:false,editable: true},
                {name:'hospital_id',index:'hospital_id', width:80, sortable:false,editable: true}

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
        jQuery(grid_selector).jqGrid('navGrid',pager_selector,
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