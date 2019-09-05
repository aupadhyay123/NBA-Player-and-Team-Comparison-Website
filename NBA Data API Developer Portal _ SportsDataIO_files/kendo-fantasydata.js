kendo.ui.ColumnSorter.fn._click = function (originalFn) {
    return function (e) {
        var element = this.element,
            dir = element.attr(kendo.attr("dir"));

        if (!dir) element.attr(kendo.attr("dir"), "asc");
        if (dir === "desc") element.attr(kendo.attr("dir"), "");
        if (dir === "asc") element.attr(kendo.attr("dir"), "desc");

        originalFn.call(this, e);
    };
}(kendo.ui.ColumnSorter.fn._click);

//following function is used to fit all the columns per its content
kendo.ui.Grid.fn.fitColumns = function (parentColumn) {
    var grid = this;
    var columns = grid.columns;
    if (parentColumn && parentColumn.columns)
        columns = parentColumn.columns;
    columns.forEach(function (col) {
        //recursive call for the grouped columns
        if (col.columns)
            return grid.fitColumns(col);

        if (!col.width) {
            grid.autoFitColumn(col);
            //$(col).attr("fluid", true);
        }
    });

    setTimeout(function () {
        $(".k-grid-content-locked").height("auto");
    }, 10)
    //if ($(".k-grid-content-locked").first()) {
    //    var lock_height = $(".k-grid-content-locked").height();
    //    var content_height = $(".k-grid-content").height();

    //    if (lock_height < content_height)
    //        $(".k-grid-content-locked").height(content_height);
    //}
    //this will expand columns if empty space is left
}//fitColumns

//this will expand all the column sizes within kendo grid if
//there empty space left after autofit
kendo.ui.Grid.fn.expandToFit = function () {
    var $gridHeaderTable = this.thead.closest('table');
    var gridDataWidth = $gridHeaderTable.width();
    var gridWrapperWidth = $gridHeaderTable.closest('.k-grid-header-wrap').innerWidth() - 5;
    // Since this is called after column auto-fit, reducing size
    // of columns would overflow data.

    setTimeout(function () {
        $(".k-grid-content-locked").height("auto");
    }, 10)

    if (gridDataWidth >= gridWrapperWidth) {
        return;
    }

    var $headerCols = $gridHeaderTable.find('colgroup > col');
    var $tableCols = this.table.find('colgroup > col');

    var sizeFactor = (gridWrapperWidth / gridDataWidth);
    $headerCols.add($tableCols).not('.k-group-col').each(function () {
        var currentWidth = $(this).width();
        var newWidth = (currentWidth * sizeFactor);
        $(this).css({
            width: newWidth
        });
    });
}//expandToFit


//apply row numbers
kendo.ui.Grid.fn.applyRowNumbers = function () {
    var grid = this;
    var rows = this.items();
    $(rows).each(function (index, item) {
        $(this).find(".row-number").html(index + 1);
    });
}

//scramble and show upgrade box
kendo.ui.Grid.fn.scramble = function () {
    var grid = this;
    var rows = this.items();
    $(rows).each(function (index, item) {
        var dataitem = grid.dataItem(item);
        if (dataitem.IsScrambled)
            $(this).addClass("scrambled");
    });

    setTimeout(function () {
        var upgradebox = $(".upgrade-box-container").clone();
        var scrambled = $('.k-grid-content .scrambled').first();
        if (scrambled) {
            var cnt = $(scrambled).find("td").length;
            var boxrow = $("<tr></tr>");
            var td = $("<td style='height: 0px; padding: 0px;' colspan='" + cnt + "'></td>");
            $(upgradebox).appendTo(td);
            $(td).appendTo(boxrow);
            $(scrambled).before(boxrow);
            $(upgradebox).show();
        }
        //if ($('.k-grid-content .scrambled').first()) {
        //    $(upgradebox).appendTo($('.k-grid-content .scrambled').first())
        //    $(upgradebox).show();
        //}
    }, 50)
   
}

//scramble and show upgrade box
kendo.ui.Grid.fn.applySort = function () {
    var grid = this;
    setTimeout(function () {
        var headers = $(".k-grid-header-wrap th:not([colspan])");
        var sorted = $(headers).filter(".k-sorted");
        if (sorted) {
            var cols = new Array();
            $.each(grid.columns, function (index, column) {
                if (!column.locked) {
                    if (!column.columns)
                        cols.push(column);
                    else
                        cols = cols.concat(column.columns);
                }
            });

            var field = sorted.attr("data-field");
            if (field) {
                var index = cols.findIndex(function (col) { return col.field == field }) + 1;
                $(".k-grid-content").find("tr td:nth-child(" + index + ")").addClass("k-sorted");
            }
        }
    }, grid, 10);
}

kendo.ui.Grid.fn.fitHeightToContent = function () {
    var contentHeight = $(".k-grid-content table").height();
    $(".k-grid-content").animate({ height: contentHeight + 20 }, 200);
    $('.k-grid').height('auto');
}

kendo.ui.Grid.fn.printColumnWidths = function () {
    var grid = this;
    $.each(grid.columns, function (index, column) {
        if (column.columns) {
            $.each(column.columns, function (sub_index, sub_column) {
                console.log(sub_column.field + ": " + sub_column.width);
            });
        }
        else
            console.log(column.field + ": " + column.width);
    });
}