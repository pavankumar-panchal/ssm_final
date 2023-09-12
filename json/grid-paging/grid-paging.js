Ext.onReady(function(){

    var ds = new Ext.data.Store({
		// HttpProxy should be used here
        proxy: new Ext.data.ScriptTagProxy({
            url: 'http://www.vinylfox.com/yui-ext/examples/grid-paging/grid-paging-data.php'
        }),
		
        reader: new Ext.data.JsonReader({
            root: 'results',
            totalProperty: 'total',
            id: 'id'
        }, [
            {name: 'employee_name', mapping: 'name'},
            {name: 'job_title', mapping: 'title'},
            {name: 'hire_date', mapping: 'hire_date', type: 'date', dateFormat: 'm-d-Y'},
            {name: 'is_active', mapping: 'active'}
        ])
		
    });

    var cm = new Ext.grid.ColumnModel([{
		   id: 'name',
           header: "Name",
           dataIndex: 'employee_name',
           width: 100
        },{
           header: "Title",
           dataIndex: 'job_title',
           width: 170
        },{
           header: "Hire Date",
           dataIndex: 'hire_date',
           width: 70,
		   renderer: Ext.util.Format.dateRenderer('n/j/Y')
        },{
           header: "Active",
           dataIndex: 'is_active',
           width: 50
        }]);

    var grid = new Ext.grid.Grid('grid-paging', {
        ds: ds,
        cm: cm,
		autoExpandColumn: 'name'
    });

    grid.render();

    var gridFoot = grid.getView().getFooterPanel(true);

    var paging = new Ext.PagingToolbar(gridFoot, ds, {
        pageSize: 25,
        displayInfo: true,
        displayMsg: 'Displaying results {0} - {1} of {2}',
        emptyMsg: "No results to display"
    });

    ds.load({params:{start:0, limit:25}});

});